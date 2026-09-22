<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | Smart Food</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            min-height: 100vh;
            background: #fff8f3;
        }

        /* ================= NAVBAR ================= */

        .navbar {
            height: 80px;
            width: 100%;
            padding: 0 7%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: white;
            border-bottom: 1px solid #f1e5de;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .logo-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #ff6b35;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .logo-text {
            font-size: 23px;
            font-weight: 800;
            color: #2d2d2d;
        }

        .logo-text span {
            color: #ff6b35;
        }

        .home-link {
            text-decoration: none;
            color: #555;
            font-size: 15px;
            font-weight: 600;
        }

        .home-link:hover {
            color: #ff6b35;
        }


        /* ================= MAIN ================= */

        .main {
            min-height: calc(100vh - 80px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 50px 7%;
        }

        .login-wrapper {
            width: 100%;
            max-width: 1150px;
            min-height: 650px;

            display: grid;
            grid-template-columns: 1.05fr .95fr;

            background: white;
            border-radius: 30px;
            overflow: hidden;

            box-shadow:
                0 25px 70px rgba(50, 30, 20, 0.12);
        }


        /* ================= LEFT ================= */

        .food-section {
            position: relative;
            overflow: hidden;

            background:
                linear-gradient(
                    rgba(0, 0, 0, .25),
                    rgba(0, 0, 0, .45)
                ),
                url("https://images.unsplash.com/photo-1547592180-85f173990554?auto=format&fit=crop&w=1000&q=80");

            background-size: cover;
            background-position: center;

            display: flex;
            align-items: flex-end;
            padding: 55px;
        }

        .food-content {
            color: white;
            max-width: 470px;
        }

        .food-badge {
            display: inline-block;
            background: rgba(255,255,255,.18);
            backdrop-filter: blur(10px);

            padding: 9px 16px;
            border-radius: 30px;

            font-size: 13px;
            font-weight: bold;

            margin-bottom: 18px;
        }

        .food-content h1 {
            font-size: 48px;
            line-height: 1.1;
            margin-bottom: 18px;
        }

        .food-content h1 span {
            color: #ffb088;
        }

        .food-content p {
            font-size: 17px;
            line-height: 1.7;
            color: #f7f7f7;
        }


        /* ================= RIGHT ================= */

        .login-section {
            padding: 65px 60px;

            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .welcome {
            margin-bottom: 35px;
        }

        .welcome h2 {
            font-size: 34px;
            color: #252525;
            margin-bottom: 10px;
        }

        .welcome p {
            color: #888;
            font-size: 15px;
        }


        /* ================= FORM ================= */

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;

            margin-bottom: 9px;

            color: #333;
            font-size: 14px;
            font-weight: 700;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);

            font-size: 18px;
            color: #999;
        }

        .input-wrapper input {
            width: 100%;

            padding: 15px 16px 15px 48px;

            border: 1px solid #e4ddd8;
            border-radius: 13px;

            outline: none;

            font-size: 15px;

            background: #fffdfb;

            transition: .2s;
        }

        .input-wrapper input:focus {
            border-color: #ff6b35;

            box-shadow:
                0 0 0 4px rgba(255,107,53,.10);
        }

        .input-wrapper input::placeholder {
            color: #aaa;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 7px;
        }


        /* ================= OPTIONS ================= */

        .options {
            display: flex;
            align-items: center;
            justify-content: space-between;

            margin: 5px 0 25px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;

            color: #777;
            font-size: 13px;
        }

        .remember input {
            accent-color: #ff6b35;
        }

        .forgot {
            color: #ff6b35;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
        }


        /* ================= BUTTON ================= */

        .login-btn {
            width: 100%;

            border: none;
            border-radius: 13px;

            padding: 16px;

            background: #ff6b35;
            color: white;

            font-size: 16px;
            font-weight: 700;

            cursor: pointer;

            box-shadow:
                0 10px 25px rgba(255,107,53,.25);

            transition: .25s;
        }

        .login-btn:hover {
            background: #f45b27;
            transform: translateY(-2px);

            box-shadow:
                0 14px 30px rgba(255,107,53,.32);
        }


        /* ================= REGISTER ================= */

        .register {
            text-align: center;
            margin-top: 25px;

            color: #888;
            font-size: 14px;
        }

        .register a {
            color: #ff6b35;
            font-weight: 700;
            text-decoration: none;
            margin-left: 4px;
        }

        .register a:hover {
            text-decoration: underline;
        }


        /* ================= MOBILE ================= */

        @media (max-width: 900px) {

            .login-wrapper {
                grid-template-columns: 1fr;
            }

            .food-section {
                min-height: 330px;
            }

            .food-content h1 {
                font-size: 38px;
            }
        }


        @media (max-width: 600px) {

            .navbar {
                padding: 0 5%;
            }

            .main {
                padding: 25px 15px;
            }

            .login-wrapper {
                border-radius: 20px;
            }

            .food-section {
                min-height: 280px;
                padding: 30px;
            }

            .food-content h1 {
                font-size: 32px;
            }

            .food-content p {
                font-size: 14px;
            }

            .login-section {
                padding: 40px 25px;
            }

            .welcome h2 {
                font-size: 28px;
            }
        }
    </style>
