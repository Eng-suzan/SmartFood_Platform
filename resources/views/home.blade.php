<x-app-layout>

    <style>

        * {
            box-sizing: border-box;
        }

        .smart-home {
            background: #fffaf7;
            min-height: 100vh;
        }

        /* ================= HERO ================= */

        .hero {
            min-height: 520px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 50px;

            padding: 70px 7%;

            background:
                linear-gradient(
                    135deg,
                    #fff4ed,
                    #fffaf7
                );
        }

        .hero-content {
            max-width: 580px;
        }

        .hero-badge {
            display: inline-block;

            background: #ffe9df;
            color: #ff5722;

            padding: 8px 15px;

            border-radius: 30px;

            font-size: 13px;
            font-weight: 700;

            margin-bottom: 20px;
        }

        .hero h1 {
            margin: 0 0 18px;

            font-size: 52px;
            line-height: 1.1;

            color: #222;
        }

        .hero h1 span {
            color: #ff5722;
        }

        .hero p {
            color: #777;

            font-size: 17px;
            line-height: 1.7;

            max-width: 520px;

            margin-bottom: 30px;
        }

        .hero-buttons {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .primary-btn,
        .secondary-btn {

            display: inline-block;

            padding: 13px 22px;

            border-radius: 10px;

            text-decoration: none;

            font-size: 14px;
            font-weight: 700;

            transition: .2s;
        }

        .primary-btn {
            background: #ff5722;
            color: white;
        }

        .primary-btn:hover {
            background: #e64a19;
            transform: translateY(-2px);
        }

        .secondary-btn {
            background: white;
            color: #ff5722;

            border: 1px solid #ffd6c7;
        }

        .secondary-btn:hover {
            background: #fff3ed;
        }


        /* ================= HERO IMAGE ================= */

        .hero-image {
            width: 450px;
            height: 380px;

            border-radius: 30px;

            overflow: hidden;

            box-shadow:
                0 15px 40px rgba(0,0,0,.12);

            flex-shrink: 0;
        }

        .hero-image img {
            width: 100%;
            height: 100%;

            object-fit: cover;
        }


        /* ================= GENERAL ================= */

        .home-section {
            max-width: 1200px;

            margin: auto;

            padding: 65px 25px;
        }

        .section-heading {
            display: flex;

            justify-content: space-between;
            align-items: flex-end;

            margin-bottom: 25px;
        }

        .section-heading h2 {
            margin: 0;

            font-size: 28px;

            color: #222;
        }

        .section-heading p {
            margin: 5px 0 0;

            color: #888;

            font-size: 14px;
        }

        .view-all {
            text-decoration: none;

            color: #ff5722;

            font-size: 14px;
            font-weight: 700;
        }


        /* ================= CATEGORIES ================= */

        .categories-grid {

            display: grid;

            grid-template-columns:
                repeat(auto-fit, minmax(150px, 1fr));

            gap: 16px;
        }

        .category-card {

            background: white;

            border: 1px solid #eee;

            border-radius: 16px;

            padding: 25px 15px;

            text-align: center;

            transition: .2s;
        }

        .category-card:hover {

            transform: translateY(-4px);

            box-shadow:
                0 10px 25px rgba(0,0,0,.07);
        }

        .category-icon {
    width: 90px;
    height: 90px;

    margin: 0 auto 15px;

    border-radius: 16px;

    overflow: hidden;

    background: #fff3ed;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 35px;
}

.category-icon img {
    width: 100%;
    height: 100%;

    object-fit: cover;
}

.category-card {
    text-decoration: none;
    color: inherit;
}
        .category-card h3 {

            margin: 0;

            font-size: 15px;

            color: #333;
        }


        /* ================= RESTAURANTS ================= */

        .restaurants-grid {

            display: grid;

            grid-template-columns:
                repeat(auto-fit, minmax(280px, 1fr));

            gap: 22px;
        }

        .restaurant-card {

            background: white;

            border: 1px solid #eee;

            border-radius: 18px;

            overflow: hidden;

            box-shadow:
                0 5px 20px rgba(0,0,0,.04);

            transition: .2s;
        }

        .restaurant-card:hover {

            transform: translateY(-4px);

            box-shadow:
                0 10px 28px rgba(0,0,0,.08);
        }

        .restaurant-image {

            width: 100%;
            height: 200px;

            object-fit: cover;
        }

        .restaurant-placeholder {

            width: 100%;
            height: 200px;

            background: #fff3ed;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 55px;
        }

        .restaurant-content {

            padding: 20px;
        }

        .restaurant-content h3 {

            margin: 0 0 8px;

            font-size: 20px;

            color: #222;
        }

        .restaurant-content p {

            margin: 6px 0;

            color: #888;

            font-size: 13px;
        }

        .restaurant-link {

            display: inline-block;

            margin-top: 12px;

            color: #ff5722;

            text-decoration: none;

            font-size: 13px;

            font-weight: 700;
        }


        /* ================= EMPTY ================= */

        .empty-box {

            background: white;

            border: 1px solid #eee;

            border-radius: 16px;

            padding: 40px;

            text-align: center;

            color: #888;
        }


        /* ================= CTA ================= */

        .cta {

            max-width: 1200px;

            margin: 20px auto 70px;

            padding: 50px 30px;

            background:
                linear-gradient(
                    135deg,
                    #ff5722,
                    #ff7043
                );

            border-radius: 25px;

            text-align: center;

            color: white;
        }

        .cta h2 {

            margin: 0 0 10px;

            font-size: 30px;
        }

        .cta p {

            margin: 0 auto 25px;

            max-width: 600px;

            color: #fff3ed;
        }

        .cta a {

            display: inline-block;

            padding: 12px 22px;

            background: white;

            color: #ff5722;

            border-radius: 10px;

            text-decoration: none;

            font-weight: 700;
        }


        /* ================= MOBILE ================= */

        @media(max-width: 850px) {

            .hero {
                flex-direction: column;

                text-align: center;
            }

            .hero-content {
                max-width: 100%;
            }

            .hero p {
                margin-left: auto;
                margin-right: auto;
            }

            .hero-buttons {
                justify-content: center;
            }

            .hero-image {
                width: 100%;
                max-width: 500px;
            }
        }

        @media(max-width: 600px) {

            .hero {
                padding: 50px 20px;
            }

            .hero h1 {
                font-size: 38px;
            }

            .section-heading {
                align-items: flex-start;
                gap: 10px;
            }

            .section-heading h2 {
                font-size: 23px;
            }
        }

    </style>


    <div class="smart-home">


        {{-- ================= HERO ================= --}}

        <section class="hero">

            <div class="hero-content">

                <span class="hero-badge">
                    🍽️ SMART FOOD EXPERIENCE
                </span>

                <h1>
                    Discover
                    <span>Great Food.</span>
                    <br>
                    Eat Smarter.
                </h1>

                <p>
                    Explore restaurants, discover delicious meals,
                    browse categories and find your next favorite dish
                    with Smart Food.
                </p>


                <div class="hero-buttons">

                    <a
                        href="{{ route('restaurants.index') }}"
                        class="primary-btn"
                    >
                        🍽️ Explore Restaurants
                    </a>

                    <a
                        href="#categories"
                        class="secondary-btn"
                    >
                        📂 Browse Categories
                    </a>

                </div>

            </div>


            <div class="hero-image">

                <img
                    src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1000&q=80"
                    alt="Smart Food"
                >

            </div>

        </section>



        {{-- ================= CATEGORIES ================= --}}

        <section
            class="home-section"
            id="categories"
        >

            <div class="section-heading">

                <div>

                    <h2>
                        🍴 Food Categories
                    </h2>

                    <p>
                        Find what you're craving.
                    </p>

                </div>

              <a
    href="{{ route('categories.index') }}"
    class="view-all"
>
    View All →
</a>
            </div>


            @if($categories->count())

                <div class="categories-grid">

                 @foreach($categories as $category)

    <a
        href="{{ route('categories.show', $category) }}"
        class="category-card"
    >

        <div class="category-icon">

            @if($category->image)

                <img
                    src="{{ asset('storage/' . $category->image) }}"
                    alt="{{ $category->name }}"
                >

            @else

                🍴

            @endif

        </div>


        <h3>
            {{ $category->name }}
        </h3>

    </a>

@endforeach
                </div>

            @else

                <div class="empty-box">
                    No categories available yet.
                </div>

            @endif

        </section>



        {{-- ================= RESTAURANTS ================= --}}

        <section class="home-section">

            <div class="section-heading">

                <div>

                    <h2>
                        🏪 Popular Restaurants
                    </h2>

                    <p>
                        Explore restaurants available on Smart Food.
                    </p>

                </div>

                <a
                    href="{{ route('restaurants.index') }}"
                    class="view-all"
                >
                    View All →
                </a>

            </div>


            @if($restaurants->count())

                <div class="restaurants-grid">

                    @foreach($restaurants as $restaurant)

                        <div class="restaurant-card">

                            @if($restaurant->image)

                                <img
                                    src="{{ asset('storage/' . $restaurant->image) }}"
                                    alt="{{ $restaurant->name }}"
                                    class="restaurant-image"
                                >

                            @else

                                <div class="restaurant-placeholder">
                                    🍔
                                </div>

                            @endif


                            <div class="restaurant-content">

                                <h3>
                                    {{ $restaurant->name }}
                                </h3>

                                <p>
                                    📍 {{ $restaurant->address }}
                                </p>

                                <p>
                                    📞 {{ $restaurant->phone }}
                                </p>

                             <a
    href="{{ route('restaurants.show', $restaurant) }}"
    class="restaurant-link"
>
    View Restaurant →
</a>
                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="empty-box">
                    No approved restaurants available yet.
                </div>

            @endif

        </section>



        {{-- ================= CTA ================= --}}

        @guest

            <section class="cta">

                <h2>
                    Ready to explore Smart Food?
                </h2>

                <p>
                    Create your account and start discovering
                    restaurants and delicious meals.
                </p>

                <a href="{{ route('register') }}">
                    Create Account
                </a>

            </section>

        @endguest


    </div>

</x-app-layout>