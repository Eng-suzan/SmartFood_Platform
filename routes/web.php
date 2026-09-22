<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\NotificationController;
use App\Models\Restaurant;
use App\Http\Controllers\ChatController;
use App\Models\Category;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    $restaurants = Restaurant::where('status', 'approved')
        ->latest()
        ->take(10)
        ->get();

    $categories = Category::latest()
        ->take(10)
        ->get();

    return view('home', compact(
        'restaurants',
        'categories'
    ));

})->name('home');


/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    return view('dashboard');

})
->middleware(['auth', 'verified'])
->name('dashboard');


/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');

});


/*
|--------------------------------------------------------------------------
| Public Restaurants
|--------------------------------------------------------------------------
|
| أي مستخدم يقدر يشوف المطاعم المعتمدة.
|
*/

Route::get(
    '/restaurants',
    [RestaurantController::class, 'index']
)->name('restaurants.index');

Route::get(
    '/restaurants/{restaurant}',
    [RestaurantController::class, 'show']
)->name('restaurants.show');


/*
|--------------------------------------------------------------------------
| Public Categories
|--------------------------------------------------------------------------
*/

Route::get(
    '/categories',
    [CategoryController::class, 'publicIndex']
)->name('categories.index');

Route::get(
    '/categories/{category}',
    [CategoryController::class, 'show']
)->name('categories.show');
Route::get(
    '/menu-items/{menuItem}',
    [MenuItemController::class, 'show']
)->name('menu-items.show');

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
|
| Admin فقط
|
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Admin Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/dashboard',
        [AdminController::class, 'dashboard']
    )->name('admin.dashboard');

Route::get('/admin/analytics', [AdminController::class, 'analytics'])
    ->name('admin.analytics');
    /*
    |--------------------------------------------------------------------------
    | Restaurant Approval
    |--------------------------------------------------------------------------
    */

    Route::patch(
        '/admin/restaurants/{restaurant}/approve',
        [AdminController::class, 'approve']
    )->name('admin.restaurants.approve');

    Route::patch(
        '/admin/restaurants/{restaurant}/reject',
        [AdminController::class, 'reject']
    )->name('admin.restaurants.reject');
Route::get('/admin/restaurants', [RestaurantController::class, 'adminIndex'])
    ->name('admin.restaurants.index');

Route::delete('/admin/restaurants/{restaurant}', [RestaurantController::class, 'destroyAdmin'])
    ->name('admin.restaurants.destroy');
    /*
    |--------------------------------------------------------------------------
    | Admin Categories
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/categories',
        [CategoryController::class, 'index']
    )->name('admin.categories.index');

    Route::get(
        '/admin/categories/create',
        [CategoryController::class, 'create']
    )->name('admin.categories.create');

    Route::post(
        '/admin/categories',
        [CategoryController::class, 'store']
    )->name('admin.categories.store');

    Route::get(
        '/admin/categories/{category}/edit',
        [CategoryController::class, 'edit']
    )->name('admin.categories.edit');

    Route::patch(
        '/admin/categories/{category}',
        [CategoryController::class, 'update']
    )->name('admin.categories.update');

    Route::delete(
        '/admin/categories/{category}',
        [CategoryController::class, 'destroy']
    )->name('admin.categories.destroy');

});


/*
|--------------------------------------------------------------------------
| Restaurant Owner
|--------------------------------------------------------------------------
|
| Restaurant Owner فقط
|
*/

Route::middleware(['auth', 'role:restaurant'])
    ->prefix('restaurant')
    ->name('restaurant.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Restaurant Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/dashboard',
            [RestaurantController::class, 'dashboard']
        )->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | Restaurant Resource
        |--------------------------------------------------------------------------
        |
        | create
        | store
        | edit
        | update
        | destroy
        |
        */

        Route::resource(
            'restaurants',
            RestaurantController::class
        )->except([
            'index',
            'show'
        ]);


        /*
        |--------------------------------------------------------------------------
        | Restaurant Menu
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/{restaurant}/menu',
            [MenuItemController::class, 'index']
        )->name('menu.index');

        Route::get(
            '/{restaurant}/menu/create',
            [MenuItemController::class, 'create']
        )->name('menu.create');

       Route::post(
    '/{restaurant}/menu',
    [MenuItemController::class, 'store']
)->name('menu.store');

Route::delete(
    '/{restaurant}/menu/{menuItem}',
    [MenuItemController::class, 'destroy']
)->name('menu.destroy');

        /*
        |--------------------------------------------------------------------------
        | Restaurant Orders
        |--------------------------------------------------------------------------
        |
        | كل مطعم يشوف أوردراته هو فقط.
        |
        */

        Route::get(
            '/{restaurant}/orders',
            [OrderController::class, 'restaurantOrders']
        )->name('orders.index');

        Route::patch(
            '/{restaurant}/orders/{order}/status',
            [OrderController::class, 'updateStatus']
        )->name('orders.status');

    });


