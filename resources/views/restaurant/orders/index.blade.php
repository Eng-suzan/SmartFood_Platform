
<x-app-layout>

    <div class="orders-page">

        {{-- Success --}}
        @if(session('success'))
            <div class="success-message">
                ✅ {{ session('success') }}
            </div>
        @endif


        {{-- Header --}}
        <div class="orders-header">

            <div>
                <span class="orders-label">
                    RESTAURANT PANEL
                </span>

                <h1>
                    Customer Orders 📦
                </h1>

                <p>
                    Manage orders received by your restaurants.
                </p>
            </div>

            <div class="orders-icon">
                📦
            </div>

        </div>


        {{-- No Orders --}}
        @if($orders->isEmpty())

            <div class="empty-orders">

                <div class="empty-icon">
                    📦
                </div>

                <h2>
                    No Orders Yet
                </h2>

                <p>
                    You don't have any customer orders yet.
                </p>

            </div>

        @else

            {{-- Orders --}}
            <div class="orders-list">

                @foreach($orders as $order)

                    <div class="order-card">

                        {{-- Order Header --}}
                        <div class="order-top">

                            <div>

                                <span class="order-number">
                                    ORDER #{{ $order->id }}
                                </span>

                                <h2>
                                    🍽️ {{ $order->restaurant->name }}
                                </h2>

                                <p>
                                    👤 Customer:
                                    {{ $order->user->name }}
                                </p>

                            </div>


                            {{-- Status --}}
                            <span class="status {{ $order->status }}">
                                {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                            </span>

                        </div>


                        {{-- Order Information --}}
                        <div class="order-info">

                            <div class="info-box">

                                <span>
                                    💰 Total
                                </span>

                                <strong>
                                    {{ number_format($order->total_amount, 2) }}
                                    EGP
                                </strong>

                            </div>


                            <div class="info-box">

                                <span>
                                    📍 Delivery Address
                                </span>

                                <strong>
                                    {{ $order->delivery_address }}
                                </strong>

                            </div>


                            <div class="info-box">

                                <span>
                                    📅 Order Date
                                </span>

                                <strong>
                                    {{ $order->created_at->format('d M Y - h:i A') }}
                                </strong>

                            </div>

                        </div>


                        {{-- Items --}}
                        <div class="order-items">

                            <div class="items-title">
                                🍔 Order Items
                            </div>


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


                        {{-- Actions --}}
                        <div class="order-actions">

                            <span class="change-status">
                                Update Order Status:
                            </span>


                                </button>
<form action="{{ route('restaurant.orders.status', [
    'restaurant' => $restaurant,
    'order' => $order
]) }}" method="POST">
    @csrf
    @method('PATCH')

    <select name="status" onchange="this.form.submit()">
        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>
            Pending
        </option>

        <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>
            Confirmed
        </option>

        <option value="preparing" {{ $order->status === 'preparing' ? 'selected' : '' }}>
            Preparing
        </option>

        <option value="out_for_delivery" {{ $order->status === 'out_for_delivery' ? 'selected' : '' }}>
            Out for Delivery
        </option>

        <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>
            Delivered
        </option>

        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>
            Cancelled
        </option>
    </select>
