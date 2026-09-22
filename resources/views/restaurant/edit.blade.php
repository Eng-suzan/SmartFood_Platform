<x-app-layout>

    <div class="restaurant-edit">

        {{-- Header --}}
        <div class="edit-header">

            <span>🍽️ RESTAURANT</span>

            <h1>Edit Your Restaurant</h1>

            <p>
                Update your restaurant information, location and working hours.
            </p>

        </div>


        {{-- Form Card --}}
        <div class="restaurant-form-card">

            <form
                method="POST"
                action="{{ route('restaurant.restaurants.update', $restaurant) }}"
                enctype="multipart/form-data"
            >

                @csrf
                @method('PUT')


                {{-- Restaurant Name --}}
                <div class="form-group">

                    <label for="name">
                        Restaurant Name
                    </label>

                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name', $restaurant->name) }}"
                        required
                    >

                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror

                </div>


                {{-- Phone --}}
                <div class="form-group">

                    <label for="phone">
                        Phone
                    </label>

                    <input
                        id="phone"
                        type="text"
                        name="phone"
                        value="{{ old('phone', $restaurant->phone) }}"
                        required
                    >

                    @error('phone')
                        <span class="error">{{ $message }}</span>
                    @enderror

                </div>


                {{-- Email --}}
                <div class="form-group">

                    <label for="email">
                        Email
                    </label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email', $restaurant->email) }}"
                    >

                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror

                </div>


                {{-- Address --}}
                <div class="form-group">

                    <label for="address">
                        Address
                    </label>

                    <input
                        id="address"
                        type="text"
                        name="address"
                        value="{{ old('address', $restaurant->address) }}"
                        required
                    >

                    @error('address')
                        <span class="error">{{ $message }}</span>
                    @enderror

                </div>


                {{-- ================= WORKING HOURS ================= --}}

<div class="hours-section">

    <h3>🕐 Working Hours</h3>

    <p>
        Update your restaurant opening and closing time.
    </p>

    <div class="hours-grid">

        <div class="form-group">

            <label for="opening_time">
                Opening Time
            </label>

            <input
                id="opening_time"
                type="time"
                name="opening_time"
                value="{{ old('opening_time', $restaurant->opening_time ? \Carbon\Carbon::parse($restaurant->opening_time)->format('H:i') : '') }}"
                required
            >

            @error('opening_time')
                <span class="error">{{ $message }}</span>
            @enderror

        </div>


        <div class="form-group">

            <label for="closing_time">
                Closing Time
            </label>

            <input
                id="closing_time"
                type="time"
                name="closing_time"
                value="{{ old('closing_time', $restaurant->closing_time ? \Carbon\Carbon::parse($restaurant->closing_time)->format('H:i') : '') }}"
                required
            >

            @error('closing_time')
                <span class="error">{{ $message }}</span>
            @enderror

        </div>

    </div>

