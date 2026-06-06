@extends('layouts.allUser')

@section('userContent')
<div class="dashboard_container">

    <div class="dashboard_top modern_top">
        <div>
            <h2>My Orders</h2>
            <p>Track all your placed orders and view their details.</p>
        </div>
    </div>

    <div class="dashboard_section modern_section">
        <div class="section_header">
            <h3>Order History</h3>
        </div>

        @if($orders->count())
        <div class="table-responsive">
            <table class="table" style="width: 100%;border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="text-align: left;">Sr.No.</th>
                        <th style="text-align: left; padding: 12px;">Order No</th>
                        <th style="text-align: left; padding: 12px;">Date</th>
                        <th style="text-align: left; padding: 12px;">Total</th>
                        <th style="text-align: left; padding: 12px;">Status</th>
                        <th style="text-align: left; padding: 12px;">Payment</th>
                        <th style="text-align: left; padding: 12px; text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr style="border-top: 1px solid #eee;">
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td style="padding: 12px;">
                            {{ $order->order_number }}
                        </td>
                        <td style="padding: 12px;">
                            {{ $order->created_at->format('d M Y, h:i A') }}
                        </td>
                        <td style="padding: 12px;">
                            Rs. {{ number_format($order->total_amount, 2) }}
                        </td>
                        <td style="padding: 12px;">
                            <span class="status {{ strtolower($order->status) }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td style="padding: 12px;">
                            {{ $order->payment_method ? strtoupper($order->payment_method) : 'N/A' }}
                        </td>
                        <td style="padding: 12px;">
                            <a href="{{ route('orders.show', $order->id) }}" class="btn_primary small">
                                View Details
                            </a>
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
        <div style="padding: 20px 0;">
            <p style="margin-bottom:20px">You have not placed any orders yet.</p>
            <a href="http://localhost:5173/Menu" class="btn_primary">Order Now</a>
        </div>
        @endif
    </div>

</div>
@endsection