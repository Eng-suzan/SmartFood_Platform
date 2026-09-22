<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\OrderItem;
class AdminController extends Controller
{
    /**
     * Admin Dashboard
     */
   public function dashboard(): View
{
    // Users
    $totalUsers = User::count();


    // Restaurants
    $totalRestaurants = Restaurant::count();

    $pendingRestaurants = Restaurant::where('status', 'pending')->count();

    $approvedRestaurants = Restaurant::where('status', 'approved')->count();


    // Orders
    $totalOrders = Order::count();

    $pendingOrders = Order::where('status', 'pending')->count();

    $confirmedOrders = Order::where('status', 'confirmed')->count();

    $preparingOrders = Order::where('status', 'preparing')->count();

    $outForDeliveryOrders = Order::where('status', 'out_for_delivery')->count();

    $deliveredOrders = Order::where('status', 'delivered')->count();

    $cancelledOrders = Order::where('status', 'cancelled')->count();


    // Revenue
    $totalRevenue = Payment::where('status', 'paid')
        ->sum('amount');


    // Average delivered order value
    $averageOrderValue = Order::where('status', 'delivered')
        ->avg('total_amount');

        $topRestaurants = Restaurant::withCount('orders')
    ->withSum([
        'orders as revenue' => function ($query) {
            $query->where('status', 'delivered');
        }
    ], 'total_amount')
    ->orderByDesc('orders_count')
    ->take(5)
    ->get();

    // Pending restaurants
    $restaurants = Restaurant::with('owner')
        ->where('status', 'pending')
        ->latest()
        ->get();


    return view('admin.dashboard', compact(
        'totalUsers',
        'totalRestaurants',
        'pendingRestaurants',
        'approvedRestaurants',

        'totalOrders',
        'pendingOrders',
        'confirmedOrders',
        'preparingOrders',
        'outForDeliveryOrders',
        'deliveredOrders',
        'cancelledOrders',

        'totalRevenue',
        'averageOrderValue',
'topRestaurants',
        'restaurants',
    ));
}
public function analytics(): View
{
    $pendingOrders = Order::where('status', 'pending')->count();

    $confirmedOrders = Order::where('status', 'confirmed')->count();

    $preparingOrders = Order::where('status', 'preparing')->count();

    $outForDeliveryOrders = Order::where('status', 'out_for_delivery')->count();

    $deliveredOrders = Order::where('status', 'delivered')->count();

    $cancelledOrders = Order::where('status', 'cancelled')->count();

    $averageOrderValue = Order::where('status', 'delivered')
        ->avg('total_amount');


    /*
    |--------------------------------------------------------------------------
    | Orders Chart
    |--------------------------------------------------------------------------
    */

    $orderStatusLabels = [
        'Pending',
        'Confirmed',
        'Preparing',
        'Out for Delivery',
        'Delivered',
        'Cancelled',
    ];

    $orderStatusData = [
        $pendingOrders,
        $confirmedOrders,
        $preparingOrders,
        $outForDeliveryOrders,
        $deliveredOrders,
        $cancelledOrders,
    ];


    /*
    |--------------------------------------------------------------------------
    | Sales Chart
    |--------------------------------------------------------------------------
    */

    $salesByDate = Order::where('status', 'delivered')
        ->selectRaw('DATE(created_at) as date, SUM(total_amount) as total')
        ->groupByRaw('DATE(created_at)')
        ->orderBy('date')
        ->get();

    $salesLabels = $salesByDate
        ->pluck('date')
        ->values();

    $salesData = $salesByDate
        ->pluck('total')
        ->map(fn ($value) => (float) $value)
        ->values();


    /*
    |--------------------------------------------------------------------------
    | Top Selling Items
    |--------------------------------------------------------------------------
    */

    $topSellingItems = OrderItem::with([
        'menuItem.restaurant'
    ])
        ->whereHas('order', function ($query) {
            $query->where('status', 'delivered');
        })
        ->selectRaw(
            'menu_item_id,
            SUM(quantity) as total_quantity,
            SUM(quantity * price) as total_sales'
        )
        ->groupBy('menu_item_id')
        ->orderByDesc('total_quantity')
        ->take(10)
        ->get();


    return view('admin.analytics', compact(
        'pendingOrders',
        'confirmedOrders',
        'preparingOrders',
        'outForDeliveryOrders',
        'deliveredOrders',
        'cancelledOrders',
        'averageOrderValue',
        'orderStatusLabels',
        'orderStatusData',
        'salesLabels',
        'salesData',
        'topSellingItems'
    ));
}
    /**
     * Approve restaurant
     */
    public function approve(Restaurant $restaurant): RedirectResponse
    {
        $restaurant->update([
            'status' => 'approved',
        ]);

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Restaurant approved successfully.');
    }

    /**
     * Reject restaurant
     */
    public function reject(Restaurant $restaurant): RedirectResponse
    {
        $restaurant->update([
            'status' => 'rejected',
        ]);

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Restaurant rejected successfully.');
    }
}