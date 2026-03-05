@extends('layouts.app')
@section('content')
    <div class="container mx-auto p-4">
        <h1 id="create-product-section" class="text-2xl font-bold mb-4">Add New Product</h1>

        @if ($errors->any())
            <div class="mb-4 rounded border border-red-300 bg-red-50 p-3 text-red-700">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST" id="CreateForm" class="bg-white p-6 rounded shadow-md">
            @csrf
            <div class="mb-4">
                <label for="name" class="CreateFormText block text-gray-700">Product Name:</label>
                <input type="text" name="name" id="name"
                    class="CreateFormText w-full border border-gray-300 p-2 rounded" value="{{ old('name') }}" required>
            </div>

            <div class="mb-4">
                <label for="description" class="CreateFormText block text-gray-700">Description:</label>
                <textarea name="description" id="description" class="CreateFormText w-full border border-gray-300 p-2 rounded" required>{{ old('description') }}</textarea>
            </div>

            <div class="mb-4">
                <label for="extended_description" class="CreateFormText block text-gray-700">Extended Description:</label>
                <textarea name="extended_description" id="extended_description"
                    class="CreateFormText w-full border border-gray-300 p-2 rounded" required>{{ old('extended_description') }}</textarea>
            </div>

            <div class="mb-4">
                <label for="image_url" class="CreateFormText block text-gray-700">Image URL:</label>
                <input type="url" name="image_url" id="image_url"
                    class="CreateFormText w-full border border-gray-300 p-2 rounded" value="{{ old('image_url') }}"
                    required>
            </div>

            <div class="mb-4">
                <label for="starter_bid" class="CreateFormText block text-gray-700">Starter Bid:</label>
                <input type="number" name="starter_bid" id="starter_bid" min="0"
                    class="CreateFormText w-full border border-gray-300 p-2 rounded" value="{{ old('starter_bid') }}"
                    required>
            </div>

            <div class="mb-4">
                <label for="bid_start_date" class="CreateFormText block text-gray-700">Bid Start Date:</label>
                <input type="date" name="bid_start_date" id="bid_start_date"
                    class="CreateFormText w-full border border-gray-300 p-2 rounded" value="{{ old('bid_start_date') }}"
                    required>
            </div>

            <div class="mb-4">
                <label for="bid_end_date" class="CreateFormText block text-gray-700">Bid End Date:</label>
                <input type="date" name="bid_end_date" id="bid_end_date"
                    class="CreateFormText w-full border border-gray-300 p-2 rounded" value="{{ old('bid_end_date') }}"
                    required>
            </div>

            <div class="mb-4">
                <label for="category" class="CreateFormText block text-gray-700">Category:</label>
                <select name="category" id="category" class="CreateFormText w-full border border-gray-300 p-2 rounded"
                    required>
                    <option value="">Choose category</option>
                    <option value="Electronics" {{ old('category') === 'Electronics' ? 'selected' : '' }}>Electronics
                    </option>
                    <option value="Books" {{ old('category') === 'Books' ? 'selected' : '' }}>Books</option>
                    <option value="Clothing" {{ old('category') === 'Clothing' ? 'selected' : '' }}>Clothing</option>
                    <option value="House" {{ old('category') === 'House' ? 'selected' : '' }}>House</option>
                    <option value="Sports" {{ old('category') === 'Sports' ? 'selected' : '' }}>Sports</option>
                    <option value="Vehicles" {{ old('category') === 'Vehicles' ? 'selected' : '' }}>Vehicles</option>
                    <option value="Jewelry" {{ old('category') === 'Jewelry' ? 'selected' : '' }}>Jewelry</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Product</button>
        </form>
        <script>
            if (localStorage.getItem('darkMode') === 'true') {
                document.getElementById('create-product-section').style.color = '#f8f9fa';
                document.getElementById('CreateForm').style.backgroundColor = '#575b64';
                const elements = document.getElementsByClassName('CreateFormText');
                for (let i = 0; i < elements.length; i++) {
                    elements[i].style.color = '#f8f9fa';
                }
            }
        </script>
    @endsection
