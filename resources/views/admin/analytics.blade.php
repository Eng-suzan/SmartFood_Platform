<x-app-layout>

<style>

    .analytics-page {
        max-width: 1200px;
        margin: auto;
        padding: 45px 25px 80px;
        background: #fafafa;
        min-height: 100vh;
    }

    .analytics-header {
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

    .analytics-header span {
        color: #ff5722;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .analytics-header h1 {
        margin: 8px 0;
        font-size: 30px;
        color: #222;
    }

    .analytics-header p {
        margin: 0;
        color: #777;
    }

    .analytics-icon {
        width: 75px;
        height: 75px;

        border-radius: 50%;

        background: #ff5722;
        color: white;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 32px;
    }

    /* Stats */

    .analytics-grid {
        display: grid;

        grid-template-columns: repeat(3, 1fr);

        gap: 18px;

        margin-bottom: 40px;
    }

    .analytics-card {
        background: white;

        border: 1px solid #eee;

        border-radius: 16px;

        padding: 22px;

        box-shadow:
            0 5px 20px rgba(0,0,0,.04);
    }

    .analytics-card span {
        display: block;

        color: #888;

        font-size: 13px;

        margin-bottom: 8px;
    }

    .analytics-card strong {
        display: block;

        color: #222;

        font-size: 30px;
    }

    .pending {
        color: #ef6c00 !important;
    }

    .success {
        color: #2e7d32 !important;
    }

    .danger {
        color: #e53935 !important;
    }

    .blue {
        color: #1976d2 !important;
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

    /* Items */

    .items-list {
        display: flex;

        flex-direction: column;

        gap: 15px;
    }

    .item-card {
        background: white;

        border: 1px solid #eee;

        border-radius: 16px;

        padding: 20px;

        display: flex;

        align-items: center;

        gap: 20px;

        box-shadow:
            0 5px 20px rgba(0,0,0,.04);
    }

    .item-rank {
        width: 45px;

        height: 45px;

        flex-shrink: 0;

        border-radius: 50%;

        background: #fff3ed;

        color: #ff5722;

        display: flex;

        align-items: center;

        justify-content: center;

        font-weight: 800;

        font-size: 17px;
    }

    .item-content {
        flex: 1;
    }

    .item-content h3 {
        margin: 0 0 5px;

        color: #222;

        font-size: 18px;
    }

    .item-content p {
        margin: 0;

        color: #888;

        font-size: 13px;
    }

    .item-info {
        display: flex;

        gap: 30px;

        text-align: right;
    }

    .item-stat span {
        display: block;

        color: #999;

        font-size: 10px;

        margin-bottom: 4px;
    }

    .item-stat strong {
        color: #333;

        font-size: 14px;
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

    /* Mobile */

    @media(max-width: 900px) {

        .analytics-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .item-card {
            align-items: flex-start;
        }

        .item-info {
            flex-direction: column;

            gap: 8px;
        }

    }
    .charts-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 40px;
}

.chart-card {
    background: white;
    border: 1px solid #eee;
    border-radius: 18px;
    padding: 25px;
    box-shadow: 0 5px 20px rgba(0,0,0,.04);
}

.chart-card h2 {
    margin: 0 0 5px;
    color: #222;
    font-size: 20px;
}

.chart-card p {
    margin: 0 0 20px;
    color: #888;
    font-size: 13px;
}

.chart-container {
    position: relative;
    height: 300px;
}

@media(max-width: 900px) {

    .charts-grid {
        grid-template-columns: 1fr;
    }

}

    @media(max-width: 600px) {

        .analytics-grid {
            grid-template-columns: 1fr;
        }

        .analytics-header {
            padding: 25px;
        }

        .analytics-icon {
            display: none;
        }

        .item-card {
            flex-direction: column;
        }

        .item-info {
            width: 100%;

            flex-direction: row;

            justify-content: space-between;

            text-align: left;
        }

    }

</style>


<div class="analytics-page">


    {{-- Header --}}

    <div class="analytics-header">

        <div>

            <span>
                ADMIN ANALYTICS
            </span>

            <h1>
                Platform Analytics 📊
            </h1>

            <p>
                Track orders and restaurant performance.
            </p>

        </div>

        <div class="analytics-icon">
            📊
        </div>

    </div>


    {{-- Order Statistics --}}

    <div class="analytics-grid">


        {{-- Pending --}}

        <div class="analytics-card">

            <span>
                🕐 Pending Orders
            </span>

            <strong class="pending">
                {{ $pendingOrders }}
            </strong>

        </div>


        {{-- Confirmed --}}

        <div class="analytics-card">

            <span>
                ✅ Confirmed Orders
            </span>

            <strong class="blue">
                {{ $confirmedOrders }}
            </strong>

        </div>


        {{-- Preparing --}}

        <div class="analytics-card">

            <span>
                👨‍🍳 Preparing Orders
            </span>

            <strong>
                {{ $preparingOrders }}
            </strong>

        </div>


        {{-- Out for Delivery --}}

        <div class="analytics-card">

            <span>
                🚚 Out for Delivery
            </span>

            <strong>
                {{ $outForDeliveryOrders }}
            </strong>

        </div>


        {{-- Delivered --}}

        <div class="analytics-card">

            <span>
                📦 Delivered Orders
            </span>

            <strong class="success">
                {{ $deliveredOrders }}
            </strong>

        </div>


        {{-- Cancelled --}}

        <div class="analytics-card">

            <span>
                ❌ Cancelled Orders
            </span>

            <strong class="danger">
                {{ $cancelledOrders }}
            </strong>

        </div>


        {{-- Average Order Value --}}

        <div class="analytics-card">

            <span>
                📊 Average Order Value
            </span>

            <strong>
                {{ number_format($averageOrderValue ?? 0, 2) }} EGP
            </strong>

        </div>

    </div>
{{-- Charts --}}

<div class="charts-grid">

    {{-- Orders by Status --}}

    <div class="chart-card">

        <h2>
            📊 Orders by Status
        </h2>

        <p>
            Distribution of orders by their current status.
        </p>

        <div class="chart-container">

            <canvas id="ordersStatusChart"></canvas>

        </div>

    </div>


    {{-- Sales Overview --}}

    <div class="chart-card">

        <h2>
            📈 Sales Overview
        </h2>

        <p>
            Total sales from delivered orders.
        </p>

        <div class="chart-container">

            <canvas id="salesChart"></canvas>

        </div>

    </div>

</div>

    {{-- Top Selling Items --}}

    <div class="section-header">

        <div>

            <h2>
                🔥 Top Selling Items
            </h2>

        </div>

        <span>
            Top 10 by quantity sold
        </span>

    </div>


    @if($topSellingItems->count())

        <div class="items-list">

            @foreach($topSellingItems as $index => $item)

                <div class="item-card">


                    {{-- Rank --}}

                    <div class="item-rank">

                        #{{ $index + 1 }}

                    </div>


                    {{-- Item --}}

                    <div class="item-content">

                        <h3>
                            {{ $item->menuItem?->name ?? 'Unknown Item' }}
                        </h3>

                        <p>
                            🏪
                            {{ $item->menuItem?->restaurant?->name ?? 'Unknown Restaurant' }}
                        </p>

                    </div>


                    {{-- Statistics --}}

                    <div class="item-info">


                        <div class="item-stat">

                            <span>
                                QUANTITY SOLD
                            </span>

                            <strong>
                                {{ $item->total_quantity }}
                            </strong>

                        </div>


                        <div class="item-stat">

                            <span>
                                TOTAL SALES
                            </span>

                            <strong>
                                {{ number_format($item->total_sales, 2) }} EGP
                            </strong>

                        </div>


                        <div class="item-stat">

                            <span>
                                PRICE
                            </span>

                            <strong>
                                {{ number_format($item->menuItem?->price ?? 0, 2) }} EGP
                            </strong>

                        </div>


                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="empty-box">

            <div>
                🍔
            </div>

            <h3>
                No Selling Data Yet
            </h3>

            <p>
                Top selling items will appear here after delivered orders.
            </p>

        </div>

    @endif


</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    /*
    |--------------------------------------------------------------------------
    | Orders by Status Chart
    |--------------------------------------------------------------------------
    */

    const ordersStatusCtx = document
        .getElementById('ordersStatusChart');

    new Chart(ordersStatusCtx, {

        type: 'doughnut',

        data: {

            labels: @json($orderStatusLabels),

            datasets: [{

                data: @json($orderStatusData),

                backgroundColor: [
                    '#ff9800',
                    '#2196f3',
                    '#9c27b0',
                    '#00acc1',
                    '#4caf50',
                    '#f44336'
                ],

                borderWidth: 0

            }]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: {
                    position: 'bottom'
                }

            }

        }

    });


    /*
    |--------------------------------------------------------------------------
    | Sales Overview Chart
    |--------------------------------------------------------------------------
    */

    const salesCtx = document
        .getElementById('salesChart');

    new Chart(salesCtx, {

        type: 'line',

        data: {

            labels: @json($salesLabels),

            datasets: [{

                label: 'Sales (EGP)',

                data: @json($salesData),

                borderWidth: 3,

                tension: 0.3,

                fill: true

            }]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            scales: {

                y: {

                    beginAtZero: true

                }

            },

            plugins: {

                legend: {
                    display: false
                }

            }

        }

    });

</script>

</x-app-layout>
