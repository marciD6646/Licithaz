@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">

        <h1 class="text-3xl font-bold mb-6 text-center">Dashboard</h1>

        <div class="dashboard-buttons flex flex-col sm:flex-row justify-center items-center gap-4 font-bold text-2xl mb-6">
            <button id="usersBtn"
                class="p-6 bg-blue-500 text-white rounded shadow w-full sm:w-1/3 text-2xl transition-colors hover:bg-blue-600">
                Users
            </button>
            <button id="productsBtn"
                class="p-6 bg-green-500 text-white rounded shadow w-full sm:w-1/3 text-2xl transition-colors hover:bg-green-600">
                Products
            </button>
        </div>

        <div id="usersSection" class="p-4 bg-gray-100 rounded shadow mb-4">
            <h2 class="text-2xl font-bold mb-4">Users</h2>
            <table class="min-w-full bg-white shadow rounded">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-2 border">ID</th>
                        <th class="p-2 border">Name</th>
                        <th class="p-2 border">Email</th>
                        <th class="p-2 border">Verified At</th>
                        <th class="p-2 border">Rank</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="p-2 border">{{ $user->id }}</td>
                            <td class="p-2 border">{{ $user->name }}</td>
                            <td class="p-2 border">{{ $user->email }}</td>
                            <td class="p-2 border">{{ $user->email_verified_at }}</td>
                            <td class="p-2 border">{{ $user->is_admin ? 'Admin' : 'User' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div id="productsSection" class="p-4 bg-gray-100 rounded shadow mb-4" style="display: none;">
            <h2 class="text-2xl font-bold mb-4">Products</h2>
            <table class="min-w-full bg-white shadow rounded">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-2 border">ID</th>
                        <th class="p-2 border">Name</th>
                        <th class="p-2 border">Category</th>
                        <th class="p-2 border">Starter Bid</th>
                        <th class="p-2 border">bid start date</th>
                        <th class="p-2 border">bid end date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td class="p-2 border">{{ $product->id }}</td>
                            <td class="p-2 border">{{ $product->name }}</td>
                            <td class="p-2 border">{{ $product->category }}</td>
                            <td class="p-2 border">${{ number_format($product->starter_bid) }}</td>
                            <td class="p-2 border">{{ $product->bid_start_date }}</td>
                            <td class="p-2 border">{{ $product->bid_end_date }}</td>
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
            usersSection.style.display = 'block';
            productsSection.style.display = 'none';
        });

        productsBtn.addEventListener('click', () => {
            productsSection.style.display = 'block';
            usersSection.style.display = 'none';
        });
    </script>
@endsection