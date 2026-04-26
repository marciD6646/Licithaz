@extends('layouts.app')

@section('title', 'My Payments')

@section('content')
    <div class="dashboard-container">
        <h1 class="dashboard-title">My Payments</h1>

        <table class="dashboard-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Paid At</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $payment)
                    <tr>
                        <td>{{ $payment->id }}</td>
                        <td>{{ $payment->product?->name ?? 'Deleted product' }}</td>
                        <td>{{ number_format((int) $payment->amount) }} Ft</td>
                        <td>{{ $payment->is_paid ? 'Paid' : 'Pending' }}</td>
                        <td>{{ optional($payment->created_at)->format('Y-m-d H:i') }}</td>
                        <td>
                            @if ($payment->product)
                                <a class="btn-edit" href="{{ route('products.show', $payment->product) }}">View</a>
                            @else
                                <span>Unavailable</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">You do not have any payments yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $payments->links() }}
        </div>
    </div>
@endsection
