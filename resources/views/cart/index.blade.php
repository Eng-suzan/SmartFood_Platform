<x-app-layout>

<style>

    /* =========================
       Cart Page
    ========================= */

    .cart-page {
        max-width: 1100px;
        margin: auto;
        padding: 45px 25px 80px;
    }


    /* =========================
       Header
    ========================= */

    .cart-header {
        margin-bottom: 30px;
    }

    .cart-label {
        color: #ff5722;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .cart-header h1 {
        margin: 8px 0 5px;
        font-size: 32px;
        color: #222;
    }

    .cart-header p {
        margin: 0;
        color: #888;
    }


    /* =========================
       Restaurant Name
    ========================= */

    .restaurant-name {
        background: #fff3ed;
        color: #ff5722;
        padding: 12px 16px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-size: 14px;
        font-weight: 600;
    }


    /* =========================
       Layout
    ========================= */

    .cart-layout {
        display: grid;
        grid-template-columns: 1fr 330px;
        gap: 25px;
        align-items: start;
    }


    /* =========================
       Cart Items
    ========================= */

    .cart-items {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .cart-item {
        background: white;
        border: 1px solid #eee;
        border-radius: 16px;
        padding: 16px;

        display: flex;
        align-items: center;
        gap: 18px;

        box-shadow: 0 5px 20px rgba(0,0,0,.04);
    }


    /* =========================
       Item Image
    ========================= */

    .cart-item-image {
        width: 100px;
        height: 90px;
        border-radius: 12px;
        object-fit: cover;
        flex-shrink: 0;
    }

    .cart-item-placeholder {
        width: 100px;
        height: 90px;
        border-radius: 12px;

        background: #fff3ed;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 35px;
        flex-shrink: 0;
    }


    /* =========================
       Item Content
    ========================= */

    .cart-item-content {
        flex: 1;
    }

    .cart-item-content h3 {
        margin: 0 0 5px;
        color: #222;
        font-size: 17px;
    }

    .cart-item-price {
        color: #ff5722;
        font-size: 14px;
        font-weight: 600;
    }


    /* =========================
       Quantity
    ========================= */

    .quantity-form {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .quantity-input {
        width: 60px;
        padding: 8px;

        border: 1px solid #ddd;
        border-radius: 8px;

        text-align: center;
    }

    .update-btn {
        border: none;

        background: #222;
        color: white;

        padding: 8px 11px;
        border-radius: 8px;

        cursor: pointer;
        font-size: 11px;
    }

    .update-btn:hover {
        background: #000;
    }


    /* =========================
       Remove
    ========================= */

    .remove-form {
        margin-left: 5px;
    }

    .remove-btn {
        border: none;

        background: #ffebee;
        color: #c62828;

        padding: 8px 10px;
        border-radius: 8px;

        cursor: pointer;
        font-size: 11px;
    }

    .remove-btn:hover {
        background: #ffcdd2;
    }


    /* =========================
       Cart Summary
    ========================= */

    .cart-summary {
        background: white;
        border: 1px solid #eee;
        border-radius: 18px;

        padding: 22px;

        box-shadow: 0 5px 20px rgba(0,0,0,.04);

        position: sticky;
        top: 25px;
    }

    .cart-summary h2 {
        margin: 0 0 20px;

        color: #222;
        font-size: 20px;
    }


    /* =========================
       Summary Rows
    ========================= */

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

        font-size: 19px;
        font-weight: 700;

        color: #222;
    }

    .total-price {
        color: #ff5722;
    }


    /* =========================
       Main Buttons
    ========================= */

    .checkout-btn {
        display: block;

        width: 100%;
        box-sizing: border-box;

        margin-top: 10px;

        background: #ff5722;
        color: white;

        padding: 13px;

        border-radius: 10px;

        text-align: center;
        text-decoration: none;

        font-weight: 700;
        font-size: 14px;

        border: none;

        transition: .2s;
    }

    .checkout-btn:hover {
        background: #e64a19;
        transform: translateY(-1px);
    }


    /* =========================
       Continue Shopping
    ========================= */

    .continue-shopping-btn {
        background: #fff3ed;
        color: #ff5722;

        border: 1px solid #ff5722;
    }

    .continue-shopping-btn:hover {
        background: #ff5722;
        color: white;
    }


    /* =========================
       Closed Checkout
    ========================= */

    .checkout-disabled {
        background: #eeeeee;
        color: #999;

        cursor: not-allowed;
        pointer-events: none;

        border: 1px solid #ddd;
    }


    /* =========================
       Closed Notice
    ========================= */

    .closed-notice {
        background: #ffebee;
        color: #c62828;

        border: 1px solid #ffcdd2;

        padding: 11px 13px;

        border-radius: 10px;

        margin-top: 10px;

        text-align: center;

        font-size: 12px;
        font-weight: 600;
    }


    /* =========================
       Clear Cart
    ========================= */

    .clear-cart-btn {
        width: 100%;

        margin-top: 20px;

        border: 1px solid #ffcdd2;

        background: #fff5f5;
        color: #c62828;

        padding: 11px;

        border-radius: 10px;

        cursor: pointer;

        font-weight: 600;

        transition: .2s;
    }

    .clear-cart-btn:hover {
        background: #ffebee;
    }


    /* =========================
       Empty Cart
    ========================= */

    .empty-cart {
        background: white;

        border: 1px solid #eee;

        border-radius: 20px;

        padding: 70px 30px;

        text-align: center;

        box-shadow: 0 5px 20px rgba(0,0,0,.04);
    }

    .empty-cart-icon {
        font-size: 65px;
        margin-bottom: 15px;
    }

    .empty-cart h2 {
        margin: 0 0 10px;
        color: #333;
    }

    .empty-cart p {
        color: #888;
        margin-bottom: 25px;
    }

    .back-restaurants {
        display: inline-block;

        background: #ff5722;
        color: white;

        text-decoration: none;

        padding: 12px 20px;

        border-radius: 10px;

        font-weight: 600;
    }

    .back-restaurants:hover {
        background: #e64a19;
    }


    /* =========================
       Messages
    ========================= */

    .success-message {
        background: #e8f5e9;
        color: #2e7d32;

        border: 1px solid #c8e6c9;

        padding: 13px 16px;

        border-radius: 10px;

        margin-bottom: 20px;

        font-size: 14px;
    }

    .error-message {
        background: #ffebee;
        color: #c62828;

        border: 1px solid #ffcdd2;

        padding: 13px 16px;

        border-radius: 10px;

        margin-bottom: 20px;

        font-size: 14px;
    }


    /* =========================
       Responsive
    ========================= */

    @media(max-width: 800px) {

        .cart-layout {
            grid-template-columns: 1fr;
        }

        .cart-summary {
            position: static;
        }

    }


    @media(max-width: 550px) {

        .cart-page {
            padding: 30px 15px 60px;
        }

        .cart-item {
            flex-wrap: wrap;
        }

        .cart-item-content {
            min-width: 150px;
        }

        .quantity-form {
            width: 100%;
        }

        .remove-form {
            margin-left: 0;
        }

    }

</style>


<div class="cart-page">


    {{-- =========================
         Header
    ========================== --}}

    <div class="cart-header">

        <span class="cart-label">
            🛒 SHOPPING CART
        </span>

        <h1>
            Your Cart
        </h1>

        <p>
            Review your selected meals before checkout.
        </p>

    </div>


    {{-- =========================
         Success Message
    ========================== --}}

    @if(session('success'))

        <div class="success-message">
            ✅ {{ session('success') }}
        </div>

    @endif


    {{-- =========================
         Error Message
    ========================== --}}

    @if(session('error'))

        <div class="error-message">
            ⚠️ {{ session('error') }}
        </div>

    @endif


    {{-- =========================
         Empty Cart
    ========================== --}}

    @if(!$cart || $cart->items->count() === 0)

        <div class="empty-cart">

            <div class="empty-cart-icon">
                🛒
            </div>

            <h2>
                Your Cart Is Empty
            </h2>

            <p>
                You haven't added any meals yet.
            </p>

            <a
                href="{{ route('restaurants.index') }}"
                class="back-restaurants"
            >
                🍽️ Browse Restaurants
            </a>

        </div>


    @else


        {{-- =========================
             Restaurant
        ========================== --}}

        <div class="restaurant-name">

            🍽️
            {{ $cart->restaurant->name }}

        </div>


        <div class="cart-layout">


            {{-- =========================
                 Cart Items
            ========================== --}}

            <div class="cart-items">

                @foreach($cart->items as $cartItem)

                    <div class="cart-item">


                        {{-- Image --}}

                        @if($cartItem->menuItem->image)

                            <img
                                src="{{ asset('storage/' . $cartItem->menuItem->image) }}"
                                alt="{{ $cartItem->menuItem->name }}"
                                class="cart-item-image"
                            >

                        @else

                            <div class="cart-item-placeholder">
                                🍔
                            </div>

                        @endif


                        {{-- Content --}}

                        <div class="cart-item-content">

                            <h3>
                                {{ $cartItem->menuItem->name }}
                            </h3>

                            <span class="cart-item-price">

                                {{ number_format($cartItem->price, 2) }} EGP

                            </span>

                        </div>


                        {{-- Quantity --}}

                        <form
                            action="{{ route('cart.update', $cartItem) }}"
                            method="POST"
                            class="quantity-form"
                        >

                            @csrf

                            @method('PATCH')

                            <input
                                type="number"
                                name="quantity"
                                value="{{ $cartItem->quantity }}"
                                min="1"
                                class="quantity-input"
                            >

                            <button
                                type="submit"
                                class="update-btn"
                            >
                                Update
                            </button>

                        </form>


                        {{-- Remove --}}

                        <form
                            action="{{ route('cart.destroy', $cartItem) }}"
                            method="POST"
                            class="remove-form"
                        >

                            @csrf

                            @method('DELETE')

                            <button
                                type="submit"
                                class="remove-btn"
                            >
                                🗑 Remove
                            </button>

                        </form>


                    </div>

                @endforeach

            </div>


            {{-- =========================
                 Order Summary
            ========================== --}}

            <div class="cart-summary">

                <h2>
                    Order Summary
                </h2>


                @php

                    $subtotal = $cart->items->sum(
                        fn($item) =>
                            $item->price * $item->quantity
                    );

                @endphp


                {{-- Items --}}

                <div class="summary-row">

                    <span>
                        Items
                    </span>

                    <span>
                        {{ $cart->items->sum('quantity') }}
                    </span>

                </div>


                {{-- Subtotal --}}

                <div class="summary-row">

                    <span>
                        Subtotal
                    </span>

                    <span>
                        {{ number_format($subtotal, 2) }} EGP
                    </span>

                </div>


                {{-- Total --}}

                <div class="summary-total">

                    <span>
                        Total
                    </span>

                    <span class="total-price">
                        {{ number_format($subtotal, 2) }} EGP
                    </span>

                </div>


                {{-- =========================
                     Checkout / Continue
                ========================== --}}

                @if($cart->restaurant->isOpenNow())


                    {{-- Checkout --}}

                    <a
                        href="{{ route('checkout.index') }}"
                        class="checkout-btn"
                    >
                        Proceed to Checkout
                    </a>


                    {{-- Continue Shopping --}}

                    <a
                        href="{{ route('restaurants.show', $cart->restaurant) }}"
                        class="checkout-btn continue-shopping-btn"
                    >
                        🛍️ Continue Shopping
                    </a>


                @else


                    {{-- Closed --}}

                    <span class="checkout-btn checkout-disabled">
                        🔴 Restaurant Closed
                    </span>

                    <div class="closed-notice">

                        ⚠️ This restaurant is currently closed.
                        You can checkout when it opens again.

                    </div>


                @endif


                {{-- =========================
                     Clear Cart
                ========================== --}}

                <form
                    action="{{ route('cart.clear') }}"
                    method="POST"
                >

                    @csrf

                    @method('DELETE')

                    <button
                        type="submit"
                        class="clear-cart-btn"
                    >
                        🗑 Clear Cart
                    </button>

                </form>


            </div>

        </div>

    @endif


</div>


</x-app-layout>
