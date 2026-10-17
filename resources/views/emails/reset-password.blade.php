<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your FoodieHub Password</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 24px;
            color: #1f2937;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
        }
        .header {
            background: linear-gradient(135deg, #ff7e00 0%, #ea580c 100%);
            padding: 34px 30px;
            text-align: center;
            color: #ffffff;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 800;
            letter-spacing: -0.5px;
        }
        .header p {
            margin: 6px 0 0 0;
            font-size: 14px;
            opacity: 0.95;
            font-weight: 500;
        }
        .body {
            padding: 36px 32px;
        }
        .greeting {
            font-size: 19px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 16px;
        }
        .intro-text {
            font-size: 15px;
            line-height: 1.7;
            color: #4b5563;
            margin-bottom: 28px;
        }
        .btn-wrapper {
            text-align: center;
            margin: 32px 0;
        }
        .btn-reset {
            display: inline-block;
            background: linear-gradient(135deg, #ff7e00 0%, #ea580c 100%);
            color: #ffffff !important;
            text-decoration: none;
            padding: 14px 36px;
            border-radius: 9999px;
            font-weight: 700;
            font-size: 16px;
            letter-spacing: 0.2px;
            box-shadow: 0 4px 14px rgba(255, 126, 0, 0.35);
            transition: transform 0.2s ease;
        }
        .info-card {
            background: #fff8f1;
            border-left: 4px solid #ff7e00;
            padding: 16px 20px;
            border-radius: 10px;
            font-size: 14px;
            color: #9a3412;
            line-height: 1.6;
            margin-bottom: 24px;
        }
        .security-note {
            font-size: 13px;
            color: #6b7280;
            line-height: 1.6;
            border-top: 1px solid #e5e7eb;
            padding-top: 20px;
            margin-top: 24px;
        }
        .fallback-link {
            font-size: 12px;
            color: #9ca3af;
            word-break: break-all;
            margin-top: 14px;
            line-height: 1.5;
        }
        .fallback-link a {
            color: #ff7e00;
            text-decoration: underline;
        }
        .footer {
            background: #111827;
            color: #9ca3af;
            text-align: center;
            padding: 24px 30px;
            font-size: 12px;
            line-height: 1.7;
        }
        .footer strong {
            color: #f3f4f6;
            font-size: 13px;
        }
        .footer p {
            margin: 4px 0 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>FoodieHub</h1>
            <p>Taste the Best, Delivered Fast</p>
        </div>

        <!-- Body -->
        <div class="body">
            <div class="greeting">Hello {{ $user->name ?? 'Foodie' }},</div>

            <p class="intro-text">
                We received a request to reset the password for your FoodieHub account. Click the button below to choose a new password and get back to your delicious cravings:
            </p>

            <div class="btn-wrapper">
                <a href="{{ $resetUrl }}" class="btn-reset" target="_blank">Reset Password</a>
            </div>

            <div class="info-card">
                <strong>⏳ Time sensitive:</strong> This password reset link will expire in <strong>{{ $expireMinutes ?? 60 }} minutes</strong> for your account security.
            </div>

            <div class="security-note">
                <p style="margin: 0;">
                    If you did not request a password reset, you can safely ignore this email — your account and saved orders remain completely secure.
                </p>

                <div class="fallback-link">
                    If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:<br>
                    <a href="{{ $resetUrl }}" target="_blank">{{ $resetUrl }}</a>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <strong>FoodieHub Inc.</strong>
            <p>Your favorite meals delivered fresh to your doorstep.</p>
            <p style="color: #6b7280; font-size: 11px; margin-top: 8px;">
                © {{ date('Y') }} FoodieHub. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
