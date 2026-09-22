<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display the user's cart.
     */
    public function index()
    {
        $cart = Cart::with([
            'restaurant',
            'items.menuItem'
        ])
        ->where('user_id', Auth::id())
        ->first();

        return view('cart.index', compact('cart'));
    }


    /**
     * Add menu item to cart.
     */
    public function store(Request $request, MenuItem $menuItem)
{
    $user = Auth::user();

    $restaurant = $menuItem->restaurant;

    // Check restaurant opening time
    if (!$restaurant->isOpenNow()) {
        return back()->with(
            'error', 'Sorry, this restaurant is currently closed.'
        );
    }

    // Check food availability
    if (!$menuItem->is_available) {
        return back()->with(
            'error',      'This item is currently unavailable.'
        );
    }

    $restaurantId = $menuItem->restaurant_id;

    // Get user's current cart
    $cart = Cart::where('user_id', $user->id)->first();

    // Cart contains another restaurant
    if ($cart && $cart->restaurant_id != $restaurantId) {

        return back()->with(
            'error',
            'Your cart contains items from another restaurant. Please clear your cart first.'
        );
    }

    // Create cart if it doesn't exist
    if (!$cart) {

        $cart = Cart::create([
            'user_id' => $user->id,
            'restaurant_id' => $restaurantId,
        ]);
    }

    // Check if this item already exists
    $cartItem = $cart->items()
        ->where('menu_item_id', $menuItem->id)
        ->first();

    if ($cartItem) {

        // Increase quantity
        $cartItem->increment('quantity');

    } else {

        // Add new item
        $cart->items()->create([
            'menu_item_id' => $menuItem->id,
            'quantity' => 1,
            'price' => $menuItem->price,
        ]);
    }

    // Go directly to Cart
    return redirect()
        ->route('cart.index')
        ->with(
            'success',
            'Item added to cart successfully.'
        );
}


    /**
     * Update cart item quantity.
     */
    public function update(
        Request $request,
        CartItem $cartItem
    ) {

        $request->validate([
            'quantity' => [
                'required',
                'integer',
                'min:1',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Make sure item belongs to current user
        |--------------------------------------------------------------------------
        */

        if (
            $cartItem->cart->user_id != Auth::id()
        ) {

            abort(403);
        }


        $cartItem->update([
            'quantity' => $request->quantity,
        ]);


        return back()->with(
            'success',
            'Cart updated successfully.'
        );
    }


    /**
     * Remove item from cart.
     */
    public function destroy(CartItem $cartItem)
    {
        if (
            $cartItem->cart->user_id != Auth::id()
        ) {

            abort(403);
        }


        $cartItem->delete();


        return back()->with(
            'success',
            'Item removed from cart.'
        );
    }


    /**
     * Clear the whole cart.
     */
    public function clear()
    {
        $cart = Cart::where(
            'user_id',
            Auth::id()
        )->first();


        if ($cart) {

            $cart->items()->delete();

            $cart->delete();
        }


        return back()->with(
            'success',
            'Cart cleared successfully.'
        );
    }
    /**
 * Add menu item to cart from AI.
 */

public function addFromAI(Request $request)
{
    $request->validate([
        'items' => 'required|array|min:1',
        'items.*.menu_item_name' => 'required|string',
        'items.*.quantity' => 'nullable|integer|min:1',
    ]);

    try {

        $addedItems = [];

        foreach ($request->items as $item) {

            /*
            |--------------------------------------------------------------------------
            | Find Menu Item
            |--------------------------------------------------------------------------
            */

            $menuItem = MenuItem::where(
                'name',
                $item['menu_item_name']
            )
            ->where('is_available', true)
            ->first();

            if (!$menuItem) {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | Get Restaurant
            |--------------------------------------------------------------------------
            */

            $restaurant = $menuItem->restaurant;

            if (!$restaurant) {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | Restaurant must be approved
            |--------------------------------------------------------------------------
            */

            if ($restaurant->status !== 'approved') {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | Restaurant must be open
            |--------------------------------------------------------------------------
            */

            if (!$restaurant->isOpenNow()) {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | Get existing cart
            |--------------------------------------------------------------------------
            */

            $cart = Cart::where(
                'user_id',
                Auth::id()
            )->first();


            /*
            |--------------------------------------------------------------------------
            | Create cart if it doesn't exist
            |--------------------------------------------------------------------------
            */

            if (!$cart) {

                $cart = Cart::create([
                    'user_id' => Auth::id(),
                    'restaurant_id' => $restaurant->id,
                ]);

            } else {

                /*
                |--------------------------------------------------------------------------
                | Prevent mixing restaurants
                |--------------------------------------------------------------------------
                */

                if (
                    $cart->restaurant_id &&
                    $cart->restaurant_id != $restaurant->id
                ) {

                    return response()->json([
                        'success' => false,
                        'message' =>
                            '⚠️ مينفعش تضيف أكل من مطعم مختلف في نفس السلة.'
                    ], 422);
                }


                /*
                |--------------------------------------------------------------------------
                | Make sure restaurant_id exists
                |--------------------------------------------------------------------------
                */

                if (!$cart->restaurant_id) {

                    $cart->restaurant_id =
                        $restaurant->id;

                    $cart->save();
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Quantity
            |--------------------------------------------------------------------------
            */

            $quantity =
                $item['quantity'] ?? 1;


            /*
            |--------------------------------------------------------------------------
            | Check existing cart item
            |--------------------------------------------------------------------------
            */

            $cartItem = CartItem::where(
                'cart_id',
                $cart->id
            )
            ->where(
                'menu_item_id',
                $menuItem->id
            )
            ->first();


            if ($cartItem) {

                $cartItem->quantity += $quantity;

                $cartItem->save();

            } else {

                CartItem::create([
                    'cart_id' => $cart->id,
                    'menu_item_id' => $menuItem->id,
                    'quantity' => $quantity,
                    'price' => $menuItem->price,
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | Save added item
            |--------------------------------------------------------------------------
            */

            $addedItems[] = [
                'name' => $menuItem->name,
                'quantity' => $quantity,
                'price' => $menuItem->price,
            ];
        }


        /*
        |--------------------------------------------------------------------------
        | Nothing was added
        |--------------------------------------------------------------------------
            */

        if (empty($addedItems)) {

            return response()->json([
                'success' => false,
                'message' =>
                    '❌ مقدرتش أضيف الأصناف المطلوبة للعربة.'
            ], 422);
        }


        /*
        |--------------------------------------------------------------------------
        | Confirmation message
        |--------------------------------------------------------------------------
        */

        $messages = [];

        foreach ($addedItems as $added) {

            $messages[] =
                "✅ ضفت {$added['quantity']} × {$added['name']} للعربة.";
        }


        return response()->json([
            'success' => true,
            'message' => implode('<br>', $messages),
            'items' => $addedItems,
        ]);


    } catch (\Throwable $e) {

        return response()->json([
            'success' => false,
            'message' =>
                'حدث خطأ أثناء إضافة الأصناف للعربة.',
            'error' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile(),
        ], 500);
    }
}

}

