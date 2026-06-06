@extends('layouts.allAdmin')

@section('content')

<div class="main_allfood_container">

    <div class="pages_header allfood_header">
        <div>
            <p class="dashboard_small_text">FoodieHub Admin</p>
            <h1>Order Details</h1>
            <p class="pages_desc">
                View full order information and update its status.
            </p>
        </div>

        <div>
            <a href="{{ route('admin.orders') }}" class="create_food_btn">← Back to Orders</a>
        </div>
    </div>

    @if(session('success'))
        <div style="margin-bottom:20px; padding:12px; background:#d1fae5; color:#065f46; border-radius:8px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="pages_overview_cards">
        <div class="mini_overview_card">
            <h3>Order Number</h3>
            <h2 style="font-size:20px;">{{ $order->order_number }}</h2>
            <p>Unique order ID</p>
        </div>

        <div class="mini_overview_card">
            <h3>Total Amount</h3>
            <h2>Rs. {{ number_format($order->total_amount, 2) }}</h2>
            <p>Customer payable total</p>
        </div>

        <div class="mini_overview_card">
            <h3>Status</h3>
            <h2 style="font-size:20px;">{{ ucfirst(str_replace('_', ' ', $order->status)) }}</h2>
            <p>Current order stage</p>
        </div>
    </div>

    <div class="allfood_table_box" style="margin-bottom: 24px;">
        <div class="box_title_row">
            <h3>Customer Information</h3>
        </div>

        <div class="contact_det">
            <p><b>Name:</b> {{ $order->user->name ?? 'N/A' }}</p>
            <p><b>Email:</b> {{ $order->user->email ?? 'N/A' }}</p>
            <p><b>Payment Method:</b> {{ strtoupper($order->payment_method ?? 'N/A') }}</p>
            <p><b>Payment Status:</b> {{ ucfirst($order->payment_status) }}</p>
            <p><b>Notes:</b> {{ $order->notes ?? 'No notes added' }}</p>
            <p><b>Placed On:</b> {{ $order->created_at->format('d M Y, h:i A') }}</p>
        </div>
    </div>

    <div class="allfood_table_box" style="margin-bottom: 24px;">
        <div class="box_title_row">
            <h3>Delivery Address</h3>
        </div>

        <div class="contact_det">
            @if($order->address)
                <p>{{ $order->address->full_name ?? '' }}</p>
                <p>{{ $order->address->mobile ?? '' }}</p>
                <p>{{ $order->address->address_line  ?? '' }}</p>
                <p>{{ $order->address->city ?? '' }}, {{ $order->address->state ?? '' }}</p>
                <p>{{ $order->address->pincode ?? '' }}</p>
            @else
                <p>No address found.</p>
            @endif
        </div>
    </div>

    <div class="allfood_table_box" style="margin-bottom: 24px;">
        <div class="box_title_row">
            <h3>Ordered Items</h3>
        </div>

        <div class="dashboard_table_wrapper">
            <table class="dashboard_table allfood_table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Food Name</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->food_name }}</td>
                        <td>Rs. {{ number_format($item->price, 2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rs. {{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="update_order_status">
        <div class="box_title_row">
            <h3>Update Order Status</h3>
        </div>

        <div style="padding: 20px 0px;">
            <form method="POST" action="{{ route('admin.orders.status', $order->id) }}">
                @csrf

                <div style="display: flex;flex-direction: column;gap: 10px;">
                    <label for="status">Order Status</label>
                    <select name="status" id="status" class="custom_select">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="preparing" {{ $order->status == 'preparing' ? 'selected' : '' }}>Preparing</option>
                        <option value="out_for_delivery" {{ $order->status == 'out_for_delivery' ? 'selected' : '' }}>Out For Delivery</option>
                        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    @error('status')
                        <p style="color:red; margin-top:6px;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="display: flex;flex-direction: column;gap: 10px; margin-top: 20px; margin-bottom: 20px;">
                    <label for="payment_status">Payment Status</label>
                    <select name="payment_status" id="payment_status" class="custom_select">
                        <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
                    </select>
                    @error('payment_status')
                        <p style="color:red; margin-top:6px;">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="create_food_btn">Update Order</button>
            </form>
        </div>
    </div>

    @include('components.usable.footer')

</div>

@endsection
