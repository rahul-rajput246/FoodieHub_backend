@extends('layouts.allAdmin')

@section('content')

<div class="main_dashboard">

    @if(Auth::check() && Auth::user()->hasRole('admin'))
        {{-- ============================== ADMIN DASHBOARD VIEW ============================== --}}
        <div class="dashboard_header">
            <div class="dashboard_header_left">
                <p class="dashboard_small_text">FoodieHub Admin Portal</p>
                <h1>Welcome Back, {{ Auth::user()->name }}</h1>
                <p class="dashboard_desc">
                    Here’s what’s happening in your FoodieHub store today. Monitor sales, products, and incoming customer orders.
                </p>
            </div>

            <div class="dashboard_header_right">
                <a href="{{ route('admin.create.category') }}" class="dashboard_top_btn">+ Add Category</a>
                <a href="{{ route('admin.forms.createFood') }}" class="dashboard_top_btn">+ Add Product</a>
                <a href="http://localhost:5173" class="dashboard_top_btn" style="background: #374151;">Visit Store</a>
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
                    <span>Orders received</span>
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
            <a href="{{ route('admin.orders') }}">Store Orders</a>
            <a href="{{ route('admin.allUsers') }}">All Users</a>
            <a href="/profile">Settings</a>
            <form class="toggle_form" method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dashboard_logout_btn">Logout</button>
            </form>
        </div>

        <div class="dashboard_grid">
            
            <div class="dashboard_table_box">
                <div class="box_title_row">
                    <h3>Recent Store Orders</h3>
                    <a href="{{ route('admin.orders') }}" class="view_all_btn">View All Orders →</a>
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
                            @forelse($recentOrders as $order)
                                <tr>
                                    <td><strong>{{ $order->order_number ?: '#' . $loop->iteration }}</strong></td>
                                    <td>{{ $order->user ? $order->user->name : 'Customer' }}</td>
                                    <td>₹{{ number_format($order->total_amount, 2) }}</td>
                                    <td><span class="order_status {{ strtolower($order->status) }}">{{ ucfirst($order->status) }}</span></td>
                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="text-align: center; padding: 20px;">No store orders yet.</td>
                                </tr>
                            @endforelse
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
                        @forelse($lowStockItems as $item)
                            <li>
                                <span>{{ $item->food_name }}</span>
                                <strong>{{ $item->food_stock }} left</strong>
                            </li>
                        @empty
                            <li style="color: #10b981; font-weight: 500;">All products have healthy stock levels.</li>
                        @endforelse
                    </ul>
                </div>

                <div class="small_dashboard_box">
                    <div class="box_title_row">
                        <h3>Store Overview</h3>
                    </div>

                    <div class="overview_item">
                        <span>Pending Orders</span>
                        <strong>{{ $pendingOrders }}</strong>
                    </div>

                    <div class="overview_item">
                        <span>Delivered Orders</span>
                        <strong>{{ $deliveredOrders }}</strong>
                    </div>

                    <div class="overview_item">
                        <span>Cancelled Orders</span>
                        <strong>{{ $cancelledOrders }}</strong>
                    </div>

                    <div class="overview_item">
                        <span>Active Food Items</span>
                        <strong>{{ $activeOrders }}</strong>
                    </div>
                </div>

                {{-- Admin Personal Activity Info --}}
                <div class="small_dashboard_box" style="border-left: 4px solid #ff7e00;">
                    <div class="box_title_row">
                        <h3>My Personal Activity</h3>
                    </div>
                    <div class="overview_item">
                        <span>My Placed Orders</span>
                        <strong>{{ $userTotalOrders }}</strong>
                    </div>
                    <div class="overview_item">
                        <span>My Cart Items</span>
                        <strong>{{ $userCartCount }}</strong>
                    </div>
                    <div class="overview_item">
                        <span>My Wishlist</span>
                        <strong>{{ $userWishlistCount }}</strong>
                    </div>
                </div>
            </div>

        </div>

    @else
        {{-- ============================== USER DASHBOARD VIEW ============================== --}}
        <div class="dashboard_header" style="background: linear-gradient(135deg, #111827, #242c3d);">
            <div class="dashboard_header_left">
                <p class="dashboard_small_text" style="color: #ffb067;">Customer Portal</p>
                <h1>Welcome Back, {{ Auth::user()->name }}</h1>
                <p class="dashboard_desc">
                    Let’s order something delicious today! Track your active orders, browse your favorite dishes, and manage your account.
                </p>
            </div>

            <div class="dashboard_header_right">
                <a href="http://localhost:5173/Menu" class="dashboard_top_btn" style="background: #ff7e00;">Order Now</a>
                <a href="/orders" class="dashboard_top_btn" style="background: rgba(255, 255, 255, 0.15); border: 1px solid rgba(255, 255, 255, 0.25);">My Orders</a>
                <a href="http://localhost:5173" class="dashboard_top_btn" style="background: #374151;">Visit Store</a>
            </div>
        </div>

        <div class="dashboard_cards">
            <div class="dashboard_card">
                <div class="dashboard_card_row">   
                    <div class="dashboard_card_icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ff9138"><path d="m691-150 139-138-42-42-97 95-39-39-42 43 81 81ZM240-600h480v-80H240v80ZM720-40q-83 0-141.5-58.5T520-240q0-83 58.5-141.5T720-440q83 0 141.5 58.5T920-240q0 83-58.5 141.5T720-40ZM120-80v-680q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v267q-19-9-39-15t-41-9v-243H200v562h243q5 31 15.5 59T486-86l-6 6-60-60-60 60-60-60-60 60-60-60-60 60Zm120-200h203q3-21 9-41t15-39H240v80Zm0-160h284q38-37 88.5-58.5T720-520H240v80Zm-40 242v-562 562Z"/></svg>
                    </div>
                    <p>Total Orders</p>
                </div>
                <div class="dashboard_card_text">
                    <h2>{{ $userTotalOrders }}</h2>
                    <p>Orders placed by you</p>
                </div>
            </div>

            <div class="dashboard_card">
                <div class="dashboard_card_row"> 
                    <div class="dashboard_card_icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ff9138"><path d="m480-120-58-52q-101-91-167-157T150-447.5Q111-500 95.5-544T80-634q0-94 63-157t157-63q52 0 99 22t81 62q34-40 81-62t99-22q94 0 157 63t63 157q0 46-15.5 90T810-447.5Q771-395 705-329T538-172l-58 52Zm0-108q96-86 158-147.5t98-107q36-45.5 50-81t14-70.5q0-60-40-100t-100-40q-47 0-87 26.5T518-680h-76q-15-41-55-67.5T300-774q-60 0-100 40t-40 100q0 35 14 70.5t50 81q36 45.5 98 107T480-228Zm0-273Z"/></svg>
                    </div>
                    <p>Wishlist</p>
                </div>
                <div class="dashboard_card_text">
                    <h2>{{ $userWishlistCount }}</h2>
                    <span>Saved favorite items</span>
                </div>
            </div>

            <div class="dashboard_card">
                <div class="dashboard_card_row"> 
                    <div class="dashboard_card_icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ff9138"><path d="M223.5-103.5Q200-127 200-160t23.5-56.5Q247-240 280-240t56.5 23.5Q360-193 360-160t-23.5 56.5Q313-80 280-80t-56.5-23.5Zm400 0Q600-127 600-160t23.5-56.5Q647-240 680-240t56.5 23.5Q760-193 760-160t-23.5 56.5Q713-80 680-80t-56.5-23.5ZM246-720l96 200h280l110-200H246Zm-38-80h590q23 0 35 20.5t1 41.5L692-482q-11 20-29.5 31T622-440H324l-44 80h480v80H280q-45 0-68-39.5t-2-78.5l54-98-144-304H40v-80h130l38 80Zm134 280h280-280Z"/></svg>
                    </div>
                    <p>Cart Items</p>
                </div>
                <div class="dashboard_card_text">
                    <h2>{{ $userCartCount }}</h2>
                    <span>Items ready to checkout</span>
                </div>
            </div>

            <div class="dashboard_card">
                <div class="dashboard_card_row"> 
                    <div class="dashboard_card_icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ff9138"><path d="M200-200v-200h240v200-200H200v200Zm480-360ZM40-120v-400l280-200 280 200-28.5 28.5L543-463 320-622 120-480v280h80v-200h240v280h-80v-200h-80v200H40Zm880-720v405q-17-18-37-32.5T840-493v-267H480v56l-80-58v-78h520ZM680-600h80v-80h-80v80Zm40 560q-83 0-141.5-58.5T520-240q0-83 58.5-141.5T720-440q83 0 141.5 58.5T920-240q0 83-58.5 141.5T720-40Zm-20-80h40v-100h100v-40H740v-100h-40v100H600v40h100v100Z"/></svg>
                    </div>
                    <p>Saved Addresses</p>
                </div>
                <div class="dashboard_card_text">
                    <h2>{{ $userAddressCount }}</h2>
                    <span>Delivery locations</span>
                </div>
            </div>
        </div>

        <div class="dashboard_quick_actions">
            <a href="http://localhost:5173/Menu">Order Food</a>
            <a href="/orders">My Orders</a>
            <a href="/cart">My Cart ({{ $userCartCount }})</a>
            <a href="/wishlist">My Wishlist ({{ $userWishlistCount }})</a>
            <a href="/profile">Profile Settings</a>
            <form class="toggle_form" method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dashboard_logout_btn">Logout</button>
            </form>
        </div>

        <div class="dashboard_grid">
            
            <div class="dashboard_table_box">
                <div class="box_title_row">
                    <h3>My Recent Orders</h3>
                    <a href="/orders" class="view_all_btn">View All Orders →</a>
                </div>

                <div class="dashboard_table_wrapper">
                    <table class="dashboard_table">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($userRecentOrders as $order)
                                <tr>
                                    <td><strong>{{ $order->order_number ?: '#' . $loop->iteration }}</strong></td>
                                    <td>
                                        @if($order->items && $order->items->count() > 0)
                                            {{ $order->items->pluck('food_name')->take(2)->join(', ') }}
                                            @if($order->items->count() > 2)
                                                <small style="color: #888;">+{{ $order->items->count() - 2 }} more</small>
                                            @endif
                                        @else
                                            Food Item
                                        @endif
                                    </td>
                                    <td><strong>₹{{ number_format($order->total_amount, 2) }}</strong></td>
                                    <td><span class="order_status {{ strtolower($order->status) }}">{{ ucfirst($order->status) }}</span></td>
                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('orders.show', $order->id) }}" class="dashboard_top_btn" style="padding: 6px 14px; font-size: 12px;">Details</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align: center; padding: 35px 20px;">
                                        <div style="font-size: 32px; margin-bottom: 8px;">🍽️</div>
                                        <h4 style="font-size: 16px; margin-bottom: 6px;">No orders placed yet</h4>
                                        <p style="color: #6b7280; font-size: 13px; margin-bottom: 16px;">Delicious food is waiting for you! Browse our menu to make your first order.</p>
                                        <a href="http://localhost:5173/Menu" class="dashboard_top_btn" style="padding: 8px 18px; font-size: 13px;">Explore Menu</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="dashboard_side_boxes">
                {{-- Profile Box --}}
                <div class="small_dashboard_box" style="text-align: center; padding: 25px 20px;">
                    <div style="margin-bottom: 12px;">
                        <img 
                            src="{{ Auth::user()->user_image 
                                ? asset('storage/' . Auth::user()->user_image) 
                                : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=ff7e00&color=fff' }}" 
                            alt="{{ Auth::user()->name }}"
                            style="width: 75px; height: 75px; border-radius: 50%; object-fit: cover; border: 3px solid #ff7e00; margin: 0 auto;"
                        >
                    </div>

                    <h3 style="font-size: 18px; margin-bottom: 4px; color: #111827;">{{ Auth::user()->name }}</h3>
                    <p style="font-size: 13px; color: #6b7280; margin-bottom: 8px;">{{ Auth::user()->email }}</p>
                    <span style="display: inline-block; background: #fff7ed; color: #ea580c; border: 1px solid #ffedd5; font-size: 12px; font-weight: 600; padding: 4px 12px; border-radius: 20px; margin-bottom: 16px;">Food Explorer 🍕</span>

                    <div>
                        <a href="/profile" class="dashboard_top_btn" style="width: 100%; display: block; text-align: center; padding: 10px 14px;">Edit Profile</a>
                    </div>
                </div>

                {{-- Quick Shortcuts --}}
                <div class="small_dashboard_box">
                    <div class="box_title_row">
                        <h3>Quick Navigation</h3>
                    </div>

                    <div class="overview_item">
                        <span>Items in Cart</span>
                        <a href="/cart" style="color: #ff7e00; font-weight: 600; text-decoration: none;">{{ $userCartCount }} View →</a>
                    </div>

                    <div class="overview_item">
                        <span>Items in Wishlist</span>
                        <a href="/wishlist" style="color: #ff7e00; font-weight: 600; text-decoration: none;">{{ $userWishlistCount }} View →</a>
                    </div>

                    <div class="overview_item">
                        <span>Delivery Addresses</span>
                        <a href="/profile" style="color: #ff7e00; font-weight: 600; text-decoration: none;">{{ $userAddressCount }} View →</a>
                    </div>

                    <div class="overview_item">
                        <span>Customer Support</span>
                        <a href="http://localhost:5173/contact" style="color: #ff7e00; font-weight: 600; text-decoration: none;">Contact Us →</a>
                    </div>
                </div>
            </div>

        </div>

    @endif

    @include('components.usable.footer')

</div>

@endsection