</div>
                {{-- ================= LOCATION ================= --}}

                <div class="location-section">

                    <h3>
                        📍 Restaurant Location
                    </h3>

                    <p>
                        Click on the map to change your restaurant location.
                    </p>


                    <button
                        type="button"
                        id="location-btn"
                        class="location-btn"
                    >
                        📍 Use My Current Location
                    </button>


                    <div id="map"></div>


                    {{-- Latitude --}}
                    <input
                        type="hidden"
                        name="latitude"
                        id="latitude"
                        value="{{ old('latitude', $restaurant->latitude) }}"
                    >


                    {{-- Longitude --}}
                    <input
                        type="hidden"
                        name="longitude"
                        id="longitude"
                        value="{{ old('longitude', $restaurant->longitude) }}"
                    >


                    <div class="coordinates">

                        <span>
                            Latitude:

                            <strong id="lat-value">
                                {{ old('latitude', $restaurant->latitude) }}
                            </strong>
                        </span>


                        <span>
                            Longitude:

                            <strong id="lng-value">
                                {{ old('longitude', $restaurant->longitude) }}
                            </strong>
                        </span>

                    </div>


                    @error('latitude')
                        <span class="error">
                            {{ $message }}
                        </span>
                    @enderror


                    @error('longitude')
                        <span class="error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>


                {{-- ================= CURRENT IMAGE ================= --}}

                @if($restaurant->image)

                    <div class="current-image">

                        <label>
                            Current Restaurant Image
                        </label>

                        <img
                            src="{{ asset('storage/' . $restaurant->image) }}"
                            alt="{{ $restaurant->name }}"
                        >

                    </div>

                @endif


                {{-- ================= NEW IMAGE ================= --}}

                <div class="form-group">

                    <label for="image">
                        Change Restaurant Image
                    </label>

                    <input
                        id="image"
                        type="file"
                        name="image"
                        accept="image/jpeg,image/png,image/jpg,image/webp"
                    >

                    <small>
                        JPG, PNG or WEBP — Max 2MB
                    </small>

                    @error('image')
                        <span class="error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>


                {{-- Buttons --}}
                <div class="buttons">

                    <a
                        href="{{ route('restaurant.dashboard') }}"
                        class="cancel-btn"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="update-btn"
                    >
                        Save Changes 💾
                    </button>

                </div>


            </form>

        </div>

    </div>


    {{-- Leaflet --}}
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    />


    <script
        src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js">
    </script>


    <script>

        const restaurantLat =
            parseFloat("{{ old('latitude', $restaurant->latitude) }}");

        const restaurantLng =
            parseFloat("{{ old('longitude', $restaurant->longitude) }}");


        const map = L.map('map').setView(
            [restaurantLat, restaurantLng],
            15
        );


        L.tileLayer(
            'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            {
                attribution:
                    '&copy; OpenStreetMap contributors'
            }
        ).addTo(map);


        let marker = L.marker([
            restaurantLat,
            restaurantLng
        ]).addTo(map);


        function setLocation(lat, lng) {

            lat = parseFloat(lat).toFixed(8);
            lng = parseFloat(lng).toFixed(8);


            const position = [
                parseFloat(lat),
                parseFloat(lng)
            ];


            marker.setLatLng(position);


            map.setView(
                position,
                16
            );


            document.getElementById('latitude').value = lat;

            document.getElementById('longitude').value = lng;

            document.getElementById('lat-value').textContent = lat;

            document.getElementById('lng-value').textContent = lng;

        }


        map.on('click', function(event) {

            setLocation(
                event.latlng.lat,
                event.latlng.lng
            );

        });


        document
            .getElementById('location-btn')
            .addEventListener('click', function() {

                const button = this;


                if (!navigator.geolocation) {

                    alert(
                        'Geolocation is not supported by your browser.'
                    );

                    return;

                }


                button.disabled = true;

                button.textContent =
                    '📍 Getting your location...';


                navigator.geolocation.getCurrentPosition(

                    function(position) {

                        setLocation(
                            position.coords.latitude,
                            position.coords.longitude
                        );


                        button.disabled = false;

                        button.textContent =
                            '✅ Location Selected';

                    },

                    function() {

                        button.disabled = false;

                        button.textContent =
                            '📍 Use My Current Location';


                        alert(
                            'Unable to get your location.'
                        );

                    },

                    {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0
                    }

                );

            });

    </script>


    <style>

        .restaurant-edit {

            max-width: 850px;

            margin: auto;

            padding: 50px 25px 80px;

        }


        .edit-header {

            text-align: center;

            margin-bottom: 30px;

        }


        .edit-header span {

            color: #ff5722;

            font-size: 12px;

            font-weight: 700;

            letter-spacing: 1px;

        }


        .edit-header h1 {

            margin: 10px 0;

            font-size: 32px;

            color: #222;

        }


        .edit-header p {

            color: #777;

            font-size: 14px;

        }


        .restaurant-form-card {

            background: white;

            border-radius: 20px;

            padding: 35px;

            border: 1px solid #eee;

            box-shadow:
                0 8px 30px rgba(0,0,0,.06);

        }


        .form-group {

            margin-bottom: 22px;

        }


        .form-group label,
        .current-image label {

            display: block;

            margin-bottom: 8px;

            font-size: 14px;

            font-weight: 600;

            color: #333;

        }


        .form-group input {

            width: 100%;

            border: 1px solid #ddd;

            border-radius: 10px;

            padding: 12px 14px;

            font-size: 14px;

            outline: none;

            box-sizing: border-box;

        }


        .form-group input:focus {

            border-color: #ff5722;

            box-shadow:
                0 0 0 3px
                rgba(255,87,34,.1);

        }


        .hours-section {

            margin-bottom: 28px;

            padding: 20px;

            background: #fffaf7;

            border: 1px solid #ffe0d2;

            border-radius: 15px;

        }


        .hours-section h3 {

            margin: 0 0 5px;

            color: #333;

            font-size: 17px;

        }


        .hours-section > p {

            margin: 0 0 18px;

            color: #888;

            font-size: 13px;

        }


        .hours-grid {

            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 15px;

        }


        .hours-grid .form-group {

            margin-bottom: 0;

        }


        .hours-note {

            margin-top: 15px;

            padding: 11px 13px;

            background: #fff3ed;

            color: #777;

            border-radius: 9px;

            font-size: 12px;

            line-height: 1.5;

        }


        .location-section {

            margin-bottom: 25px;

        }


        .location-section h3 {

            margin-bottom: 5px;

            color: #333;

            font-size: 18px;

        }


        .location-section p {

            color: #888;

            font-size: 13px;

            margin-bottom: 12px;

        }


        .location-btn {

            border: 1px solid #ffd6c7;

            background: #fff3ed;

            color: #ff5722;

            padding: 11px 16px;

            border-radius: 10px;

            font-size: 13px;

            font-weight: 700;

            cursor: pointer;

            margin-bottom: 15px;

        }


        #map {

            width: 100%;

            height: 350px;

            border-radius: 15px;

            overflow: hidden;

            border: 1px solid #ddd;

        }


        .coordinates {

            display: flex;

            gap: 20px;

            margin-top: 12px;

            padding: 12px;

            background: #fff7f3;

            border-radius: 10px;

            font-size: 13px;

            color: #777;

            flex-wrap: wrap;

        }


        .coordinates strong {

            color: #ff5722;

        }


        .current-image {

            margin-bottom: 22px;

        }


        .current-image img {

            display: block;

            width: 180px;

            height: 130px;

            object-fit: cover;

            border-radius: 12px;

            border: 1px solid #eee;

        }


        .form-group small {

            display: block;

            margin-top: 6px;

            color: #999;

            font-size: 12px;

        }


        .error {

            display: block;

            margin-top: 5px;

            color: #e53935;

            font-size: 12px;

        }


        .buttons {

            display: flex;

            gap: 12px;

            margin-top: 25px;

        }


        .update-btn,
        .cancel-btn {

            flex: 1;

            padding: 13px;

            border-radius: 10px;

            text-align: center;

            font-size: 14px;

            font-weight: 600;

            text-decoration: none;

            cursor: pointer;

        }


        .update-btn {

            border: none;

            background: #ff5722;

            color: white;

        }


        .update-btn:hover {

            background: #e64a19;

        }


        .cancel-btn {

            background: #f5f5f5;

            color: #555;

        }


        .cancel-btn:hover {

            background: #e8e8e8;

        }


        @media(max-width: 600px) {

            .restaurant-form-card {

                padding: 25px 20px;

            }


            .hours-grid {

                grid-template-columns: 1fr;

            }


            .buttons {

                flex-direction: column;

            }

        }

    </style>

</x-app-layout>