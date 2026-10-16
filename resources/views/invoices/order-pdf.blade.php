<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice - {{ $order->order_number }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 12px;
            color: #1f2937;
            background: #ffffff;
            line-height: 1.5;
            padding: 30px;
        }

        .header-table {
            width: 100%;
            margin-bottom: 25px;
            border-bottom: 2px solid #ff7e00;
            padding-bottom: 15px;
        }

        .brand-title {
            font-size: 26px;
            font-weight: bold;
            color: #ff7e00;
            letter-spacing: -0.5px;
        }

        .brand-subtitle {
            font-size: 11px;
            color: #6b7280;
            margin-top: 2px;
        }

        .invoice-title {
            font-size: 22px;
            font-weight: bold;
            color: #111827;
            text-align: right;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .invoice-meta {
            text-align: right;
            font-size: 11px;
            color: #4b5563;
            margin-top: 4px;
        }

        .info-table {
            width: 100%;
            margin-bottom: 22px;
        }

        .info-col {
            width: 50%;
            vertical-align: top;
        }

        .info-card {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 12px 14px;
            margin-right: 8px;
        }

        .info-col:last-child .info-card {
            margin-right: 0;
            margin-left: 8px;
        }

        .info-card-title {
            font-size: 12px;
            font-weight: bold;
            color: #111827;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 6px;
            margin-bottom: 8px;
        }

        .info-card p {
            font-size: 11px;
            color: #374151;
            margin-bottom: 3px;
        }

        .info-card strong {
            color: #111827;
        }

        .meta-badges {
            width: 100%;
            margin-bottom: 20px;
            background: #f3f4f6;
            border-radius: 6px;
            padding: 8px 12px;
        }

        .meta-badges table {
            width: 100%;
        }

        .meta-badges td {
            font-size: 11px;
            color: #374151;
        }

        .meta-badges strong {
            color: #111827;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .items-table th {
            background: #111827;
            color: #ffffff;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 10px 12px;
            text-align: left;
        }

        .items-table th.text-center, .items-table td.text-center {
            text-align: center;
        }

        .items-table th.text-right, .items-table td.text-right {
            text-align: right;
        }

        .items-table td {
            padding: 10px 12px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 11px;
            color: #374151;
        }

        .items-table tr:nth-child(even) td {
            background: #f9fafb;
        }

        .totals-table-wrapper {
            width: 100%;
            margin-bottom: 25px;
        }

        .totals-table-wrapper td {
            vertical-align: top;
        }

        .notes-box {
            width: 55%;
            padding-right: 20px;
        }

        .notes-card {
            background: #fffbeb;
            border: 1px solid #fef3c7;
            border-radius: 6px;
            padding: 10px 12px;
            font-size: 11px;
            color: #92400e;
        }

        .totals-table {
            width: 100%;
            border-collapse: collapse;
        }

        .totals-table td {
            padding: 6px 10px;
            font-size: 11px;
        }

        .totals-table td.label {
            color: #6b7280;
            text-align: right;
        }

        .totals-table td.value {
            color: #111827;
            text-align: right;
            font-weight: 600;
            width: 110px;
        }

        .grand-total-row td {
            border-top: 2px solid #111827;
            border-bottom: 2px solid #111827;
            padding: 10px;
            font-size: 13px;
            font-weight: bold;
            color: #ff7e00 !important;
            background: #fff7ed;
        }

        .status-pill {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-paid {
            background: #d1fae5;
            color: #065f46;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-confirmed {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-delivered {
            background: #d1fae5;
            color: #065f46;
        }

        .footer {
            border-top: 1px dashed #d1d5db;
            padding-top: 15px;
            text-align: center;
            font-size: 10px;
            color: #9ca3af;
            margin-top: 20px;
        }

        .footer p {
            margin-bottom: 2px;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <table class="header-table">
        <tr>
            <td style="width: 55%; vertical-align: middle;">
                <div class="brand-title">FoodieHub</div>
                <div class="brand-subtitle">Fast & Delicious Food Delivered to Your Doorstep</div>
            </td>
            <td style="width: 45%; vertical-align: middle;">
                <div class="invoice-title">Tax Invoice</div>
                <div class="invoice-meta">
                    <strong>Invoice #:</strong> INV-{{ $order->id }}-{{ date('Y') }}<br>
                    <strong>Order #:</strong> {{ $order->order_number }}<br>
                    <strong>Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}
                </div>
            </td>
        </tr>
    </table>

    <!-- Info Cards -->
    <table class="info-table">
        <tr>
            <!-- Restaurant Info -->
            <td class="info-col">
                <div class="info-card">
                    <div class="info-card-title">Sold By (Restaurant)</div>
                    <p><strong>FoodieHub Kitchen Pvt. Ltd.</strong></p>
                    <p>SCO #42, Food Street, Sector 25D</p>
                    <p>Chandigarh, Punjab - 160014, India</p>
                    <p><strong>Phone:</strong> +91 98765 43210</p>
                    <p><strong>Email:</strong> support@foodiehub.com</p>
                    <p><strong>FSSAI Lic:</strong> 10020026001234</p>
                </div>
            </td>

            <!-- Customer / Delivery Info -->
            <td class="info-col">
                <div class="info-card">
                    <div class="info-card-title">Billed & Delivered To</div>
                    @if($order->address)
                        <p><strong>{{ $order->address->full_name }}</strong></p>
                        <p><strong>Phone:</strong> {{ $order->address->mobile }}</p>
                        <p><strong>Email:</strong> {{ $order->user->email ?? 'N/A' }}</p>
                        <p>{{ $order->address->address_line }}</p>
                        <p>{{ $order->address->city }}, {{ $order->address->state }} - {{ $order->address->pincode }}</p>
                    @else
                        <p><strong>{{ $order->user->name ?? 'Valued Customer' }}</strong></p>
                        <p><strong>Email:</strong> {{ $order->user->email ?? 'N/A' }}</p>
                        <p>No physical address recorded.</p>
                    @endif
                </div>
            </td>
        </tr>
    </table>

    <!-- Order Meta Bar -->
    <div class="meta-badges">
        <table>
            <tr>
                <td style="width: 25%;">
                    <strong>Payment Method:</strong><br>
                    {{ strtoupper($order->payment_method ?? 'COD') }}
                </td>
                <td style="width: 25%;">
                    <strong>Payment Status:</strong><br>
                    <span class="status-pill {{ $order->payment_status == 'paid' ? 'status-paid' : 'status-pending' }}">
                        {{ ucfirst($order->payment_status ?? 'Pending') }}
                    </span>
                </td>
                <td style="width: 25%;">
                    <strong>Order Status:</strong><br>
                    <span class="status-pill status-confirmed">
                        {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                    </span>
                </td>
                <td style="width: 25%;">
                    <strong>Items Count:</strong><br>
                    {{ $order->items->sum('quantity') }} Item(s)
                </td>
            </tr>
        </table>
    </div>

    <!-- Items Table -->
    <table class="items-table">
        <thead>
            <tr>
                <th style="width: 8%;" class="text-center">#</th>
                <th style="width: 47%;">Food Item Description</th>
                <th style="width: 15%;" class="text-right">Price</th>
                <th style="width: 12%;" class="text-center">Qty</th>
                <th style="width: 18%;" class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>
                    <strong>{{ $item->food_name }}</strong>
                </td>
                <td class="text-right">Rs. {{ number_format($item->price, 2) }}</td>
                <td class="text-center">{{ $item->quantity }}</td>
                <td class="text-right">Rs. {{ number_format($item->subtotal, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Totals and Notes Table -->
    <table class="totals-table-wrapper">
        <tr>
            <td class="notes-box">
                @if(!empty($order->notes))
                    <div class="notes-card">
                        <strong>Customer Instructions:</strong><br>
                        {{ $order->notes }}
                    </div>
                @else
                    <div style="font-size: 11px; color: #9ca3af; padding: 6px;">
                        <em>Thank you for supporting FoodieHub! Rate your order and share feedback on our website.</em>
                    </div>
                @endif
            </td>
            <td style="width: 45%;">
                <table class="totals-table">
                    <tr>
                        <td class="label">Items Subtotal:</td>
                        <td class="value">Rs. {{ number_format($calculatedSubtotal, 2) }}</td>
                    </tr>
                    <tr>
                        <td class="label">Delivery Fee:</td>
                        <td class="value">
                            @if($calculatedDeliveryFee == 0)
                                <span style="color: #059669; font-weight: bold;">FREE</span>
                            @else
                                Rs. {{ number_format($calculatedDeliveryFee, 2) }}
                            @endif
                        </td>
                    </tr>
                    @if($calculatedDiscount > 0)
                    <tr>
                        <td class="label" style="color: #059669;">
                            @if(!empty($order->coupon_code))
                                Coupon Discount ({{ $order->coupon_code }}):
                            @else
                                Special Discount:
                            @endif
                        </td>
                        <td class="value" style="color: #059669;">-Rs. {{ number_format($calculatedDiscount, 2) }}</td>
                    </tr>
                    @endif
                    <tr class="grand-total-row">
                        <td class="label" style="color: #111827;">Grand Total:</td>
                        <td class="value" style="color: #ff7e00;">Rs. {{ number_format($order->total_amount, 2) }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- Footer -->
    <div class="footer">
        <p>This is a computer-generated tax invoice and does not require a physical signature.</p>
        <p>© {{ date('Y') }} FoodieHub Technologies Inc. All rights reserved. | Contact: support@foodiehub.com</p>
    </div>

</body>
</html>
