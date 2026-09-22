
<x-app-layout>

    <style>

        .checkout-page {
            max-width: 1100px;
            margin: auto;
            padding: 45px 25px 80px;
        }

        .checkout-header {
            margin-bottom: 30px;
        }

        .checkout-label {
            color: #ff5722;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .checkout-header h1 {
            margin: 8px 0 5px;
            font-size: 32px;
            color: #222;
        }

        .checkout-header p {
            color: #888;
            margin: 0;
        }

        .checkout-layout {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 25px;
            align-items: start;
        }

        .checkout-card {
            background: white;
            border: 1px solid #eee;
            border-radius: 18px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,.04);
        }

        .checkout-card h2 {
            margin: 0 0 20px;
            color: #222;
            font-size: 20px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            color: #444;
            font-size: 13px;
            font-weight: 600;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid #ddd;
            border-radius: 9px;
            box-sizing: border-box;
            font-family: inherit;
            background: white;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #ff5722;
        }

        .error {
            color: #e53935;
            font-size: 12px;
            margin-top: 5px;
        }

        .order-restaurant {
            background: #fff3ed;
            color: #ff5722;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 13px 0;
            border-bottom: 1px solid #eee;
        }

        .order-item-name {
            color: #333;
            font-size: 14px;
        }

        .order-item-quantity {
            color: #888;
            font-size: 12px;
            margin-left: 8px;
        }

        .order-item-price {
            color: #ff5722;
            font-weight: 600;
            font-size: 13px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 13px;
            color: #777;
            font-size: 14px;
        }

        .summary-total {
            border-top: 1px solid #eee;
            margin-top: 15px;
            padding-top: 17px;
            display: flex;
            justify-content: space-between;
            font-size: 20px;
            font-weight: 700;
        }

        .total-price {
            color: #ff5722;
        }

        .place-order-btn {
            width: 100%;
            border: none;
            background: #ff5722;
            color: white;
            padding: 14px;
            border-radius: 10px;
            margin-top: 20px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
        }

        .place-order-btn:hover {
            background: #e64a19;
        }

        .back-cart {
            display: block;
            text-align: center;
            margin-top: 12px;
            color: #777;
            text-decoration: none;
            font-size: 13px;
        }

        @media(max-width: 800px) {

            .checkout-layout {
                grid-template-columns: 1fr;
            }

        }

    </style>


    <div class="checkout-page">

        <div class="checkout-header">

            <span class="checkout-label">
                💳 CHECKOUT
            </span>

            <h1>
                Checkout
            </h1>

            <p>
                Enter your delivery address and choose your payment method.
            </p>

        </div>


        <div class="checkout-layout">


            {{-- Delivery & Payment Information --}}

            <div class="checkout-card">

                <h2>
                    📍 Delivery Information
                </h2>


                <form
                    action="{{ route('checkout.store') }}"
                    method="POST"
                >

                    @csrf


                    {{-- Delivery Address --}}

                    <div class="form-group">

                        <label>
                            Delivery Address
                        </label>

                        <input
                            type="text"
                            name="delivery_address"
                            value="{{ old('delivery_address') }}"
                            placeholder="Enter your full delivery address"
                            required
                        >

                        @error('delivery_address')

                            <div class="error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Payment Method --}}

                    <div class="form-group">

                        <label>
                            Payment Method
                        </label>

                        <select
                            name="payment_method"
                            required
                        >

                            <option value="">
                                Choose payment method
                            </option>

                            <option
                                value="cash"
                                {{ old('payment_method') === 'cash' ? 'selected' : '' }}
                            >
                                💵 Cash on Delivery
                            </option>

                            <option
                                value="card"
                                {{ old('payment_method') === 'card' ? 'selected' : '' }}
                            >
                                💳 Credit / Debit Card
                            </option>

                        </select>

                        @error('payment_method')

                            <div class="error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Place Order --}}

                    <button
                        type="submit"
                        class="place-order-btn"
                    >
                        ✅ Continue
                    </button>

                </form>


                <a
                    href="{{ route('cart.index') }}"
                    class="back-cart"
                >
                    ← Back to Cart
                </a>

            </div>


            {{-- Order Summary --}}

            <div class="checkout-card">

                <h2>
                    🛒 Your Order
                </h2>


                <div class="order-restaurant">

                    🍽️ {{ $cart->restaurant->name }}

                </div>


                @foreach($cart->items as $item)

                    <div class="order-item">

                        <div>

                            <span class="order-item-name">
                                {{ $item->menuItem->name }}
                            </span>

                            <span class="order-item-quantity">
                                × {{ $item->quantity }}
                            </span>

                        </div>

                        <span class="order-item-price">

                            {{ number_format(
                                $item->price * $item->quantity,
                                2
                            ) }}

                            EGP

                        </span>

                    </div>

                @endforeach


                <div style="margin-top: 20px;">

                    <div class="summary-row">

                        <span>
                            Items
                        </span>

                        <span>
                            {{ $cart->items->sum('quantity') }}
                        </span>

                    </div>


                    <div class="summary-total">

                        <span>
                            Total
                        </span>

                        <span class="total-price">

                            {{ number_format($subtotal, 2) }} EGP

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>

