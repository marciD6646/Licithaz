@session('status')
    <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded mb-6 text-center" role="alert">
        {{ session('status') }}
    </div>
@endsession

@extends('layouts.app')

@section('content')
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

@endsection