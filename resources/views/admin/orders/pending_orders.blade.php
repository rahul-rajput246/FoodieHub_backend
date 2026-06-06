@extends('layouts.allAdmin')

@section('content')

<div class="main_allfood_container">

    <!-- HEADER -->
    <div class="pages_header allfood_header">
        <div>
            <p class="dashboard_small_text">FoodieHub Admin</p>
            <h1>Pending Orders</h1>
            <p class="pages_desc">
                Manage all pending orders, review details and update order status.
            </p>
        </div>
    </div>

    <!-- OVERVIEW -->
    <div class="pages_overview_cards">
        <div class="mini_overview_card">
            <h3>Total Pending</h3>
            <h2>{{ $orders->count() }}</h2>
            <p>Orders waiting for action</p>
        </div>

        <div class="mini_overview_card">
            <h3>Today Orders</h3>
            <h2>{{ $orders->where('created_at', '>=', now()->startOfDay())->count() }}</h2>
            <p>Placed today</p>
        </div>

        <div class="mini_overview_card">
            <h3>Total Orders Revenue</h3>
            <h2>₹{{ $orders->sum('total_amount') }}</h2>
            <p>From pending orders</p>
        </div>
    </div>

    <!-- TABLE -->
    <div class="allfood_table_box">

        <div class="box_title_row">
            <h3>Pending Orders List</h3>
        </div>

        <div class="dashboard_table_wrapper">
            <table class="dashboard_table">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Order ID</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($orders as $order)

                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            <div class="food_list_info">
                                <div class="food_list_img">
                                    <img src="{{ $order->user->user_image 
                                    ? asset('storage/' . $order->user->user_image) 
                                    : 'https://ui-avatars.com/api/?name=' . urlencode($order->user->name) }}">
                                </div>
                                <div class="food_list_text">
                                    <h4>{{ $order->user->name }}</h4>
                                    <p>{{ $order->user->email }}</p>
                                </div>
                            </div>
                        </td>

                        <td>#ORD{{ $order->id }}</td>

                        <td>₹{{ $order->total_amount }}</td>

                        <td>
                            <span class="order_status pending">
                                Pending
                            </span>
                        </td>

                        <td>{{ $order->created_at->format('d M Y') }}</td>

                        <td>
                            <div class="action_btn_group">

                                <a href="{{ route('admin.orders.show', $order->id) }}" class="action_btn edit_btn">
                                    View
                                </a>

                                <form action="{{ route('admin.orders.status', $order->id) }}" method="POST">
                                    @csrf

                                    <input type="hidden" name="status" value="confirmed">
                                    <input type="hidden" name="payment_status" value="pending">

                                    <button type="submit" class="action_btn" style="background:#ecfdf5;color:#059669;">
                                        Accept
                                    </button>
                                </form>

                                <form action="{{ route('admin.orders.status', $order->id) }}" method="POST">
                                    @csrf

                                    <input type="hidden" name="status" value="cancelled">
                                    <input type="hidden" name="payment_status" value="failed">

                                    <button type="submit" class="action_btn delete_btn">
                                        Reject
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>

                    @empty

                    <tr>
                        <td colspan="7" style="text-align:center; padding:20px;">
                            No pending orders found.
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>
        </div>

    </div>

    @include('components.usable.footer')

</div>

@endsection