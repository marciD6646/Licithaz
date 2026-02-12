<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AUCTIONHOUSE</title>
</head>

<body>
    @yield('header')
    <hr>
    <a href="{{ route('products.index') }}">View Products</a>
    <a href="{{ route('products.create') }}">Add New Product</a>


    @yield('content')
</body>

</html>