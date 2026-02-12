<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AUCTIONHOUSE</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-amber-100">
    @yield('header')
    <hr>
    <nav class="bg-gray-800 p-4 text-white gap-2.5 flex flex-row flex-nowrap justify-around">
        <a class="hover:text-gray-300" href="{{ route('welcome') }}">Home</a>
        <a class="hover:text-gray-300" href="{{ route('products.index') }}">View Products</a>
        <a class="hover:text-gray-300" href="{{ route('products.create') }}">Add New Product</a>
        <a class="hover:text-gray-300" href="">About us</a>
        <a class="hover:text-gray-300" href="">(admin dashboard)</a>
        <a class="hover:text-gray-300" href="">Profile</a>
    </nav>

    @yield('content')
</body>

</html>
