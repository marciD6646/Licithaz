@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div class="mx-auto mt-6 max-w-5xl rounded-xl border border-green-400 bg-green-100 px-4 py-3 text-center text-green-800"
            role="alert">
            {{ session('status') }}
        </div>
    @endif

    <label for="dark-mode-toggle" id="dark-mode-toggle-switch-label"
        style="position: absolute;
                                                    right: 5rem;
                                                    top: 5.5rem;
                                                    font-size: 1rem;
                                                    font-weight: bolder;
                                                    color: rgb(0, 0, 0);">Dark
        mode</label>
    <div id="dark-mode-container" onclick="DarkModeSwitcher()"
        style="background-color: rgb(0, 0, 0);
                                                    width: 7rem;
                                                    height: 3rem;
                                                    border-radius: 1.5rem;
                                                    position: absolute;
                                                    right: 4rem;
                                                    top: 7rem;">
        <div id="offDarkMode"
            style="background-color: #4A5568;
                                                    width: 2.5rem;
                                                    height: 2.5rem;
                                                    border-radius: 50%;
                                                    position: absolute;
                                                    left: 0.25rem;
                                                    top: 0.25rem;">
        </div>
        <div id="onDarkMode"
            style="background-color: #4A5568;
                                                    width: 2.5rem;
                                                    height: 2.5rem;
                                                    border-radius: 50%;
                                                    position: absolute;
                                                    right: 0.25rem;
                                                    top: 0.25rem;
                                                    display: none;">
        </div>
    </div>

    <div class="mx-auto max-w-5xl px-6 py-10">
        <div class="grid gap-6 lg:grid-cols-[320px,1fr] lg:items-start">
            <div id="user-div" class="profile-card w-full rounded-xl bg-white p-8 text-center shadow-lg">
                <p class="text-lg font-semibold text-gray-800">Name: {{ $user->name }}</p>
                <p class="mt-2 text-gray-600">Email: {{ $user->email }}</p>
                <p class="mt-2 text-gray-600">Placed bids: {{ $user->bids->count() }}</p>
                <a href=""
                    class="mt-4 inline-block w-3/4 cursor-pointer rounded bg-gray-700 px-4 py-2 text-center font-bold text-white hover:bg-gray-500">
                    Add Balance
                </a>

                <a href="#my-bids"
                    class="mt-4 inline-block w-3/4 cursor-pointer rounded bg-gray-700 px-4 py-2 text-center font-bold text-white hover:bg-gray-500">
                    View Bids
                </a>
            </div>

            <div id="my-bids" class="profile-card rounded-xl bg-white p-8 shadow-lg">
                <h2 class="text-2xl font-bold text-gray-800">My bids</h2>
                <p class="mt-2 text-sm text-gray-600">Every bid you place appears here with the related product.</p>

                <div class="mt-6 space-y-4">
                    @if ($user->bids->isEmpty())
                        <div class="rounded-xl border border-dashed border-gray-300 px-4 py-6 text-center text-gray-600">
                            You have not placed any bids yet.
                        </div>
                    @else
                        @foreach ($user->bids as $bid)
                            <div class="rounded-xl border border-gray-200 px-4 py-4">
                                <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                                    <div>
                                        <p class="text-sm text-gray-500">Product</p>
                                        <a href="{{ route('products.show', $bid->product) }}"
                                            class="text-lg font-semibold text-gray-800 hover:text-emerald-700">
                                            {{ $bid->product->name }}
                                        </a>
                                        <p class="mt-1 text-sm text-gray-500">Placed at
                                            {{ $bid->created_at->format('Y-m-d H:i') }}</p>
                                    </div>

                                    <div class="text-left md:text-right">
                                        <p class="text-sm text-gray-500">Your bid</p>
                                        <p class="text-lg font-bold text-emerald-700">{{ number_format($bid->amount) }} Ft
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        var isDarkMode = localStorage.getItem('darkMode') === 'true';

        function updateProfileCardTheme() {
            var cards = document.getElementsByClassName('profile-card');

            for (var i = 0; i < cards.length; i++) {
                cards[i].style.backgroundColor = isDarkMode ? '#2D3748' : '#FFFFFF';
                cards[i].style.color = isDarkMode ? '#F7FAFC' : '';
            }
        }

        if (isDarkMode) {
            document.getElementById('offDarkMode').style.display = 'none';
            document.getElementById('onDarkMode').style.display = 'block';
            document.body.classList.remove('bg-amber-100');
            document.body.style.backgroundColor = '#1A202C';
        } else {
            document.getElementById('offDarkMode').style.display = 'block';
            document.getElementById('onDarkMode').style.display = 'none';
            document.body.classList.add('bg-amber-100');
            document.body.style.backgroundColor = '';
        }

        updateProfileCardTheme();

        function DarkModeSwitcher() {
            isDarkMode = !isDarkMode;
            localStorage.setItem('darkMode', isDarkMode);

            if (isDarkMode) {
                document.getElementById('offDarkMode').style.display = 'none';
                document.getElementById('onDarkMode').style.display = 'block';
                document.body.classList.remove('bg-amber-100');
                document.body.style.backgroundColor = '#1A202C';
            } else {
                document.getElementById('offDarkMode').style.display = 'block';
                document.getElementById('onDarkMode').style.display = 'none';
                document.body.classList.add('bg-amber-100');
                document.body.style.backgroundColor = '';
            }

            updateProfileCardTheme();
        }
    </script>
@endsection
