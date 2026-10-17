<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'FoodieHub Auth')</title>

        <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('./favicon.png') }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .auth-password-wrapper {
                position: relative !important;
                width: 100% !important;
                display: block !important;
            }
            .auth-password-wrapper .auth-input {
                width: 100% !important;
                padding-right: 46px !important;
                box-sizing: border-box !important;
            }
            .auth-password-toggle {
                position: absolute !important;
                right: 12px !important;
                top: 50% !important;
                transform: translateY(-50%) !important;
                background: transparent !important;
                border: none !important;
                padding: 6px !important;
                margin: 0 !important;
                cursor: pointer !important;
                color: #6b7280 !important;
                display: inline-flex !important;
                align-items: center !important;
                justify-content: center !important;
                border-radius: 8px !important;
                z-index: 10 !important;
                line-height: 1 !important;
            }
            .auth-password-toggle:hover {
                color: var(--fh-orange, #ff7e00) !important;
            }
        </style>
    </head>
    <body class="auth-theme">
        <div class="auth-shell">

            <div class="auth-page">
                <section class="auth-brand-panel">
                    <a href="{{ url('/') }}" class="auth-brand-link">Foodie<span>Hub</span></a>

                    <div class="auth-brand-copy">
                        <p class="auth-eyebrow">Fresh meals. Fast access.</p>
                        <h1>FoodieHub keeps every craving one click away.</h1>
                        <p>
                            Sign in to continue your food journey, manage your profile, and move between the customer side
                            and the admin side with the same account system.
                        </p>
                    </div>

                    <div class="auth-feature-grid">
                        <div class="auth-feature-card">
                            <strong>Fast checkout</strong>
                            <span>Pick favorites and get back to ordering quickly.</span>
                        </div>

                        <div class="auth-feature-card">
                            <strong>FoodieHub Access</strong>
                            <span>One clean auth flow for users and admins.</span>
                        </div>
                    </div>

                    <div class="auth-brand-footer">
                        <span class="auth-dot"></span>
                        Crafted with the FoodieHub orange and charcoal theme
                    </div>
                </section>

                <main class="auth-form-panel">
                    <div class="auth-form-card">
                        @yield('content')
                    </div>
                </main>
            </div>
        </div>
        <script>
            function togglePasswordVisibility(inputId, btn) {
                const input = document.getElementById(inputId);
                if (!input) return;
                const isPassword = input.type === 'password';
                input.type = isPassword ? 'text' : 'password';

                const eyeOpen = btn.querySelector('.eye-open');
                const eyeClosed = btn.querySelector('.eye-closed');
                if (eyeOpen && eyeClosed) {
                    eyeOpen.style.display = isPassword ? 'none' : 'block';
                    eyeClosed.style.display = isPassword ? 'block' : 'none';
                }
            }
        </script>
    </body>
</html>
