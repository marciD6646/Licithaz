@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-6xl px-6 py-10">
        @if (session('status'))
            <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-800">
                {{ session('status') }}
            </div>
        @endif

        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900">{{ $product->name }}</h1>
            <p class="mt-2 text-slate-600">{{ $product->category }}</p>
            <div class="mt-4 flex flex-wrap gap-3 text-sm font-medium text-slate-600">
                <span class="rounded-full bg-slate-100 px-3 py-1">Current highest bid:
                    {{ number_format($currentHighestBid) }} Ft</span>
                <span class="rounded-full bg-slate-100 px-3 py-1">Auction ends:
                    {{ $product->bid_end_date->format('Y-m-d') }}</span>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <img src="{{ asset($product->image_url) }}"
                        onerror="this.onerror=null;this.src='{{ asset('images/1.jpg') }}';">
                </div>
                <div class="flex flex-col gap-4">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">Description</h2>
                        <p class="mt-2 text-sm text-slate-600">{{ $product->extended_description }}</p>
                    </div>
                    <div class="flex flex-wrap gap-3 text-xs font-semibold">
                        <span class="self-start rounded-full bg-emerald-50 px-3 py-1 text-emerald-700">
                            Starting bid: {{ number_format($product->starter_bid) }} Ft
                        </span>
                        <span class="self-start rounded-full bg-sky-50 px-3 py-1 text-sky-700">
                            Next minimum bid: {{ number_format($minimumBid) }} Ft
                        </span>
                    </div>
                    <div>
                        @guest
                            <p>Please log in to place a bid.</p>
                        @else
                            @if ($product->isBiddingOpen())
                                <form action="{{ route('products.bids.store', $product) }}" method="POST"
                                    class="flex flex-col gap-3 md:flex-row md:items-start">
                                    @csrf

                                    <button type="submit"
                                        class="rounded-full bg-emerald-500 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-600">
                                        Place Bid
                                    </button>

                                    <div class="relative w-full md:w-40">
                                        <input type="number" id="amount" name="amount" min="{{ $minimumBid }}"
                                            step="1000" value="{{ old('amount', $minimumBid) }}"
                                            class="w-full rounded-lg border px-3 py-2 pr-10 {{ $errors->has('amount') ? 'border-red-500' : 'border-slate-300' }}">
                                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-500">
                                            Ft
                                        </span>
                                    </div>

                                    <p class="flex items-center text-sm text-slate-500">
                                        Minimum: {{ number_format($minimumBid) }} Ft
                                    </p>
                                </form>

                                @error('amount')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            @else
                                <p class="rounded-xl bg-amber-50 px-4 py-3 text-sm text-amber-800">
                                    Bidding is closed for this product.
                                </p>
                            @endif
                        @endguest
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-semibold text-slate-900">Recent bids</h2>

            @if ($product->bids->isEmpty())
                <p class="mt-3 text-sm text-slate-600">No bids have been placed yet.</p>
            @else
                <div class="mt-4 space-y-3">
                    @foreach ($product->bids as $bid)
                        <div class="flex items-center justify-between rounded-xl border border-slate-200 px-4 py-3">
                            <div>
                                <p class="font-semibold text-slate-900">{{ $bid->user->name }}</p>
                                <p class="text-sm text-slate-500">{{ $bid->created_at->format('Y-m-d H:i') }}</p>
                            </div>

                            <span class="text-sm font-semibold text-emerald-700">{{ number_format($bid->amount) }}
                                Ft</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
