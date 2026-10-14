<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $replySubject }}</title>
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
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        }
        .header {
            background: linear-gradient(135deg, #ff7e00 0%, #ea580c 100%);
            padding: 30px;
            text-align: center;
            color: #ffffff;
        }
        .header h1 {
            margin: 0;
            font-size: 26px;
            font-weight: 800;
            letter-spacing: -0.5px;
        }
        .header p {
            margin: 6px 0 0 0;
            font-size: 14px;
            opacity: 0.9;
        }
        .body {
            padding: 32px 30px;
        }
        .greeting {
            font-size: 18px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 16px;
        }
        .reply-box {
            background: #f9fafb;
            border-left: 4px solid #ff7e00;
            padding: 18px 20px;
            border-radius: 8px;
            font-size: 15px;
            line-height: 1.7;
            color: #1f2937;
            margin-bottom: 24px;
            white-space: pre-line;
        }
        .original-quote {
            background: #ffffff;
            border: 1px dashed #e5e7eb;
            border-radius: 8px;
            padding: 16px;
            margin-top: 24px;
        }
        .original-quote-title {
            font-size: 12px;
            font-weight: 700;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }
        .original-quote-content {
            font-size: 13px;
            color: #4b5563;
            line-height: 1.6;
            white-space: pre-line;
        }
        .footer {
            background: #111827;
            color: #9ca3af;
            text-align: center;
            padding: 20px 30px;
            font-size: 12px;
            line-height: 1.6;
        }
        .footer a {
            color: #ff7e00;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>FoodieHub</h1>
            <p>Customer Support & Inquiries</p>
        </div>

        <div class="body">
            <div class="greeting">Hello {{ $messageModel->name }},</div>

            <p style="font-size: 14px; color: #4b5563; margin-top: 0; margin-bottom: 16px;">
                Thank you for contacting FoodieHub. Here is the response to your message:
            </p>

            <div class="reply-box">
                {{ $replyContent }}
            </div>

            <p style="font-size: 14px; color: #6b7280; margin-bottom: 0;">
                If you have further questions or need immediate assistance, please feel free to reply directly to this email or visit our website.
            </p>

            <div class="original-quote">
                <div class="original-quote-title">Your Original Message (Received {{ $messageModel->created_at->format('d M Y, h:i A') }}):</div>
                <div class="original-quote-content">"{{ $messageModel->message }}"</div>
            </div>
        </div>

        <div class="footer">
            <p style="margin: 0 0 6px 0;">Warm regards,<br><strong>The FoodieHub Team</strong></p>
            <p style="margin: 0;">Fresh & Delicious Meals Delivered To Your Doorstep</p>
        </div>
    </div>
</body>
</html>
