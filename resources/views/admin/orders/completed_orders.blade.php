@extends('layouts.allAdmin')

@section('content')

<div class="main_allfood_container">

    <!-- HEADER -->
    <div class="pages_header allfood_header">
        <div>
            <p class="dashboard_small_text">FoodieHub Admin</p>
            <h1>Completed Orders</h1>
            <p class="pages_desc">
                View all successfully delivered orders and earnings.
            </p>
        </div>
    </div>

    <!-- OVERVIEW -->
    <div class="pages_overview_cards">
        <div class="mini_overview_card">
            <h3>Total Completed</h3>
            <h2>{{ $orders->count() }}</h2>
            <p>Delivered orders</p>
        </div>

        <div class="mini_overview_card">
            <h3>Today Delivered</h3>
            <h2>{{ $orders->where('created_at', '>=', now()->startOfDay())->count() }}</h2>
            <p>Completed today</p>
        </div>

        <div class="mini_overview_card">
            <h3>Total Delivered Revenue</h3>
            <h2>₹{{ $orders->sum('total_amount') }}</h2>
            <p>From completed orders</p>
        </div>
    </div>

    <!-- TABLE -->
    <div class="allfood_table_box">

        <div class="box_title_row">
            <h3>Completed Orders List</h3>
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
                            <span class="order_status delivered">
                                Delivered
                            </span>
                        </td>

                        <td>{{ $order->created_at->format('d M Y') }}</td>

                        <td>
                            <div class="action_btn_group">

                                <a href="{{ route('admin.orders.show', $order->id) }}" class="action_btn edit_btn">
                                    View
                                </a>

                            </div>
                        </td>
                    </tr>

                    @empty

                    <tr>
                        <td colspan="7" style="text-align:center; padding:20px;">
                            No completed orders found.
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