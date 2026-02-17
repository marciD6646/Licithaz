@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-6xl px-6 py-10">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900">{{ $product->name }}</h1>
            <p class="mt-2 text-slate-600">{{ $product->category }}</p>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <img src="{{ asset($product->image_url) }}"
                        onerror="this.onerror=null;this.src='{{ asset('images/1.jpg') }}';">
                </div>
                <div class="flex flex-col gap-4">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">Description</h2>
                        <p class="mt-2 text-sm text-slate-600">{{ $product->extended_description }}</p>
                    </div>
                    <span class="self-start rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                        Starting bid: {{ $product->starter_bid }}
                    </span>
                    <div>
                       @guest
                       <p>Please log in to place a bid.</p>
                       @else
                        <button
                            class="rounded-full bg-emerald-500 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-600">Place Bid</button>
                        <div class="relative w-40">
    <input 
        type="number" 
        id="quantity" 
        name="quantity" 
        min="1" 
        max="5"
        class="w-full rounded-lg border border-slate-300 px-3 py-2 pr-10"
    >
    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-500">
        Ft
    </span>
</div>
 
                        
                        @endguest 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