</form>
                                @csrf
                                @method('PATCH')


                               

                                 

                        </div>

                    </div>

                @endforeach

            </div>

        @endif

    </div>


    <style>

        .orders-page {
            max-width: 1100px;
            margin: auto;
            padding: 45px 25px 80px;
        }


        /* Success */

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

        .orders-header {
            background: linear-gradient(
                135deg,
                #fff3ed,
                #ffffff
            );

            border: 1px solid #ffe0d2;
            border-radius: 24px;

            padding: 35px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            margin-bottom: 30px;
        }


        .orders-label {
            color: #ff5722;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
        }


        .orders-header h1 {
            margin: 10px 0 5px;
            font-size: 30px;
            color: #222;
        }


        .orders-header p {
            margin: 0;
            color: #777;
        }


        .orders-icon {
            width: 75px;
            height: 75px;

            border-radius: 50%;

            background: #ff5722;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 32px;

            box-shadow:
                0 8px 20px rgba(255, 87, 34, .2);
        }


        /* Orders List */

        .orders-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }


        /* Card */

        .order-card {
            background: white;

            border: 1px solid #eee;
            border-radius: 20px;

            padding: 25px;

            box-shadow:
                0 5px 20px rgba(0, 0, 0, .04);

            transition: .2s;
        }


        .order-card:hover {
            transform: translateY(-2px);

            box-shadow:
                0 10px 28px rgba(0, 0, 0, .08);
        }


        /* Top */

        .order-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;

            padding-bottom: 18px;

            border-bottom: 1px solid #eee;
        }


        .order-number {
            color: #ff5722;

            font-size: 11px;

            font-weight: 700;

            letter-spacing: 1px;
        }


        .order-top h2 {
            margin: 7px 0;

            color: #222;

            font-size: 20px;
        }


        .order-top p {
            margin: 0;

            color: #777;

            font-size: 13px;
        }


        /* Status */

        .status {
            padding: 7px 13px;

            border-radius: 20px;

            font-size: 11px;

            font-weight: 700;

            white-space: nowrap;
        }


        .status.pending {
            background: #fff3e0;
            color: #ef6c00;
        }


        .status.confirmed {
            background: #e3f2fd;
            color: #1976d2;
        }


        .status.preparing {
            background: #f3e5f5;
            color: #7b1fa2;
        }


        .status.out_for_delivery {
            background: #e8eaf6;
            color: #3949ab;
        }


        .status.delivered {
            background: #e8f5e9;
            color: #2e7d32;
        }


        .status.cancelled {
            background: #ffebee;
            color: #c62828;
        }


        /* Info */

        .order-info {
            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 12px;

            margin: 20px 0;
        }


        .info-box {
            background: #fafafa;

            border-radius: 10px;

            padding: 14px;
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


        /* Items */

        .order-items {
            border-top: 1px solid #eee;

            padding-top: 18px;
        }


        .items-title {
            color: #333;

            font-weight: 700;

            font-size: 14px;

            margin-bottom: 10px;
        }


        .order-item {
            display: flex;

            justify-content: space-between;

            align-items: center;

            padding: 10px 0;

            border-bottom: 1px solid #f3f3f3;

            font-size: 13px;
        }


        .item-name {
            color: #444;

            font-weight: 600;
        }


        .item-quantity {
            color: #999;

            margin-left: 7px;
        }


        .item-price {
            color: #ff5722;

            font-weight: 600;
        }


        /* Actions */

        .order-actions {
            margin-top: 18px;

            padding-top: 18px;

            border-top: 1px solid #eee;

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;
        }


        .change-status {
            color: #777;

            font-size: 13px;

            font-weight: 600;
        }


        .order-actions select {
            padding: 10px 14px;

            border: 1px solid #ddd;

            border-radius: 9px;

            background: white;

            font-family: inherit;

            font-size: 13px;

            cursor: pointer;

            min-width: 180px;
        }


        .order-actions select:focus {
            outline: none;

            border-color: #ff5722;
        }


        /* Empty */

        .empty-orders {
            background: white;

            border: 1px solid #eee;

            border-radius: 20px;

            padding: 70px 30px;

            text-align: center;

            box-shadow:
                0 5px 20px rgba(0,0,0,.04);
        }


        .empty-icon {
            font-size: 55px;

            margin-bottom: 15px;
        }


        .empty-orders h2 {
            margin: 0 0 10px;

            color: #222;
        }


        .empty-orders p {
            color: #888;
        }


        /* Mobile */

        @media(max-width: 700px) {

            .orders-header {
                padding: 25px;
            }


            .orders-header h1 {
                font-size: 23px;
            }


            .orders-icon {
                width: 60px;
                height: 60px;

                font-size: 26px;
            }


            .order-info {
                grid-template-columns: 1fr;
            }


            .order-top {
                flex-direction: column;

                gap: 12px;
            }


            .order-actions {
                flex-direction: column;

                align-items: stretch;
            }


            .order-actions select {
                width: 100%;
            }

        }

    </style>

</x-app-layout>

