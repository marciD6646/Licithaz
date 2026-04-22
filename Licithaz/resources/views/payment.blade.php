@extends('layouts.app')

@section('title', 'Payment')

@section('content')
    <div class="Payment-container">

        <h1 class="Payment-title">Payment</h1>

        <div class="Payment-summary">
            <h2>{{ $product->name }}</h2>
            <p>Winning bid: {{ number_format($amount) }} Ft</p>
        </div>

        <div class="Payment-details">
            <h2>Payment Details</h2>

            <form method="POST" action="{{ route('products.pay', $product) }}">
                @csrf

                <label>Name on Card:</label>
                <input type="text" name="card_name" required>

                <label>Card Number:</label>
                <input type="text" name="card_number" required>

                <label>Expiry Date:</label>
                <input type="text" name="expiry_date" required>

                <label>CVV:</label>
                <input type="text" name="cvv" required>

                <button type="submit" class="Payment-button">
                    Pay Now
                </button>
            </form>
        </div>

    </div>
@endsection