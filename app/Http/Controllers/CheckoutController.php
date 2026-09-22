<?php

namespace App\Http\Controllers;

use App\Notifications\NewOrderNotification;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Show checkout page
     */
    public function index()
    {
        $cart = Cart::with([
            'restaurant',
            'items.menuItem'
        ])
        ->where('user_id', Auth::id())
        ->first();

        // Cart empty
        if (!$cart || $cart->items->count() === 0) {
            return redirect()
                ->route('restaurants.index')
                ->with('error', 'Your cart is empty.');
        }

        // Restaurant closed
        if (!$cart->restaurant->isOpenNow()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'This restaurant is currently closed.');
        }

        // Calculate subtotal
        $subtotal = $cart->items->sum(
            fn ($item) => $item->price * $item->quantity
        );

        return view(
            'checkout.index',
            compact('cart', 'subtotal')
        );
    }

    /**
     * Process checkout
     */
    public function store(Request $request)
    {
        // Validate checkout data
        $request->validate([
            'delivery_address' => [
                'required',
                'string',
                'max:500',
            ],

            'payment_method' => [
                'required',
                'in:cash,card',
            ],
        ]);

        // Get cart
        $cart = Cart::with([
            'restaurant',
            'items.menuItem'
        ])
        ->where('user_id', Auth::id())
        ->first();

        // Cart empty
        if (!$cart || $cart->items->count() === 0) {
            return redirect()
                ->route('restaurants.index')
                ->with('error', 'Your cart is empty.');
        }

        // Check restaurant is still open
        if (!$cart->restaurant->isOpenNow()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'This restaurant is currently closed.');
        }

        /*
        |--------------------------------------------------------------------------
        | Card Payment
        |--------------------------------------------------------------------------
        */

        if ($request->payment_method === 'card') {

            session([
                'checkout.delivery_address' =>
                    $request->delivery_address,
            ]);

            return redirect()
                ->route('payment.create');
        }

        /*
        |--------------------------------------------------------------------------
        | Cash on Delivery
        |--------------------------------------------------------------------------
        */

        $order = DB::transaction(function () use (
            $cart,
            $request
        ) {

            // Calculate total
            $total = $cart->items->sum(
                fn ($item) =>
                    $item->price * $item->quantity
            );

            // Create Order
            $order = Order::create([
                'user_id' =>
                    Auth::id(),

                'restaurant_id' =>
                    $cart->restaurant_id,

                'total_amount' =>
                    $total,

                'status' =>
                    'pending',

                'delivery_address' =>
                    $request->delivery_address,
            ]);

            // Create Order Items
            foreach ($cart->items as $cartItem) {

                OrderItem::create([
                    'order_id' =>
                        $order->id,

                    'menu_item_id' =>
                        $cartItem->menu_item_id,

                    'quantity' =>
                        $cartItem->quantity,

                    'price' =>
                        $cartItem->price,
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Create Cash Payment
            |--------------------------------------------------------------------------
            */

            Payment::create([
                'order_id' =>
                    $order->id,

                'amount' =>
                    $total,

                'method' =>
                    'cash',

                'status' =>
                    'pending',

                'transaction_id' =>
                    null,

                'paid_at' =>
                    null,
            ]);

            // Clear cart
            $cart->items()->delete();
            $cart->delete();

            return $order;
        });

        /*
        |--------------------------------------------------------------------------
        | Notify Restaurant
        |--------------------------------------------------------------------------
        */

        $order->load('restaurant.owner');

        $order->restaurant->owner->notify(
            new NewOrderNotification($order)
        );

        return redirect()
            ->route('orders.index')
            ->with(
                'success',
                'Your order has been placed successfully!'
            );
    }
}