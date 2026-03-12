@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-7xl py-16 px-6">   
  <div class="text-center mb-16">
    <h1 class="text-5xl md:text-6xl font-extrabold mb-4 text-gray-900">
        About AuctionHouse
    </h1>
    <p class="text-gray-500 text-lg md:text-xl max-w-2xl mx-auto">
        Connecting buyers and sellers in a fair and exciting online auction experience.
    </p>
</div>

  <div class="mb-16 bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl transition-shadow duration-300">
    <h2 class="text-3xl font-semibold mb-4 text-gray-800">Our Story</h2>
    <p class="text-gray-600 leading-relaxed">
        Valami szöveg rólúnk...
    </p>
</div>

<!-- céljain hogy miért csinaljuk ezt az oldalt miért lesz hasznos stb -->
   <div class="mb-16 bg-gradient-to-r from-blue-50 to-indigo-50 p-8 rounded-2xl shadow-lg">
    <h2 class="text-3xl font-semibold mb-6 text-gray-800">Our Mission</h2>
    <ul class="space-y-4 text-gray-700">
        <li class="flex items-start">
            <span class="text-blue-600 mr-2 mt-1">✔</span> Create a transparent auction platform.
        </li>
        <li class="flex items-start">
            <span class="text-blue-600 mr-2 mt-1">✔</span> Empower collectors and sellers worldwide.
        </li>
        <li class="flex items-start">
            <span class="text-blue-600 mr-2 mt-1">✔</span> Ensure secure and fair bidding.
        </li>
    </ul>
</div>
           

    
    <div>
    <h2 class="text-3xl font-semibold mb-8 text-gray-800 text-center">Meet the Team</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col items-center text-center hover:scale-105 transform transition-transform duration-300">
            <img src="{{ asset('images/deak.png') }}" alt="Deákvári Marcell" class="w-24 h-24 rounded-full mb-4 shadow-md">
            <p class="font-bold text-lg">Deákvári Marcell</p>
            <p class="text-gray-500">Developer</p>
        </div>
        <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col items-center text-center hover:scale-105 transform transition-transform duration-300">
            <img src="{{ asset('images/szok.png') }}" alt="Szokolay Márk" class="w-24 h-24 rounded-full mb-4 shadow-md">
            <p class="font-bold text-lg">Szokolay Márk</p>
            <p class="text-gray-500">Developer</p>
        </div>
        <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col items-center text-center hover:scale-105 transform transition-transform duration-300">
            <img src="{{ asset('images/vik.png') }}" alt="Csermák Viktor" class="w-24 h-24 rounded-full mb-4 shadow-md">
            <p class="font-bold text-lg">Csermák Viktor</p>
            <p class="text-gray-500">Developer</p>
        </div>
    </div>
</div>

<div class="mt-16 text-center">
    <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-800">Start Bidding Today!</h2>
    <p class="text-gray-500 mb-6 max-w-xl mx-auto">
        Join our community of collectors and enthusiasts and explore unique items for auction.
    </p>
    <a href="{{ route('products.index') }}" class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 py-3 rounded-full font-semibold shadow-lg hover:from-blue-700 hover:to-indigo-700 transition-colors duration-300">
        Browse Auctions
    </a>
</div>
</div>
@endsection