@extends('layouts.app')
@section('title', 'Profile')

@section('content')
    @if ($user->is_banned)
        <div class="banned-alert p-6 bg-red-100 text-red-800 rounded-md text-center">
            Your account has been banned.
        </div>
    @else
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
                    <a href="" class="profile-btn balance-btn">Add Balance</a>
                    <a href="#my-bids" class="profile-btn bids-btn">View Bids</a>
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
                                        <a href="{{ route('products.show', $bid->product) }}" class="product-name">
                                            {{ $bid->product->name }}
                                        </a>
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
    @endif
@endsection