<x-app-layout>

    <style>
        .item-page {
            max-width: 1000px;
            margin: auto;
            padding: 50px 25px 80px;
        }

        .item-card {
            background: white;
            border: 1px solid #eee;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0,0,0,.06);
        }

        .item-image {
            width: 100%;
            height: 400px;
            background: #fff3ed;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .item-image img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .item-placeholder {
            font-size: 100px;
        }

        .item-content {
            padding: 35px;
        }

        .item-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
        }

        .item-name {
            margin: 0;
            font-size: 32px;
            color: #222;
        }

        .restaurant-name {
            margin-top: 10px;
            color: #777;
            font-size: 14px;
        }

        .category-name {
            margin-top: 5px;
            color: #999;
            font-size: 13px;
        }

        .description {
            margin: 25px 0;
            color: #666;
            line-height: 1.8;
            font-size: 15px;
        }

        .price {
            color: #ff5722;
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 25px;
        }

        .available {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .unavailable {
            background: #ffebee;
            color: #c62828;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .add-cart-btn {
            display: inline-block;
            width: 100%;
            border: none;
            background: #ff5722;
            color: white;
            padding: 15px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s;
        }

        .add-cart-btn:hover {
            background: #e64a19;
        }

        .disabled-btn {
            width: 100%;
            background: #ddd;
            color: #777;
            padding: 15px;
            border-radius: 12px;
            text-align: center;
            font-weight: 700;
        }

        .back-btn {
            display: inline-block;
            margin-bottom: 20px;
            color: #ff5722;
            text-decoration: none;
            font-weight: 700;
        }

        @media(max-width:600px) {
            .item-image {
                height: 280px;
            }

            .item-content {
                padding: 25px;
            }

            .item-name {
                font-size: 26px;
            }
        }
    </style>

    <div class="item-page">

        <a href="{{ url()->previous() }}" class="back-btn">
            ← Back
        </a>

        <div class="item-card">

            <div class="item-image">
                @if($menuItem->image)
                    <img
                        src="{{ asset('storage/' . $menuItem->image) }}"
                        alt="{{ $menuItem->name }}"
                    >
                @else
                    <div class="item-placeholder">🍔</div>
                @endif
            </div>

            <div class="item-content">

                <div class="item-top">

                    <div>
                        <h1 class="item-name">
                            {{ $menuItem->name }}
                        </h1>

                        @if($menuItem->restaurant)
                            <div class="restaurant-name">
                                🏪 {{ $menuItem->restaurant->name }}
                            </div>
                        @endif

                        @if($menuItem->category)
                            <div class="category-name">
                                🍽️ {{ $menuItem->category->name }}
                            </div>
                        @endif
                    </div>

                    @if($menuItem->is_available)
                        <span class="available">
                            Available
                        </span>
                    @else
                        <span class="unavailable">
                            Unavailable
                        </span>
                    @endif

                </div>

                @if($menuItem->description)
                    <p class="description">
                        {{ $menuItem->description }}
                    </p>
                @else
                    <p class="description">
                        Delicious {{ $menuItem->name }}
                        from {{ $menuItem->restaurant->name ?? 'our restaurant' }}.
                    </p>
                @endif

                <div class="price">
                    {{ number_format($menuItem->price, 2) }} EGP
                </div>

                @if($menuItem->is_available)

                    @auth
                        <form
                            action="{{ route('cart.store', $menuItem) }}"
                            method="POST"
                        >
                            @csrf

                            <button type="submit" class="add-cart-btn">
                                🛒 Add to Cart
                            </button>
                        </form>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="add-cart-btn"
                            style="text-align:center; text-decoration:none;"
                        >
                            Login to Add to Cart
                        </a>
                    @endauth

                @else

                    <div class="disabled-btn">
                        Currently Unavailable
                    </div>

                @endif

            </div>
        </div>

    </div>

</x-app-layout>