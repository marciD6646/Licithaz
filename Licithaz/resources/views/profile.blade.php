@extends('layouts.app')
@section('title', 'Profile')

@section('content')
    @if (session('status'))
        <div class="status-alert" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="profile-container">
        <div class="profile-grid">
            <div id="user-div" class="profile-card user-card">
                <p class="user-name">Name: {{ $user->name }}</p>
                <p class="user-email">Email: {{ $user->email }}</p>
                <p class="user-bids">Placed bids: {{ $user->bids->count() }}</p>
            </div>

            <div id="my-bids" class="profile-card bids-card">
                <h2 class="bids-title">My bids</h2>
                <p class="bids-subtitle">Every bid you place appears here with the related product.</p>

                <div class="bids-list">
                    @if ($user->bids->isEmpty())
                        <div class="empty-state">
                            You have not placed any bids yet.
                        </div>
                    @else
                        @foreach ($user->bids as $bid)
                            <div class="bid-item">
                                <div class="bid-info">
                                    <p class="info-label">Product</p>
                                    @if ($bid->product && !$bid->product->trashed())
                                        <a href="{{ route('products.show', $bid->product) }}" class="product-name">
                                            {{ $bid->product->name }}
                                        </a>
                                    @elseif ($bid->product)
                                        <span class="product-name">{{ $bid->product->name }} (deleted)</span>
                                    @else
                                        <span class="product-name">Deleted product</span>
                                    @endif
                                    <p class="bid-date">Placed at {{ $bid->created_at->format('Y-m-d H:i') }}</p>
                                </div>
                                <div class="bid-amount-section">
                                    <p class="info-label">Your bid</p>
                                    <p class="bid-value">{{ number_format($bid->amount) }} Ft</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection