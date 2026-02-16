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
        <a class="hover:text-gray-300" href="">About us</a>
        @guest
        <a class="hover:text-gray-300" href="{{ route('login') }}">Login</a>
        <a class="hover:text-gray-300" href="{{ route('register') }}">Register</a>
        
       
        @endguest
        @auth
        @if (Auth::user()->is_admin)
        
            <a class="hover:text-gray-300" href="">Admin Dashboard</a>
            <a class="hover:text-gray-300" href="{{ route('products.create')  }}">Add New Product</a>
        
        
        @endif
        <a class="hover:text-gray-300" href="">Profile</a>
        <a class="hover:text-gray-300" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>
        @endauth
        
    </nav>

    @yield('content')
</body>

</html>
