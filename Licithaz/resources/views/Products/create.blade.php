@extends('layouts.app')

@section('content')
    @auth
        @if (Auth::user()->is_banned)
            <div class="banned-alert p-6 bg-red-100 text-red-800 rounded-md text-center">
                Your account has been banned.
            </div>
        @else
            <div class="form-container">
                <h1 class="form-title">Add New Product</h1>

                @if ($errors->any())
                    <div class="error-container">
                        <ul class="error-list">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('products.store') }}" method="POST" id="CreateForm" class="main-form"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label class="form-label">Product Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="form-input">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Category</label>
                        <select name="category" required class="form-input">
                            <option value="">Choose category</option>
                            <option value="Electronics" {{ old('category') === 'Electronics' ? 'selected' : '' }}>Electronics</option>
                            <option value="Books" {{ old('category') === 'Books' ? 'selected' : '' }}>Books</option>
                            <option value="Clothing" {{ old('category') === 'Clothing' ? 'selected' : '' }}>Clothing</option>
                            <option value="House" {{ old('category') === 'House' ? 'selected' : '' }}>House</option>
                            <option value="Sports" {{ old('category') === 'Sports' ? 'selected' : '' }}>Sports</option>
                            <option value="Vehicles" {{ old('category') === 'Vehicles' ? 'selected' : '' }}>Vehicles</option>
                            <option value="Jewelry" {{ old('category') === 'Jewelry' ? 'selected' : '' }}>Jewelry</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Short Description</label>
                        <textarea name="description" rows="3" required class="form-input">{{ old('description') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Extended Description</label>
                        <textarea name="extended_description" rows="5" required
                            class="form-input">{{ old('extended_description') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Image URL</label>
                        <input type="file" name="image_url" value="{{ old('image_url') }}" required class="form-input"
                            accept="image/*">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Starter Bid</label>
                            <input type="number" name="starter_bid" min="0" value="{{ old('starter_bid') }}" required
                                class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Bid Start Date</label>
                            <input type="date" name="bid_start_date" value="{{ old('bid_start_date') }}" required
                                class="form-input">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Bid End Date</label>
                        <input type="date" name="bid_end_date" value="{{ old('bid_end_date') }}" required class="form-input">
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="submit-btn">Add Product</button>
                    </div>
                </form>
            </div>
        @endif
    @endauth
@endsection