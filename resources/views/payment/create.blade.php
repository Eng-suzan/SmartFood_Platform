@extends('layouts.app')

@section('content')

<style>
    .payment-page {
        max-width: 700px;
        margin: 50px auto;
        padding: 0 20px;
    }

    .payment-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 10px 35px rgba(0, 0, 0, 0.10);
        overflow: hidden;
    }

    .payment-header {
        background: linear-gradient(135deg, #ff6b35, #ff8c42);
        color: white;
        text-align: center;
        padding: 35px 20px;
    }

    .payment-icon {
        font-size: 42px;
        margin-bottom: 10px;
    }

    .payment-header h2 {
        margin: 0 0 8px;
        font-size: 28px;
    }

    .payment-header p {
        margin: 0;
        opacity: 0.9;
    }

    .payment-body {
        padding: 35px;
    }

    .payment-total {
        text-align: center;
        margin-bottom: 30px;
    }

    .payment-total span {
        display: block;
        color: #777;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .payment-total strong {
        font-size: 36px;
        color: #222;
    }

    .delivery-box {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 18px;
        margin-bottom: 25px;
    }

    .delivery-title {
        font-weight: bold;
        margin-bottom: 8px;
        color: #333;
    }

    .delivery-address {
        color: #666;
    }

    .paypal-box {
        border: 1px solid #e5e5e5;
        border-radius: 14px;
        padding: 25px;
        text-align: center;
        margin-bottom: 20px;
    }

    .paypal-logo {
        font-size: 32px;
        font-weight: bold;
        color: #003087;
        margin-bottom: 8px;
    }

    .paypal-box h3 {
        margin: 0 0 8px;
        color: #222;
    }

    .paypal-box p {
        color: #777;
        font-size: 14px;
        margin-bottom: 22px;
    }

    .paypal-button {
        width: 100%;
        border: none;
        border-radius: 10px;
        padding: 14px;
        background: #0070ba;
        color: white;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.2s;
    }

    .paypal-button:hover {
        background: #005ea6;
    }

    .back-button {
        display: block;
        text-align: center;
        text-decoration: none;
        color: #666;
        padding: 12px;
    }

    .secure-payment {
        text-align: center;
        color: #888;
        font-size: 13px;
        margin-top: 25px;
    }
</style>


<div class="payment-page">

    <div class="payment-card">

        <div class="payment-header">

            <div class="payment-icon">
                💳
            </div>

            <h2>
                Secure Payment
            </h2>

            <p>
                Complete your order securely with PayPal
            </p>

        </div>


        <div class="payment-body">

            {{-- Order Total --}}
            <div class="payment-total">

                <span>
                    Order Total
                </span>

                <strong>
                    ${{ number_format($amount, 2) }} EGP
                </strong>

            </div>


            {{-- Delivery Address --}}
            <div class="delivery-box">

                <div class="delivery-title">
                    📍 Delivery Address
                </div>

                <div class="delivery-address">
                    {{ $delivery_address }}
                </div>

            </div>


            {{-- PayPal --}}
            <div class="paypal-box">

                <div class="paypal-logo">
                    PayPal
                </div>

                <h3>
                    Pay with PayPal
                </h3>

                <p>
                    You will be redirected to PayPal
                    to complete your payment securely.
                </p>


                <form
                    method="POST"
                    action="{{ route('payment.paypal') }}"
                >

                    @csrf

                    <button
                        type="submit"
                        class="paypal-button"
                    >
                        Pay with PayPal
                    </button>

                </form>

            </div>


            {{-- Back --}}
            <a
                href="{{ route('checkout.index') }}"
                class="back-button"
            >
                ← Back to Checkout
            </a>


            <div class="secure-payment">
                🔒 Secure payment powered by PayPal Sandbox
            </div>

        </div>

    </div>

</div>

@endsection