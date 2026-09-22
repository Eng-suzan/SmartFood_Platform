<x-app-layout>

    <style>

        .order-details-page {
            max-width: 1000px;
            margin: auto;
            padding: 45px 25px 80px;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 20px;

            color: #777;
            text-decoration: none;

            font-size: 13px;
        }

        .back-link:hover {
            color: #ff5722;
        }

        .order-details-card {
            background: white;
            border: 1px solid #eee;
            border-radius: 20px;

            padding: 30px;

            box-shadow: 0 5px 20px rgba(0,0,0,.04);
        }

        .order-details-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;

            gap: 20px;

            margin-bottom: 25px;
        }

        .order-label {
            color: #ff5722;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .order-details-header h1 {
            margin: 8px 0 5px;

            color: #222;
            font-size: 28px;
        }

        .order-date {
            color: #999;
            font-size: 13px;
        }

        .status {
            padding: 8px 14px;
            border-radius: 20px;

            font-size: 12px;
            font-weight: 700;
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

        .restaurant-box {
            background: #fff3ed;

            padding: 15px;

            border-radius: 12px;

            margin-bottom: 25px;

            color: #ff5722;

            font-weight: 600;
        }

        .section-title {
            margin: 25px 0 15px;

            color: #333;
            font-size: 18px;
        }

        .items-list {
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;
        }

        .item-row {
            display: flex;
            justify-content: space-between;
            align-items: center;

            padding: 15px 0;

            border-bottom: 1px solid #eee;
        }

        .item-row:last-child {
            border-bottom: none;
        }

        .item-name {
            color: #333;
            font-weight: 600;
        }

        .item-quantity {
            color: #999;
            font-size: 12px;
            margin-left: 8px;
        }

        .item-price {
            color: #ff5722;
            font-weight: 700;
        }

        .delivery-box {
            background: #fafafa;

            border-radius: 12px;

            padding: 18px;

            margin-top: 20px;
        }

        .delivery-box span {
            display: block;

            color: #999;

            font-size: 11px;

            margin-bottom: 5px;
        }

        .delivery-box strong {
            color: #333;

            font-size: 14px;
        }

        .total-box {
            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-top: 25px;
            padding-top: 20px;

            border-top: 1px solid #eee;

            font-size: 20px;
            font-weight: 700;
        }

        .total-price {
            color: #ff5722;
        }
/* Review */

.review-box {
    margin-top: 30px;
    padding: 25px;

    background: #fff8f5;
    border: 1px solid #ffe0d2;
    border-radius: 16px;
}

.review-box h2 {
    margin: 0 0 8px;

    color: #333;
    font-size: 20px;
}

.review-subtitle {
    color: #888;
    font-size: 13px;
    margin-bottom: 20px;
}

.rating-stars {
    display: flex;
    flex-direction: row-reverse;
    justify-content: flex-end;
    gap: 6px;
    margin: 15px 0;
}

.rating-stars input {
    display: none;
}

.rating-stars label {
    font-size: 34px;
    color: #ddd;
    cursor: pointer;
    transition: 0.2s;
}

/* Hover */
.rating-stars label:hover,
.rating-stars label:hover ~ label {
    color: #ffc107;
}

/* Selected */
.rating-stars input:checked + label,
.rating-stars input:checked ~ label {
    color: #ffc107;
}


.review-comment {
    width: 100%;
    min-height: 100px;

    padding: 12px;

    border: 1px solid #ddd;
    border-radius: 10px;

    resize: vertical;

    font-family: inherit;
}

.review-comment:focus {
    outline: none;
    border-color: #ff5722;
}

.review-submit {
    margin-top: 15px;

    padding: 11px 22px;

    border: none;
    border-radius: 10px;

    background: #ff5722;
    color: white;

    font-weight: 700;

    cursor: pointer;
}

.review-submit:hover {
    background: #e64a19;
}

.existing-review {
    margin-top: 30px;
    padding: 25px;

    background: #fff8f5;
    border: 1px solid #ffe0d2;
    border-radius: 16px;
}

.existing-rating {
    color: #ffc107;
    font-size: 24px;
    margin: 10px 0;
}

.existing-comment {
    color: #666;
    font-size: 14px;
    line-height: 1.6;
}
        @media(max-width: 600px) {

            .order-details-header {
                flex-direction: column;
            }

            .order-details-card {
                padding: 20px;
            }

        }

    </style>


    <div class="order-details-page">

        <a
            href="{{ route('orders.index') }}"
            class="back-link"
        >
            ← Back to Orders
        </a>


        <div class="order-details-card">


            {{-- Header --}}

            <div class="order-details-header">

                <div>

                    <span class="order-label">
                        ORDER #{{ $order->id }}
                    </span>

                    <h1>
                        Your Order
                    </h1>

                    <div class="order-date">
                        {{ $order->created_at->format('d M Y - h:i A') }}
                    </div>

                </div>


                <span
                    class="status status-{{ $order->status }}"
                >
                    {{ ucwords(str_replace('_', ' ', $order->status)) }}
                </span>

            </div>


            {{-- Restaurant --}}

            <div class="restaurant-box">

                🍽️ {{ $order->restaurant->name }}

            </div>


            {{-- Items --}}

            <h2 class="section-title">
                🍔 Order Items
            </h2>


            <div class="items-list">

                @foreach($order->items as $item)

                    <div class="item-row">

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
                    {{-- Review --}}

@if($order->status === 'delivered')

    @if($order->review)

        {{-- Already Reviewed --}}

        <div class="existing-review">

            <h2>
                ⭐ Your Review
            </h2>

            <div class="existing-rating">

                @for($i = 1; $i <= 5; $i++)

                    {{ $i <= $order->review->rating ? '★' : '☆' }}

                @endfor

            </div>

            @if($order->review->comment)

                <p class="existing-comment">
                    "{{ $order->review->comment }}"
                </p>

            @endif

        </div>

    @else

        {{-- Add Review --}}

        <div class="review-box">

            <h2>
                ⭐ Rate Your Order
            </h2>

            <p class="review-subtitle">
                How was your experience with
                {{ $order->restaurant->name }}?
            </p>


            <form
                action="{{ route('reviews.store', $order) }}"
                method="POST"
            >

                @csrf


                <label>
                    Your Rating
                </label>


                <div class="rating-stars">

                    @for($i = 1; $i <= 5; $i++)

                        <input
                            type="radio"
                            id="star{{ $i }}"
                            name="rating"
                            value="{{ $i }}"
                            required
                        >

                        <label for="star{{ $i }}">
                            ★
                        </label>

                    @endfor

                </div>


                <textarea
                    name="comment"
                    class="review-comment"
                    placeholder="Tell us about your experience... (optional)"
                ></textarea>


                <button
                    type="submit"
                    class="review-submit"
                >
                    Submit Review ⭐
                </button>

            </form>

        </div>

    @endif

@endif

                @endforeach

            </div>


            {{-- Delivery --}}

            <h2 class="section-title">
                📍 Delivery Information
            </h2>


            <div class="delivery-box">

                <span>
                    ADDRESS
                </span>

                <strong>
                    {{ $order->delivery_address }}
                </strong>

            </div>


            <div class="delivery-box">

                <span>
                    LOCATION
                </span>

                <strong>
                    {{ $order->latitude }},
                    {{ $order->longitude }}
                </strong>

            </div>


            {{-- Total --}}

            <div class="total-box">

                <span>
                    Total
                </span>

                <span class="total-price">
                    {{ number_format($order->total_amount, 2) }}
                    EGP
                </span>

            </div>


        </div>

    </div>

</x-app-layout>