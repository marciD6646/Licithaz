@extends('layouts.app')
@section('content')

    <div class="container mx-auto p-4">
        <h1 id="create-product-section" class="text-2xl font-bold mb-4">Add New Product</h1>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" id="CreateForm"
            class="bg-white p-6 rounded shadow-md">
            @csrf
            <div class="mb-4">
                <label for="name" class="CreateFormText block text-gray-700">Product Name:</label>
                <input type="text" name="name" id="name" class="CreateFormText w-full border border-gray-300 p-2 rounded"
                    required>
            </div>

            <div class="mb-4">
                <label for="description" class="CreateFormText block text-gray-700">Description:</label>
                <textarea name="description" id="description"
                    class="CreateFormText w-full border border-gray-300 p-2 rounded" required></textarea>
            </div>

            <div class="mb-4">
                <label for="starting_price" class="CreateFormText block text-gray-700">Starting Price:</label>
                <input type="number" name="starting_price" id="starting_price"
                    class="CreateFormText w-full border border-gray-300 p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label for="image" class="CreateFormText block text-gray-700">Product Image:</label>
                <input type="file" name="image" id="image" class="CreateFormText w-full border border-gray-300 p-2 rounded">
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