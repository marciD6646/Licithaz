<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Licit - Auction Platform')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="body-bg min-h-screen flex flex-col">
    <hr class="hr-style">

    <nav class="navbar">
        <a href="{{ route('welcome') }}" class="navbar-link">Home</a>
        <a href="{{ route('products.index') }}" class="navbar-link">View Products</a>
        <a href="{{ route('aboutus') }}" class="navbar-link">About Us</a>

        @guest
            <a href="{{ route('login') }}" class="navbar-link">Login</a>
            <a href="{{ route('register') }}" class="navbar-link">Register</a>
        @endguest

        @auth
            @if (Auth::user()->is_admin)
                <a href="{{ route('dashboard') }}" class="navbar-link">Admin Dashboard</a>
                <a href="{{ route('products.create') }}" class="navbar-link">Add New Product</a>
            @endif

            <a href="{{ route('profile') }}" class="navbar-link">Profile</a>

            <form action="{{ route('logout') }}" method="POST" class="flex-1">
                @csrf
                <button type="submit" class="navbar-link">Logout</button>
            </form>
        @endauth
    </nav>
<main class="flex-grow">
    @yield('content')
</main>

    <footer class="footer">
    <div class="footer-container">
        <div>
            <h3 class="footer-title">Licit</h3>
            <p class="footer-text">
                A modern auction platform where you can discover, bid, and win items with confidence.
            </p>
        </div>

        <div>
            <h4 class="footer-subtitle">Quick Links</h4>
            <ul class="footer-list">
                <li><a href="{{ route('welcome') }}">Home</a></li>
                <li><a href="{{ route('products.index') }}">Products</a></li>
                <li><a href="{{ route('aboutus') }}">About Us</a></li>
            </ul>
        </div>

        <div>
            <h4 class="footer-subtitle">Account</h4>
            <ul class="footer-list">
                @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @endguest

                @auth
                    <li><a href="{{ route('profile') }}">Profile</a></li>
                @endauth
            </ul>
        </div>

        <div>
            <h4 class="footer-subtitle">Contact</h4>
            <p>Email: support@licit.com</p>
            <p>Phone: +123 456 789</p>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} Licit. All rights reserved.</p>
    </div>
</footer>

</body>

</html>
