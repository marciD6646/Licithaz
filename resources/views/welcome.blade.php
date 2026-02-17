@extends('layouts.app')

@section('content')
    <main class="mx-auto max-w-6xl space-y-12 px-6 py-12">
        <section class="grid items-center gap-10 rounded-3xl bg-slate-50 p-8 shadow-sm md:grid-cols-2">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Welcome</p>
                <h1 class="mt-3 text-4xl font-extrabold tracking-tight text-slate-900 md:text-5xl">
                    Bid smarter at AuctionHouse
                </h1>
                <p class="mt-4 text-lg text-slate-600">
                    Discover live listings, track your bids, and win items with confidence.
                </p>
                <div class="mt-6 flex flex-wrap gap-3">
                    <a class="rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white hover:bg-slate-800"
                        href="{{ route('products.index') }}">
                        Browse products
                    </a>

                </div>
            </div>
            <div class="relative">
                <div class="absolute -inset-3 rounded-3xl bg-linear-to-tr from-amber-200 via-orange-100 to-rose-200">
                </div>
                <img class="relative w-full rounded-2xl object-cover shadow-lg" src="" alt="A picture about auctions" />
            </div>
        </section>

        <section class="grid items-center gap-10 rounded-3xl bg-slate-900 p-8 text-white shadow-sm md:grid-cols-2">
            <div class="order-2 md:order-1 flex flex-col gap-6">
                <!--<img class="w-full rounded-2xl object-cover shadow-lg" src="" alt="Team collaborating on a project" />-->
                <div class="flex items-center gap-4">
                    <img class="w-2/7 rounded-2xl object-cover shadow-lg" src="{{ asset('images/deak.png') }}"
                        alt="Deákvári Marcell" />
                    <p class="text-lg font-semibold"> ■► Deákvári Marcell</p>
                </div>
                <div class="flex items-center gap-4">
                    <img class="w-2/7 rounded-2xl object-cover shadow-lg" src="{{ asset('images/szok.png') }}"
                        alt="Szokolay Márk" />
                    <p class="text-lg font-semibold"> ■► Szokolay Márk</p>
                </div>
                <div class="flex items-center gap-4">
                    <img class="w-2/7 rounded-2xl object-cover shadow-lg" src="{{ asset('images/vik.png') }}"
                        alt="Csermák Viktor" />
                    <p class="text-lg font-semibold"> ■► Csermák Viktor</p>
                </div>

            </div>
            </div>
            <div class="order-1 md:order-2">
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-amber-200">What is this about</p>
                <h2 class="mt-3 text-3xl font-bold md:text-4xl">
                    A simple platform for winning bids
                </h2>
                <p class="mt-4 text-lg text-slate-200">
                    You can find everything from cars to property, electronics to collectibles. Our user-friendly interface
                    makes it easy to search, bid, and win your desired items.
                </p>
                <p class="mt-4 text-sm text-slate-300">
                    Use the navigation to explore listings to get started.
                </p>
            </div>
        </section>
    </main>
@endsection