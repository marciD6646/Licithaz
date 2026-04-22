@extends('layouts.app')

@section('title', 'Welcome')


@section('content')
    <main class="main-content">
        <section id="welcome-section" class="welcome-section">
            <div class="welcome-content">
                <p class="welcome-badge">Welcome</p>
                <h1 class="welcome-title">Bid smarter at AuctionHouse</h1>
                <p class="welcome-description">Discover live listings, track your bids, and win items with confidence.</p>
                <div class="welcome-actions">
                    <a class="main-button" href="{{ route('products.index') }}">Browse products</a>
                </div>
            </div>
            <div class="image-section">
                <div class="image-gradient"></div>
                <img class="main-image" src="{{ asset('images/bid.png') }}" alt="A picture about auctions" />
            </div>
        </section>

        <section class="team-section">
            <div class="team-list">
                <div class="team-item">
                    <img class="team-photo" src="{{ asset('images/deak.png') }}" alt="Deákvári Marcell" />
                    <p class="team-name">■► Deákvári Marcell</p>
                </div>
                <div class="team-item">
                    <img class="team-photo" src="{{ asset('images/szok.png') }}" alt="Szokolay Márk" />
                    <p class="team-name">■► Szokolay Márk</p>
                </div>
                <div class="team-item">
                    <img class="team-photo" src="{{ asset('images/vik.png') }}" alt="Csermák Viktor" />
                    <p class="team-name">■► Csermák Viktor</p>
                </div>
            </div>
            <div class="about-content">
                <p class="about-badge">What is this about</p>
                <h2 class="about-title">A simple platform for winning bids</h2>
                <p class="about-description">
                    You can find everything from cars to property, electronics to collectibles. Our user-friendly interface
                    makes it easy to search, bid, and win your desired items.
                </p>
                <p class="about-note">Use the navigation to explore listings to get started.</p>
            </div>
        </section>
    </main>
@endsection