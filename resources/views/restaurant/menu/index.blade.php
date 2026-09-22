<x-app-layout>

    <div class="menu-page">

        {{-- Header --}}
        <div class="menu-header">

            <div>

                <span class="menu-label">
                    🍔 RESTAURANT MENU
                </span>

                <h1>
                    {{ $restaurant->name }}
                </h1>

                <p>
                    Manage your restaurant food items.
                </p>

            </div>


            <a
                href="{{ route('restaurant.menu.create', ['restaurant' => $restaurant->id]) }}"
                class="add-food-btn"
            >
                + Add Food 🍔
            </a>

        </div>


        {{-- Success Message --}}
        @if(session('success'))

            <div class="success-message">
                ✅ {{ session('success') }}
            </div>

        @endif


        {{-- Menu Items --}}
        @if($menuItems->count() > 0)

            <div class="menu-grid">

                @foreach($menuItems as $item)

                    <div class="menu-card">


                        {{-- Image --}}
                        <div class="food-image">

                            @if($item->image)

                                <img
                                    src="{{ asset('storage/' . $item->image) }}"
                                    alt="{{ $item->name }}"
                                >

                            @else

                                <div class="no-food-image">
                                    🍔
                                </div>

                            @endif

                        </div>


                        {{-- Content --}}
                        <div class="food-content">

                            <div class="food-top">

                                <h2>
                                    {{ $item->name }}
                                </h2>

                                @if($item->is_available)

                                    <span class="available">
                                        Available
                                    </span>

                                @else

                                    <span class="unavailable">
                                        Unavailable
                                    </span>

                                @endif

                            </div>


                            {{-- Category --}}
                            @if($item->category)

                                <span class="category">
                                    {{ $item->category->name }}
                                </span>

                            @endif


                            {{-- Description --}}
                            @if($item->description)

                                <p class="description">
                                    {{ $item->description }}
                                </p>

                            @else

                                <p class="description no-description">
                                    No description available.
                                </p>

                            @endif


                            {{-- Price --}}
                          <div class="food-bottom">

    <strong class="price">
        {{ number_format($item->price, 2) }}
        EGP
    </strong>

    <form
        action="{{ route('restaurant.menu.destroy', [
            'restaurant' => $restaurant->id,
            'menuItem' => $item->id
        ]) }}"
        method="POST"
        onsubmit="return confirm('Are you sure you want to delete this food item?');"
    >
        @csrf
        @method('DELETE')

        <button type="submit" class="delete-food-btn">
            🗑 Delete
        </button>
    </form>

</div>
                        </div>

                    </div>

                @endforeach

            </div>


        @else

            {{-- Empty Menu --}}
            <div class="empty-menu">

                <div class="empty-icon">
                    🍔
                </div>

                <h2>
                    Your Menu Is Empty
                </h2>

                <p>
                    You haven't added any food items yet.
                    Start by adding your first meal.
                </p>

                <a
                    href="{{ route('restaurant.menu.create', ['restaurant' => $restaurant->id]) }}"
                    class="add-food-btn"
                >
                    + Add Your First Food 🍔
                </a>

            </div>

        @endif

    </div>


<style>

.menu-page {
    max-width: 1100px;
    margin: auto;
    padding: 50px 25px 80px;
}


/* Header */

.menu-header {
    background: linear-gradient(
        135deg,
        #fff3ed,
        #ffffff
    );

    border: 1px solid #ffe0d2;
    border-radius: 24px;

    padding: 35px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 25px;

    margin-bottom: 25px;
}

.menu-label {
    color: #ff5722;

    font-size: 11px;
    font-weight: 700;

    letter-spacing: 1px;
}

.menu-header h1 {
    margin: 10px 0 5px;

    font-size: 30px;
    color: #222;
}

.menu-header p {
    margin: 0;

    color: #777;
}


/* Add Button */

.add-food-btn {
    display: inline-block;

    background: #ff5722;
    color: white;

    padding: 13px 22px;

    border-radius: 10px;

    text-decoration: none;

    font-size: 14px;
    font-weight: 600;

    white-space: nowrap;

    transition: .2s;
}

