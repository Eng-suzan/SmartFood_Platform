<nav class="food-navbar">
    <div class="food-nav-container">

        <!-- Logo -->
        <a href="{{ route('home') }}" class="food-logo">
            🍔 <span>Smart Food</span>
        </a>

        <!-- Navigation Links -->
        <div class="food-nav-links">
            <a href="{{ route('home') }}">Home</a>


@auth

        {{-- Admin Dashboard --}}
        @if(Auth::user()->role === 'admin')

            <a href="{{ route('admin.dashboard') }}">
                📊 Dashboard
            </a>

        @endif
        {{-- Restaurant Dashboard --}}
    @if(Auth::user()->role === 'restaurant')
        <a href="{{ route('restaurant.dashboard') }}">
            📊 Dashboard
        </a>
    @endif
@endauth
            @auth

    @if(Auth::user()->role === 'admin')

        <a href="{{ route('admin.restaurants.index') }}">
            🍽️ Restaurants
        </a>

    @else

        <a href="{{ route('restaurants.index') }}">
            🍽️ Restaurants
        </a>

    @endif

@else

    <a href="{{ route('restaurants.index') }}">
        🍽️ Restaurants
    </a>

@endauth
        
            <a href="{{ route('categories.index') }}">
                📂 Categories
            </a>
 @auth
    @if(Auth::user()->role === 'customer')
        <a href="{{ route('chat.index') }}">
            🤖 AI Assistant
        </a>
    @endif
@endauth
      <a href="{{ route('about') }}">
                📖 About
            </a>
        </div>
@auth

    @if(Auth::user()->role === 'customer')
<a href="{{ route('orders.index') }}">
        📦 Orders
    </a>
        @php
            $cartCount = \App\Models\Cart::where('user_id', Auth::id())
                ->with('items')
                ->first()?->items
                ->sum('quantity') ?? 0;
        @endphp

        <a href="{{ route('cart.index') }}" class="cart-link">
            🛒 Cart

            @if($cartCount > 0)
                <span class="cart-count">
                    {{ $cartCount }}
                </span>
            @endif
        </a>

    @endif

@endauth
    
<!-- Right Side -->
<div class="food-nav-actions">

    @auth

        {{-- Notifications --}}
        @php
            $notificationCount = Auth::user()->unreadNotifications->count();
        @endphp

      <a href="{{ route('notifications.index') }}"
   class="notification-link"
   title="Notifications">

    🔔

    @if($notificationCount > 0)
        <span class="notification-count">
            {{ $notificationCount > 99 ? '99+' : $notificationCount }}
        </span>
    @endif

</a>


        <!-- Profile -->
        <a href="{{ route('profile.edit') }}" class="profile-link">

            <div class="profile-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>

            <div class="profile-text">
                <span>Hello 👋</span>
                <strong>{{ Auth::user()->name }}</strong>
            </div>

        </a>


        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="logout-btn">
                Logout
            </button>
        </form>


    @else

        <!-- Login -->
        <a href="{{ route('login') }}" class="login-btn">
            Login
        </a>

        <!-- Register -->
        <a href="{{ route('register') }}" class="register-btn">
            Register
        </a>

    @endauth

</div>

    </div>
</nav>

<style>

    /* =========================
       Navbar
    ========================= */

    .food-navbar {
        background: white;
        border-bottom: 1px solid #eee;
        height: 72px;

        display: flex;
        align-items: center;

        position: sticky;
        top: 0;
        z-index: 1000;

        box-shadow: 0 2px 10px rgba(0,0,0,0.04);
    }

    .food-nav-container {
        width: 100%;
        max-width: 1200px;

        margin: auto;
        padding: 0 25px;

        display: flex;
        align-items: center;
        justify-content: space-between;
    }


    /* =========================
       Logo
    ========================= */

    .food-logo {
        text-decoration: none;
        color: #222;

        font-size: 22px;
        font-weight: bold;

        display: flex;
        align-items: center;
        gap: 8px;
    }

    .food-logo span {
        color: #ff5722;
    }

.cart-link {
    position: relative;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    text-decoration: none;
    color: #333;
}

.cart-count {
    background: #ff5722;
    color: white;

    min-width: 20px;
    height: 20px;

    padding: 0 5px;

    border-radius: 20px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    font-size: 11px;
    font-weight: 700;
}
    /* =========================
       Navigation Links
    ========================= */

    .food-nav-links {
        display: flex;
        align-items: center;
        gap: 30px;
    }

    .food-nav-links a {
        text-decoration: none;
        color: #555;

        font-size: 15px;
        font-weight: 500;

        transition: 0.2s;
    }

    .food-nav-links a:hover {
        color: #ff5722;
    }

/* =========================
   Notifications
========================= */

/* =========================
   Notifications
========================= */

.notification-link {
    position: relative !important;

    width: 42px;
    height: 42px;

    display: inline-flex !important;
    align-items: center;
    justify-content: center;

    text-decoration: none;
    font-size: 22px;

    border-radius: 50%;
    transition: 0.2s;

    flex-shrink: 0;
}

.notification-link:hover {
    background: #fff3ed;
}

.notification-count {
    position: absolute !important;

    top: -3px !important;
    right: -5px !important;

    min-width: 19px !important;
    height: 19px !important;

    padding: 0 5px !important;

    background: #ff5722 !important;
    color: #fff !important;

    border-radius: 50% !important;

    display: flex !important;
    align-items: center;
    justify-content: center;

    font-size: 10px !important;
    line-height: 1 !important;
    font-weight: 700 !important;

    border: 2px solid white !important;

    box-sizing: border-box;
}


    /* =========================
       Right Side
    ========================= */

    .food-nav-actions {
        display: flex;
        align-items: center;
        gap: 15px;
    }


    /* =========================
       Profile
    ========================= */

    .profile-link {
        display: flex;
        align-items: center;

        gap: 9px;

        text-decoration: none;

        padding: 6px 10px;

        border-radius: 12px;

        transition: 0.2s;
    }

    .profile-link:hover {
        background: #fff3ed;
    }


    .profile-avatar {
        width: 40px;
        height: 40px;

        border-radius: 50%;

        background: linear-gradient(
            135deg,
            #ff5722,
            #ff8a65
        );

        color: white;

        display: flex;
        align-items: center;
        justify-content: center;

        font-weight: bold;
        font-size: 16px;
    }


    .profile-text {
        display: flex;
        flex-direction: column;

        line-height: 1.2;
    }

    .profile-text span {
        font-size: 11px;
        color: #999;
    }

    .profile-text strong {
        font-size: 14px;
        color: #333;

        max-width: 120px;

        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }


    /* =========================
       Logout
    ========================= */

    .logout-btn {
        border: none;
        background: transparent;

        color: #555;

        cursor: pointer;

        font-size: 14px;
        font-weight: 500;

        padding: 8px 5px;

        transition: 0.2s;
    }

    .logout-btn:hover {
        color: #ff5722;
    }


    /* =========================
       Login / Register
    ========================= */

    .login-btn,
    .register-btn {
        text-decoration: none;

        background: #ff5722;
        color: white;

        padding: 10px 18px;

        border-radius: 8px;

        font-weight: 600;

        transition: 0.2s;
    }

    .login-btn:hover,
    .register-btn:hover {
        background: #e64a19;
    }


    /* =========================
       Mobile
    ========================= */

    @media (max-width: 768px) {

        .food-nav-links {
            display: none;
        }

        .food-nav-container {
            padding: 0 15px;
        }

        .profile-text {
            display: none;
        }

        .logout-btn {
            font-size: 13px;
        }
    }

</style>