@extends('layouts.app')
@section('title', 'Profile')

@section('content')
    <div class="profile-layout">

        <!-- SIDEBAR -->
        <div class="sidebar">
            <button onclick="showTab('profile')" class="sidebar-item">Profile</button>
            <button onclick="showTab('edit')" class="sidebar-item">Edit Profile</button>
            <button onclick="showTab('password')" class="sidebar-item">Password</button>
            <button onclick="showTab('bids')" class="sidebar-item">My Bids</button>
            <button onclick="showTab('payments')" class="sidebar-item">My Payments</button>
        </div>

        <!-- CONTENT -->
        <div class="content">

            <!-- PROFILE -->
            @if (session('success'))
                <div id="success-message" class="success-alert">
                    {{ session('success') }}
                </div>
            @endif
            <div id="tab-profile" class="tab card">
                <div class="profile-header">
                    <div class="profile-avatar">
                        @if ($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-white text-xl font-bold">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </span>
                        @endif
                    </div>

                    <div>
                        <h1>{{ $user->name }}</h1>
                        <p>{{ $user->email }}</p>
                        <p>Member since: {{ $user->created_at->format('Y. m. d.') }}</p>
                    </div>
                </div>
            </div>

            <!-- EDIT -->
            <div id="tab-edit" class="tab card" style="display:none;">
                <h2>Edit Profile</h2>

                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="input">
                    </div>

                    <div class="form-group">
                        <label>Profile Image</label>
                        <input type="file" name="avatar" class="input">
                    </div>

                    <button class="btn-primary">Save</button>
                </form>
            </div>

            <!-- PASSWORD -->

            <div id="tab-password" class="tab card" style="display:none;">
                @if ($errors->any())
                    <div class="error-box">
                        @foreach ($errors->all() as $error)
                            <div class="error">{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                <h2>Change Password</h2>

                <form method="POST" action="{{ route('profile.password.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Current Password</label>
                        <input type="password" name="current_password" class="input">
                    </div>

                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" name="password" class="input">
                    </div>

                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" class="input">
                    </div>

                    <button class="btn-primary">Update Password</button>
                </form>
            </div>

            <!-- BIDS -->
            <div id="tab-bids" class="tab card" style="display:none;">
                <h2>My Bids</h2>

                @if ($user->bids->isEmpty())
                    <div class="empty-state">
                        No bids yet
                    </div>
                @else
                    <div class="bid-list">
                        @foreach ($user->bids as $bid)
                            <div class="bid-card">
                                <div>
                                    {{ $bid->product->name ?? 'Deleted product' }}
                                    <p class="bid-date">{{ $bid->created_at->diffForHumans() }}</p>
                                </div>
                                <div style="display:flex;align-items:center;gap:1rem;">
                                    <span class="bid-price">
                                        {{ number_format($bid->amount) }} Ft
                                    </span>
                                    @if ($bid->product && $bid->product->winner_id === auth()->id())
                                        @if ($bid->product->status === 'pending_payment')
                                            <a href="{{ route('products.checkout', $bid->product) }}" class="btn-primary"
                                                style="text-decoration:none;">
                                                💳 Pay Now
                                            </a>
                                        @elseif ($bid->product->status === 'sold')
                                            <span style="color:#22c55e;font-weight:600;">✅ Paid</span>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- PAYMENTS -->
            <div id="tab-payments" class="tab card" style="display:none;">
                <h2>My Payments</h2>

                <div style="display:flex;gap:1rem;flex-wrap:wrap;">
                    <a href="{{ route('payments.index') }}" class="btn-primary" style="text-decoration:none;">
                        Open My Payments
                    </a>

                    @if (auth()->user()?->is_admin)
                        <a href="{{ route('payments.admin') }}" class="btn-primary" style="text-decoration:none;">
                            Open Admin Payments
                        </a>
                    @endif
                </div>

                <p style="margin-top:1rem;color:#6b7280;">
                    Payment details pages open from the My Payments list.
                </p>
            </div>

        </div>
    </div>

    <!-- JS -->
    <script>
        function showTab(tab) {
            document.querySelectorAll('.tab').forEach(el => {
                el.style.display = 'none';
            });

            document.getElementById('tab-' + tab).style.display = 'block';
        }

        // default tab

        @if ($errors->has('password') || $errors->has('current_password'))
            showTab('password');
        @elseif ($errors->has('name') || $errors->has('avatar'))
            showTab('edit');
        @else
            showTab('profile');
        @endif
    </script>

@endsection