/*
|--------------------------------------------------------------------------
| About
|--------------------------------------------------------------------------
*/

Route::get(
    '/about',
    function () {

        return view('about');

    }
)->name('about');


/*
|--------------------------------------------------------------------------
| Cart
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Cart Index
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/cart',
        [CartController::class, 'index']
    )->name('cart.index');

/* Add To Cart From AI
|--------------------------------------------------------------------------
*/

Route::post(
    '/cart/ai-add',
    [CartController::class, 'addFromAI']
)->name('cart.ai.add');



    /*

    |--------------------------------------------------------------------------
    | Add To Cart
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/cart/{menuItem}',
        [CartController::class, 'store']
    )->name('cart.store');


    /*
    |--------------------------------------------------------------------------
    | Update Quantity
    |--------------------------------------------------------------------------
    */

    Route::patch(
        '/cart/{cartItem}',
        [CartController::class, 'update']
    )->name('cart.update');


    /*
    |--------------------------------------------------------------------------
    | Remove Item
    |--------------------------------------------------------------------------
    */

    Route::delete(
        '/cart/{cartItem}',
        [CartController::class, 'destroy']
    )->name('cart.destroy');


    /*
    |--------------------------------------------------------------------------
    | Clear Cart
    |--------------------------------------------------------------------------
    */

    Route::delete(
        '/cart',
        [CartController::class, 'clear']
    )->name('cart.clear');

});


/*
|--------------------------------------------------------------------------
| Checkout
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Checkout Page
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/checkout',
        [CheckoutController::class, 'index']
    )->name('checkout.index');


    /*
    |--------------------------------------------------------------------------
    | Place Order
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/checkout',
        [CheckoutController::class, 'store']
    )->name('checkout.store');
/*
|--------------------------------------------------------------------------
| Fake Payment
|--------------------------------------------------------------------------
*/

Route::get(
    '/payment',
    [PaymentController::class, 'create']
)->name('payment.create');

Route::post(
    '/payment/paypal',
    [PaymentController::class, 'createPayPalOrder']
)->name('payment.paypal');
Route::get(
    '/payment/success',
    [PaymentController::class, 'success']
)->name('payment.success');

Route::get(
    '/payment/cancel',
    [PaymentController::class, 'cancel']
)->name('payment.cancel');
});

/*
|--------------------------------------------------------------------------
| Customer Orders
|--------------------------------------------------------------------------
|
| الزبون يشوف أوردراته هو فقط.
|
*/

Route::middleware('auth')->group(function () {

    Route::get(
        '/orders',
        [OrderController::class, 'index']
    )->name('orders.index');

    Route::get(
        '/orders/{order}',
        [OrderController::class, 'show']
    )->name('orders.show');

    Route::delete(
        '/orders/{order}',
        [OrderController::class, 'destroy']
    )->name('orders.destroy');

});



/* customer orders */

Route::middleware('auth')->group(function () {
    Route::post('/orders/{order}/review', [ReviewController::class, 'store'])
        ->name('reviews.store');
});

Route::middleware('auth')->group(function () {

    Route::get('/notifications',
        [NotificationController::class, 'index']
    )->name('notifications.index');

    Route::get('/notifications/read-all',
        [NotificationController::class, 'readAll']
    )->name('notifications.readAll');

       Route::get('/notifications/{id}/read',
        [NotificationController::class, 'read']
    )->name('notifications.read');

});
Route::middleware(['auth', 'role:customer'])->group(function () {

    Route::get('/chat', [ChatController::class, 'index'])
        ->name('chat.index');

    Route::post('/chat/send', [ChatController::class, 'send'])
        ->name('chat.send');

});
/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';