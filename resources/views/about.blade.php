<x-app-layout>

    <style>

        * {
            box-sizing: border-box;
        }

        .about-page {
            background: #fffaf7;
            min-height: 100vh;
        }

        /* ================= HERO ================= */

        .about-hero {
            padding: 75px 7%;

            background:
                linear-gradient(
                    135deg,
                    #fff3ed,
                    #fffaf7
                );

            text-align: center;
        }

        .about-badge {
            display: inline-block;

            background: #ffe9df;
            color: #ff5722;

            padding: 8px 15px;

            border-radius: 30px;

            font-size: 12px;
            font-weight: 700;

            margin-bottom: 18px;
        }

        .about-hero h1 {
            margin: 0 0 18px;

            font-size: 48px;

            color: #222;
        }

        .about-hero h1 span {
            color: #ff5722;
        }

        .about-hero p {
            max-width: 700px;

            margin: auto;

            color: #777;

            font-size: 16px;

            line-height: 1.8;
        }


        /* ================= ABOUT ================= */

        .about-section {
            max-width: 1100px;

            margin: auto;

            padding: 70px 25px;
        }

        .about-grid {
            display: grid;

            grid-template-columns:
                1fr 1fr;

            gap: 45px;

            align-items: center;
        }

        .about-image {
            width: 100%;
            height: 380px;

            border-radius: 24px;

            overflow: hidden;

            box-shadow:
                0 12px 35px rgba(0,0,0,.10);
        }

        .about-image img {
            width: 100%;
            height: 100%;

            object-fit: cover;
        }

        .about-content h2 {
            margin: 0 0 15px;

            font-size: 32px;

            color: #222;
        }

        .about-content h2 span {
            color: #ff5722;
        }

        .about-content p {
            color: #777;

            font-size: 14px;

            line-height: 1.8;

            margin-bottom: 15px;
        }


        /* ================= FEATURES ================= */

        .features-section {
            background: white;

            padding: 70px 25px;
        }

        .section-title {
            text-align: center;

            margin-bottom: 35px;
        }

        .section-title h2 {
            margin: 0 0 8px;

            font-size: 30px;

            color: #222;
        }

        .section-title p {
            margin: 0;

            color: #888;

            font-size: 14px;
        }

        .features-grid {
            max-width: 1100px;

            margin: auto;

            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 20px;
        }

        .feature-card {
            background: #fffaf7;

            border: 1px solid #eee;

            border-radius: 18px;

            padding: 30px 22px;

            text-align: center;

            transition: .2s;
        }

        .feature-card:hover {
            transform: translateY(-4px);

            box-shadow:
                0 10px 25px rgba(0,0,0,.06);
        }

        .feature-icon {
            width: 60px;
            height: 60px;

            margin: 0 auto 15px;

            border-radius: 16px;

            background: #fff3ed;

            display: flex;

            align-items: center;
            justify-content: center;

            font-size: 28px;
        }

        .feature-card h3 {
            margin: 0 0 10px;

            font-size: 18px;

            color: #222;
        }

        .feature-card p {
            margin: 0;

            color: #888;

            font-size: 13px;

            line-height: 1.7;
        }


        /* ================= HOW IT WORKS ================= */

        .how-section {
            max-width: 1100px;

            margin: auto;

            padding: 70px 25px;
        }

        .steps {
            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 25px;
        }

        .step {
            text-align: center;

            padding: 25px;
        }

        .step-number {
            width: 55px;
            height: 55px;

            margin: 0 auto 15px;

            border-radius: 50%;

            background: #ff5722;

            color: white;

            display: flex;

            align-items: center;
            justify-content: center;

            font-size: 20px;

            font-weight: 700;
        }

        .step h3 {
            margin: 0 0 8px;

            color: #222;

            font-size: 18px;
        }

        .step p {
            margin: 0;

            color: #888;

            font-size: 13px;

            line-height: 1.7;
        }


        /* ================= CTA ================= */

        .about-cta {
            max-width: 1100px;

            margin: 0 auto 70px;

            padding: 50px 25px;

            border-radius: 25px;

            background:
                linear-gradient(
                    135deg,
                    #ff5722,
                    #ff7043
                );

            text-align: center;

            color: white;
        }

        .about-cta h2 {
            margin: 0 0 10px;

            font-size: 30px;
        }

        .about-cta p {
            max-width: 600px;

            margin: 0 auto 25px;

            color: #fff3ed;

            line-height: 1.7;
        }

        .about-cta a {
            display: inline-block;

            padding: 12px 22px;

            background: white;

            color: #ff5722;

            border-radius: 10px;

            text-decoration: none;

            font-size: 14px;

            font-weight: 700;
        }


        /* ================= MOBILE ================= */

        @media(max-width: 800px) {

            .about-grid {
                grid-template-columns: 1fr;
            }

            .features-grid,
            .steps {
                grid-template-columns: 1fr;
            }

            .about-hero h1 {
                font-size: 38px;
            }

        }

    </style>


    <div class="about-page">


        {{-- ================= HERO ================= --}}

        <section class="about-hero">

            <span class="about-badge">
                🍽️ ABOUT SMART FOOD
            </span>

            <h1>
                Food Made
                <span>Smarter.</span>
            </h1>

            <p>
                Smart Food is a modern food discovery platform
                that helps users discover restaurants, explore food
                categories, and find delicious meals in one simple place.
            </p>

        </section>



        {{-- ================= WHO WE ARE ================= --}}

        <section class="about-section">

            <div class="about-grid">


                <div class="about-image">

                    <img
                        src="https://images.unsplash.com/photo-1498837167922-ddd27525d352?auto=format&fit=crop&w=1000&q=80"
                        alt="Smart Food"
                    >

                </div>


                <div class="about-content">

                    <h2>
                        Discover Food
                        <span>Better.</span>
                    </h2>

                    <p>
                        Smart Food connects food lovers with restaurants
                        and delicious meals through an easy and organized
                        digital experience.
                    </p>

                    <p>
                        Users can browse restaurants, explore different
                        food categories, and discover meals with their
                        prices and details.
                    </p>

                    <p>
                        Restaurant owners can also manage their restaurants
                        and add their menu items to reach more customers.
                    </p>

                </div>

            </div>

        </section>



        {{-- ================= FEATURES ================= --}}

        <section class="features-section">

            <div class="section-title">

                <h2>
                    Why Smart Food?
                </h2>

                <p>
                    Everything you need to discover great food.
                </p>

            </div>


            <div class="features-grid">


                <div class="feature-card">

                    <div class="feature-icon">
                        🍽️
                    </div>

                    <h3>
                        Discover Restaurants
                    </h3>

                    <p>
                        Explore approved restaurants and
                        discover new places to enjoy your favorite meals.
                    </p>

                </div>


                <div class="feature-card">

                    <div class="feature-icon">
                        📂
                    </div>

                    <h3>
                        Food Categories
                    </h3>

                    <p>
                        Browse food by categories and quickly
                        find exactly what you're craving.
                    </p>

                </div>


                <div class="feature-card">

                    <div class="feature-icon">
                        🍔
                    </div>

                    <h3>
                        Detailed Meals
                    </h3>

                    <p>
                        View meal images, descriptions,
                        prices, availability and restaurant information.
                    </p>

                </div>


                <div class="feature-card">

                    <div class="feature-icon">
                        👨‍🍳
                    </div>

                    <h3>
                        Restaurant Management
                    </h3>

                    <p>
                        Restaurant owners can manage their restaurant
                        and add their menu items easily.
                    </p>

                </div>


                <div class="feature-card">

                    <div class="feature-icon">
                        🔎
                    </div>

                    <h3>
                        Easy Exploration
                    </h3>

                    <p>
                        Find restaurants and meals through a simple
                        and user-friendly experience.
                    </p>

                </div>


                <div class="feature-card">

                    <div class="feature-icon">
                        ⚡
                    </div>

                    <h3>
                        Smart Experience
                    </h3>

                    <p>
                        A clean and modern platform designed
                        to make food discovery easier.
                    </p>

                </div>


            </div>

        </section>



        {{-- ================= HOW IT WORKS ================= --}}

        <section class="how-section">

            <div class="section-title">

                <h2>
                    How Smart Food Works
                </h2>

                <p>
                    Discover your next favorite meal in three simple steps.
                </p>

            </div>


            <div class="steps">


                <div class="step">

                    <div class="step-number">
                        1
                    </div>

                    <h3>
                        Explore
                    </h3>

                    <p>
                        Browse restaurants and food categories
                        available on Smart Food.
                    </p>

                </div>


                <div class="step">

                    <div class="step-number">
                        2
                    </div>

                    <h3>
                        Discover
                    </h3>

                    <p>
                        Open a restaurant or category and
                        explore delicious meals.
                    </p>

                </div>


                <div class="step">

                    <div class="step-number">
                        3
                    </div>

                    <h3>
                        Enjoy
                    </h3>

                    <p>
                        Find the meal you love and enjoy
                        a smarter food discovery experience.
                    </p>

                </div>


            </div>

        </section>



        {{-- ================= CTA ================= --}}

        @guest

            <section class="about-cta">

                <h2>
                    Ready to Discover Great Food?
                </h2>

                <p>
                    Join Smart Food and start exploring
                    restaurants and delicious meals today.
                </p>

                <a href="{{ route('register') }}">
                    Create Account
                </a>

            </section>

        @endguest


    </div>

</x-app-layout>