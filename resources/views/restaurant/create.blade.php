<x-app-layout>

    <div class="restaurant-create">

        {{-- ================= HEADER ================= --}}

        <div class="create-header">

            <span>🍽️ RESTAURANT</span>

            <h1>Create Your Restaurant</h1>

            <p>
                Add your restaurant information, location and working hours.
            </p>

        </div>


        {{-- ================= FORM ================= --}}

        <div class="restaurant-form-card">

            <form
                method="POST"
                action="{{ route('restaurant.restaurants.store') }}"
                enctype="multipart/form-data"
            >

                @csrf


                {{-- Restaurant Name --}}
                <div class="form-group">

                    <label for="name">
                        Restaurant Name
                    </label>

                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Enter restaurant name"
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
                        value="{{ old('phone') }}"
                        placeholder="Restaurant phone"
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
                        value="{{ old('email') }}"
                        placeholder="restaurant@example.com"
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
                        value="{{ old('address') }}"
                        placeholder="Restaurant address"
                        required
                    >

                    @error('address')
                        <span class="error">{{ $message }}</span>
                    @enderror

                </div>


                {{-- ================= WORKING HOURS ================= --}}

                <div class="hours-section">

                    <h3>
                        🕐 Working Hours
                    </h3>

                    <p>
                        Set the opening and closing time of your restaurant.
                    </p>


                    <div class="hours-grid">

                        {{-- Opening Time --}}
                        <div class="form-group">

                            <label for="opening_time">
                                Opening Time
                            </label>

                            <input
                                id="opening_time"
                                type="time"
                                name="opening_time"
                                value="{{ old('opening_time', '08:00') }}"
                                required
                            >

                            @error('opening_time')
                                <span class="error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>


                        {{-- Closing Time --}}
                        <div class="form-group">

                            <label for="closing_time">
                                Closing Time
                            </label>

                            <input
                                id="closing_time"
                                type="time"
                                name="closing_time"
                                value="{{ old('closing_time', '03:00') }}"
                                required
                            >

                            @error('closing_time')
                                <span class="error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                    </div>


                    <div class="hours-note">
                        💡 Example: 08:00 AM → 03:00 AM means the restaurant
                        stays open overnight.
                    </div>

                </div>


                {{-- ================= LOCATION ================= --}}

                <div class="location-section">

                    <h3>
                        📍 Restaurant Location
                    </h3>

                    <p>
                        Click on the map to select your restaurant location
                        or use your current location.
                    </p>


                    {{-- Current Location Button --}}

                    <button
                        type="button"
                        id="location-btn"
                        class="location-btn"
                    >
                        📍 Use My Current Location
                    </button>


                    {{-- Map --}}

                    <div id="map"></div>


                    {{-- Hidden Latitude --}}

                    <input
                        type="hidden"
                        name="latitude"
                        id="latitude"
                        value="{{ old('latitude') }}"
                    >


                    {{-- Hidden Longitude --}}

                    <input
                        type="hidden"
                        name="longitude"
                        id="longitude"
                        value="{{ old('longitude') }}"
                    >


                    {{-- Coordinates --}}

                    <div class="coordinates">

                        <span>
                            Latitude:

                            <strong id="lat-value">
                                {{ old('latitude', 'Not selected') }}
                            </strong>
                        </span>


                        <span>
                            Longitude:

                            <strong id="lng-value">
                                {{ old('longitude', 'Not selected') }}
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


                {{-- ================= IMAGE ================= --}}

                <div class="form-group">

                    <label for="image">
                        Restaurant Image
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


                {{-- ================= BUTTON ================= --}}

                <button
                    type="submit"
                    class="create-btn"
                >
                    Create Restaurant 🍽️
                </button>

            </form>

        </div>

    </div>


    {{-- ================= LEAFLET CSS ================= --}}

    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    />


    {{-- ================= LEAFLET JS ================= --}}

    <script
        src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js">
    </script>


    <script>

        // ==========================================
        // DEFAULT LOCATION
        // ==========================================

        const defaultLat = 31.1107;
        const defaultLng = 30.9388;


        // ==========================================
        // OLD VALUES
        // ==========================================

        const oldLat = "{{ old('latitude') }}";
        const oldLng = "{{ old('longitude') }}";


        let startLat = oldLat
            ? parseFloat(oldLat)
            : defaultLat;

        let startLng = oldLng
            ? parseFloat(oldLng)
            : defaultLng;


        // ==========================================
        // CREATE MAP
        // ==========================================

        const map = L.map('map').setView(
            [startLat, startLng],
            13
        );


        // ==========================================
        // OPEN STREET MAP
        // ==========================================

        L.tileLayer(
            'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            {
                attribution:
                    '&copy; OpenStreetMap contributors'
            }
        ).addTo(map);


        // ==========================================
        // MARKER
        // ==========================================

        let marker = null;


        // If old location exists
        if (oldLat && oldLng) {

            marker = L.marker([
                startLat,
                startLng
            ]).addTo(map);

        }


        // ==========================================
        // SET LOCATION FUNCTION
        // ==========================================

        function setLocation(lat, lng) {

            lat = parseFloat(lat).toFixed(8);
            lng = parseFloat(lng).toFixed(8);


            const position = [
                parseFloat(lat),
                parseFloat(lng)
            ];


            // Update marker

            if (marker) {

                marker.setLatLng(position);

            } else {

                marker = L.marker(position)
                    .addTo(map);

            }


            // Move map

            map.setView(
                position,
                16
            );


            // Update hidden inputs

            document.getElementById('latitude').value = lat;

            document.getElementById('longitude').value = lng;


            // Update displayed values

            document.getElementById('lat-value')
                .textContent = lat;

            document.getElementById('lng-value')
                .textContent = lng;

        }


        // ==========================================
        // CLICK MAP
        // ==========================================

        map.on('click', function(event) {

            setLocation(
                event.latlng.lat,
                event.latlng.lng
            );

        });


        // ==========================================
        // USE CURRENT LOCATION
        // ==========================================

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

                        const lat =
                            position.coords.latitude;

                        const lng =
                            position.coords.longitude;


                        setLocation(lat, lng);


                        button.disabled = false;

                        button.textContent =
                            '✅ Location Selected';

                    },


                    function(error) {

                        button.disabled = false;

                        button.textContent =
                            '📍 Use My Current Location';


                        alert(
                            'Unable to get your location. Please allow location access or select the location manually from the map.'
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

        /* ==========================================
           PAGE
        ========================================== */

        .restaurant-create {

            max-width: 850px;

            margin: auto;

            padding: 50px 25px 80px;

        }


        /* ==========================================
           HEADER
        ========================================== */

        .create-header {

            text-align: center;

            margin-bottom: 30px;

        }


        .create-header span {

            color: #ff5722;

            font-size: 12px;

            font-weight: 700;

            letter-spacing: 1px;

        }


        .create-header h1 {

            margin: 10px 0;

            font-size: 32px;

            color: #222;

        }


        .create-header p {

            color: #777;

            font-size: 14px;

        }


        /* ==========================================
           CARD
        ========================================== */

        .restaurant-form-card {

            background: white;

            border-radius: 20px;

            padding: 35px;

            border: 1px solid #eee;

            box-shadow:
                0 8px 30px rgba(0,0,0,.06);

        }


        /* ==========================================
           FORM
        ========================================== */

        .form-group {

            margin-bottom: 22px;

        }


        .form-group label {

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


        /* ==========================================
           WORKING HOURS
        ========================================== */

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

            grid-template-columns:
                1fr 1fr;

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


        /* ==========================================
           LOCATION
        ========================================== */

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


        /* ==========================================
           LOCATION BUTTON
        ========================================== */

        .location-btn {

            border: none;

            background: #fff3ed;

            color: #ff5722;

            border: 1px solid #ffd6c7;

            padding: 11px 16px;

            border-radius: 10px;

            font-size: 13px;

            font-weight: 700;

            cursor: pointer;

            margin-bottom: 15px;

        }


        .location-btn:hover {

            background: #ffe9df;

        }


        .location-btn:disabled {

            opacity: .7;

            cursor: wait;

        }


        /* ==========================================
           MAP
        ========================================== */

        #map {

            width: 100%;

            height: 350px;

            border-radius: 15px;

            overflow: hidden;

            border: 1px solid #ddd;

        }


        /* ==========================================
           COORDINATES
        ========================================== */

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


        /* ==========================================
           SMALL TEXT
        ========================================== */

        .form-group small {

            display: block;

            margin-top: 6px;

            color: #999;

            font-size: 12px;

        }


        /* ==========================================
           ERROR
        ========================================== */

        .error {

            display: block;

            margin-top: 5px;

            color: #e53935;

            font-size: 12px;

        }


        /* ==========================================
           CREATE BUTTON
        ========================================== */

        .create-btn {

            width: 100%;

            border: none;

            background: #ff5722;

            color: white;

            padding: 13px;

            border-radius: 10px;

            font-size: 15px;

            font-weight: 600;

            cursor: pointer;

        }


        .create-btn:hover {

            background: #e64a19;

        }


        /* ==========================================
           MOBILE
        ========================================== */

        @media(max-width: 600px) {

            .restaurant-form-card {

                padding: 25px 20px;

            }


            .create-header h1 {

                font-size: 26px;

            }


            .hours-grid {

                grid-template-columns: 1fr;

            }


            .coordinates {

                flex-direction: column;

                gap: 8px;

            }

        }

    </style>

</x-app-layout>