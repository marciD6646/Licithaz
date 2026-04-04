@extends('layouts.app')

@section('content')
    @auth
        @if (Auth::user()->is_banned)
            <div class="banned-alert p-6 bg-red-100 text-red-800 rounded-md text-center">
                Your account has been banned.
            </div>
        @else
            <div class="dashboard-container">

                <h1 class="dashboard-title">Dashboard</h1>

                <div class="dashboard-buttons">
                    <button id="usersBtn" class="dashboard-button users-btn">Users</button>
                    <button id="productsBtn" class="dashboard-button products-btn">Products</button>
                </div>

                <!-- USERS TABLE -->
                <div id="usersSection" class="dashboard-section users-section">
                    <h2 class="dashboard-section-title">Users</h2>
                    <table class="dashboard-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Verified At</th>
                                <th>Rank</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->email_verified_at }}</td>
                                    <td>{{ $user->is_admin ? 'Admin' : 'User' }}</td>
                                    <td class="actions-cell">
                                        <button class="btn-edit">Edit</button>

                                        <!-- Ban/Unban -->
                                        @if(!$user->is_admin || auth()->user()->id !== $user->id)
                                            <form action="{{ route('users.toggleBan', $user) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="btn-banUnban {{ $user->is_banned ? 'bg-green-500 hover:bg-green-600' : 'bg-red-500 hover:bg-red-600' }} text-white">
                                                    {{ $user->is_banned ? 'Unban' : 'Ban' }}
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- PRODUCTS TABLE -->
                <div id="productsSection" class="dashboard-section products-section hidden">
                    <h2 class="dashboard-section-title">Products</h2>
                    <table class="dashboard-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Starter Bid</th>
                                <th>Bid Start Date</th>
                                <th>Bid End Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category }}</td>
                                    <td>${{ number_format($product->starter_bid) }}</td>
                                    <td>{{ $product->bid_start_date }}</td>
                                    <td>{{ $product->bid_end_date }}</td>
                                    <td class="actions-cell">
                                        <a href="{{ route('products.edit', $product) }}" class="btn-edit">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

            <script>
                const usersBtn = document.getElementById('usersBtn');
                const productsBtn = document.getElementById('productsBtn');
                const usersSection = document.getElementById('usersSection');
                const productsSection = document.getElementById('productsSection');

                usersBtn.addEventListener('click', () => {
                    usersSection.classList.remove('hidden');
                    productsSection.classList.add('hidden');
                });

                productsBtn.addEventListener('click', () => {
                    productsSection.classList.remove('hidden');
                    usersSection.classList.add('hidden');
                });
            </script>
        @endif
    @endauth
@endsection