@extends('layouts.allAdmin')

@section('content')

<div class="main_allfood_container">

    <div class="pages_header allfood_header">
        <div>
            <p class="dashboard_small_text">FoodieHub Admin</p>
            <h1>All Orders</h1>
            <p class="pages_desc">
                Manage all customer orders, track statuses and check order details from here.
            </p>
        </div>
    </div>

    <div class="pages_overview_cards">
        <div class="mini_overview_card">
            <h3>Total Orders</h3>
            <h2>{{ $orders->count() }}</h2>
            <p>All orders in database</p>
        </div>

        <div class="mini_overview_card">
            <h3>Pending Orders</h3>
            <h2>{{ $orders->where('status', 'pending')->count() }}</h2>
            <p>Need admin action</p>
        </div>

        <div class="mini_overview_card">
            <h3>Delivered Orders</h3>
            <h2>{{ $orders->where('status', 'delivered')->count() }}</h2>
            <p>Completed successfully</p>
        </div>
    </div>

    <div class="allfood_table_box">
        <div class="box_title_row">
            <h3>Order Listing</h3>
        </div>

        <div class="dashboard_table_wrapper">
            <table class="dashboard_table allfood_table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Order No</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Order Status</th>
                        <th>Payment</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ $order->user->name ?? 'N/A' }}</td>
                        <td>Rs. {{ number_format($order->total_amount, 2) }}</td>
                        <td>
                            <span class="order_status {{ strtolower($order->status) }}">
                                {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                            </span>
                        </td>
                        <td>
                            <span class="food_status {{ $order->payment_status == 'paid' ? 'active' : 'inactive' }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </td>
                        <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                        <td>
                            <div class="action_btn_group">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="action_btn edit_btn">
                                    View Details
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

    @include('components.usable.footer')

</div>

@endsection