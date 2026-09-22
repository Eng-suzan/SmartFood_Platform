<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuItemController extends Controller
{
    /**
     * Display restaurant menu items.
     */
    public function index(Restaurant $restaurant)
    {
        // Make sure this restaurant belongs to the logged-in user
        if ($restaurant->owner_id != Auth::id()) {
            abort(403);
        }

        $menuItems = MenuItem::with('category')
            ->where('restaurant_id', $restaurant->id)
            ->latest()
            ->get();

        return view(
            'restaurant.menu.index',
            compact('restaurant', 'menuItems')
        );
    }


    /**
     * Show create menu item form.
     */
    public function create(Restaurant $restaurant)
    {
        // Make sure restaurant belongs to logged-in user
        if ($restaurant->owner_id != Auth::id()) {
            abort(403);
        }

        $categories = Category::orderBy('id')->get();

        return view(
            'restaurant.menu.create',
            compact('restaurant', 'categories')
        );
    }


    /**
     * Store a new menu item.
     */
    public function store(
        Request $request,
        Restaurant $restaurant
    ) {
        // Make sure restaurant belongs to logged-in user
        if ($restaurant->owner_id != Auth::id()) {
            abort(403);
        }


        $validated = $request->validate([

            'category_id' => [
                'required',
                'exists:categories,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,webp',
                'max:2048',
            ],

        ]);


        // Upload image
        $imagePath = null;

        if ($request->hasFile('image')) {

            $imagePath = $request
                ->file('image')
                ->store(
                    'menu-items',
                    'public'
                );
        }


        // Create menu item
        $restaurant->menuItems()->create([

            'category_id' => $validated['category_id'],

            'name' => $validated['name'],

            'description' =>
                $validated['description'] ?? null,

            'price' =>
                $validated['price'],

            'image' =>
                $imagePath,

            'is_available' =>
                true,

        ]);


        // Go to menu items page
        return redirect()
            ->route(
                'restaurant.menu.index',
                ['restaurant' => $restaurant->id]
            )
            ->with(
                'success',
                'Menu item added successfully.'
            );
    }
    /**
 * Show menu item details.
 */
public function show(MenuItem $menuItem)
{
    $menuItem->load(['restaurant', 'category']);

    return view(
        'menu-items.show',
        compact('menuItem')
    );
}
    /**
 * Delete a menu item.
 */
public function destroy(Restaurant $restaurant, MenuItem $menuItem)
{
    // Make sure restaurant belongs to logged-in user
    if ($restaurant->owner_id != Auth::id()) {
        abort(403);
    }

    // Make sure the menu item belongs to this restaurant
    if ($menuItem->restaurant_id != $restaurant->id) {
        abort(403);
    }

    // Delete image from storage
    if ($menuItem->image) {
        \Illuminate\Support\Facades\Storage::disk('public')
            ->delete($menuItem->image);
    }

    // Delete menu item
    $menuItem->delete();

    return redirect()
        ->route('restaurant.menu.index', [
            'restaurant' => $restaurant->id
        ])
        ->with('success', 'Menu item deleted successfully.');
}
}