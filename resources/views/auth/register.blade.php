@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center px-6 py-12">
        <div class="w-full max-w-md">
            <div class="rounded-3xl bg-slate-50 p-8 shadow-sm">
                <div class="mb-6">
                    <h1 class="text-3xl font-bold text-slate-900">{{ __('Register') }}</h1>
                    <p class="mt-2 text-sm text-slate-600">Create your account to start bidding.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">
                            {{ __('Name') }}
                        </label>
                        <input id="name" type="text"
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-500 @error('name') border-red-500 @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="mt-2 block text-sm font-medium text-red-600" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">
                            {{ __('Email Address') }}
                        </label>
                        <input id="email" type="email"
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-500 @error('email') border-red-500 @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="mt-2 block text-sm font-medium text-red-600" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">
                            {{ __('Password') }}
                        </label>
                        <input id="password" type="password"
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-500 @error('password') border-red-500 @enderror"
                            name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="mt-2 block text-sm font-medium text-red-600" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div>
                        <label for="password-confirm" class="block text-sm font-semibold text-slate-700 mb-2">
                            {{ __('Confirm Password') }}
                        </label>
                        <input id="password-confirm" type="password"
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-500"
                            name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white hover:bg-slate-800 transition">
                            {{ __('Register') }}
                        </button>
                    </div>

                    @if (Route::has('login'))
                        <div class="mt-6 text-center">
                            <p class="text-sm text-slate-600">
                                Already have an account?
                                <a href="{{ route('login') }}" class="font-semibold text-slate-900 hover:text-slate-700">
                                    Login here
                                </a>
                            </p>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
