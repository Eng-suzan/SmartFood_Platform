<x-app-layout>

    <style>

        /* =========================
           Restaurant Page
        ========================= */

        .restaurant-page {
            max-width: 1100px;
            margin: auto;
            padding: 45px 25px 80px;
        }


        /* =========================
           Restaurant Hero
        ========================= */

        .restaurant-hero {
            background: white;

            border: 1px solid #eee;

            border-radius: 22px;

            overflow: hidden;

            box-shadow:
                0 8px 25px rgba(0, 0, 0, .05);

            margin-bottom: 40px;
        }


        /* =========================
           Restaurant Cover Image
        ========================= */

        .restaurant-cover {
            width: 100%;
            height: 330px;

            object-fit: cover;
            object-position: center center;

            display: block;
        }


        /* Placeholder */

        .restaurant-cover-placeholder {
            width: 100%;
            height: 330px;

            background: #fff3ed;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 80px;
        }


        /* =========================
           Restaurant Details
        ========================= */

        .restaurant-details {
            padding: 30px;
        }


        .restaurant-details-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;

            gap: 20px;
        }


        .restaurant-details h1 {
            margin: 0 0 10px;

            font-size: 32px;

            color: #222;
        }


        .restaurant-address {
            color: #777;

            margin: 0;

            font-size: 14px;
        }


        /* =========================
           Status
        ========================= */

        .restaurant-status {
            padding: 7px 14px;

            border-radius: 20px;

            font-size: 12px;

            font-weight: 700;

            background: #e8f5e9;

            color: #2e7d32;

            white-space: nowrap;
        }


        /* =========================
           Restaurant Info
        ========================= */

        .restaurant-info {
            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 15px;

            margin-top: 25px;
        }


        .info-box {
            background: #fafafa;

            border-radius: 12px;

            padding: 15px;
        }


        .info-box span {
            display: block;

            color: #999;

            font-size: 11px;

            margin-bottom: 5px;
        }


        .info-box strong {
            color: #333;

            font-size: 13px;

            word-break: break-word;
        }


        /* =========================
           Meals Section
        ========================= */

        .section-title {
            margin-bottom: 25px;
        }


        .section-title span {
            color: #ff5722;

            font-size: 11px;

            font-weight: 700;

            letter-spacing: 1px;
        }


        .section-title h2 {
            margin: 7px 0 0;

            color: #222;

            font-size: 28px;
        }


        /* =========================
           Meals Grid
        ========================= */

        .meals-grid {
            display: grid;

            grid-template-columns:
                repeat(auto-fit, minmax(250px, 1fr));

            gap: 22px;
        }


        /* =========================
           Meal Card
        ========================= */

        .meal-card {
            background: white;

            border: 1px solid #eee;

            border-radius: 16px;

            overflow: hidden;

            box-shadow:
                0 5px 20px rgba(0, 0, 0, .04);

            transition: .2s;
        }


        .meal-card:hover {
            transform: translateY(-4px);

            box-shadow:
                0 10px 28px rgba(0, 0, 0, .08);
        }


        /* =========================
           Meal Image
        ========================= */

        .meal-image {
            width: 100%;
            height: 190px;

            object-fit: cover;
            object-position: center;

            display: block;
        }


        .meal-placeholder {
            width: 100%;
            height: 190px;

            background: #fff3ed;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 55px;
        }


        /* =========================
           Meal Content
        ========================= */

        .meal-content {
            padding: 18px;
        }


        .meal-content h3 {
            margin: 0 0 8px;

            color: #222;

            font-size: 19px;
        }


        .meal-description {
            color: #888;

            font-size: 13px;

            line-height: 1.6;

            margin: 0 0 12px;
        }


        .meal-bottom {
            display: flex;

            justify-content: space-between;

            align-items: center;
        }


        .meal-price {
            color: #ff5722;

            font-size: 17px;

            font-weight: 700;
        }


        /* =========================
           Empty Meals
        ========================= */

        .empty-meals {
            background: white;

            border: 1px solid #eee;

            border-radius: 16px;

            padding: 50px;

            text-align: center;

            color: #888;
        }


        .empty-meals h3 {
            color: #444;

            margin: 10px 0 6px;
        }


        .empty-meals p {
            margin: 0;
        }


        /* =========================
           Responsive
        ========================= */

        @media(max-width: 700px) {

            .restaurant-page {
                padding: 25px 15px 60px;
            }


            .restaurant-details {
                padding: 22px;
            }


            .restaurant-details-top {
                flex-direction: column;
            }


            .restaurant-info {
                grid-template-columns: 1fr;
            }


            .restaurant-cover,
            .restaurant-cover-placeholder {
                height: 230px;
            }


            .restaurant-details h1 {
                font-size: 26px;
            }


            .section-title h2 {
                font-size: 24px;
            }
        }


        @media(max-width: 480px) {

            .restaurant-cover,
            .restaurant-cover-placeholder {
                height: 200px;
            }


            .meal-image,
            .meal-placeholder {
                height: 170px;
            }
            .closed-btn {
    display: inline-block;

    background: #f5f5f5;
    color: #999;

    padding: 9px 13px;

    border-radius: 9px;

    font-size: 12px;
    font-weight: 600;
}
            .add-cart-btn {
    border: none;

    background: #ff5722;
    color: white;

    padding: 9px 13px;

    border-radius: 9px;

    font-size: 12px;
    font-weight: 600;

    text-decoration: none;

    cursor: pointer;

    transition: .2s;
}

.add-cart-btn:hover {
    background: #e64a19;
    transform: translateY(-1px);
}
        }

    </style>


    <div class="restaurant-page">


        {{-- =====================================================
             Restaurant Information
        ====================================================== --}}

        <div class="restaurant-hero">


            {{-- Restaurant Image --}}

            @if($restaurant->image)

                <img
                    src="{{ asset('storage/' . $restaurant->image) }}"
                    alt="{{ $restaurant->name }}"
                    class="restaurant-cover"
                >

            @else

                <div class="restaurant-cover-placeholder">
                    🍽️
                </div>

            @endif


            {{-- Restaurant Details --}}

            <div class="restaurant-details">


                <div class="restaurant-details-top">


                    <div>

                        <h1>
                            {{ $restaurant->name }}
                        </h1>

                        <p class="restaurant-address">
                            📍 {{ $restaurant->address }}
                        </p>

                    </div>


                    <span class="restaurant-status">

                        {{ ucfirst($restaurant->status) }}

                    </span>


                </div>


                {{-- Restaurant Information Grid --}}

                <div class="restaurant-info">


                    {{-- Phone --}}

                    <div class="info-box">

                        <span>
                            PHONE
                        </span>

                        <strong>
                            {{ $restaurant->phone }}
                        </strong>

                    </div>


                    {{-- Email --}}

                    <div class="info-box">

                        <span>
                            EMAIL
                        </span>

                        <strong>
                            {{ $restaurant->email ?? 'Not provided' }}
                        </strong>

                    </div>


                    {{-- Open / Closed --}}

                    <div class="info-box">

                        <span>
                            STATUS
                        </span>

                        <strong>

                          @if($restaurant->isOpenNow())

                                🟢 Open

                            @else

                                🔴 Closed

                            @endif

                        </strong>

                    </div>


                </div>

            </div>

        </div>



        {{-- =====================================================
             Meals Section
        ====================================================== --}}

        <div class="section-title">

            <span>
                OUR MENU
            </span>

            <h2>
                🍽️ Meals
            </h2>

        </div>



        @if($menuItems->count())


            <div class="meals-grid">


                @foreach($menuItems as $meal)


                    <div class="meal-card">


                        {{-- Meal Image --}}

                        @if($meal->image)

                            <img
                                src="{{ asset('storage/' . $meal->image) }}"
                                alt="{{ $meal->name }}"
                                class="meal-image"
                            >

                        @else

                            <div class="meal-placeholder">
                                🍔
                            </div>

                        @endif


                        {{-- Meal Content --}}

                        <div class="meal-content">


                            <h3>
                                {{ $meal->name }}
                            </h3>


                            <p class="meal-description">

                                {{ $meal->description
                                    ?? 'Delicious meal from ' . $restaurant->name
                                }}

                            </p>


                           <div class="meal-bottom">

    <span class="meal-price">
        {{ number_format($meal->price, 2) }} EGP
    </span>
@auth

    @if(Auth::user()->role === 'customer')

        @if($restaurant->isOpenNow())

            <form
                action="{{ route('cart.store', $meal) }}"
                method="POST"
            >
                @csrf

                <button
                    type="submit"
                    class="add-cart-btn"
                >
                    🛒 Add to Cart
                </button>
            </form>

        @else

            <span class="closed-btn">
                🔴 Restaurant Closed
            </span>

        @endif

    @endif

@else
   
     

        <a
            href="{{ route('login') }}"
            class="add-cart-btn"
        >
            🛒 Add to Cart
        </a>

    @endauth

</div>


                        </div>


                    </div>


                @endforeach


            </div>


        @else


            {{-- No Meals --}}

            <div class="empty-meals">

                <div style="font-size: 50px;">
                    🍽️
                </div>

                <h3>
                    No meals available yet
                </h3>

                <p>
                    This restaurant hasn't added any meals yet.
                </p>

            </div>


        @endif


    </div>

</x-app-layout>