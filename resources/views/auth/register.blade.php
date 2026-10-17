@extends('layouts.auth-custom')

@section('title', 'FoodieHub Register')

@section('content')
    <div class="auth-copy-block">
        <h2 class="auth-form-title">Create your Foodie<span>Hub</span> account</h2>
    </div>

    <form method="POST" action="{{ route('register') }}" class="auth-form-stack">
        @csrf
        @if(request('redirect'))
            <input type="hidden" name="redirect" value="{{ request('redirect') }}">
        @endif

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
                <div class="auth-password-wrapper" style="position: relative; width: 100%; display: flex; align-items: center;">
                    <input
                        id="password"
                        class="auth-input"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        placeholder="Create password"
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

            <div class="auth-field">
                <label for="password_confirmation" class="auth-label">{{ __('Confirm Password') }}</label>
                <div class="auth-password-wrapper" style="position: relative; width: 100%; display: flex; align-items: center;">
                    <input
                        id="password_confirmation"
                        class="auth-input"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="Confirm password"
                        style="width: 100%; padding-right: 44px; box-sizing: border-box;"
                    >
                    <button
                        type="button"
                        class="auth-password-toggle"
                        onclick="togglePasswordVisibility('password_confirmation', this)"
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
        <a href="{{ route('login') }}{{ request('redirect') ? '?redirect=' . urlencode(request('redirect')) : '' }}">Log in here</a>
    </div>
@endsection
