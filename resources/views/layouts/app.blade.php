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

    <nav class="bg-gray-800 text-white flex divide-x divide-gray-700">
        <a href="{{ route('welcome') }}" class="flex-1 text-center py-3 hover:bg-gray-700 transition-colors">
            Home
        </a>

        <a href="{{ route('products.index') }}" class="flex-1 text-center py-3 hover:bg-gray-700 transition-colors">
            View Products
        </a>

        <a href="#" class="flex-1 text-center py-3 hover:bg-gray-700 transition-colors">
            About Us
        </a>

        @guest
            <a href="{{ route('login') }}" class="flex-1 text-center py-3 hover:bg-gray-700 transition-colors">
                Login
            </a>

            <a href="{{ route('register') }}" class="flex-1 text-center py-3 hover:bg-gray-700 transition-colors">
                Register
            </a>
        @endguest

        @auth
            @if (Auth::user()->is_admin)
                <a href="#" class="flex-1 text-center py-3 hover:bg-gray-700 transition-colors">
                    Admin Dashboard
                </a>

                <a href="{{ route('products.create') }}" class="flex-1 text-center py-3 hover:bg-gray-700 transition-colors">
                    Add New Product
                </a>
            @endif

            <a href="{{ route('profile') }}" class="flex-1 text-center py-3 hover:bg-gray-700 transition-colors">
                Profile
            </a>

            <form action="{{ route('logout') }}" method="POST" class="flex-1">
                @csrf
                <button type="submit" class="w-full text-center py-3 hover:bg-gray-700 transition-colors">
                    Logout
                </button>
            </form>
        @endauth
    </nav>

    @yield('content')
</body>

</html>