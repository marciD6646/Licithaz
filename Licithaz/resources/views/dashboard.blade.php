@extends('layouts.app')

@section('content')
    <div class="dashboard-container">

        <h1 class="dashboard-title">Dashboard</h1>

        <div class="dashboard-buttons">
            <button id="usersBtn" class="dashboard-button users-btn">Users</button>
            <button id="productsBtn" class="dashboard-button products-btn">Products</button>
            <button id="restoreProductsBtn" class="dashboard-button products-btn">Restore Products</button>
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
                        <th>Actions</th> <!-- Buttons column -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->email_verified_at }}</td>
                            <td>{{ $user->is_admin ? 'Admin' : 'User' }}</td>
                            <td class="actions-cell">
                                <a href="{{ route('users.edit', $user) }}" class="btn-edit">
                                    Edit
                                </a>
                                <!-- BAN / UNBAN -->
                                <form action="{{ route('users.toggleBan', $user) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn-ban">
                                        {{ $user->is_banned ? 'Unban' : 'Ban' }}
                                    </button>
                                </form>
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
                        <th>Actions</th> <!-- Buttons column -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category }}</td>
                            <td>{{ number_format($product->starter_bid) }} Ft</td>
                            <td>{{ $product->bid_start_date }}</td>
                            <td>{{ $product->bid_end_date }}</td>
                            <td class="actions-cell">
                                <a href="{{ route('products.edit', $product) }}" class="btn-edit">Edit</a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- RESTORE PRODUCTS TABLE -->
        <div id="restoreProductsSection" class="dashboard-section products-section hidden">
            <h2 class="dashboard-section-title">Deleted Products</h2>
            <table class="dashboard-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Deleted At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($trashedProducts as $trashedProduct)
                        <tr>
                            <td>{{ $trashedProduct->id }}</td>
                            <td>{{ $trashedProduct->name }}</td>
                            <td>{{ $trashedProduct->category }}</td>
                            <td>{{ $trashedProduct->deleted_at }}</td>
                            <td class="actions-cell">
                                <form action="{{ route('products.restore', $trashedProduct->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn-edit">Restore</button>
                                </form>
                                <form action="{{ route('products.forceDelete', $trashedProduct->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">Force Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No deleted products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        const usersBtn = document.getElementById('usersBtn');
        const productsBtn = document.getElementById('productsBtn');
        const restoreProductsBtn = document.getElementById('restoreProductsBtn');
        const usersSection = document.getElementById('usersSection');
        const productsSection = document.getElementById('productsSection');
        const restoreProductsSection = document.getElementById('restoreProductsSection');

        usersBtn.addEventListener('click', () => {
            usersSection.classList.remove('hidden');
            productsSection.classList.add('hidden');
            restoreProductsSection.classList.add('hidden');
        });

        productsBtn.addEventListener('click', () => {
            productsSection.classList.remove('hidden');
            usersSection.classList.add('hidden');
            restoreProductsSection.classList.add('hidden');
        });

        restoreProductsBtn.addEventListener('click', () => {
            restoreProductsSection.classList.remove('hidden');
            usersSection.classList.add('hidden');
            productsSection.classList.add('hidden');
        });
    </script>
@endsection