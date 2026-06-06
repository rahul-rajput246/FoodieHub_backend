@extends('layouts.allAdmin')

@section('content')

<div class="main_dashboard">

    <div class="dashboard_header">
        <div class="dashboard_header_left">
            <p class="dashboard_small_text">FoodieHub Admin</p>
            <h1>Welcome Back, Admin</h1>
            <p class="dashboard_desc">
                Here’s what’s happening in your FoodieHub store today.
            </p>
        </div>

        <div class="dashboard_header_right">
            <a href="{{ route('admin.create.category') }}" class="dashboard_top_btn">+ Add Category</a>
            <a href="{{ route('admin.forms.createFood') }}" class="dashboard_top_btn">+ Add Product</a>
        </div>
    </div>

    <div class="dashboard_cards">
        <div class="dashboard_card">
            <div class="dashboard_card_row">   
                <div class="dashboard_card_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ff9138"><path d="M172.31-180Q142-180 121-201q-21-21-21-51.31v-455.38Q100-738 121-759q21-21 51.31-21h219.61l80 80h315.77Q818-700 839-679q21 21 21 51.31v375.38Q860-222 839-201q-21 21-51.31 21H172.31Zm0-60h615.38q5.39 0 8.85-3.46t3.46-8.85v-375.38q0-5.39-3.46-8.85t-8.85-3.46H447.38l-80-80H172.31q-5.39 0-8.85 3.46t-3.46 8.85v455.38q0 5.39 3.46 8.85t8.85 3.46ZM160-240v-480 480Z"/></svg>
                </div>
                    <p>Total Categories</p>
            </div>
            <div class="dashboard_card_text">
                <h2>{{ $totalCategory }}</h2>
                <p>Food sections available</p>
            </div>
        </div>

        <div class="dashboard_card">
            <div class="dashboard_card_row"> 
                <div class="dashboard_card_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ff9138"><path d="M554.16-412.31q-29.31-49.61-85.95-67.11t-117.06-17.5q-60.23 0-117.34 17.5-57.12 17.5-85.66 67.11h406.01Zm-485.31 60q0-98.23 86.77-151.42 86.77-53.19 195.53-53.19 108.77 0 195.54 53.19t86.77 151.42H68.85Zm0 146.16v-60h564.61v60H68.85ZM713.46-60v-60h56l56-552.31H454.23l-7.69-60h192.31v-160h59.99v160h192.31l-62.92 625.08q-2.62 20.77-18.15 34Q794.54-60 773.77-60h-60.31Zm0-60h56-56Zm-612.3 60q-13.74 0-23.02-9.29-9.29-9.29-9.29-23.02V-120h564.61v27.69q0 13.73-9.29 23.02T601.15-60H101.16Zm249.99-352.31Z"/></svg>
                </div>
                <p>Total Products</p>
            </div>
            <div class="dashboard_card_text">
                <h2>{{ $totalFood }}</h2>
                <span>Menu items added</span>
            </div>
        </div>

        <div class="dashboard_card">
            <div class="dashboard_card_row"> 
                <div class="dashboard_card_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ff9138"><path d="M236.58-118.12q-20.42-20.42-20.42-49.57 0-29.16 20.42-49.58 20.42-20.42 49.57-20.42 29.16 0 49.58 20.42 20.42 20.42 20.42 49.58 0 29.15-20.42 49.57-20.42 20.43-49.58 20.43-29.15 0-49.57-20.43Zm387.69 0q-20.42-20.42-20.42-49.57 0-29.16 20.42-49.58 20.42-20.42 49.58-20.42 29.15 0 49.57 20.42t20.42 49.58q0 29.15-20.42 49.57Q703-97.69 673.85-97.69q-29.16 0-49.58-20.43ZM240.61-730 342-517.69h272.69q3.46 0 6.16-1.73 2.69-1.73 4.61-4.81l107.31-195q2.31-4.23.38-7.5-1.92-3.27-6.54-3.27h-486Zm-28.76-60h555.38q24.54 0 37.11 20.89 12.58 20.88 1.2 42.65L677.38-494.31q-9.84 17.31-26.03 26.96-16.2 9.66-35.5 9.66H324l-46.31 84.61q-3.08 4.62-.19 10 2.88 5.39 8.65 5.39h457.69v60H286.15q-40 0-60.11-34.5-20.12-34.5-1.42-68.89l57.07-102.61L136.16-810H60v-60h113.85l38 80ZM342-517.69h280-280Z"/></svg>
                </div>
                <p>Total Orders</p>
            </div>
            <div class="dashboard_card_text">
                <h2>{{ $totalOrders }}</h2>
                <span>Orders received today</span>
            </div>
        </div>

        <div class="dashboard_card">
            <div class="dashboard_card_row"> 
                <div class="dashboard_card_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ff9138"><path d="M207.69-110.77q-15.59 0-27.06-11.73-11.47-11.73-11.47-27.19v-96.97q0-83.12 51.69-146.84t132.92-81.27q-37.07 26-57.46 65.46-20.39 39.46-20.39 84.58v174.96q0 10.13 3 20.25 3 10.13 9.24 18.75h-80.47Zm135.68 0q-15.69 0-27.22-11.59-11.53-11.58-11.53-27.33v-175q0-65 45.46-110.16Q395.54-480 460.54-480h174.68q64.7 0 109.86 45.15 45.15 45.16 45.15 110.16v58.61q0 65-45.15 110.15-45.16 45.16-110.16 45.16H343.37ZM480-557.85q-60.86 0-103.27-42.34-42.42-42.35-42.42-103.35 0-61 42.42-103.34 42.41-42.35 103.27-42.35t103.27 42.35q42.42 42.34 42.42 103.34t-42.42 103.35Q540.86-557.85 480-557.85Z"/></svg>
                </div>
                <p>Total Users</p>
            </div>
            <div class="dashboard_card_text">
                <h2>{{ $totalUsers }}</h2>
                <span>Registered customers</span>
            </div>
        </div>
    </div>

    <div class="dashboard_quick_actions">
        <a href="{{ route('admin.category') }}">Manage Categories</a>
        <a href="{{ route('admin.allFood') }}">Manage Food</a>
        <a href="/profile">Settings</a>
        <form class="toggle_form" method="POST" action="{{ route('logout') }}">
        @csrf
            <button type="submit" class="dashboard_logout_btn">Logout</button>
        </form>
    </div>

    <div class="dashboard_grid">
        
        <div class="dashboard_table_box">
            <div class="box_title_row">
                <h3>Recent Orders</h3>
                <a href="{{ route('admin.orders') }}" class="view_all_btn">View All</a>
            </div>

            <div class="dashboard_table_wrapper">
                <table class="dashboard_table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($recentOrders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>₹{{ $order->total_amount }}</td>
                                <td><span class="order_status pending">{{ $order->status }}</span></td>
                                <td>{{ $order->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="dashboard_side_boxes">
            <div class="small_dashboard_box">
                <div class="box_title_row">
                    <h3>Stock Alerts</h3>
                </div>

                <ul class="stock_alert_list">
                    @foreach($lowStockItems as $item)
                        <li>
                            <span>{{ $item->food_name }}</span>
                            <strong>{{ $item->food_stock }} left</strong>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="small_dashboard_box">
                <div class="box_title_row">
                    <h3>Quick Overview</h3>
                </div>

                <div class="overview_item">
                    <span>Pending Orders</span>
                    <strong>{{ $pendingOrders }}</strong>
                </div>

                <div class="overview_item">
                    <span>Delivered Today</span>
                    <strong>{{ $deliveredOrders }}</strong>
                </div>

                <div class="overview_item">
                    <span>Cancelled Orders</span>
                    <strong>{{ $cancelledOrders }}</strong>
                </div>

                <div class="overview_item">
                    <span>Active Products</span>
                    <strong>{{ $activeOrders }}</strong>
                </div>
            </div>
        </div>

    </div>

    @include('components.usable.footer')

</div>

@endsection 