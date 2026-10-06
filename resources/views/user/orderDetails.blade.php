@extends('layouts.allAdmin')

@section('content')

<div class="main_dashboard">

    <div class="dashboard_header">
        <div class="dashboard_header_left">
            <p class="dashboard_small_text">Customer Portal</p>
            <h1>Order Details #{{ $order->order_number }}</h1>
            <p class="dashboard_desc">
                Placed on {{ $order->created_at->format('d M Y, h:i A') }} • Status: {{ ucfirst($order->status) }}
            </p>
        </div>

        <div class="dashboard_header_right">
            <a href="{{ route('orders.index') }}" class="dashboard_top_btn" style="background: #374151;">← Back to Orders</a>
            <a href="http://localhost:5173/Menu" class="dashboard_top_btn">+ Order Again</a>
        </div>
    </div>

    <div class="dashboard_grid">

        <div class="dashboard_table_box">
            <div class="box_title_row">
                <h3>Ordered Items</h3>
            </div>

            @if($order->items->count())
                <div class="dashboard_table_wrapper">
                    <table class="dashboard_table">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td>
                                        <strong>{{ $item->food_name }}</strong>
                                    </td>
                                    <td>₹{{ number_format($item->price, 2) }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td><strong>₹{{ number_format($item->subtotal, 2) }}</strong></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div style="margin-top: 25px; padding-top: 15px; border-top: 1px solid #e5e7eb; display: flex; justify-content: flex-end;">
                    <div style="font-size: 18px; font-weight: 700; color: #111827;">
                        Grand Total: <span style="color: #ff7e00;">₹{{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>
            @else
                <p style="padding: 20px 0; color: #6b7280;">No items found for this order.</p>
            @endif
        </div>

        <div class="dashboard_side_boxes">
            {{-- Order Summary Info --}}
            <div class="small_dashboard_box">
                <div class="box_title_row">
                    <h3>Order Summary</h3>
                </div>

                <div class="overview_item">
                    <span>Order Status</span>
                    <span class="order_status {{ strtolower($order->status) }}">{{ ucfirst($order->status) }}</span>
                </div>
                <div class="overview_item">
                    <span>Payment Method</span>
                    <strong>{{ $order->payment_method ? strtoupper($order->payment_method) : 'N/A' }}</strong>
                </div>
                <div class="overview_item">
                    <span>Payment Status</span>
                    <strong>{{ ucfirst($order->payment_status) }}</strong>
                </div>
                @if(!empty($order->notes))
                <div class="overview_item" style="flex-direction: column; align-items: flex-start; gap: 4px;">
                    <span>Notes</span>
                    <p style="font-size: 13px; color: #4b5563; margin: 0;">{{ $order->notes }}</p>
                </div>
                @endif
            </div>

            {{-- Delivery Address --}}
            <div class="small_dashboard_box">
                <div class="box_title_row">
                    <h3>Delivery Address</h3>
                </div>

                @if($order->address)
                    <div style="font-size: 14px; line-height: 1.6; color: #374151;">
                        <strong style="color: #111827; font-size: 15px;">{{ $order->address->full_name }}</strong>
                        <p style="margin: 4px 0;">📞 {{ $order->address->mobile }}</p>
                        <p style="margin: 4px 0;">📍 {{ $order->address->address_line }}</p>
                        <p style="margin: 4px 0;">{{ $order->address->city }}, {{ $order->address->state }} - {{ $order->address->pincode }}</p>
                        @if(!empty($order->address->landmark))
                            <p style="margin: 4px 0;"><small>Landmark: {{ $order->address->landmark }}</small></p>
                        @endif
                        @if(!empty($order->address->type))
                            <span style="display: inline-block; background: #e5e7eb; padding: 2px 8px; border-radius: 4px; font-size: 11px; text-transform: uppercase; font-weight: 600; margin-top: 6px;">{{ $order->address->type }}</span>
                        @endif
                    </div>
                @else
                    <p style="color: #9ca3af; font-size: 14px;">Address details not available.</p>
                @endif
            </div>
        </div>

    </div>

    @include('components.usable.footer')

</div>

@endsection