.add-food-btn:hover {
    background: #e64a19;
    transform: translateY(-1px);
}


/* Success */

.success-message {
    background: #e8f5e9;

    color: #2e7d32;

    border: 1px solid #c8e6c9;

    padding: 13px 16px;

    border-radius: 10px;

    margin-bottom: 25px;

    font-size: 14px;
}


/* Grid */

.menu-grid {
    display: grid;

    grid-template-columns:
        repeat(3, 1fr);

    gap: 22px;
}


/* Card */

.menu-card {
    background: white;

    border: 1px solid #eee;

    border-radius: 18px;

    overflow: hidden;

    box-shadow:
        0 5px 20px rgba(0,0,0,.05);

    transition: .2s;
}

.menu-card:hover {
    transform: translateY(-4px);

    box-shadow:
        0 10px 28px rgba(0,0,0,.09);
}


/* Image */

.food-image {
    width: 100%;

    height: 210px;

    background: #fff3ed;

    overflow: hidden;
}

.food-image img {
    width: 100%;

    height: 100%;

    object-fit: cover;
}

.no-food-image {
    width: 100%;
    height: 100%;

    display: flex;

    align-items: center;
    justify-content: center;

    font-size: 60px;
}


/* Content */

.food-content {
    padding: 20px;
}

.food-top {
    display: flex;

    align-items: flex-start;

    justify-content: space-between;

    gap: 10px;
}

.food-top h2 {
    margin: 0;

    color: #222;

    font-size: 19px;
}


/* Status */

.available,
.unavailable {
    padding: 5px 9px;

    border-radius: 20px;

    font-size: 10px;

    font-weight: 600;

    white-space: nowrap;
}

.available {
    background: #e8f5e9;
    color: #2e7d32;
}

.unavailable {
    background: #ffebee;
    color: #c62828;
}


/* Category */

.category {
    display: inline-block;

    margin-top: 10px;

    padding: 5px 9px;

    background: #fff3ed;

    color: #ff5722;

    border-radius: 8px;

    font-size: 11px;

    font-weight: 600;
}


/* Description */

.description {
    margin: 13px 0;

    color: #777;

    font-size: 13px;

    line-height: 1.6;

    min-height: 42px;
}

.no-description {
    color: #aaa;
}


/* Bottom */

.food-bottom {
    border-top: 1px solid #eee;

    padding-top: 15px;

    margin-top: 10px;
}

.price {
    color: #ff5722;

    font-size: 18px;
}
.food-bottom {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
}

.delete-food-btn {
    border: none;
    background: #ffebee;
    color: #c62828;

    padding: 8px 12px;

    border-radius: 8px;

    font-size: 12px;
    font-weight: 600;

    cursor: pointer;

    transition: .2s;
}

.delete-food-btn:hover {
    background: #ffcdd2;
}

/* Empty */

.empty-menu {
    background: white;

    border: 1px solid #eee;

    border-radius: 20px;

    padding: 70px 30px;

    text-align: center;

    box-shadow:
        0 5px 20px rgba(0,0,0,.04);
}

.empty-icon {
    font-size: 65px;

    margin-bottom: 15px;
}

.empty-menu h2 {
    margin: 0 0 10px;

    color: #222;
}

.empty-menu p {
    color: #888;

    max-width: 500px;

    margin: 0 auto 25px;

    line-height: 1.6;
}


/* Responsive */

@media(max-width: 900px) {

    .menu-grid {
        grid-template-columns:
            repeat(2, 1fr);
    }

}

@media(max-width: 600px) {

    .menu-header {
        flex-direction: column;

        align-items: flex-start;

        padding: 25px;
    }

    .menu-header h1 {
        font-size: 24px;
    }

    .menu-grid {
        grid-template-columns: 1fr;
    }

    .food-image {
        height: 230px;
    }

}

</style>

</x-app-layout>