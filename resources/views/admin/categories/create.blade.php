<x-app-layout>

    <style>

        .category-form-page {
            max-width: 650px;
            margin: auto;
            padding: 60px 25px;
        }

        .form-card {
            background: white;
            border: 1px solid #eee;
            border-radius: 20px;
            padding: 35px;

            box-shadow:
                0 8px 25px rgba(0,0,0,.05);
        }

        .form-card h1 {
            margin: 0 0 8px;
            font-size: 28px;
            color: #222;
        }

        .form-card p {
            color: #888;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 700;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 13px 14px;

            border: 1px solid #ddd;
            border-radius: 10px;

            outline: none;
            box-sizing: border-box;
        }

        .form-group input:focus {
            border-color: #ff5722;

            box-shadow:
                0 0 0 3px rgba(255,87,34,.1);
        }

        .form-group input[type="file"] {
            padding: 10px;
            background: #fafafa;
            cursor: pointer;
        }

        .error {
            color: #d32f2f;
            font-size: 12px;
            margin-top: 6px;
        }

        .form-actions {
            display: flex;
            gap: 10px;
        }

        .save-btn,
        .cancel-btn {
            padding: 11px 18px;

            border-radius: 9px;

            text-decoration: none;

            font-size: 13px;
            font-weight: 700;
        }

        .save-btn {
            border: none;
            background: #ff5722;
            color: white;
            cursor: pointer;
        }

        .save-btn:hover {
            background: #e64a19;
        }

        .cancel-btn {
            background: #f5f5f5;
            color: #555;
        }

        .cancel-btn:hover {
            background: #eeeeee;
        }

    </style>


    <div class="category-form-page">

        <div class="form-card">

            {{-- Header --}}

            <h1>
                ➕ Add Category
            </h1>

            <p>
                Create a new food category.
            </p>


            {{-- Form --}}

            <form
                method="POST"
                action="{{ route('admin.categories.store') }}"
                enctype="multipart/form-data"
            >

                @csrf


                {{-- Category Name --}}

                <div class="form-group">

                    <label for="name">
                        Category Name
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="e.g. Burgers"
                        required
                    >

                    @error('name')

                        <div class="error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Category Image --}}

                <div class="form-group">

                    <label for="image">
                        Category Image
                    </label>

                    <input
                        type="file"
                        id="image"
                        name="image"
                        accept="image/*"
                    >

                    @error('image')

                        <div class="error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Actions --}}

                <div class="form-actions">

                    <button
                        type="submit"
                        class="save-btn"
                    >
                        Save Category
                    </button>

                    <a
                        href="{{ route('admin.categories.index') }}"
                        class="cancel-btn"
                    >
                        Cancel
                    </a>

                </div>


            </form>

        </div>

    </div>

</x-app-layout>