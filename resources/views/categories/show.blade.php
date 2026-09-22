<x-app-layout>

    <style>
        .category-page {
            max-width: 1150px;
            margin: auto;
            padding: 50px 25px 80px;
        }

        /* ================= HEADER ================= */

        .category-header {
            background: linear-gradient(
                135deg,
                #fff3ed,
                #fffaf7
            );
            border: 1px solid #ffe0d2;
            border-radius: 24px;
            padding: 35px;
            display: flex;
            align-items: center;
            gap: 30px;
            margin-bottom: 35px;
        }

        .category-image {
            width: 140px;
            height: 140px;
            border-radius: 20px;
            overflow: hidden;
            background: #fff3ed;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .category-image img {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            object-fit: contain;
            padding: 8px;
        }

        .category-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 55px;
        }

        .category-info h1 {
            margin: 0 0 8px;
            font-size: 32px;
            color: #222;
        }

        .category-info p {
            margin: 0;
            color: #777;
            font-size: 14px;
        }

        .back-btn {
            display: inline-block;
            margin-top: 15px;
            color: #ff5722;
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
        }

        /* ================= FOOD ================= */

        .section-title {
            margin-bottom: 22px;
        }

        .section-title h2 {
            margin: 0 0 5px;
            font-size: 25px;
            color: #222;
        }

        .section-title p {
            margin: 0;
            color: #888;
            font-size: 14px;
        }

        .food-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 22px;
        }

        .food-card {
            background: white;
            border: 1px solid #eee;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,.04);
            transition: .2s;
        }

        .food-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 28px rgba(0,0,0,.08);
        }

        .food-image {
            width: 100%;
            height: 190px;
            background: #fff3ed;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
        }

        .food-image img {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            object-fit: contain;
        }

        .food-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 55px;
        }

        .food-content {
            padding: 20px;
        }

        .food-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 10px;
        }

        .food-top h3 {
            margin: 0;
            font-size: 19px;
            color: #222;
        }

        .available {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
        }

        .unavailable {
            background: #ffebee;
            color: #c62828;
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
        }

        .food-description {
            color: #777;
            font-size: 13px;
            line-height: 1.6;
            margin: 13px 0;
        }

        .restaurant-name {
            color: #888;
            font-size: 12px;
            margin-bottom: 12px;
        }

        .food-bottom {
            border-top: 1px solid #eee;
            padding-top: 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .price {
            color: #ff5722;
            font-size: 18px;
            font-weight: 700;
        }

        /* ================= EMPTY ================= */

        .empty-box {
            background: white;
            border: 1px solid #eee;
            border-radius: 18px;
            padding: 60px 30px;
            text-align: center;
            color: #888;
        }

        .empty-icon {
            font-size: 60px;
            margin-bottom: 15px;
        }

        .empty-box h2 {
            margin: 0 0 8px;
            color: #333;
        }

        /* ================= MOBILE ================= */

        @media(max-width: 600px) {
            .category-header {
                flex-direction: column;
                text-align: center;
                padding: 25px;
            }

            .category-info h1 {
                font-size: 27px;
            }
        }
    </style>

    <div class="category-page">

        {{-- ================= CATEGORY HEADER ================= --}}
        <div class="category-header">
            <div class="category-image">
                @if($category->image)
                    <img
                        src="{{ asset('storage/' . $category->image) }}"
                        alt="{{ $category->name }}"
                    >
                @else
                    <div class="category-placeholder">
                        🍴
                    </div>
                @endif
            </div>

            <div class="category-info">
                <h1>
                    {{ $category->name }}
                </h1>
                <p>
                    Explore all meals available in {{ $category->name }}.
                </p>
                <a href="{{ route('home') }}" class="back-btn">
                    ← Back to Home
                </a>
            </div>
        </div>

        {{-- ================= FOOD ================= --}}
        <div class="section-title">
            <h2>
                🍽️ {{ $category->name }} Meals
            </h2>
            <p>
                Delicious meals from our restaurants.
            </p>
        </div>

        @if($menuItems->count())
            <div class="food-grid">
                @foreach($menuItems as $item)
    <a
        href="{{ route('menu-items.show', $item) }}"
        class="food-card"
        style="text-decoration: none; color: inherit;"
    >
                        {{-- IMAGE --}}
                        <div class="food-image">
                            @if($item->image)
                                <img
                                    src="{{ asset('storage/' . $item->image) }}"
                                    alt="{{ $item->name }}"
                                >
                            @else
                                <div class="food-placeholder">
                                    🍔
                                </div>
                            @endif
                        </div>

                        {{-- CONTENT --}}
                        <div class="food-content">
                            <div class="food-top">
                                <h3>
                                    {{ $item->name }}
                                </h3>

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

                            @if($item->restaurant)
                                <div class="restaurant-name">
                                    🏪 {{ $item->restaurant->name }}
                                </div>
                            @endif

                            @if($item->description)
                                <p class="food-description">
                                    {{ $item->description }}
                                </p>
                            @else
                                <p class="food-description">
                                    Delicious meal from {{ $category->name }}.
                                </p>
                            @endif

                            <div class="food-bottom">
                                <span class="price">
                                    {{ number_format($item->price, 2) }} EGP
                                </span>
                            </div>
                        </div>
                    </div>
             </a>
@endforeach
        @else
            <div class="empty-box">
                <div class="empty-icon">
                    🍽️
                </div>
                <h2>
                    No Meals Yet
                </h2>
                <p>
                    There are no meals available in this category yet.
                </p>
            </div>
        @endif

    </div>

</x-app-layout>