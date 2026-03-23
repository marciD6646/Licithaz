@extends('layouts.app')

@section('content')
    <div class="products-container">
        <div class="products-header">
            <h1 class="products-title">Products</h1>
            <p class="products-subtitle">Browse active listings and starter bids.</p>
        </div>

        @if ($products->isEmpty())
            <div class="empty-state">
                No products yet. Create a listing to get started.
            </div>
        @else
            <div class="products-grid">
                @foreach ($products as $product)
                    <div class="product-card">
                        <div class="product-header">
                            <div>
                                <h2 class="product-name">{{ $product->name }}</h2>
                                <p class="product-category">{{ $product->category }}</p>
                            </div>
                            <span class="bid-badge">
                                Starting bid: {{ $product->starter_bid }}
                            </span>
                        </div>
                        <div class="product-description">
                            <p>Description: {{ $product->description }}</p>
                        </div>
                        <div class="product-actions">
                            <a href="{{ route('products.show', $product) }}" class="product-button">
                                View Details
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection