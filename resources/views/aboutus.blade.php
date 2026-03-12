@extends('layouts.app')

@section('content')
<div class="container mx-auto py-12 px-4">
   
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold mb-4">About AuctionHouse</h1>
        <p class="text-gray-700 text-lg">Connecting buyers and sellers in a fair and exciting online auction experience.</p>
    </div>

  
    <div class="mb-12">
        <h2 class="text-2xl font-semibold mb-4">Our Story</h2>
        <p class="text-gray-700 mb-4">
           Valami szöveg rólúnk
        </p>
        
    </div>

    
    <div class="mb-12 bg-gray-50 p-6 rounded-lg shadow">
        <h2 class="text-2xl font-semibold mb-4">Our Mission</h2>
        <ul class="list-disc list-inside text-gray-700 space-y-2">
            <!-- céljain hogy miért csinaljuk ezt az oldalt miért lesz hasznos stb -->
            <li><strong>:</strong> </li>
            <li><strong>:</strong></li>
            <li><strong>:</strong> </li>
        </ul>
    </div>

    
    <div>
        <h2 class="text-2xl font-semibold mb-6">Meet the Team</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-lg shadow-lg p-4 flex items-center">
                <img src="{{ asset('images/deak.png') }}" alt="Deákvári Marcell" class="w-16 h-16 rounded-full mr-4">
                <div>
                    <p class="font-bold">Deákvári Marcell</p>
                    <p class="text-gray-600 text-sm">(Developer)</p>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-4 flex items-center">
                <img src="{{ asset('images/szok.png') }}" alt="Szokolay Márk" class="w-16 h-16 rounded-full mr-4">
                <div>
                    <p class="font-bold">Szokolay Márk</p>
                    <p class="text-gray-600 text-sm">(Developer)</p>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-4 flex items-center">
                <img src="{{ asset('images/vik.png') }}" alt="Szokolay Márk" class="w-16 h-16 rounded-full mr-4">
                <div>
                    <p class="font-bold">Csermák Viktor</p>
                    <p class="text-gray-600 text-sm">(Developer)</p>
                </div>
            </div>
            <!-- Ide lehet további csapattagokat hozzáadni -->
        </div>
    </div>

    <!-- Call to Action -->
    <div class="mt-12 text-center">
        <h2 class="text-2xl font-semibold mb-4">Start Bidding Today!</h2>
        <p class="text-gray-700 mb-6">Join our community of collectors and enthusiasts and explore unique items for auction.</p>
        <a href="{{ route('products.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700">
            Browse Auctions
        </a>
    </div>
</div>
@endsection