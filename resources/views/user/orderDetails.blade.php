@extends('layouts.allUser')

@section('userContent')
<div class="dashboard_container">

    <div class="dashboard_top modern_top">
        <div>
            <h2>Order Details</h2>
            <p>View complete information about your order.</p>
        </div>

        <div>
            <a href="{{ route('orders.index') }}" class="btn_outline">Back to Orders</a>
        </div>
    </div>

    <div class="dashboard_grid" style="grid-template-columns: 2fr 1fr; gap: 20px;">

        <div class="dashboard_section modern_section">
            <div class="section_header">
                <h3><b>Order #{{ $order->order_number }}</b></h3>
            </div>

            <div style="margin-bottom: 20px;display: flex;flex-direction: column;gap: 10px;">
                <p>Order Date: {{ $order->created_at->format('d M Y, h:i A') }}</p>
                <p>Status: {{ ucfirst($order->status) }}</p>
                <p>Payment Method: {{ $order->payment_method ? strtoupper($order->payment_method) : 'N/A' }}</p>
                <p>Payment Status: {{ ucfirst($order->payment_status) }}</p>

                @if(!empty($order->notes))
                    <p><strong>Notes:</strong> {{ $order->notes }}</p>
                @endif
            </div>

            <div class="section_header">
                <h3>Ordered Items</h3>
            </div>

            @if($order->items->count())
                <table class="table" style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="text-align: left; padding: 12px;">Food Name</th>
                            <th style="text-align: left; padding: 12px;">Price</th>
                            <th style="text-align: left; padding: 12px;">Quantity</th>
                            <th style="text-align: left; padding: 12px;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr style="border-top: 1px solid #eee;">
                                <td style="padding: 12px;">{{ $item->food_name }}</td>
                                <td style="padding: 12px;">Rs. {{ number_format($item->price, 2) }}</td>
                                <td style="padding: 12px;">{{ $item->quantity }}</td>
                                <td style="padding: 12px;">Rs. {{ number_format($item->subtotal, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div style="margin-top: 20px; text-align: right;">
                    <h3>Grand Total: Rs. {{ number_format($order->total_amount, 2) }}</h3>
                </div>
            @else
                <p>No items found for this order.</p>
            @endif
        </div>

        <div class="profile_box modern_profile" style="padding: 20px;">
            <h3 style="margin-bottom: 15px;">Delivery Address</h3>

            @if($order->address)
                <p><strong>{{ $order->address->full_name }}</strong></p>
                <p>{{ $order->address->mobile }}</p>
                <p>{{ $order->address->address_line }}</p>
                <p>{{ $order->address->city }}, {{ $order->address->state }} - {{ $order->address->pincode }}</p>

                @if(!empty($order->address->landmark))
                    <p><strong>Landmark:</strong> {{ $order->address->landmark }}</p>
                @endif

                @if(!empty($order->address->type))
                    <p><strong>Type:</strong> {{ ucfirst($order->address->type) }}</p>
                @endif
            @else
                <p>Address not available.</p>
            @endif
        </div>

    </div>

</div>
@endsection
