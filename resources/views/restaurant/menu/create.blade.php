<x-app-layout>

    <div class="menu-create">

        {{-- Header --}}
        <div class="create-header">

            <span>🍔 MENU</span>

            <h1>Add Menu Item</h1>

            <p>
                Add a new meal to {{ $restaurant->name }}.
            </p>

        </div>


        {{-- Success Message --}}
        @if(session('success'))

            <div class="success-message">
                {{ session('success') }}
            </div>

        @endif


        {{-- Form --}}
        <div class="menu-form-card">

            <form
                method="POST"
                action="{{ route('restaurant.menu.store', ['restaurant' => $restaurant->id]) }}"
                enctype="multipart/form-data"
            >

                @csrf


                {{-- Category --}}
                <div class="form-group">

                    <label for="category_id">
                        Category
                    </label>

                    <select
                        id="category_id"
                        name="category_id"
                        required
                    >

                        <option value="">
                            Select Category
                        </option>

                        @foreach($categories as $category)

                            <option
                                value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}
                            >
                                {{ $category->name }}
                            </option>

                        @endforeach

                    </select>

                    @error('category_id')
                        <span class="error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>


                {{-- Food Name --}}
                <div class="form-group">

                    <label for="name">
                        Food Name
                    </label>

                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Example: Chicken Burger"
                        required
                    >

                    @error('name')
                        <span class="error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>


                {{-- Description --}}
                <div class="form-group">

                    <label for="description">
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        placeholder="Describe the meal..."
                    >{{ old('description') }}</textarea>

                    @error('description')
                        <span class="error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>


                {{-- Price --}}
                <div class="form-group">

                    <label for="price">
                        Price
                    </label>

                    <div class="price-input">

                        <input
                            id="price"
                            type="number"
                            name="price"
                            value="{{ old('price') }}"
                            placeholder="0.00"
                            min="0"
                            step="0.01"
                            required
                        >

                        <span>EGP</span>

                    </div>

                    @error('price')
                        <span class="error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>


                {{-- Image --}}
                <div class="form-group">

                    <label for="image">
                        Food Image
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
                <div class="form-actions">

                    <a
                        href="{{ route('restaurant.menu.index', ['restaurant' => $restaurant->id]) }}"
                        class="cancel-btn"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="create-btn"
                    >
                        Add Food 🍔
                    </button>

                </div>

            </form>

        </div>

    </div>


<style>

.menu-create {
    max-width: 850px;
    margin: auto;
    padding: 50px 25px 80px;
}

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

.success-message {
    background: #e8f5e9;
    color: #2e7d32;
    border: 1px solid #c8e6c9;
    padding: 12px 15px;
    border-radius: 10px;
    margin-bottom: 20px;
}

.menu-form-card {
    background: white;
    border-radius: 20px;
    padding: 35px;
    border: 1px solid #eee;
    box-shadow: 0 8px 30px rgba(0,0,0,.06);
}

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

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 12px 14px;
    font-size: 14px;
    outline: none;
    box-sizing: border-box;
    font-family: inherit;
}

.form-group textarea {
    resize: vertical;
    min-height: 120px;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    border-color: #ff5722;
    box-shadow: 0 0 0 3px rgba(255,87,34,.1);
}

.price-input {
    position: relative;
}

.price-input input {
    padding-right: 55px;
}

.price-input span {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #888;
    font-size: 13px;
    font-weight: 600;
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

.form-actions {
    display: flex;
    gap: 12px;
    margin-top: 30px;
}

.cancel-btn,
.create-btn {
    flex: 1;
    padding: 13px;
    border-radius: 10px;
    text-align: center;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    box-sizing: border-box;
}

.cancel-btn {
    background: #f5f5f5;
    color: #555;
    border: 1px solid #ddd;
}

.cancel-btn:hover {
    background: #eee;
}

.create-btn {
    border: none;
    background: #ff5722;
    color: white;
}

.create-btn:hover {
    background: #e64a19;
}

@media(max-width: 600px) {

    .menu-form-card {
        padding: 25px 20px;
    }

    .create-header h1 {
        font-size: 26px;
    }

    .form-actions {
        flex-direction: column;
    }

}

</style>

</x-app-layout>