<x-app-layout>

    <div style="max-width:1100px; margin:auto; padding:50px 25px;">

        <h1>📂 Categories</h1>

        <p>Browse food categories</p>

        <div style="
            display:grid;
            grid-template-columns:repeat(auto-fill,minmax(220px,1fr));
            gap:20px;
            margin-top:30px;
        ">

            @foreach($categories as $category)

                <div style="
                    background:white;
                    padding:20px;
                    border-radius:15px;
                    border:1px solid #eee;
                ">

                    @if($category->image)

                        <img
                            src="{{ asset('storage/' . $category->image) }}"
                            alt="{{ $category->name }}"
                            style="
                                width:100%;
                                height:160px;
                                object-fit:cover;
                                border-radius:12px;
                            "
                        >

                    @else

                        <div style="
                            height:160px;
                            display:flex;
                            align-items:center;
                            justify-content:center;
                            background:#fff3ed;
                            border-radius:12px;
                            font-size:50px;
                        ">
                            🍽️
                        </div>

                    @endif

                    <h2 style="margin-top:15px;">
                        {{ $category->name }}
                    </h2>

                </div>

            @endforeach

        </div>

    </div>

</x-app-layout>