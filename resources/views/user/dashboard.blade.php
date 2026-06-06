@extends('layouts.allUser')

@section('userContent')

<div class="dashboard_container">

    <!-- TOP BAR -->
    <div class="dashboard_top modern_top">
        <div>
            <h2>Welcome back, {{ Auth::user()->name }} </h2>
            <p>Let’s order something amazing today </p>
        </div>

        <div class="quick_actions">
    
            <a href="/menu" class="btn_primary">
                <svg class="btn_icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="9" cy="21" r="1"/>
                    <circle cx="20" cy="21" r="1"/>
                    <path d="M1 1h4l2.5 12h11.5l2-8H6"/>
                </svg>
                Order Now
            </a>

            <a href="/orders" class="btn_outline">
                <svg class="btn_icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="16" rx="2"/>
                    <path d="M7 8h10M7 12h8M7 16h6"/>
                </svg>
                My Orders
            </a>

        </div>
    </div>

    <!-- STATS -->
    <div class="dashboard_cards modern_cards">

        <div class="card stat_card">
            <h3>Total Orders</h3>
            <p>12</p>
            <span class="svg-icons"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="m691-150 139-138-42-42-97 95-39-39-42 43 81 81ZM240-600h480v-80H240v80ZM720-40q-83 0-141.5-58.5T520-240q0-83 58.5-141.5T720-440q83 0 141.5 58.5T920-240q0 83-58.5 141.5T720-40ZM120-80v-680q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v267q-19-9-39-15t-41-9v-243H200v562h243q5 31 15.5 59T486-86l-6 6-60-60-60 60-60-60-60 60-60-60-60 60Zm120-200h203q3-21 9-41t15-39H240v80Zm0-160h284q38-37 88.5-58.5T720-520H240v80Zm-40 242v-562 562Z"/></svg></span>
        </div>

        <div class="card stat_card">
            <h3>Wishlist</h3>
            <p>5</p>
            <span class="svg-icons"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="m480-120-58-52q-101-91-167-157T150-447.5Q111-500 95.5-544T80-634q0-94 63-157t157-63q52 0 99 22t81 62q34-40 81-62t99-22q94 0 157 63t63 157q0 46-15.5 90T810-447.5Q771-395 705-329T538-172l-58 52Zm0-108q96-86 158-147.5t98-107q36-45.5 50-81t14-70.5q0-60-40-100t-100-40q-47 0-87 26.5T518-680h-76q-15-41-55-67.5T300-774q-60 0-100 40t-40 100q0 35 14 70.5t50 81q36 45.5 98 107T480-228Zm0-273Z"/></svg></span>
        </div>

        <div class="card stat_card">
            <h3>Cart</h3>
            <p>3</p>
            <span class="svg-icons">🛒</span>
        </div>

        <div class="card stat_card highlight_card">
            <h3>Saved Address</h3>
            <p>2</p>
            <span class="svg-icons"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M200-200v-200h240v200-200H200v200Zm480-360ZM40-120v-400l280-200 280 200-28.5 28.5L543-463 320-622 120-480v280h80v-200h240v280h-80v-200h-80v200H40Zm880-720v405q-17-18-37-32.5T840-493v-267H480v56l-80-58v-78h520ZM680-600h80v-80h-80v80Zm40 560q-83 0-141.5-58.5T520-240q0-83 58.5-141.5T720-440q83 0 141.5 58.5T920-240q0 83-58.5 141.5T720-40Zm-20-80h40v-100h100v-40H740v-100h-40v100H600v40h100v100Z"/></svg></span>
        </div>

    </div>

    <!-- GRID -->
    <div class="dashboard_grid">

        <!-- ORDERS -->
        <div class="dashboard_section modern_section">
            <div class="section_header">
                <h3>Recent Orders</h3>
                <a href="/orders">View All →</a>
            </div>

            <div class="order_list">

    <div class="order_item">
        <div class="order_left">
            <h4>#1234</h4>
            <p>Burger Combo</p>
        </div>

        <div class="order_right">
            <span class="status delivered">Delivered</span>
            <strong>₹250</strong>
        </div>
    </div>

    <div class="order_item">
        <div class="order_left">
            <h4>#1235</h4>
            <p>Pizza</p>
        </div>

        <div class="order_right">
            <span class="status pending">Preparing</span>
            <strong>₹400</strong>
        </div>
    </div>

</div>
        </div>

        <!-- PROFILE -->
        <div class="profile_box modern_profile">
            <div class="profile_bg"></div>

            <img 
                src="{{ Auth::user()->user_image 
                    ? asset('storage/' . Auth::user()->user_image) 
                    : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}" 
                alt="user"
            >

            <h4>{{ Auth::user()->name }}</h4>
            <p>Food Explorer </p>

            <a href="/user/profile" class="btn_primary small">Edit Profile</a>
        </div>

    </div>  

</div>

@endsection