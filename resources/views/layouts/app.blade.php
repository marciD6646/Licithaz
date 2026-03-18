<body class="body-bg">
    @yield('header')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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

    @yield('content')
</body>