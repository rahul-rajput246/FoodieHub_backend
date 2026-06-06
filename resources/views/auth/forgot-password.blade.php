@extends('layouts.auth-custom')

@section('title', 'Forgot Password')

@section('content')
    <div class="auth-copy-block">
        <p class="auth-form-kicker">Password Recovery</p>
        <h2 class="auth-form-title">Forgot your password?</h2>
        <p class="auth-form-subtitle">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </p>
    </div>

    @if (session('status'))
        <div class="auth-alert auth-alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="auth-form-stack">
        @csrf

        <div class="auth-field">
            <label for="email" class="auth-label">Email Address</label>
            <input
                id="email"
                class="auth-input"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                placeholder="Enter your email"
            >
            @error('email')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="auth-submit-button">
            Email Password Reset Link
        </button>
    </form>

    <div class="auth-switch">
        <span>Remember your password?</span>
        <a href="{{ route('login') }}">Back to login</a>
    </div>
@endsection
