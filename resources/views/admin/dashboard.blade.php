<x-app-layout>

<style>

    .admin-dashboard {
        max-width: 1200px;
        margin: auto;
        padding: 45px 25px 80px;
        background: #fafafa;
        min-height: 100vh;
    }

    /* Header */

    .admin-header {
        display: flex;
        justify-content: space-between;
        align-items: center;

        background: linear-gradient(
            135deg,
            #fff3ed,
            #ffffff
        );

        border: 1px solid #ffe0d2;
        border-radius: 22px;

        padding: 35px;

        margin-bottom: 30px;
    }

    .admin-header span {
        color: #ff5722;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .admin-header h1 {
        margin: 8px 0;
        font-size: 30px;
        color: #222;
    }

    .admin-header p {
        margin: 0 0 20px;
        color: #777;
    }

    .admin-icon {
        width: 75px;
        height: 75px;

        flex-shrink: 0;

        border-radius: 50%;

        background: #ff5722;
        color: white;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 32px;
    }

    /* Admin Actions */

    .admin-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .admin-action-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;

        padding: 11px 18px;

        border-radius: 10px;

        text-decoration: none;

        font-size: 14px;
        font-weight: 600;

        transition: 0.2s ease;

        border: 1px solid #eee;

        background: white;

        color: #333;

        box-shadow: 0 3px 10px rgba(0,0,0,.05);
    }

    .admin-action-btn span {
        font-size: 17px;
        letter-spacing: 0;
    }

    .admin-action-btn:hover {
        transform: translateY(-2px);

        box-shadow: 0 6px 16px rgba(0,0,0,.10);
    }

    .analytics-btn:hover {
        border-color: #ff5722;
        color: #ff5722;
    }

    .restaurant-btn:hover {
        border-color: #2196f3;
        color: #2196f3;
    }

    .categories-btn:hover {
        border-color: #673ab7;
        color: #673ab7;
    }

    /* Stats */

    .stats-grid {
        display: grid;

        grid-template-columns: repeat(3, 1fr);

        gap: 18px;

        margin-bottom: 40px;
    }

    .stat-card {
        background: white;

        border: 1px solid #eee;

        border-radius: 16px;

        padding: 22px;

        box-shadow:
            0 5px 20px rgba(0,0,0,.04);
    }

    .stat-card span {
        display: block;

        color: #888;

        font-size: 13px;

        margin-bottom: 8px;
    }

    .stat-card strong {
        display: block;

        color: #222;

        font-size: 30px;
    }

    .pending-number {
        color: #ef6c00 !important;
    }

    .approved-number {
        color: #2e7d32 !important;
    }

    /* Success Message */

    .success-message {
        background: #e8f5e9;

        color: #2e7d32;

        border: 1px solid #c8e6c9;

        padding: 13px 17px;

        border-radius: 10px;

        margin-bottom: 20px;

        font-size: 14px;
    }

    /* Section */

    .section-header {
        display: flex;

        justify-content: space-between;

        align-items: center;

        margin-bottom: 18px;
    }

    .section-header h2 {
        margin: 0;

        color: #222;

        font-size: 24px;
    }

    .section-header span {
        color: #888;

        font-size: 13px;
    }

    /* Restaurant List */

    .restaurants-list {
        display: flex;

        flex-direction: column;

        gap: 18px;
    }

    /* Restaurant Card */

    .restaurant-card {
        background: white;

        border: 1px solid #eee;

        border-radius: 18px;

        padding: 20px;

        display: flex;

        gap: 20px;

        box-shadow:
            0 5px 20px rgba(0,0,0,.04);
    }

    .restaurant-image {
        width: 180px;

        height: 150px;

        flex-shrink: 0;

        border-radius: 14px;

        overflow: hidden;

        background: #fff3ed;
    }

    .restaurant-image img {
        width: 100%;

        height: 100%;

        object-fit: cover;
    }

    .restaurant-placeholder {
        height: 100%;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 50px;
    }

    .restaurant-content {
        flex: 1;
    }

    .restaurant-title {
        display: flex;

        justify-content: space-between;

        gap: 15px;

        margin-bottom: 14px;
    }

    .restaurant-title h3 {
        margin: 0 0 6px;

        color: #222;

        font-size: 21px;
    }

    .restaurant-title p {
        margin: 0;

        color: #888;

        font-size: 13px;
    }

    .owner {
        color: #666;

        font-size: 13px;

        margin-bottom: 12px;
    }

    /* Restaurant Info */

    .info-grid {
        display: grid;

        grid-template-columns: repeat(3, 1fr);

        gap: 10px;

        margin-bottom: 18px;
    }

    .info-item {
        padding: 10px;

        background: #fafafa;

        border-radius: 8px;
    }

    .info-item span {
        display: block;

        color: #999;

        font-size: 10px;

        margin-bottom: 3px;
    }

    .info-item strong {
        color: #333;

        font-size: 12px;
    }

    /* Restaurant Buttons */

    .restaurant-actions {
        display: flex;

        gap: 10px;
    }

    .approve-btn,
    .reject-btn,
    .delete-btn {
        border: none;

        padding: 9px 15px;

        border-radius: 8px;

        color: white;

        font-size: 12px;

        font-weight: 700;

        cursor: pointer;
    }

    .approve-btn {
        background: #2e7d32;
    }

    .approve-btn:hover {
        background: #256628;
    }

    .reject-btn {
        background: #e53935;
    }

    .reject-btn:hover {
        background: #c62828;
    }

    .delete-btn {
        background: #555;
    }

    .delete-btn:hover {
        background: #333;
    }

    /* Empty */

    .empty-box {
        background: white;

        border: 1px solid #eee;

        border-radius: 18px;

        padding: 55px 20px;

        text-align: center;

        color: #888;
    }

    .empty-box div {
        font-size: 50px;

        margin-bottom: 10px;
    }

    .empty-box h3 {
        color: #333;

        margin-bottom: 8px;
    }

    /* Mobile */

    @media(max-width: 900px) {

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .restaurant-card {
            flex-direction: column;
        }

        .restaurant-image {
            width: 100%;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

    }

    @media(max-width: 600px) {

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .admin-header {
            padding: 25px;
        }

        .admin-header {
            align-items: flex-start;
        }

        .admin-icon {
            display: none;
        }

        .admin-actions {
            flex-direction: column;
        }

        .admin-action-btn {
            width: 100%;
            justify-content: center;
        }

        .restaurant-actions {
            flex-wrap: wrap;
        }

    }

</style>


<div class="admin-dashboard">


    {{-- Success Message --}}

    @if(session('success'))

        <div class="success-message">

            ✅ {{ session('success') }}

        </div>

    @endif


    {{-- Header --}}

    <div class="admin-header">

        <div>

            <span>
                ADMIN PANEL
            </span>

            <h1>
                Welcome admin, {{ Auth::user()->name }} 👋
            </h1>

            <p>
                Manage Smart Food platform and restaurants.
            </p>


            {{-- Admin Actions --}}

            <div class="admin-actions">

                <a
                    href="{{ route('admin.analytics') }}"
                    class="admin-action-btn analytics-btn"
                >
                    <span>📊</span>
                    Analytics
                </a>


                <a
                    href="{{ route('admin.restaurants.index') }}"
                    class="admin-action-btn restaurant-btn"
                >
                    <span>🏪</span>
                    Restaurants
                </a>


                <a
                    href="{{ route('admin.categories.index') }}"
                    class="admin-action-btn categories-btn"
                >
                    <span>📂</span>
                    Categories
                </a>

            </div>

        </div>


        <div class="admin-icon">
            👨‍💼
        </div>

    </div>


    {{-- Stats --}}

    <div class="stats-grid">


        {{-- Total Users --}}

        <div class="stat-card">

            <span>
                👥 Total Users
            </span>

            <strong>
                {{ $totalUsers }}
            </strong>

        </div>


        {{-- Total Restaurants --}}

        <div class="stat-card">

            <span>
                🏪 Total Restaurants
            </span>

            <strong>
                {{ $totalRestaurants }}
            </strong>

        </div>


        {{-- Total Orders --}}

        <div class="stat-card">

            <span>
                📦 Total Orders
            </span>

            <strong>
                {{ $totalOrders }}
            </strong>

        </div>


        {{-- Total Revenue --}}

        <div class="stat-card">

            <span>
                💰 Total Revenue
            </span>

            <strong>
                {{ number_format($totalRevenue, 2) }} EGP
            </strong>

        </div>


        {{-- Pending Restaurants --}}

        <div class="stat-card">

            <span>
                ⏳ Pending Restaurants
            </span>

            <strong class="pending-number">
                {{ $pendingRestaurants }}
            </strong>

        </div>


        {{-- Approved Restaurants --}}

        <div class="stat-card">

            <span>
                ✅ Approved Restaurants
            </span>

            <strong class="approved-number">
                {{ $approvedRestaurants }}
            </strong>

        </div>

    </div>


    {{-- Top Restaurants --}}

    <div
        class="section-header"
        style="margin-top: 35px;"
    >

        <div>

            <h2>
                🏆 Top Restaurants
            </h2>

        </div>

        <span>
            Top 5 by orders
        </span>

    </div>


    @if($topRestaurants->count())

        <div class="restaurants-list">

            @foreach($topRestaurants as $restaurant)

                <div class="restaurant-card">


                    {{-- Restaurant Image --}}

                    <div class="restaurant-image">

                        @if($restaurant->image)

                            <img
                                src="{{ asset('storage/' . $restaurant->image) }}"
                                alt="{{ $restaurant->name }}"
                            >

                        @else

                            <div class="restaurant-placeholder">
                                🍽️
                            </div>

                        @endif

                    </div>


                    {{-- Restaurant Info --}}

                    <div class="restaurant-content">

                        <div class="restaurant-title">

                            <div>

                                <h3>
                                    {{ $restaurant->name }}
                                </h3>

                                <p>
                                    📍 {{ $restaurant->address }}
                                </p>

                            </div>

                        </div>


                        <div class="info-grid">


                            {{-- Total Orders --}}

                            <div class="info-item">

                                <span>
                                    TOTAL ORDERS
                                </span>

                                <strong>
                                    {{ $restaurant->orders_count }}
                                </strong>

                            </div>


                            {{-- Revenue --}}

                            <div class="info-item">

                                <span>
                                    REVENUE
                                </span>

                                <strong>
                                    {{ number_format($restaurant->revenue ?? 0, 2) }} EGP
                                </strong>

                            </div>


                            {{-- Owner --}}

                            <div class="info-item">

                                <span>
                                    OWNER
                                </span>

                                <strong>
                                    {{ $restaurant->owner?->name ?? 'Unknown' }}
                                </strong>

                            </div>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="empty-box">

            <div>
                📊
            </div>

            <h3>
                No Restaurant Analytics Yet
            </h3>

            <p>
                Restaurant performance will appear here once orders are available.
            </p>

        </div>

    @endif


    {{-- Pending Restaurants --}}

    <div
        class="section-header"
        style="margin-top: 35px;"
    >

        <div>

            <h2>
                🏪 Pending Restaurants
            </h2>

        </div>

        <span>
            {{ $pendingRestaurants }} pending
        </span>

    </div>


    @if($restaurants->count())

        <div class="restaurants-list">

            @foreach($restaurants as $restaurant)

                <div class="restaurant-card">


                    {{-- Image --}}

                    <div class="restaurant-image">

                        @if($restaurant->image)

                            <img
                                src="{{ asset('storage/' . $restaurant->image) }}"
                                alt="{{ $restaurant->name }}"
                            >

                        @else

                            <div class="restaurant-placeholder">
                                🍽️
                            </div>

                        @endif

                    </div>


                    {{-- Content --}}

                    <div class="restaurant-content">

                        <div class="restaurant-title">

                            <div>

                                <h3>
                                    {{ $restaurant->name }}
                                </h3>

                                <p>
                                    📍 {{ $restaurant->address }}
                                </p>

                            </div>

                        </div>


                        <div class="owner">

                            👤 Owner:
                            {{ $restaurant->owner?->name ?? 'Unknown' }}

                        </div>


                        <div class="info-grid">


                            {{-- Phone --}}

                            <div class="info-item">

                                <span>
                                    PHONE
                                </span>

                                <strong>
                                    {{ $restaurant->phone }}
                                </strong>

                            </div>


                            {{-- Email --}}

                            <div class="info-item">

                                <span>
                                    EMAIL
                                </span>

                                <strong>
                                    {{ $restaurant->email ?? 'Not provided' }}
                                </strong>

                            </div>


                            {{-- Status --}}

                            <div class="info-item">

                                <span>
                                    STATUS
                                </span>

                                <strong>
                                    Pending
                                </strong>

                            </div>

                        </div>


                        {{-- Actions --}}

                        <div class="restaurant-actions">


                            {{-- Approve --}}

                            <form
                                method="POST"
                                action="{{ route('admin.restaurants.approve', $restaurant) }}"
                            >

                                @csrf

                                @method('PATCH')

                                <button
                                    type="submit"
                                    class="approve-btn"
                                >
                                    ✅ Approve
                                </button>

                            </form>


                            {{-- Reject --}}

                            <form
                                method="POST"
                                action="{{ route('admin.restaurants.reject', $restaurant) }}"
                            >

                                @csrf

                                @method('PATCH')

                                <button
                                    type="submit"
                                    class="reject-btn"
                                >
                                    ❌ Reject
                                </button>

                            </form>


                            {{-- Delete --}}

                            <form
                                method="POST"
                                action="{{ route('admin.restaurants.destroy', $restaurant) }}"
                                onsubmit="return confirm('Are you sure you want to delete this restaurant?');"
                            >

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="delete-btn"
                                >
                                    🗑️ Delete
                                </button>

                            </form>


                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="empty-box">

            <div>
                ✅
            </div>

            <h3>
                No Pending Restaurants
            </h3>

            <p>
                All restaurants have been reviewed.
            </p>

        </div>

    @endif


</div>

</x-app-layout>