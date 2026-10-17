@extends('layouts.auth-custom')

@section('title', 'FoodieHub Login')

@section('content')
    <script>
    fetch("http://localhost:8000/sanctum/csrf-cookie", {
        credentials: "include"
    });
    </script>

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
        @if(request('redirect'))
            <input type="hidden" name="redirect" value="{{ request('redirect') }}">
        @endif

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
            <div class="auth-password-wrapper" style="position: relative; width: 100%; display: flex; align-items: center;">
                <input
                    id="password"
                    class="auth-input"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="Enter your password"
                    style="width: 100%; padding-right: 44px; box-sizing: border-box;"
                >
                <button
                    type="button"
                    class="auth-password-toggle"
                    onclick="togglePasswordVisibility('password', this)"
                    aria-label="Toggle password visibility"
                    title="Show/Hide password"
                    style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: transparent; border: none; padding: 6px; margin: 0; cursor: pointer; color: #6b7280; display: inline-flex; align-items: center; justify-content: center; z-index: 10;"
                >
                    <svg class="eye-open" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                    <svg class="eye-closed" style="display: none;" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                        <line x1="1" y1="1" x2="23" y2="23"></line>
                    </svg>
                </button>
            </div>
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
        <a href="{{ route('register') }}{{ request('redirect') ? '?redirect=' . urlencode(request('redirect')) : '' }}">Create an account</a>
    </div>
@endsection




