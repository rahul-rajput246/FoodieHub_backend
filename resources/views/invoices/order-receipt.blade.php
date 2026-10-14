<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt #{{ $order->order_number }} - FoodieHub</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #e5e7eb;
            font-family: 'Courier New', Courier, monospace, 'Lucida Console';
            color: #111827;
            padding: 20px 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        /* Top Action Bar */
        .action-bar {
            width: 100%;
            max-width: 380px;
            margin-bottom: 16px;
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .btn {
            flex: 1;
            padding: 10px 14px;
            border-radius: 8px;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            font-size: 13px;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .btn-print {
            background-color: #ff7e00;
            color: #ffffff;
        }

        .btn-print:hover {
            background-color: #ea580c;
        }

        .btn-pdf {
            background-color: #2563eb;
            color: #ffffff;
        }

        .btn-pdf:hover {
            background-color: #1d4ed8;
        }

        .btn-back {
            background-color: #374151;
            color: #ffffff;
            flex: 0 0 auto;
            padding: 10px 14px;
        }

        .btn-back:hover {
            background-color: #1f2937;
        }

        /* Thermal Slip Paper */
        .receipt-container {
            width: 100%;
            max-width: 380px;
            background: #ffffff;
            padding: 24px 20px;
            border-radius: 4px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            font-size: 13px;
            line-height: 1.4;
        }

        .receipt-header {
            text-align: center;
            margin-bottom: 12px;
        }

        .receipt-brand {
            font-size: 22px;
            font-weight: 900;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #000;
        }

        .receipt-tagline {
            font-size: 11px;
            margin-top: 2px;
            color: #4b5563;
        }

        .receipt-address {
            font-size: 11px;
            margin-top: 6px;
            line-height: 1.3;
        }

        .divider {
            border-top: 1px dashed #374151;
            margin: 10px 0;
        }

        .double-divider {
            border-top: 2px dashed #111827;
            margin: 10px 0;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            margin-bottom: 3px;
        }

        .info-row strong {
            font-weight: bold;
        }

        /* Items List */
        .item-row {
            margin-bottom: 6px;
            font-size: 12px;
        }

        .item-main {
            display: flex;
            justify-content: space-between;
            font-weight: 600;
        }

        .item-sub {
            display: flex;
            justify-content: space-between;
            font-size: 11px;
            color: #4b5563;
            padding-left: 8px;
        }

        /* Totals */
        .total-row {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            margin-bottom: 4px;
        }

        .grand-total {
            font-size: 15px;
            font-weight: 900;
            margin-top: 6px;
            padding-top: 6px;
            border-top: 1px solid #111827;
            display: flex;
            justify-content: space-between;
        }

        /* Customer Box */
        .customer-box {
            font-size: 11px;
            margin-top: 8px;
            line-height: 1.3;
        }

        .receipt-footer {
            text-align: center;
            font-size: 11px;
            margin-top: 16px;
            line-height: 1.4;
        }

        .barcode-box {
            text-align: center;
            margin: 14px 0 6px 0;
            font-size: 11px;
            letter-spacing: 4px;
            font-weight: bold;
        }

        /* Print Specific Styling */
        @media print {
            body {
                background: #ffffff;
                padding: 0;
                margin: 0;
            }

            .action-bar {
                display: none !important;
            }

            .receipt-container {
                max-width: 100%;
                width: 100%;
                box-shadow: none;
                border-radius: 0;
                padding: 10px;
            }
        }
    </style>
</head>
<body>

    <!-- Action Bar (Hidden on Print) -->
    <div class="action-bar">
        <button onclick="window.print()" class="btn btn-print">
            🖨️ Print Receipt
        </button>
        <a href="{{ route(request()->is('admin/*') ? 'admin.orders.invoice' : 'orders.invoice', $order->id) }}" class="btn btn-pdf">
            📄 PDF Invoice
        </a>
        <button onclick="window.close()" class="btn btn-back">
            ✕ Close
        </button>
    </div>

    <!-- Thermal POS Slip -->
    <div class="receipt-container">
        
        <div class="receipt-header">
            <div class="receipt-brand">FoodieHub</div>
            <div class="receipt-tagline">Fast & Delicious Food Delivered</div>
            <div class="receipt-address">
                SCO #42, Sector 25D, Chandigarh<br>
                Tel: +91 98765 43210<br>
                FSSAI Lic: 10020026001234
            </div>
        </div>

        <div class="double-divider"></div>

        <div class="info-row">
            <span>ORDER NO:</span>
            <strong>#{{ $order->order_number }}</strong>
        </div>
        <div class="info-row">
            <span>DATE:</span>
            <span>{{ $order->created_at->format('d/m/Y') }}</span>
        </div>
        <div class="info-row">
            <span>TIME:</span>
            <span>{{ $order->created_at->format('h:i A') }}</span>
        </div>
        <div class="info-row">
            <span>PAYMENT:</span>
            <strong>{{ strtoupper($order->payment_method ?? 'COD') }} ({{ ucfirst($order->payment_status) }})</strong>
        </div>
        <div class="info-row">
            <span>STATUS:</span>
            <strong>{{ ucfirst(str_replace('_', ' ', $order->status)) }}</strong>
        </div>

        <div class="divider"></div>

        <!-- Column Headers -->
        <div style="display: flex; justify-content: space-between; font-weight: bold; font-size: 11px; margin-bottom: 6px;">
            <span>QTY & ITEM</span>
            <span>AMOUNT</span>
        </div>

        <div class="divider"></div>

        <!-- Items -->
        @foreach($order->items as $item)
        <div class="item-row">
            <div class="item-main">
                <span>{{ $item->food_name }}</span>
                <span>₹{{ number_format($item->subtotal, 2) }}</span>
            </div>
            <div class="item-sub">
                <span>{{ $item->quantity }} x ₹{{ number_format($item->price, 2) }}</span>
            </div>
        </div>
        @endforeach

        <div class="divider"></div>

        <!-- Totals -->
        <div class="total-row">
            <span>Items Subtotal:</span>
            <span>₹{{ number_format($calculatedSubtotal, 2) }}</span>
        </div>

        <div class="total-row">
            <span>Delivery Charge:</span>
            <span>
                @if($calculatedDeliveryFee == 0)
                    FREE
                @else
                    ₹{{ number_format($calculatedDeliveryFee, 2) }}
                @endif
            </span>
        </div>

        @if($calculatedDiscount > 0)
        <div class="total-row">
            <span>Discount Applied:</span>
            <span>-₹{{ number_format($calculatedDiscount, 2) }}</span>
        </div>
        @endif

        <div class="grand-total">
            <span>TOTAL PAYABLE:</span>
            <span>₹{{ number_format($order->total_amount, 2) }}</span>
        </div>

        <div class="double-divider"></div>

        <!-- Delivery Address -->
        <div class="customer-box">
            <strong>DELIVERY TO:</strong><br>
            @if($order->address)
                {{ $order->address->full_name }} ({{ $order->address->mobile }})<br>
                {{ $order->address->address_line }}<br>
                {{ $order->address->city }}, {{ $order->address->state }} - {{ $order->address->pincode }}
            @else
                {{ $order->user->name ?? 'Customer' }} ({{ $order->user->email ?? '' }})
            @endif

            @if(!empty($order->notes))
                <br><strong>Note:</strong> {{ $order->notes }}
            @endif
        </div>

        <div class="divider"></div>

        <!-- Barcode simulation & Footer -->
        <div class="barcode-box">
            * {{ $order->order_number }} *
        </div>

        <div class="receipt-footer">
            THANK YOU FOR DINING WITH US!<br>
            www.foodiehub.com<br>
            Please keep this receipt for verification.
        </div>

    </div>

    @if(request()->has('autoprint'))
    <script>
        window.addEventListener('load', function() {
            setTimeout(function() {
                window.print();
            }, 300);
        });
    </script>
    @endif

</body>
</html>
