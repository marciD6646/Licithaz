@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center px-6 py-12">
        <div class="w-full max-w-md">
            <div class="rounded-3xl bg-slate-50 p-8 shadow-sm">
                <div class="mb-6">
                    <h1 class="text-3xl font-bold text-slate-900">{{ __('Login') }}</h1>
                    <p class="mt-2 text-sm text-slate-600">Welcome back! Please login to your account.</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">
                            {{ __('Email Address') }}
                        </label>
                        <input id="email" type="email"
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-500 @error('email') border-red-500 @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                            name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="mt-2 block text-sm font-medium text-red-600" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <input class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-500" type="checkbox"
                            name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="ml-2 text-sm text-slate-700" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>

                    <div class="flex flex-col gap-3">
                        <button type="submit"
                            class="w-full rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white hover:bg-slate-800 transition">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="text-center text-sm text-slate-600 hover:text-slate-900"
                                href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>

                    @if (Route::has('register'))
                        <div class="mt-6 text-center">
                            <p class="text-sm text-slate-600">
                                Don't have an account?
                                <a href="{{ route('register') }}"
                                    class="font-semibold text-slate-900 hover:text-slate-700">
                                    Register here
                                </a>
                            </p>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
