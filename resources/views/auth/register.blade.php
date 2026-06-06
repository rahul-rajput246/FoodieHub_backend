@extends('layouts.auth-custom')

@section('title', 'FoodieHub Register')

@section('content')
    <div class="auth-copy-block">
        <h2 class="auth-form-title">Create your Foodie<span>Hub</span> account</h2>
    </div>

    <form method="POST" action="{{ route('register') }}" class="auth-form-stack">
        @csrf

        <div class="auth-field-grid">
            <div class="auth-field">
                <label for="name" class="auth-label">{{ __('Full Name') }}</label>
                <input
                    id="name"
                    class="auth-input"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Enter your full name"
                >
                @error('name')
                    <p class="auth-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="auth-field">
                <label for="email" class="auth-label">{{ __('Email Address') }}</label>
                <input
                    id="email"
                    class="auth-input"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="username"
                    placeholder="Enter your email"
                >
                @error('email')
                    <p class="auth-error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="auth-field-grid">
            <div class="auth-field">
                <label for="password" class="auth-label">{{ __('Password') }}</label>
                <input
                    id="password"
                    class="auth-input"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="Create password"
                >
                @error('password')
                    <p class="auth-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="auth-field">
                <label for="password_confirmation" class="auth-label">{{ __('Confirm Password') }}</label>
                <input
                    id="password_confirmation"
                    class="auth-input"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Confirm password"
                >
                @error('password_confirmation')
                    <p class="auth-error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <button type="submit" class="auth-submit-button">
            {{ __('Register') }}
        </button>
    </form>

    <div class="auth-switch">
        <span>Already have an account?</span>
        <a href="{{ route('login') }}">Log in here</a>
    </div>
@endsection
