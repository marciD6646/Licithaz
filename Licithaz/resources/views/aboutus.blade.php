@extends('layouts.app')
@section('title', 'About Us')

@section('content')
    @auth
        @if (Auth::user()->is_banned)
            <div class="banned-alert p-6 bg-red-100 text-red-800 rounded-md text-center">
                Your account has been banned.
            </div>
        @endif
    @endauth

    @if (!Auth::check() || (Auth::check() && !Auth::user()->is_banned))
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
                <h2 class="section-title">Our Story</h2>
                <p class="text">
                    Valami szöveg rólúnk...
                </p>
            </div>

            <div class="mission">
                <h2 class="section-title">Our Mission</h2>
                <ul class="mission-list">
                    <li><span class="check">✔</span> Create a transparent auction platform.</li>
                    <li><span class="check">✔</span> Empower collectors and sellers worldwide.</li>
                    <li><span class="check">✔</span> Ensure secure and fair bidding.</li>
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
    @endif
@endsection