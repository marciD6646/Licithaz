@extends('layouts.app')

@section('content')
    <div class="RegisterPage">
        <div class="RegisterCard">
            <div class="RegisterTitleContainer">
                <h1 class="RegisterTitle">{{ __('Register') }}</h1>
                <p class="RegisterTitleDescription">Create your account to start bidding.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="RegisterForm">
                @csrf

                <div>
                    <label for="name" class="RegisterName">
                        {{ __('Name') }}
                    </label>
                    <input id="name" type="text" class="RegisterNameInput @error('name') border-red-500 @enderror"
                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="RegisterNameAlert" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div>
                    <label for="email" class="RegisterEmail">
                        {{ __('Email Address') }}
                    </label>
                    <input id="email" type="email" class="RegisterEmailInput @error('email') border-red-500 @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                        <span class="RegisterEmailAlert" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div>
                    <label for="password" class="RegisterPassword">
                        {{ __('Password') }}
                    </label>
                    <input id="password" type="password"
                        class="RegisterPasswordInput @error('password') border-red-500 @enderror" name="password" required
                        autocomplete="new-password">

                    @error('password')
                        <span class="RegisterPasswordAlert" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div>
                    <label for="password-confirm" class="RegisterPasswordConfirm">
                        {{ __('Confirm Password') }}
                    </label>
                    <input id="password-confirm" type="password" class="RegisterPasswordConfirmInput"
                        name="password_confirmation" required autocomplete="new-password">
                </div>

                <div>
                    <button type="submit" class="RegisterSubmit">
                        {{ __('Register') }}
                    </button>
                </div>

                @if (Route::has('login'))
                    <div class="RegisterLoginLink">
                        <p class="RegisterLoginLinkText">
                            Already have an account?
                            <a href="{{ route('login') }}" class="LoginButton">
                                Login here
                            </a>
                        </p>
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection