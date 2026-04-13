@extends('layouts.app')

@section('content')
    <div class="login-wrapper">
        <div class="login-card">

            <div class="mb-6">
                <h1 class="login-title">{{ __('Login') }}</h1>
                <p class="login-subtitle">Welcome back! Please login to your account.</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="input-label">
                        {{ __('Email Address') }}
                    </label>

                    <input id="email" type="email" class="input @error('email') input-error @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="error-text">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div>
                    <label for="password" class="input-label">
                        {{ __('Password') }}
                    </label>

                    <input id="password" type="password" class="input @error('password') input-error @enderror"
                        name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="error-text">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="checkbox-row">
                    <input class="checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="checkbox-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>

                <div class="button-group">
                    <button type="submit" class="login-button">
                        {{ __('Login') }}
                    </button>

                    @if (Route::has('password.request'))
                        <a class="forgot-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>

                @if (Route::has('register'))
                    <div class="register-box">
                        <p class="register-text">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="register-link">
                                Register here
                            </a>
                        </p>
                    </div>
                @endif

            </form>

        </div>
    </div>
@endsection