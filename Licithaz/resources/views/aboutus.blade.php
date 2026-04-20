@extends('layouts.app')
@section('title', 'About Us')


@section('content')
    <div class="container">

        <div class="intro">
            <h1 class="page-title">
                About AuctionHouse
            </h1>
            <p class="page-subtitle">
                Connecting buyers and sellers in a fair and exciting online auction experience.
            </p>
        </div>

        <div class="card">
            <h2 class="section-title">About us</h2>
            <p class="text">
              We are a passionate team dedicated to building a simple, transparent, and reliable online bidding platform where users can discover great products and place competitive bids with ease.
            </p>
        </div>

        <!-- céljaink hogy miért csinaljuk ezt az oldalt miért lesz hasznos stb -->
        <div class="mission">
            <h2 class="section-title">What we do</h2>
            <h2>We provide a platform where users can:</h2>
            <ul class="mission-list">
                <li><span class="check">✔</span> Browse available products in real time.</li>
                <li><span class="check">✔</span> Place bids securely and transparently</li>
                <li><span class="check">✔</span> Track their bidding history</li>
                <li><span class="check">✔</span> Manage their profile and activity easily</li>
            </ul>
        </div>

        <div class="team">
            <h2 class="section-title center">Meet the Team</h2>

            <div class="team-grid">
                <div class="team-member">
                    <img src="{{ asset('images/deak.png') }}" alt="Deákvári Marcell" class="avatar">
                    <p class="name">Deákvári Marcell</p>
                    <p class="role">Developer</p>
                </div>

                <div class="team-member">
                    <img src="{{ asset('images/szok.png') }}" alt="Szokolay Márk" class="avatar">
                    <p class="name">Szokolay Márk</p>
                    <p class="role">Developer</p>
                </div>

                <div class="team-member">
                    <img src="{{ asset('images/vik.png') }}" alt="Csermák Viktor" class="avatar">
                    <p class="name">Csermák Viktor</p>
                    <p class="role">Developer</p>
                </div>
            </div>
        </div>

        <div class="action-section">
            <h2 class="action-title">Start Bidding Today!</h2>
            <p class="action-text">
                Join our community of collectors and enthusiasts and explore unique items for auction.
            </p>
            <a href="{{ route('products.index') }}" class="action-button">
                Browse Auctions
            </a>
        </div>

    </div>
@endsection
