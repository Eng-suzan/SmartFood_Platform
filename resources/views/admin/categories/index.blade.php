<x-app-layout>

    <style>

        .categories-page {
            max-width: 1100px;
            margin: auto;
            padding: 45px 25px 80px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-bottom: 30px;
        }

        .page-header h1 {
            margin: 0;
            color: #222;
            font-size: 30px;
        }

        .page-header p {
            margin: 7px 0 0;
            color: #888;
        }

        .add-btn {
            background: #ff5722;
            color: white;

            padding: 12px 18px;

            border-radius: 9px;

            text-decoration: none;

            font-size: 13px;
            font-weight: 700;
        }

        .success-message {
            background: #e8f5e9;
            color: #2e7d32;

            padding: 13px 17px;

            border-radius: 10px;

            margin-bottom: 20px;
        }

        .categories-list {
            display: grid;

            grid-template-columns:
                repeat(auto-fill, minmax(250px, 1fr));

            gap: 18px;
        }

        .category-card {
            background: white;

            border: 1px solid #eee;

            border-radius: 16px;

            padding: 22px;

            box-shadow: 0 5px 20px rgba(0,0,0,.04);

            transition: .2s;
        }

        .category-card:hover {
            transform: translateY(-3px);

            box-shadow:
                0 10px 25px rgba(0,0,0,.08);
        }

        .category-icon {
            width: 100%;
            height: 160px;

            border-radius: 12px;

            background: #fff3ed;

            display: flex;
            align-items: center;
            justify-content: center;

            overflow: hidden;

            margin-bottom: 15px;
        }

        .category-icon img {
            width: 100%;
            height: 100%;

            object-fit: cover;

            display: block;
        }

        .category-placeholder {
            font-size: 45px;
        }

        .category-card h2 {
            margin: 0 0 15px;

            font-size: 19px;

            color: #222;
        }

        .category-actions {
            display: flex;
            gap: 8px;
        }

        .edit-btn,
        .delete-btn {
            padding: 8px 12px;

            border-radius: 8px;

            font-size: 12px;

            font-weight: 700;

            cursor: pointer;

            text-decoration: none;
        }

        .edit-btn {
            background: #fff3ed;
            color: #ff5722;
        }

        .delete-btn {
            border: none;

            background: #ffebee;
            color: #d32f2f;
        }

        .empty-box {
            background: white;
            border: 1px solid #eee;

            border-radius: 16px;

            padding: 50px;

            text-align: center;

            color: #888;
        }

    </style>


    <div class="categories-page">

        {{-- Success Message --}}

        @if(session('success'))

            <div class="success-message">
                ✅ {{ session('success') }}
            </div>

        @endif


        {{-- Header --}}

        <div class="page-header">

            <div>

                <h1>
                    📂 Categories
                </h1>

                <p>
                    Manage food categories
                </p>

            </div>

            <a
                href="{{ route('admin.categories.create') }}"
                class="add-btn"
            >
                + Add Category
            </a>

        </div>


        {{-- Categories --}}

        @if($categories->count())

            <div class="categories-list">

                @foreach($categories as $category)

                    <div class="category-card">

                        {{-- Category Image --}}

                        <div class="category-icon">

                            @if($category->image)

                                <img
                                    src="{{ asset('storage/' . $category->image) }}"
                                    alt="{{ $category->name }}"
                                >

                            @else

                                <div class="category-placeholder">
                                    🍽️
                                </div>

                            @endif

                        </div>


                        {{-- Category Name --}}

                        <h2>
                            {{ $category->name }}
                        </h2>


                        {{-- Actions --}}

                        <div class="category-actions">

                            <a
                                href="{{ route('admin.categories.edit', $category) }}"
                                class="edit-btn"
                            >
                                ✏️ Edit
                            </a>


                            <form
                                method="POST"
                                action="{{ route('admin.categories.destroy', $category) }}"
                            >

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="delete-btn"
                                    onclick="return confirm('Delete this category?')"
                                >
                                    🗑️ Delete
                                </button>

                            </form>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="empty-box">

                <div style="font-size:50px;">
                    📂
                </div>

                <h2>
                    No Categories Yet
                </h2>

                <p>
                    Create your first food category.
                </p>

            </div>

        @endif

    </div>

</x-app-layout>