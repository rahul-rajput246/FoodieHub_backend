<script>
fetch("http://localhost:8000/sanctum/csrf-cookie", {
    credentials: "include"
});
</script>

@extends('layouts.auth-custom')

@section('title', 'FoodieHub Login')

@section('content')
    <div class="auth-copy-block">
        <p class="auth-form-kicker">Login</p>
        <h2 class="auth-form-title">Welcome back to FoodieHub</h2>
        <p class="auth-form-subtitle">
            Sign in to continue your orders, save favorites, or access the admin area with your assigned role.
        </p>
    </div>

    @if (session('status'))
        <div class="auth-alert auth-alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="auth-form-stack">
        @csrf

        <div class="auth-field">
            <label for="email" class="auth-label">{{ __('Email Address') }}</label>
            <input
                id="email"
                class="auth-input"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
                placeholder="Enter your email"
            >
            @error('email')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="auth-field">
            <label for="password" class="auth-label">{{ __('Password') }}</label>
            <input
                id="password"
                class="auth-input"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="Enter your password"
            >
            @error('password')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="auth-row">
            <label for="remember_me" class="auth-checkbox">
                <input id="remember_me" type="checkbox" name="remember">
                <span>{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="auth-inline-link" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <button type="submit" class="auth-submit-button">
            {{ __('Log in') }}
        </button>
    </form>

    <div class="auth-switch">
        <span>New to FoodieHub?</span>
        <a href="{{ route('register') }}">Create an account</a>
    </div>
@endsection




