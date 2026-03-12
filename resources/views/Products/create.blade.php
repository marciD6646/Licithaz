@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-3xl px-6">
    <h1 id="create-product-section"
        class="text-4xl md:text-5xl font-extrabold text-center mb-10 
        bg-gradient-to-r from-black to-gray-500 bg-clip-text text-transparent">
        Add New Product
    </h1>
    @if ($errors->any())

    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-red-700 shadow">
        <ul class="list-disc pl-5 space-y-1">

    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
        </ul>
        </div>
    @endif


    <form
        action="{{ route('products.store') }}"
        method="POST"
        id="CreateForm"
        class="bg-white p-8 rounded-3xl shadow-xl border border-slate-200 space-y-6">
    @csrf
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">
        Product Name
        </label>
        <input
            type="text"
            name="name"
            value="{{ old('name') }}"
            required
            class="w-full rounded-lg border border-slate-300 px-4 py-2  ">
    </div>

<<<<<<< HEAD
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">
        Category
        </label>
        <select
            name="category"
            required
            class="w-full rounded-lg border border-slate-300 px-4 py-2 ">
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

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">
        Short Description
        </label>
        <textarea
            name="description"
            rows="3"
            required
            class="w-full rounded-lg border border-slate-300 px-4 py-2 ">{{ old('description') }}
        </textarea>
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">
        Extended Description
        </label>
        <textarea
            name="extended_description"
            rows="5"
            required
            class="w-full rounded-lg border border-slate-300 px-4 py-2 ">{{ old('extended_description') }}
        </textarea>
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">
        Image URL
        </label>

        <input
        type="url"
        name="image_url"
        value="{{ old('image_url') }}"
        required

        class="w-full rounded-lg border border-slate-300 px-4 py-2 ">
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>

            <label class="block text-sm font-semibold text-slate-700 mb-2">
            Starter Bid
            </label>

            <input
                type="number"
                name="starter_bid"
                min="0"
                value="{{ old('starter_bid') }}"
                required
                class="w-full rounded-lg border border-slate-300 px-4 py-2 ">

        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
            Bid Start Date
            </label>

            <input
                type="date"
                name="bid_start_date"
                value="{{ old('bid_start_date') }}"
                required
                class="w-full rounded-lg border border-slate-300 px-4 py-2 ">
        </div>
    </div>


    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">
        Bid End Date
        </label>

        <input
            type="date"
            name="bid_end_date"
            value="{{ old('bid_end_date') }}"
            required
            class="w-full rounded-lg border border-slate-300 px-4 py-2 ">
    </div>

    <div class="pt-4">
        <button
            type="submit"
            class="w-full bg-emerald-500 hover:bg-emerald-600 transition text-white font-semibold py-3 rounded-full shadow">
            Add Product
        </button>
    </div>
    </form>

</div>
<script>
if (localStorage.getItem('darkMode') === 'true') {
document.getElementById('create-product-section').style.color = '#f8f9fa';
document.getElementById('CreateForm').style.backgroundColor = '#575b64';
}
</script>
@endsection
=======
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
>>>>>>> be79229 (Admin Dashboard basic)
