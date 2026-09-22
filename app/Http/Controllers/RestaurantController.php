<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Public Restaurants
    |--------------------------------------------------------------------------
    */

  public function index(Request $request)
{
    $query = Restaurant::where('status', 'approved');

    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    $restaurants = $query->latest()->get();

    return view('restaurant.index', compact('restaurants'));
}


    /*
    |--------------------------------------------------------------------------
    | Show Restaurant
    |--------------------------------------------------------------------------
    */

public function show(Restaurant $restaurant)
{
    abort_unless($restaurant->status === 'approved', 404);

    $menuItems = MenuItem::where('restaurant_id', $restaurant->id)
        ->where('is_available', true)
        ->latest()
        ->get();

    return view(
        'restaurant.show',
        compact('restaurant', 'menuItems')
    );
}

    /*
    |--------------------------------------------------------------------------
    | Restaurant Dashboard
    |--------------------------------------------------------------------------
    */

  public function dashboard()
{
    $restaurants = Restaurant::where('owner_id', Auth::id())
        ->latest()
        ->get();

    $restaurantIds = $restaurants->pluck('id');

    $newOrdersCount = \App\Models\Order::whereIn('restaurant_id', $restaurantIds)
        ->where('status', 'pending')
        ->count();

    return view('restaurant.dashboard', compact(
        'restaurants',
        'newOrdersCount'
    ));
}


    /*
    |--------------------------------------------------------------------------
    | Create
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('restaurant.create');
    }


    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'phone' => [
                'required',
                'string',
                'max:20'
            ],

            'email' => [
                'nullable',
                'email',
                'max:255'
            ],

            'address' => [
                'required',
                'string',
                'max:255'
            ],

            'latitude' => [
                'required',
                'numeric',
                'between:-90,90'
            ],

            'longitude' => [
                'required',
                'numeric',
                'between:-180,180'
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,webp',
                'max:2048'
            ],

        ]);


        /*
        | Upload Image
        */

        $imagePath = null;

        if ($request->hasFile('image')) {

            $imagePath = $request->file('image')
                ->store('restaurants', 'public');

        }


        /*
        | Create Restaurant
        */

        Restaurant::create([

            'owner_id' => Auth::id(),

            'name' => $validated['name'],

            'phone' => $validated['phone'],

            'email' => $validated['email'] ?? null,

            'address' => $validated['address'],

            'latitude' => $validated['latitude'],

            'longitude' => $validated['longitude'],

            'image' => $imagePath,

            'status' => 'pending',

            'is_open' => false,

        ]);


        return redirect()
            ->route('restaurant.dashboard')
            ->with(
                'success',
                'Your restaurant has been created and is waiting for admin approval.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Edit
    |--------------------------------------------------------------------------
    */

    public function edit(Restaurant $restaurant)
    {
        /*
        | Make sure the restaurant belongs to the logged-in owner
        */

        abort_unless(
            $restaurant->owner_id === Auth::id(),
            403
        );


        return view(
            'restaurant.edit',
            compact('restaurant')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Restaurant $restaurant
    ) {

        /*
        | Make sure owner owns this restaurant
        */

        abort_unless(
            $restaurant->owner_id === Auth::id(),
            403
        );


      $validated = $request->validate([

    'name' => [
        'required',
        'string',
        'max:255'
    ],

    'phone' => [
        'required',
        'string',
        'max:20'
    ],

    'email' => [
        'nullable',
        'email',
        'max:255'
    ],

    'address' => [
        'required',
        'string',
        'max:255'
    ],

    'opening_time' => [
        'required',
        'date_format:H:i'
    ],

    'closing_time' => [
        'required',
        'date_format:H:i'
    ],

    'latitude' => [
        'required',
        'numeric',
        'between:-90,90'
    ],

    'longitude' => [
        'required',
        'numeric',
        'between:-180,180'
    ],

    'image' => [
        'nullable',
        'image',
        'mimes:jpeg,png,jpg,webp',
        'max:2048'
    ],

]);

        /*
        | Update Image
        */

        if ($request->hasFile('image')) {

            $imagePath = $request->file('image')
                ->store('restaurants', 'public');

            $validated['image'] = $imagePath;

        }


        /*
        | Update Restaurant
        */

        $restaurant->update($validated);


        return redirect()
            ->route('restaurant.dashboard')
            ->with(
                'success',
                'Restaurant updated successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Destroy
    |--------------------------------------------------------------------------
    */

    public function destroy(Restaurant $restaurant)
    {
        /*
        | Make sure owner owns this restaurant
        */

        abort_unless(
            $restaurant->owner_id === Auth::id(),
            403
        );


        $restaurant->delete();


        return redirect()
            ->route('restaurant.dashboard')
            ->with(
                'success',
                'Restaurant deleted successfully.'
            );
    }
    public function adminIndex()
{
    $restaurants = Restaurant::with('owner')
        ->latest()
        ->get();

    return view('admin.restaurants.index', compact('restaurants'));
}
    public function destroyAdmin(Restaurant $restaurant)
{
    $restaurant->delete();

    return back()->with('success', 'Restaurant deleted successfully.');
}
}