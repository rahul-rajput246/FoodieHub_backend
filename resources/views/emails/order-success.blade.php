<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed - FoodieHub</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f3f4f6;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            color: #1f2937;
            -webkit-font-smoothing: antialiased;
        }

        .email-wrapper {
            width: 100%;
            background-color: #f3f4f6;
            padding: 30px 10px;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        /* Header */
        .email-header {
            background: linear-gradient(135deg, #ff7e00 0%, #ea580c 100%);
            padding: 35px 30px;
            text-align: center;
            color: #ffffff;
        }

        .brand-logo {
            font-size: 28px;
            font-weight: 800;
            letter-spacing: -0.5px;
            margin-bottom: 8px;
        }

        .header-icon {
            font-size: 40px;
            margin-bottom: 10px;
            display: inline-block;
        }

        .header-title {
            font-size: 22px;
            font-weight: 700;
            margin: 0;
        }

        .header-subtitle {
            font-size: 14px;
            opacity: 0.9;
            margin-top: 6px;
        }

        /* Body */
        .email-body {
            padding: 30px;
        }

        .greeting {
            font-size: 16px;
            color: #111827;
            margin-bottom: 18px;
        }

        /* Highlights Card */
        .highlight-card {
            background-color: #fff7ed;
            border: 1px solid #fed7aa;
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
        }

        .highlight-item {
            font-size: 13px;
        }

        .highlight-label {
            color: #9a3412;
            font-size: 11px;
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .highlight-value {
            color: #111827;
            font-weight: 700;
            font-size: 15px;
        }

        /* Order Items Table */
        .section-title {
            font-size: 16px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .items-table th {
            text-align: left;
            padding: 10px 12px;
            background: #f9fafb;
            font-size: 12px;
            color: #6b7280;
            text-transform: uppercase;
            font-weight: 600;
            border-bottom: 1px solid #e5e7eb;
        }

        .items-table td {
            padding: 12px;
            font-size: 14px;
            border-bottom: 1px solid #f3f4f6;
            color: #374151;
        }

        .item-name {
            font-weight: 600;
            color: #111827;
        }

        .item-qty {
            color: #6b7280;
            font-size: 13px;
        }

        /* Totals */
        .totals-table {
            width: 100%;
            margin-bottom: 25px;
        }

        .totals-table td {
            padding: 6px 12px;
            font-size: 14px;
        }

        .totals-label {
            text-align: right;
            color: #6b7280;
        }

        .totals-value {
            text-align: right;
            font-weight: 600;
            color: #111827;
            width: 120px;
        }

        .grand-total-row td {
            padding-top: 10px;
            border-top: 2px solid #e5e7eb;
            font-size: 17px;
            font-weight: 700;
            color: #ff7e00 !important;
        }

        /* Address Card */
        .address-box {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 16px 18px;
            margin-bottom: 25px;
        }

        .address-box p {
            margin: 3px 0;
            font-size: 13px;
            color: #4b5563;
        }

        /* Invoice Attachment Notice */
        .invoice-notice {
            background-color: #ecfdf5;
            border: 1px solid #a7f3d0;
            border-radius: 12px;
            padding: 14px 18px;
            margin-bottom: 25px;
            font-size: 13px;
            color: #065f46;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* CTA Button */
        .cta-container {
            text-align: center;
            margin: 25px 0 10px 0;
        }

        .cta-button {
            display: inline-block;
            background: #ff7e00;
            color: #ffffff !important;
            text-decoration: none;
            padding: 14px 28px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 15px;
            box-shadow: 0 4px 12px rgba(255, 126, 0, 0.3);
        }

        /* Footer */
        .email-footer {
            background-color: #f9fafb;
            border-top: 1px solid #e5e7eb;
            padding: 24px 30px;
            text-align: center;
            font-size: 12px;
            color: #9ca3af;
            line-height: 1.5;
        }

        .email-footer a {
            color: #ff7e00;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <div class="email-wrapper">
        <div class="email-container">
            
            <!-- Header -->
            <div class="email-header">
                <div class="brand-logo">FoodieHub</div>
                <div class="header-icon" style="display: inline-flex; align-items: center; justify-content: center; width: 48px; height: 48px; border-radius: 50%; background: rgba(255,255,255,0.2); margin: 8px auto;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </div>
                <h1 class="header-title">Order Confirmed!</h1>
                <p class="header-subtitle">Your food is being freshly prepared in our kitchen</p>
            </div>

            <!-- Body -->
            <div class="email-body">
                
                <p class="greeting">
                    Hi <strong>{{ $order->address->full_name ?? $order->user->name }}</strong>,<br>
                    Thank you for your order! We have received your order and our chefs have started preparing it with love.
                </p>

                <!-- Highlights Box -->
                <table style="width: 100%; margin-bottom: 24px; background: #fff7ed; border: 1px solid #fed7aa; border-radius: 12px; padding: 14px;">
                    <tr>
                        <td style="width: 33%; text-align: center; vertical-align: middle;">
                            <div style="font-size: 11px; color: #9a3412; text-transform: uppercase; font-weight: 600;">Order ID</div>
                            <div style="font-size: 14px; font-weight: 700; color: #111827; margin-top: 2px;">#{{ $order->order_number }}</div>
                        </td>
                        <td style="width: 33%; text-align: center; vertical-align: middle; border-left: 1px solid #fed7aa; border-right: 1px solid #fed7aa;">
                            <div style="font-size: 11px; color: #9a3412; text-transform: uppercase; font-weight: 600;">Estimated Delivery</div>
                            <div style="font-size: 14px; font-weight: 700; color: #ff7e00; margin-top: 2px;">25–30 Mins</div>
                        </td>
                        <td style="width: 33%; text-align: center; vertical-align: middle;">
                            <div style="font-size: 11px; color: #9a3412; text-transform: uppercase; font-weight: 600;">Payment</div>
                            <div style="font-size: 14px; font-weight: 700; color: #111827; margin-top: 2px;">
                                {{ strtoupper($order->payment_method ?? 'COD') }} 
                                <span style="font-size: 11px; color: {{ $order->payment_status == 'paid' ? '#059669' : '#d97706' }};">
                                    ({{ ucfirst($order->payment_status) }})
                                </span>
                            </div>
                        </td>
                    </tr>
                </table>

                <!-- Items Ordered -->
                <div class="section-title">🍱 Items in Your Order</div>
                <table class="items-table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th style="text-align: center; width: 60px;">Qty</th>
                            <th style="text-align: right; width: 90px;">Price</th>
                            <th style="text-align: right; width: 90px;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>
                                <div class="item-name">{{ $item->food_name }}</div>
                            </td>
                            <td style="text-align: center;" class="item-qty">{{ $item->quantity }}</td>
                            <td style="text-align: right;">₹{{ number_format($item->price, 2) }}</td>
                            <td style="text-align: right; font-weight: 600;">₹{{ number_format($item->subtotal, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Order Totals -->
                <table class="totals-table">
                    <tr>
                        <td class="totals-label">Items Subtotal:</td>
                        <td class="totals-value">₹{{ number_format($calculatedSubtotal, 2) }}</td>
                    </tr>
                    <tr>
                        <td class="totals-label">Delivery Fee:</td>
                        <td class="totals-value">
                            @if($calculatedDeliveryFee == 0)
                                <span style="color: #059669; font-weight: bold;">FREE</span>
                            @else
                                ₹{{ number_format($calculatedDeliveryFee, 2) }}
                            @endif
                        </td>
                    </tr>
                    @if($calculatedDiscount > 0)
                    <tr>
                        <td class="totals-label" style="color: #059669;">Special Discount:</td>
                        <td class="totals-value" style="color: #059669;">-₹{{ number_format($calculatedDiscount, 2) }}</td>
                    </tr>
                    @endif
                    <tr class="grand-total-row">
                        <td class="totals-label">Total Amount Paid / Payable:</td>
                        <td class="totals-value">₹{{ number_format($order->total_amount, 2) }}</td>
                    </tr>
                </table>

                <!-- Delivery Address -->
                <div class="section-title">📍 Delivery Address</div>
                <div class="address-box">
                    @if($order->address)
                        <p><strong>{{ $order->address->full_name }}</strong> • {{ $order->address->mobile }}</p>
                        <p>{{ $order->address->address_line }}</p>
                        <p>{{ $order->address->city }}, {{ $order->address->state }} - {{ $order->address->pincode }}</p>
                    @else
                        <p><strong>{{ $order->user->name }}</strong> ({{ $order->user->email }})</p>
                    @endif

                    @if(!empty($order->notes))
                        <p style="margin-top: 8px; color: #92400e;"><strong>Note for Rider:</strong> {{ $order->notes }}</p>
                    @endif
                </div>

                <!-- Invoice Attached Banner -->
                <div class="invoice-notice" style="display: flex; align-items: flex-start; gap: 10px;">
                    <span style="display: inline-flex; align-items: center; margin-top: 2px;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                        </svg>
                    </span>
                    <div>
                        <strong>PDF Invoice Attached:</strong><br>
                        We have attached your official Tax Invoice (PDF) to this email for your records and easy reimbursement.
                    </div>
                </div>

                <!-- CTA -->
                <div class="cta-container">
                    <a href="{{ url('/orders/' . $order->id) }}" class="cta-button">
                        View Order in Portal
                    </a>
                </div>

            </div>

            <!-- Footer -->
            <div class="email-footer">
                <p>Questions about your order? Reach our customer care anytime at <a href="mailto:support@foodiehub.com">support@foodiehub.com</a> or call +91 98765 43210.</p>
                <p>© {{ date('Y') }} FoodieHub Technologies Inc. All rights reserved.</p>
            </div>

        </div>
    </div>

</body>
</html>
