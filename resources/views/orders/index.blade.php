<x-app-layout>

    <style>

        .orders-page {
            max-width: 1100px;
            margin: auto;
            padding: 45px 25px 80px;
        }

        .orders-header {
            margin-bottom: 30px;
        }

        .orders-label {
            color: #ff5722;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .orders-header h1 {
            margin: 8px 0 5px;
            font-size: 32px;
            color: #222;
        }

        .orders-header p {
            margin: 0;
            color: #888;
        }

        .success-message {
            background: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
            padding: 13px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .orders-list {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .order-card {
            background: white;
            border: 1px solid #eee;
            border-radius: 18px;
            padding: 22px;

            box-shadow: 0 5px 20px rgba(0,0,0,.04);

            transition: .2s;
        }

        .order-card:hover {
            transform: translateY(-2px);

            box-shadow:
                0 10px 28px rgba(0,0,0,.08);
        }

        .order-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;

            gap: 20px;

            margin-bottom: 18px;
        }

        .order-number {
            color: #ff5722;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .order-restaurant {
            margin-top: 6px;
            font-size: 20px;
            font-weight: 700;
            color: #222;
        }

        .order-date {
            margin-top: 5px;
            color: #999;
            font-size: 12px;
        }

        .order-status {
            padding: 7px 13px;
            border-radius: 20px;

            font-size: 11px;
            font-weight: 700;

            white-space: nowrap;
        }

        .status-pending {
            background: #fff3e0;
            color: #ef6c00;
        }

        .status-accepted {
            background: #e3f2fd;
            color: #1565c0;
        }

        .status-preparing {
            background: #f3e5f5;
            color: #7b1fa2;
        }

        .status-out_for_delivery {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .status-delivered {
            background: #e8f5e9;
            color: #1b5e20;
        }

        .status-cancelled {
            background: #ffebee;
            color: #c62828;
        }
.order-actions {
display: flex;
gap: 10px;
align-items: center;
margin-top: 15px;
flex-wrap: wrap;
}

.view-order-btn,
.delete-order-btn {
display: inline-flex;
align-items: center;
justify-content: center;
padding: 9px 14px;
border-radius: 9px;
border: none;
text-decoration: none;
font-family: inherit;
font-size: 12px;
font-weight: 600;
cursor: pointer;
transition: .2s;
}

.view-order-btn {
background: #fff3ed;
color: #ff5722;
}

.view-order-btn:hover {
background: #ff5722;
color: white;
}

.delete-order-btn {
background: #ffebee;
color: #e53935;
}

.delete-order-btn:hover {
background: #e53935;
color: white;
}

        .order-items {
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;

            padding: 12px 0;

            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            align-items: center;

            font-size: 13px;
        }

        .item-name {
            color: #444;
        }

        .item-quantity {
            color: #999;
            margin-left: 5px;
        }

        .item-price {
            color: #ff5722;
            font-weight: 600;
        }

        .order-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-top: 17px;
        }

        .order-total-label {
            color: #888;
            font-size: 12px;
        }

        .order-total {
            color: #ff5722;
            font-size: 19px;
            font-weight: 700;
        }

        .view-order-btn {
            display: inline-block;

            background: #ff5722;
            color: white;

            padding: 10px 16px;

            border-radius: 9px;

            text-decoration: none;

            font-size: 12px;
            font-weight: 600;

            transition: .2s;
        }

        .view-order-btn:hover {
            background: #e64a19;
        }

        .empty-orders {
            background: white;
            border: 1px solid #eee;

            border-radius: 20px;

            padding: 70px 30px;

            text-align: center;

            box-shadow: 0 5px 20px rgba(0,0,0,.04);
        }

        .empty-orders-icon {
            font-size: 65px;
            margin-bottom: 15px;
        }

        .empty-orders h2 {
            margin: 0 0 10px;
            color: #333;
        }

        .empty-orders p {
            color: #888;
            margin-bottom: 25px;
        }

        .browse-btn {
            display: inline-block;

            background: #ff5722;
            color: white;

            padding: 12px 20px;

            border-radius: 10px;

            text-decoration: none;

            font-weight: 600;
        }

        @media(max-width: 600px) {

            .orders-page {
                padding: 30px 15px 60px;
            }

            .order-top {
                flex-direction: column;
            }

            .order-bottom {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .view-order-btn {
                width: 100%;
                text-align: center;
                box-sizing: border-box;
            }

        }

    </style>


    <div class="orders-page">

        {{-- Header --}}

        <div class="orders-header">

            <span class="orders-label">
                📦 MY ORDERS
            </span>

            <h1>
                My Orders
            </h1>

            <p>
                Track and manage your orders.
            </p>

        </div>


        {{-- Success --}}

        @if(session('success'))

            <div class="success-message">
                ✅ {{ session('success') }}
            </div>

        @endif


        {{-- Empty --}}

        @if($orders->isEmpty())

            <div class="empty-orders">

                <div class="empty-orders-icon">
                    📦
                </div>

                <h2>
                    No Orders Yet
                </h2>

                <p>
                    You haven't placed any orders yet.
                </p>

                <a
                    href="{{ route('restaurants.index') }}"
                    class="browse-btn"
                >
                    🍽️ Browse Restaurants
                </a>

            </div>

        @else

            <div class="orders-list">

                @foreach($orders as $order)

                    <div class="order-card">

                        {{-- Top --}}

                        <div class="order-top">

                            <div>

                                <div class="order-number">
                                    ORDER #{{ $order->id }}
                                </div>

                                <div class="order-restaurant">
                                    🍽️ {{ $order->restaurant->name }}
                                </div>

                                <div class="order-date">
                                    {{ $order->created_at->format('d M Y - h:i A') }}
                                </div>

                            </div>


                            <span
                                class="order-status status-{{ $order->status }}"
                            >
                                {{ ucwords(str_replace('_', ' ', $order->status)) }}
                            </span>

                        </div>


                        {{-- Items --}}

                        <div class="order-items">

                            @foreach($order->items as $item)

                                <div class="order-item">

                                    <div>

                                        <span class="item-name">
                                            {{ $item->menuItem->name }}
                                        </span>

                                        <span class="item-quantity">
                                            × {{ $item->quantity }}
                                        </span>

                                    </div>

                                    <span class="item-price">

                                        {{ number_format(
                                            $item->price * $item->quantity,
                                            2
                                        ) }}
                                        EGP

                                    </span>

                                </div>

                            @endforeach

                        </div>


                        {{-- Bottom --}}

                        <div class="order-bottom">

                            <div>

                                <div class="order-total-label">
                                    TOTAL
                                </div>

                                <div class="order-total">
                                    {{ number_format($order->total_amount, 2) }}
                                    EGP
                                </div>

                            </div>


                            <a
                                href="{{ route('orders.show', $order) }}"
                                class="view-order-btn"
                            >
                                👁️ View Order

                            </a>
<form action="{{ route('orders.destroy', $order) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this order?');" > @csrf @method('DELETE') <button type="submit" class="delete-order-btn"> 🗑️ Delete </button> </form>
                        </div>

                    </div>

                @endforeach

            </div>

        @endif

    </div>

</x-app-layout>