@extends('layouts.auth-custom')

@section('title', 'Reset Password')

@section('content')
    <div class="auth-copy-block">
        <p class="auth-form-kicker">Set New Password</p>
        <h2 class="auth-form-title">Create a new password</h2>
        <p class="auth-form-subtitle">
            Choose a strong password for your FoodieHub account.
        </p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="auth-form-stack">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="auth-field">
            <label for="email" class="auth-label">Email Address</label>
            <input
                id="email"
                class="auth-input"
                type="email"
                name="email"
                value="{{ old('email', $request->email) }}"
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
            <label for="password" class="auth-label">New Password</label>
            <input
                id="password"
                class="auth-input"
                type="password"
                name="password"
                required
                autocomplete="new-password"
                placeholder="Enter new password"
            >
            @error('password')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="auth-field">
            <label for="password_confirmation" class="auth-label">Confirm Password</label>
            <input
                id="password_confirmation"
                class="auth-input"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="Confirm new password"
            >
            @error('password_confirmation')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="auth-submit-button">
            Reset Password
        </button>
    </form>
@endsection