</head>


<body>

    <!-- ================= NAVBAR ================= -->

    <nav class="navbar">

        <a href="/" class="logo">

            <div class="logo-icon">
                🍴
            </div>

            <div class="logo-text">
                Smart<span>Food</span>
            </div>

        </a>

        <a href="/" class="home-link">
            ← Back to Home
        </a>

    </nav>


    <!-- ================= MAIN ================= -->

    <main class="main">

        <div class="login-wrapper">


            <!-- LEFT FOOD IMAGE -->

            <section class="food-section">

                <div class="food-content">

                    <div class="food-badge">
                        🍽️ SMART FOOD EXPERIENCE
                    </div>

                    <h1>
                        Eat Smart.<br>
                        Live <span>Better.</span>
                    </h1>

                    <p>
                        Discover delicious meals,
                        make smarter food choices,
                        and enjoy a personalized
                        food experience.
                    </p>

                </div>

            </section>


            <!-- RIGHT LOGIN -->

            <section class="login-section">

                <div class="welcome">

                    <h2>
                        Welcome Back 👋
                    </h2>

                    <p>
                        Sign in to continue your journey with Smart Food.
                    </p>

                </div>


                @if (session('status'))

                    <div style="
                        color: #15803d;
                        background: #f0fdf4;
                        padding: 12px 15px;
                        border-radius: 10px;
                        margin-bottom: 20px;
                        font-size: 14px;
                    ">
                        {{ session('status') }}
                    </div>

                @endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif



                <!-- FORM -->

                <form method="POST" action="{{ route('login') }}">

                    @csrf


                    <!-- PHONE -->

                    <div class="form-group">

                        <label for="phone">
                            Phone Number
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">
                                📱
                            </span>

                            <input
                                id="phone"
                                type="text"
                                name="phone"
                                value="{{ old('phone') }}"
                                required
                                autofocus
                                autocomplete="tel"
                                placeholder="Enter your phone number"
                            >

                        </div>

                        @error('phone')

                            <div class="error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <!-- PASSWORD -->

                    <div class="form-group">

                        <label for="password">
                            Password
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">
                                🔒
                            </span>

                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="Enter your password"
                            >

                        </div>

                        @error('password')

                            <div class="error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <!-- OPTIONS -->

                    <div class="options">

                        <label class="remember">

                            <input
                                type="checkbox"
                                name="remember"
                                id="remember_me"
                            >

                            Remember me

                        </label>

                    </div>


                    <!-- LOGIN -->

                    <button
                        type="submit"
                        class="login-btn"
                    >
                        Login to Smart Food
                    </button>

                </form>


                <!-- REGISTER -->

                <div class="register">

                    Don't have an account?

                    <a href="{{ route('register') }}">
                        Create Account
                    </a>

                </div>

            </section>

        </div>

    </main>

</body>

</html>