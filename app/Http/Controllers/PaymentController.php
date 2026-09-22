<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Notifications\NewOrderNotification;
use App\Services\PayPalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Show payment page.
     */
    public function create()
    {
        $cart = Cart::with([
            'restaurant',
            'items.menuItem',
        ])
            ->where('user_id', Auth::id())
            ->first();

        if (!$cart || $cart->items->count() === 0) {
            return redirect()
                ->route('restaurants.index')
                ->with('error', 'Your cart is empty.');
        }

        if (!$cart->restaurant->isOpenNow()) {
            return redirect()
                ->route('cart.index')
                ->with(
                    'error',
                    'This restaurant is currently closed.'
                );
        }

        $amount = $cart->items->sum(
            fn($item) => $item->price * $item->quantity
        );

        $deliveryAddress = session(
            'checkout.delivery_address'
        );

        if (!$deliveryAddress) {
            return redirect()
                ->route('checkout.index')
                ->with(
                    'error',
                    'Please complete checkout first.'
                );
        }

        return view('payment.create', [
            'amount' => $amount,
            'delivery_address' => $deliveryAddress,
        ]);
    }

    /**
     * Create PayPal order.
     */
    public function createPayPalOrder(PayPalService $paypal) //Dependency Injection
    {
        $cart = Cart::with([
            'restaurant',
            'items.menuItem',
        ])
            ->where('user_id', Auth::id())
            ->first();

        if (!$cart || $cart->items->count() === 0) {
            return redirect()
                ->route('restaurants.index')
                ->with(
                    'error',
                    'Your cart is empty.'
                );
        }

        if (!$cart->restaurant->isOpenNow()) {
            return redirect()
                ->route('cart.index')
                ->with(
                    'error',
                    'This restaurant is currently closed.'
                );
        }

        $deliveryAddress = session(
            'checkout.delivery_address'
        );

        if (!$deliveryAddress) {
            return redirect()
                ->route('checkout.index')
                ->with(
                    'error',
                    'Please complete checkout first.'
                );
        }

        $amount = $cart->items->sum(
            fn($item) => $item->price * $item->quantity
        );

        try {
            $paypalOrder = $paypal->createOrder(
                (float) $amount
            );

            if (
                empty($paypalOrder['id']) ||
                empty($paypalOrder['links'])
            ) {
                return back()->with(
                    'error',
                    'Unable to create PayPal payment.'
                );
            }

            session([
                'paypal_order_id' => $paypalOrder['id'],
            ]);

            foreach ($paypalOrder['links'] as $link) {
                if (
                    isset($link['rel']) &&
                    $link['rel'] === 'approve'
                ) {
                    return redirect()->away(
                        $link['href']
                    );
                }
            }

            return back()->with(
                'error',
                'PayPal approval link was not found.'
            );
        } catch (\Throwable $e) {

            return back()->with(
                'error',
                'PayPal error: ' . $e->getMessage()
            );
        }
    }

    /**
     * PayPal success callback.
     */
    public function success(
        Request $request,
        PayPalService $paypal
    ) {
        $paypalOrderId = $request->query('token');

        if (!$paypalOrderId) {
            $paypalOrderId = session(
                'paypal_order_id'
            );
        }

        if (!$paypalOrderId) {
            return redirect()
                ->route('cart.index')
                ->with(
                    'error',
                    'PayPal payment session not found.'
                );
        }

        try {

            /*
             * Capture PayPal payment.
             */
            $paypalData = $paypal->captureOrder($paypalOrderId);

            if (($paypalData['status'] ?? null)  !== 'COMPLETED') {
                return redirect()->route('cart.index')
                    ->with('error', 'PayPal payment was not completed.');
            }

            /*
             * Get current cart.
             */
            $cart = Cart::with(['restaurant',  'items.menuItem',])
                ->where('user_id', Auth::id())->first();

            if (!$cart || $cart->items->count() === 0) {
                return redirect()
                    ->route('orders.index')
                    ->with('error',  'Cart is empty.');
            }

            /*
             * Calculate total.
             */
            $total = $cart->items->sum( fn($item) => $item->price * $item->quantity );

            /*
             * Delivery address.
             */
            $deliveryAddress = session(  'checkout.delivery_address'     );

            if (!$deliveryAddress) {
                return redirect()
                    ->route('checkout.index')
                    ->with(   'error','Delivery address not found.'    );
            }

            /*
             * Get PayPal capture ID.
             */
            $transactionId =
                $paypalData['purchase_units'][0]['payments']['captures'][0]['id']
                ?? $paypalOrderId;

            /*
             * Create Order + Order Items + Payment.
             */
            $order = DB::transaction(
                function () use (
                    $cart,
                    $total,
                    $deliveryAddress,
                    $transactionId
                ) {

                    $order = Order::create([
                        'user_id' => Auth::id(),

                        'restaurant_id' =>
                        $cart->restaurant_id,

                        'total_amount' => $total,

                        'status' => 'pending',

                        'delivery_address' => $deliveryAddress,
                    ]);

                    foreach (
                        $cart->items   as $cartItem
                    ) {

                        OrderItem::create([
                            'order_id' => $order->id,

                            'menu_item_id' =>
                            $cartItem->menu_item_id,

                            'quantity' =>
                            $cartItem->quantity,

                            'price' =>
                            $cartItem->price,
                        ]);
                    }

                    Payment::create([
                        'order_id' => $order->id,

                        'amount' => $total,

                        'method' => 'paypal',

                        'status' => 'paid',

                        'transaction_id' =>
                        $transactionId,

                        'paid_at' => now(),
                    ]);

                    /*
                     * Clear cart.
                     */
                    $cart->items()->delete();

                    $cart->delete();

                    return $order;
                }
            );

            /*
             * Clear checkout session.
             */
            session()->forget([
                'checkout',
                'paypal_order_id',
            ]);

            /*
             * Notify restaurant owner.
             */
            $order->load(
                'restaurant.owner'
            );

            if (
                $order->restaurant &&
                $order->restaurant->owner
            ) {

                $order
                    ->restaurant
                    ->owner
                    ->notify(
                        new NewOrderNotification(
                            $order
                        )
                    );
            }

            return redirect()
                ->route('orders.index')
                ->with(
                    'success',
                    'Payment successful! Your order has been placed.'
                );
        } catch (\Throwable $e) {

            dd([
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
        }
    }

    /**
     * PayPal cancelled callback.
     */
    public function cancel()
    {
        session()->forget(
            'paypal_order_id'
        );

        return redirect()
            ->route('cart.index')
            ->with(
                'error',
                'PayPal payment was cancelled.'
            );
    }
}
