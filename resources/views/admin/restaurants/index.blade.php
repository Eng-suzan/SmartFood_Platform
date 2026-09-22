
<x-app-layout>

    <style>
        .admin-restaurants {
            max-width: 1200px;
            margin: auto;
            padding: 45px 25px 80px;
            background: #fafafa;
            min-height: 100vh;
        }

        .page-header {
            background: linear-gradient(135deg, #fff3ed, #ffffff);
            border: 1px solid #ffe0d2;
            border-radius: 22px;
            padding: 30px;
            margin-bottom: 30px;
        }

        .page-header h1 {
            margin: 0 0 8px;
            font-size: 30px;
            color: #222;
        }

        .page-header p {
            margin: 0;
            color: #777;
        }

        .back-btn {
            display: inline-block;
            margin-top: 18px;
            padding: 10px 16px;
            background: #fff;
            color: #ff5722;
            border: 1px solid #ff5722;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
        }

        .success-message {
            background: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
            padding: 13px 17px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .restaurants-list {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .restaurant-card {
            background: white;
            border: 1px solid #eee;
            border-radius: 18px;
            padding: 20px;
            display: flex;
            gap: 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,.04);
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
            margin-bottom: 12px;
        }

        .restaurant-title h2 {
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
            margin-bottom: 15px;
        }

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

        .status-pending {
            color: #ef6c00 !important;
        }

        .status-approved {
            color: #2e7d32 !important;
        }

        .status-rejected {
            color: #e53935 !important;
        }

        .restaurant-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .action-btn {
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

        @media(max-width: 800px) {
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
    </style>


    <div class="admin-restaurants">

        @if(session('success'))
            <div class="success-message">
                ✅ {{ session('success') }}
            </div>
        @endif


        <div class="page-header">

            <h1>
                🍽️ Manage Restaurants
            </h1>

            <p>
                View and manage all restaurants on Smart Food.
            </p>

            <a href="{{ route('admin.dashboard') }}" class="back-btn">
                ← Back to Dashboard
            </a>

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

                                <h2>
                                    {{ $restaurant->name }}
                                </h2>

                                <p>
                                    📍 {{ $restaurant->address }}
                                </p>

                            </div>


                            <div class="owner">

                                👤 Owner:
                                {{ $restaurant->owner?->name ?? 'Unknown' }}

                            </div>


                            <div class="info-grid">

                                <div class="info-item">

                                    <span>
                                        PHONE
                                    </span>

                                    <strong>
                                        {{ $restaurant->phone }}
                                    </strong>

                                </div>


                                <div class="info-item">

                                    <span>
                                        EMAIL
                                    </span>

                                    <strong>
                                        {{ $restaurant->email ?? 'Not provided' }}
                                    </strong>

                                </div>


                                <div class="info-item">

                                    <span>
                                        STATUS
                                    </span>

                                    <strong
                                        class="
                                            @if($restaurant->status === 'approved')
                                                status-approved
                                            @elseif($restaurant->status === 'rejected')
                                                status-rejected
                                            @else
                                                status-pending
                                            @endif
                                        "
                                    >
                                        {{ ucfirst($restaurant->status) }}
                                    </strong>

                                </div>

                            </div>


                            {{-- Actions --}}

                            <div class="restaurant-actions">

                                {{-- Approve --}}

                                @if($restaurant->status !== 'approved')

                                    <form
                                        method="POST"
                                        action="{{ route('admin.restaurants.approve', $restaurant) }}"
                                    >

                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="action-btn approve-btn"
                                        >
                                            ✅ Approve
                                        </button>

                                    </form>

                                @endif


                                {{-- Reject --}}

                                @if($restaurant->status !== 'rejected')

                                    <form
                                        method="POST"
                                        action="{{ route('admin.restaurants.reject', $restaurant) }}"
                                    >

                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="action-btn reject-btn"
                                        >
                                            ❌ Reject
                                        </button>

                                    </form>

                                @endif


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
                                        class="action-btn delete-btn"
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
                    🏪
                </div>

                <h3>
                    No Restaurants Found
                </h3>

                <p>
                    There are no restaurants on the platform yet.
                </p>

            </div>

        @endif

    </div>

</x-app-layout>

