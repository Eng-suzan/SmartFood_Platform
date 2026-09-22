<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Order $order)
    {
        // Make sure the order belongs to the logged-in customer
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Review only after Delivered
        if ($order->status !== 'delivered') {
            return back()->with('error', 'You can review the order only after it is delivered.');
        }

        // Prevent duplicate review
        if (Review::where('order_id', $order->id)->exists()) {
            return back()->with('error', 'You have already reviewed this order.');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'restaurant_id' => $order->restaurant_id,
            'order_id' => $order->id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'] ?? null,
        ]);

        return back()->with('success', 'Thank you for your review! ⭐');
    }
}