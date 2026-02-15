@extends('layouts.app')
@section('content')
    <div class="mx-auto max-w-6xl px-6 py-10">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900">Products</h1>
            <p class="mt-2 text-slate-600">Browse active listings and starter bids.</p>
        </div>

        @if ($products->isEmpty())
            <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-6 text-slate-600">
                No products yet. Create a listing to get started.
            </div>
        @else
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($products as $product)
                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h2 class="text-lg font-semibold text-slate-900">{{ $product->name }}</h2>
                                <p class="mt-1 text-sm text-slate-500">{{ $product->category }}</p>
                            </div>
                            <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                                Starting bid: {{ $product->starter_bid }}
                            </span>
                        </div>
                        <div>
                            <p class="mt-4 text-sm text-slate-600">Description: {{ $product->description }}</p>
                        </div>
                        <div class="mt-auto flex justify-end">
                            <a href="{{ route('products.show', $product) }}"
                                class="inline-flex justify-end btn btn-primary rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white hover:bg-slate-800">View
                                Details </a>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
