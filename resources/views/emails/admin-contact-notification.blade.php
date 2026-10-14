<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Customer Inquiry - FoodieHub</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f3f4f6;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            color: #1f2937;
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        }

        .header {
            background: linear-gradient(135deg, #ff7e00 0%, #ea580c 100%);
            color: #ffffff;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            margin: 0 0 6px 0;
            font-size: 22px;
            font-weight: 800;
        }

        .content {
            padding: 30px;
        }

        .info-card {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 18px 20px;
            margin-bottom: 22px;
        }

        .info-row {
            margin-bottom: 10px;
            font-size: 14px;
        }

        .info-row strong {
            color: #111827;
            display: inline-block;
            width: 90px;
        }

        .info-row a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 500;
        }

        .message-box {
            background: #fff7ed;
            border: 1px solid #fed7aa;
            border-radius: 12px;
            padding: 18px 20px;
            margin-bottom: 25px;
        }

        .message-box h3 {
            margin: 0 0 10px 0;
            font-size: 13px;
            text-transform: uppercase;
            color: #9a3412;
            letter-spacing: 0.5px;
        }

        .message-box p {
            margin: 0;
            font-size: 14px;
            line-height: 1.6;
            color: #374151;
            white-space: pre-line;
        }

        .actions {
            text-align: center;
            margin: 20px 0 10px 0;
        }

        .btn {
            display: inline-block;
            background: #ff7e00;
            color: #ffffff !important;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
        }

        .footer {
            border-top: 1px solid #e5e7eb;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #9ca3af;
        }
    </style>
</head>
<body>

    <div class="container">
        
        <div class="header">
            <h1>📩 New Customer Inquiry</h1>
            <p style="margin: 0; opacity: 0.9; font-size: 13px;">Received via FoodieHub Contact Us Form</p>
        </div>

        <div class="content">
            
            <div class="info-card">
                <div class="info-row">
                    <strong>Name:</strong> {{ $contactMessage->name }}
                </div>
                <div class="info-row">
                    <strong>Email:</strong> <a href="mailto:{{ $contactMessage->email }}">{{ $contactMessage->email }}</a>
                </div>
                @if(!empty($contactMessage->phone))
                <div class="info-row">
                    <strong>Phone:</strong> <a href="tel:{{ $contactMessage->phone }}">{{ $contactMessage->phone }}</a>
                </div>
                @endif
                <div class="info-row" style="margin-bottom: 0;">
                    <strong>Date & Time:</strong> {{ $contactMessage->created_at->format('d M Y, h:i A') }}
                </div>
            </div>

            <div class="message-box">
                <h3>Customer Message</h3>
                <p>{{ $contactMessage->message }}</p>
            </div>

            <div class="actions">
                <a href="mailto:{{ $contactMessage->email }}?subject=Re:%20Inquiry%20at%20FoodieHub" class="btn">
                    Reply to {{ $contactMessage->name }}
                </a>
            </div>

        </div>

        <div class="footer">
            FoodieHub Admin Notification System • SCO #42, Sector 25D, Chandigarh
        </div>

    </div>

</body>
</html>
