@session('status')
    <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded mb-6 text-center" role="alert">
        {{ session('status') }}
    </div>
@endsession

@extends('layouts.app')

@section('content')
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
            ⁫</div>
        <div id="onDarkMode"
            style="background-color: #4A5568;
                                                    width: 2.5rem;
                                                    height: 2.5rem;
                                                    border-radius: 50%;
                                                    position: absolute;
                                                    right: 0.25rem;
                                                    top: 0.25rem;
                                                    display: none;">
            ⁫</div>
    </div>

    <div class="flex justify-center items-center h-[80vh]">

        <div id="user-div" class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md text-center">
            <!--<div id="profile-pic" class="w-32 h-32 mx-auto mb-4 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 text-2xl font-bold"> {{ strtoupper(substr($user->name, 0, 1)) }} </div>-->

            <p class="text-lg font-semibold text-gray-800">Name: {{ $user->name }}</p>
            <p class="mt-2 text-gray-600">Email: {{ $user->email }}</p>
            <!--<p class="mt-2 text-gray-600">Joined: {{ $user->created_at->format('F j, Y') }}</p>-->
            <a href=""
                class="w-3/4 bg-gray-700 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded mt-4 cursor-pointer inline-block text-center">
                Add Balance
            </a>

            <a href=""
                class="w-3/4 bg-gray-700 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded mt-4 cursor-pointer inline-block text-center">
                View Bids
            </a>

        </div>
    </div>
    <script>
        var isDarkMode = localStorage.getItem('darkMode') === 'true';

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
        }
    </script>
@endsection
