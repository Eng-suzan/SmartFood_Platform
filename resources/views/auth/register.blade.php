
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register | Smart Food</title>

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

            padding: 40px 7%;
        }

        .register-wrapper {
            width: 100%;
            max-width: 1150px;

            display: grid;
            grid-template-columns: .95fr 1.05fr;

            background: white;

            border-radius: 30px;
            overflow: hidden;

            box-shadow:
                0 25px 70px rgba(50, 30, 20, 0.12);
        }


        /* ================= LEFT REGISTER ================= */

        .register-section {
            padding: 45px 60px;

            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .welcome {
            margin-bottom: 25px;
        }

        .welcome h2 {
            font-size: 34px;
            color: #252525;
            margin-bottom: 10px;
        }

        .welcome p {
            color: #888;
            font-size: 15px;
            line-height: 1.5;
        }


        /* ================= FORM ================= */

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;

            margin-bottom: 8px;

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

            font-size: 17px;
        }

        .input-wrapper input {
            width: 100%;

            padding: 13px 16px 13px 48px;

            border: 1px solid #e4ddd8;
            border-radius: 13px;

            outline: none;

            font-size: 14px;

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
            font-size: 12px;
            margin-top: 5px;
        }


        /* ================= BUTTON ================= */

        .register-btn {
            width: 100%;

            border: none;
            border-radius: 13px;

            padding: 15px;

            margin-top: 5px;

            background: #ff6b35;
            color: white;

            font-size: 16px;
            font-weight: 700;

            cursor: pointer;

            box-shadow:
                0 10px 25px rgba(255,107,53,.25);

            transition: .25s;
        }

        .register-btn:hover {
            background: #f45b27;

            transform: translateY(-2px);

            box-shadow:
                0 14px 30px rgba(255,107,53,.32);
        }


        /* ================= LOGIN LINK ================= */

        .login-link {
            text-align: center;

            margin-top: 20px;

            color: #888;
            font-size: 14px;
        }

        .login-link a {
            color: #ff6b35;

            font-weight: 700;

            text-decoration: none;

            margin-left: 4px;
        }

        .login-link a:hover {
            text-decoration: underline;
        }


        /* ================= RIGHT FOOD ================= */

        .food-section {
            position: relative;

            overflow: hidden;

            min-height: 650px;

            background:
                linear-gradient(
                    rgba(0, 0, 0, .25),
                    rgba(0, 0, 0, .48)
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


        /* ================= SUCCESS ================= */

        .success-message {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #047857;

            padding: 12px 15px;

            border-radius: 10px;

            margin-bottom: 20px;

            font-size: 14px;
        }


        /* ================= MOBILE ================= */

        @media (max-width: 900px) {

            .register-wrapper {
                grid-template-columns: 1fr;
            }

            .food-section {
                min-height: 300px;
                order: -1;
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

            .register-section {
                padding: 40px 25px;
            }

            .food-section {
                min-height: 260px;
                padding: 30px;
            }

            .food-content h1 {
                font-size: 30px;
            }

            .food-content p {
                font-size: 14px;
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

        <div class="register-wrapper">


            <!-- ================= REGISTER FORM ================= -->

            <section class="register-section">

                <div class="welcome">

                    <h2>
                        Create Account 🎉
                    </h2>

                    <p>
                        Join Smart Food and start your smart food journey.
                    </p>

                </div>


                <!-- SUCCESS MESSAGE -->

                @if (session('success'))

                    <div class="success-message">
                        🎉 {{ session('success') }}
                    </div>

                @endif


                <!-- FORM -->

                <form method="POST" action="{{ route('register') }}">

                    @csrf


                    <!-- NAME -->

                    <div class="form-group">

                        <label for="name">
                            Full Name
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">
                                👤
                            </span>

                            <input
                                id="name"
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                autofocus
                                autocomplete="name"
                                placeholder="Enter your full name"
                            >

                        </div>

                        @error('name')

                            <div class="error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


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
<div class="form-group">

                        <label for="role">
                            Register As
                        </label>

                        <div class="input-wrapper">

                           
                            <select
                                id="role"
                                name="role"
                                required
                            >
                                <option value="">Select Role</option>
                                <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Customer</option>
                                <option value="restaurant" {{ old('role') == 'restaurant' ? 'selected' : '' }}>Restaurant</option>
                            </select>

                        </div>

                        @error('role')

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
                                autocomplete="new-password"
                                placeholder="Create a password"
                            >

                        </div>

                        @error('password')

                            <div class="error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <!-- CONFIRM PASSWORD -->

                    <div class="form-group">

                        <label for="password_confirmation">
                            Confirm Password
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">
                                🔐
                            </span>

                            <input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                required
                                autocomplete="new-password"
                                placeholder="Confirm your password"
                            >

                        </div>

                        @error('password_confirmation')

                            <div class="error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <!-- REGISTER BUTTON -->

                    <button
                        type="submit"
                        class="register-btn"
                    >
                        Create My Account
                    </button>

                </form>


                <!-- LOGIN -->

                <div class="login-link">

                    Already have an account?

                    <a href="{{ route('login') }}">
                        Login
                    </a>

                </div>

            </section>


            <!-- ================= FOOD IMAGE ================= -->

            <section class="food-section">

                <div class="food-content">

                    <div class="food-badge">
                        🍽️ WELCOME TO SMART FOOD
                    </div>

                    <h1>
                        Your Food.<br>
                        Your <span>Choice.</span>
                    </h1>

                    <p>
                        Create your account and discover
                        a smarter way to enjoy your favorite meals.
                    </p>

                </div>

            </section>

        </div>

    </main>

</body>

</html>
