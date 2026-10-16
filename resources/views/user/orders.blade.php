@extends('layouts.allAdmin')

@section('content')

<div class="main_dashboard">

    <div class="dashboard_header">
        <div class="dashboard_header_left">
            <p class="dashboard_small_text">Customer Portal</p>
            <h1>My Orders</h1>
            <p class="dashboard_desc">
                Track all your placed food orders, view real-time delivery status, and inspect order details.
            </p>
        </div>

        <div class="dashboard_header_right">
            <a href="http://localhost:5173/Menu" class="dashboard_top_btn">+ Order New Food</a>
            <a href="/admin/dashboard" class="dashboard_top_btn" style="background: #374151;">Dashboard</a>
        </div>
    </div>

    <div class="dashboard_table_box">
        <div class="box_title_row">
            <h3>Order History</h3>
            <span style="font-size: 13px; color: #6b7280;">Showing {{ $orders->total() ?? $orders->count() }} orders</span>
        </div>

        @if($orders->count())
            <div class="dashboard_table_wrapper">
                <table class="dashboard_table">
                    <thead>
                        <tr>
                            <th>Sr.No.</th>
                            <th>Order No</th>
                            <th>Date</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $order->order_number }}</strong></td>
                            <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                            <td><strong>₹{{ number_format($order->total_amount, 2) }}</strong></td>
                            <td>
                                <span class="order_status {{ strtolower($order->status) }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>{{ $order->payment_method ? strtoupper($order->payment_method) : 'N/A' }}</td>
                            <td>
                                <div style="display: flex; gap: 6px; align-items: center;">
                                    <a href="{{ route('orders.show', $order->id) }}" class="dashboard_top_btn" style="padding: 6px 12px; font-size: 13px;">
                                        View Details
                                    </a>
                                    <a href="{{ route('orders.invoice', $order->id) }}" title="Download PDF Invoice" class="dashboard_top_btn" style="padding: 6px 10px; font-size: 13px; background: #2563eb; display: inline-flex; align-items: center; gap: 4px;">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                            <polyline points="14 2 14 8 20 8"></polyline>
                                            <line x1="12" y1="18" x2="12" y2="12"></line>
                                            <polyline points="9 15 12 18 15 15"></polyline>
                                        </svg>
                                        PDF
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 20px;">
                {{ $orders->links() }}
            </div>
        @else
            <div style="text-align: center; padding: 40px 20px;">
                <div style="font-size: 36px; margin-bottom: 10px;">📦</div>
                <h3 style="font-size: 18px; color: #111827; margin-bottom: 6px;">No orders found</h3>
                <p style="color: #6b7280; font-size: 14px; margin-bottom: 18px;">You have not placed any orders yet. Discover delicious dishes from our menu!</p>
                <a href="http://localhost:5173/Menu" class="dashboard_top_btn">Browse Menu & Order</a>
            </div>
        @endif
    </div>

    @include('components.usable.footer')

</div>

@endsection