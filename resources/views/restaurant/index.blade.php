@include('layouts.food-nav')

<style>

    .restaurants-page {
        max-width: 1200px;
        margin: auto;
        padding: 50px 25px;
    }

    .restaurants-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .restaurants-header h1 {
        font-size: 36px;
        color: #222;
        margin-bottom: 10px;
    }

    .restaurants-header p {
        color: #777;
        font-size: 16px;
    }

    .restaurants-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 25px;
    }

    /* CARD */

    .restaurant-card {
        display: block;

        background: white;
        border-radius: 16px;
        overflow: hidden;

        box-shadow: 0 5px 20px rgba(0,0,0,0.08);

        transition: 0.3s;

        text-decoration: none;
        color: inherit;

        cursor: pointer;
    }

    .restaurant-card:hover {
        transform: translateY(-5px);

        box-shadow:
            0 10px 30px rgba(0,0,0,0.12);
    }
    

    .restaurant-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .restaurant-placeholder {
        width: 100%;
        height: 200px;

        background: #fff3ed;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 55px;
    }

    .restaurant-info {
        padding: 20px;
    }

    .restaurant-info h2 {
        margin: 0 0 10px;
        font-size: 22px;
        color: #222;
    }

    .restaurant-info p {
        color: #666;
        margin: 7px 0;
    }

    .restaurant-status {
        display: inline-block;

        margin-top: 12px;

        padding: 6px 12px;

        border-radius: 20px;

        background: #e8f7ee;
        color: #22934a;

        font-size: 13px;
        font-weight: 600;
    }

    .view-menu {
        display: block;

        margin-top: 15px;

        color: #ff5722;

        font-size: 13px;
        font-weight: 700;
    }
    .search-form {
    max-width: 800px;
    margin: 0 auto 40px;

    display: flex;
    gap: 10px;
}

.search-form input {
    flex: 1;

    padding: 14px 18px;

    border: 1px solid #ddd;
    border-radius: 12px;

    font-size: 16px;
    outline: none;
}

.search-form input:focus {
    border-color: #ff5722;
}

.search-form button {
    padding: 14px 25px;

    border: none;
    border-radius: 12px;

    background: #ff5722;
    color: white;

    font-weight: 700;
    cursor: pointer;
}

.search-form a {
    display: flex;
    align-items: center;

    padding: 0 18px;

    border-radius: 12px;

    background: #eee;

    color: #555;
    text-decoration: none;
}

</style>


<div class="restaurants-page">
<form method="GET" action="{{ route('restaurants.index') }}" class="search-form">

    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="🔍 Search restaurants..."
    >

    <button type="submit">
        Search
    </button>

    @if(request('search'))
        <a href="{{ route('restaurants.index') }}">
            Clear
        </a>
    @endif

</form>
    <div class="restaurants-header">

        <h1>
            🍽️ All Restaurants
        </h1>

        <p>
            Discover all restaurants available on Smart Food
        </p>

    </div>



    @if($restaurants->count())

        <div class="restaurants-grid">

            @foreach($restaurants as $restaurant)

                {{-- Restaurant Card --}}

                <a
                    href="{{ route('restaurants.show', $restaurant) }}"
                    class="restaurant-card"
                >

                    {{-- Image --}}

                    @if($restaurant->image)

                        <img
                            src="{{ asset('storage/' . $restaurant->image) }}"
                            alt="{{ $restaurant->name }}"
                            class="restaurant-image"
                        >

                    @else

                        <div class="restaurant-placeholder">
                            🍔
                        </div>

                    @endif


                    {{-- Information --}}

                    <div class="restaurant-info">

                        <h2>
                            {{ $restaurant->name }}
                        </h2>

                        <p>
                            📍 {{ $restaurant->address }}
                        </p>

                        <p>
                            📞 {{ $restaurant->phone }}
                        </p>

                        <span class="restaurant-status">
                            Approved
                        </span>

                        <span class="view-menu">
                            View Restaurant & Menu →
                        </span>

                    </div>

                </a>

            @endforeach

        </div>


    @else

        <div style="text-align:center; padding:60px;">

            <h2>
                No restaurants available yet.
            </h2>

            <p>
                Restaurants will appear here after admin approval.
            </p>

        </div>

    @endif

</div>