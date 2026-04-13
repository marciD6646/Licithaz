@extends('layouts.app')

@section('content')
    <div class="edit-product-container">
        <h1>Edit Product</h1>

        <!-- Display validation errors if any -->
        @if ($errors->any())
            <div style="color:red; margin-bottom:1rem;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Edit Product Form -->
        <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div style="margin-bottom:0.5rem;">
                <label>Name:</label>
                <input type="text" name="name" value="{{ $product->name }}" required>
            </div>

            <div style="margin-bottom:0.5rem;">
                <label>Category:</label>
                <input type="text" name="category" value="{{ $product->category }}" required>
            </div>

            <div style="margin-bottom:0.5rem;">
                <label>Starter Bid:</label>
                <input type="number" name="starter_bid" value="{{ $product->starter_bid }}" min="0" step="0.01"
                    required>
            </div>

            <div style="margin-bottom:0.5rem;">
                <label>Bid Start Date:</label>
                <input type="date" name="bid_start_date"
                    value="{{ \Carbon\Carbon::parse($product->bid_start_date)->format('Y-m-d') }}" required>
            </div>

            <div style="margin-bottom:0.5rem;">
                <label>Bid End Date:</label>
                <input type="date" name="bid_end_date"
                    value="{{ \Carbon\Carbon::parse($product->bid_end_date)->format('Y-m-d') }}" required>
            </div>

            <div style="margin-bottom:0.5rem;">
                <label>Description:</label>
                <textarea name="description" required>{{ $product->description }}</textarea>
            </div>

            <div style="margin-bottom:0.5rem;">
                <label>Extended Description:</label>
                <textarea name="extended_description" required>{{ $product->extended_description }}</textarea>
            </div>

            <div style="margin-bottom:0.5rem;">
                <label>Image:</label>
                <input type="file" name="image_url" accept="image/*">
                <small>Leave empty to keep current image.</small>
            </div>

            <button type="submit" style="margin-top:1rem;">Update Product</button>
        </form>
    </div>
@endsection
