@extends('layouts.app')

@section('content')
    <div class="product-detail-container">
        @if (session('status'))
            <div class="success-alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="product-header">
            <h1 class="product-name-header">{{ $product->name }}</h1>
            <p class="product-category-header">{{ $product->category }}</p>
            <div class="product-meta">
                <span class="meta-badge highest-bid">Current highest bid: {{ number_format($currentHighestBid) }} Ft</span>
                <span class="meta-badge auction-end">Auction ends: {{ $product->bid_end_date->format('Y-m-d') }}</span>
            </div>
        </div>

        <div class="product-main-card">
            <div class="product-main-grid">
                <div class="product-image-section">
                    <img src="{{ asset($product->image_url) }}"
                        onerror="this.onerror=null;this.src='{{ asset('images/1.jpg') }}';">
                </div>
                <div class="product-details-section">
                    <div class="description-section">
                        <h2 class="description-title">Description</h2>
                        <p class="description-text">{{ $product->extended_description }}</p>
                    </div>
                    <div class="bid-info-badges">
                        <span class="bid-badge starter-bid">
                            Starting bid: {{ number_format($product->starter_bid) }} Ft
                        </span>
                        <span class="bid-badge minimum-bid">
                            Next minimum bid: {{ number_format($minimumBid) }} Ft
                        </span>
                    </div>
                    <div class="bid-form-section">
                        @guest
                            <p class="guest-message">Please log in to place a bid.</p>
                        @else
                            @if ($product->isBiddingOpen())
                                <form action="{{ route('products.bids.store', $product) }}" method="POST" class="bid-form">
                                    @csrf
                                    <button type="submit" class="bid-button">Place Bid</button>
                                    <div class="bid-input-group">
                                        <input type="number" id="amount" name="amount" min="{{ $minimumBid }}" step="1000"
                                            value="{{ old('amount', $minimumBid) }}" class="bid-input">
                                        <span class="input-suffix">Ft</span>
                                    </div>
                                    <p class="minimum-notice">Minimum: {{ number_format($minimumBid) }} Ft</p>
                                </form>
                                @error('amount')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            @else
                                <p class="auction-closed">Bidding is closed for this product.</p>
                            @endif
                        @endguest
                    </div>
                </div>
            </div>
        </div>

        <div class="bids-history-card">
            <h2 class="bids-history-title">Recent bids</h2>
            @if ($product->bids->isEmpty())
                <p class="no-bids-message">No bids have been placed yet.</p>
            @else
                <div class="bids-list">
                    @foreach ($product->bids as $bid)
                        <div class="bid-item">
                            <div>
                                <p class="bid-user">{{ $bid->user->name }}</p>
                                <p class="bid-time">{{ $bid->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                            <span class="bid-amount">{{ number_format($bid->amount) }} Ft</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection