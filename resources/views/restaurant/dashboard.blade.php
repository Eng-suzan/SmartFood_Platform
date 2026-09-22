<x-app-layout>

    <div class="restaurant-dashboard">

        {{-- Success Message --}}
        @if(session('success'))
            <div class="success-message">
                ✅ {{ session('success') }}
            </div>
        @endif

        {{-- Header --}}
        <div class="dashboard-header">
            <div>
                <span class="dashboard-label">
                    RESTAURANT PANEL
                </span>
                <h1>
                    Welcome, {{ Auth::user()->name }} 👋
                </h1>
                <p>
                    Manage your restaurants, meals and orders.
                </p>
            </div>

            <div class="restaurant-icon">
                🍽️
            </div>
        </div>

        {{-- Top Action --}}
        <div class="dashboard-actions">
            <a href="{{ route('restaurant.restaurants.create') }}" class="create-btn">
                + Create Restaurant
            </a>
        </div>

        {{-- No Restaurants --}}
        @if($restaurants->isEmpty())
            <div class="empty-restaurant">
                <div class="empty-icon">
                    🍽️
                </div>
                <h2>
                    You don't have a restaurant yet
                </h2>
                <p>
                    Create your first restaurant and start managing your meals and orders.
                </p>
                <a href="{{ route('restaurant.restaurants.create') }}" class="create-btn">
                    🍽️ Create Your Restaurant
                </a>
            </div>
        @else

            {{-- Restaurants --}}
            <div class="section-header">
                <div>
                    <span>YOUR RESTAURANTS</span>
                    <h2>My Restaurants</h2>
                </div>
                <strong>
                    {{ $restaurants->count() }}
                    {{ $restaurants->count() == 1 ? 'Restaurant' : 'Restaurants' }}
                </strong>
            </div>

            <div class="restaurants-list">
                @foreach($restaurants as $restaurant)
                    <div class="restaurant-card">

                        {{-- Image --}}
                        <div class="restaurant-image">
                            @if($restaurant->image)
                                <img src="{{ asset('storage/' . $restaurant->image) }}" alt="{{ $restaurant->name }}">
                            @else
                                <div class="no-image">
                                    🍽️
                                </div>
                            @endif
                        </div>

                        {{-- Information --}}
                        <div class="restaurant-content">
                            <div class="restaurant-title">
                                <div>
                                    <h2>{{ $restaurant->name }}</h2>
                                    <p>📍 {{ $restaurant->address }}</p>
                                </div>
                                <span class="status {{ $restaurant->status === 'approved' ? 'approved' : 'pending' }}">
                                    {{ ucfirst($restaurant->status) }}
                                </span>
                            </div>

                            {{-- Info Grid --}}
                            <div class="info-grid">
                                <div class="info-item">
                                    <span>📞 Phone</span>
                                    <strong>{{ $restaurant->phone }}</strong>
                                </div>

                                <div class="info-item">
                                    <span>📧 Email</span>
                                    <strong>{{ $restaurant->email ?? 'Not provided' }}</strong>
                                </div>

                                <div class="info-item">
                                    <span>🟢 Status</span>
                                    <strong class="{{ $restaurant->isOpenNow() ? 'open' : 'closed' }}">
                                        {{ $restaurant->isOpenNow() ? 'Open' : 'Closed' }}
                                    </strong>
                                </div>

                                <div class="info-item">
                                    <span>📍 Location</span>
                                    <strong>
                                        {{ $restaurant->latitude }}, {{ $restaurant->longitude }}
                                    </strong>
                                </div>
                            </div>

                            {{-- Actions --}}
                            <div class="restaurant-actions">
                                {{-- Manage Meals --}}
                                <a href="{{ route('restaurant.menu.index', $restaurant) }}" class="action-btn">
                                    🍔 Manage Meals
                                </a>

                                {{-- Edit Restaurant --}}
                                <a href="{{ route('restaurant.restaurants.edit', $restaurant) }}" class="action-btn edit-btn">
                                    ✏️ Edit
                                </a>

                                {{-- Delete Restaurant --}}
                                <form action="{{ route('restaurant.restaurants.destroy', $restaurant) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this restaurant?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn delete-btn">
                                        🗑️ Delete
                                    </button>
                                </form>

                                {{-- Orders --}}
                                <a href="{{ route('restaurant.orders.index', $restaurant) }}" class="action-btn order-btn">
    📦 Orders

    @if($restaurant->newOrdersCount > 0)
        <span class="order-count">
            {{ $restaurant->newOrdersCount }}
        </span>
    @endif
</a>

                                {{-- Sales --}}
                                <a href="#" class="action-btn">
                                    📊 Sales
                                </a>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>

    <style>
        .restaurant-dashboard {
            max-width: 1100px;
            margin: auto;
            padding: 45px 25px 80px;
        }

        /* Success Message */
        .success-message {
            background: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
            border-radius: 12px;
            padding: 14px 18px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        /* Header */
        .dashboard-header {
            background: linear-gradient(135deg, #fff3ed, #ffffff);
            border: 1px solid #ffe0d2;
            border-radius: 24px;
            padding: 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .dashboard-label {
            color: #ff5722;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .dashboard-header h1 {
            margin: 10px 0 5px;
            font-size: 30px;
            color: #222;
        }

        .dashboard-header p {
            margin: 0;
            color: #777;
        }

        .restaurant-icon {
            width: 85px;
            height: 85px;
            border-radius: 50%;
            background: #ff5722;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 38px;
            box-shadow: 0 8px 20px rgba(255, 87, 34, .2);
            flex-shrink: 0;
        }

        /* Actions */
        .dashboard-actions {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 30px;
        }

        .create-btn {
            display: inline-block;
            background: #ff5722;
            color: white;
            padding: 13px 22px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: .2s;
        }

        .create-btn:hover {
            background: #e64a19;
            transform: translateY(-1px);
        }

        /* Section Header */
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
        }

        .section-header span {
            color: #ff5722;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .section-header h2 {
            margin: 5px 0 0;
            font-size: 24px;
            color: #222;
        }

        .section-header > strong {
            color: #888;
            font-size: 13px;
        }

        /* Restaurants List */
        .restaurants-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Restaurant Card */
        .restaurant-card {
            background: white;
            border: 1px solid #eee;
            border-radius: 20px;
            padding: 22px;
            display: flex;
            gap: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .04);
            transition: .2s;
        }

        .restaurant-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(0, 0, 0, .08);
        }

        /* Image Box */
        .restaurant-image {
            width: 220px;
            height: 190px;
            flex-shrink: 0;
            border-radius: 15px;
            overflow: hidden;
            background: #fff3ed;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 8px;
        }

        .restaurant-image img {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            object-fit: contain;
        }

        .no-image {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 55px;
        }

        /* Content */
        .restaurant-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .restaurant-title {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 15px;
        }

        .restaurant-title h2 {
            margin: 0 0 7px;
            color: #222;
            font-size: 23px;
        }

        .restaurant-title p {
            margin: 0;
            color: #888;
            font-size: 13px;
        }

        /* Status Badges */
        .status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
        }

        .status.approved {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .status.pending {
            background: #fff3e0;
            color: #ef6c00;
        }

        /* Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            margin-bottom: 15px;
        }

        .info-item {
            padding: 10px 12px;
            background: #fafafa;
            border-radius: 9px;
        }

        .info-item span {
            display: block;
            color: #999;
            font-size: 11px;
            margin-bottom: 4px;
        }

        .info-item strong {
            color: #333;
            font-size: 12px;
            word-break: break-word;
        }

        .info-item strong.open {
            color: #2e7d32;
        }

        .info-item strong.closed {
            color: #e53935;
        }

        /* Action Buttons */
        .restaurant-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 9px 13px;
            background: #fff3ed;
            color: #ff5722;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            transition: .2s;
            cursor: pointer;
            font-family: inherit;
        }

        .action-btn:hover {
            background: #ff5722;
            color: white;
        }

        .edit-btn {
            background: #fff8e1;
            color: #f57c00;
        }

        .edit-btn:hover {
            background: #f57c00;
            color: white;
        }

        .delete-btn {
            background: #ffebee;
            color: #e53935;
        }

        .delete-btn:hover {
            background: #e53935;
            color: white;
        }

        /* Empty State */
        .empty-restaurant {
            background: white;
            border: 1px solid #eee;
            border-radius: 20px;
            padding: 60px 30px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .04);
        }

        .empty-icon {
            font-size: 55px;
            margin-bottom: 15px;
        }

        .empty-restaurant h2 {
            margin: 0 0 10px;
            color: #222;
        }

        .empty-restaurant p {
            color: #888;
            max-width: 500px;
            margin: 0 auto 25px;
            line-height: 1.6;
        }

        /* Mobile View Rules */
        @media(max-width: 768px) {
            .dashboard-header {
                padding: 25px;
            }

            .dashboard-header h1 {
                font-size: 23px;
            }

            .restaurant-icon {
                width: 60px;
                height: 60px;
                font-size: 28px;
            }

            .restaurant-card {
                flex-direction: column;
            }

            .restaurant-image {
                width: 100%;
                height: 200px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .restaurant-title {
                flex-direction: column;
            }

            .section-header {
                align-items: flex-start;
                gap: 10px;
            }
            .order-btn {
    position: relative;
}

.order-count {
    position: absolute;
    top: -10px;
    right: -8px;

    min-width: 24px;
    height: 24px;
    padding: 0 7px;

    background: #e53935;
    color: white;

    border-radius: 50%;
    border: 3px solid white;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 11px;
    font-weight: 700;

    z-index: 10;
}
                 }
    </style>
<script>
    setTimeout(function () {
        location.reload();
    }, 60000);
</script>
</x-app-layout>