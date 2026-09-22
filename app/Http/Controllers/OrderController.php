<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\OrderStatusNotification;
class OrderController extends Controller
{
    /**
     * Display user's orders.
     */
    public function index()
    {
        $orders = Order::with('restaurant')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Display a specific order for customer.
     */
    public function show(Order $order)
    {
        // Customer can only view his own orders
        abort_if($order->user_id !== Auth::id(), 403);

        $order->load([
            'restaurant',
            'items.menuItem',
        ]);

        return view('orders.show', compact('order'));
    }


    /**
     * Display orders for restaurant owner.
     */
  public function restaurantOrders(\App\Models\Restaurant $restaurant)
{
    // تأكيد إن المطعم ده بتاع الـ owner الحالي
    abort_if($restaurant->owner_id !== Auth::id(), 403);

    $orders = Order::with([
        'user',
        'restaurant',
        'items.menuItem',
    ])
    ->where('restaurant_id', $restaurant->id)
    ->latest()
    ->get();

    return view('restaurant.orders.index', compact(
        'orders',
        'restaurant'
    ));
}
    /**
     * Update order status by restaurant owner.
     */
    public function updateStatus(Request $request, Restaurant $restaurant, Order $order)
{
    if ($restaurant->owner_id !== auth()->id()) {
        abort(403);
    }

    if ($order->restaurant_id !== $restaurant->id) {
        abort(403);
    }

    $request->validate([
        'status' => 'required|in:pending,confirmed,preparing,out_for_delivery,delivered,cancelled',
    ]);

    $order->update([
        'status' => $request->status,
    ]);
       $order->user->notify(
        new OrderStatusNotification($order, $request->status)
    );

    return back()->with('success', 'Order status updated successfully.');
}

public function destroy(Order $order)
{
// Make sure the order belongs to the logged-in customer
if ($order->user_id !== auth()->id()) {
abort(403);
}

$order->delete();

return redirect()
    ->route('orders.index')
    ->with('success', 'Order deleted successfully.');


}

}

