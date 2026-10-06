@extends('layouts.allAdmin')

@section('content')

<div class="main_dashboard">

    <div class="dashboard_header">
        <div class="dashboard_header_left">
            <p class="dashboard_small_text">Customer Portal</p>
            <h1>My Cart</h1>
            <p class="dashboard_desc">Review your selected delicious items before proceeding to checkout.</p>
        </div>

        <div class="dashboard_header_right">
            <a href="http://localhost:5173/Menu" class="dashboard_top_btn">+ Add More Food</a>
            <a href="/admin/dashboard" class="dashboard_top_btn" style="background: #374151;">Dashboard</a>
        </div>
    </div>

    <div class="dashboard_grid">

        <div class="dashboard_table_box">
            <div class="box_title_row">
                <h3>Cart Items ({{ $cartItems->count() }})</h3>
            </div>

            @if($cartItems->count())
                <div class="dashboard_table_wrapper">
                    <table class="dashboard_table">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $item)
                                @if($item->food)
                                <tr>
                                    <td>
                                        <div class="food_list_info">
                                            <div class="food_list_img">
                                                <img src="{{ $item->food->food_image ? asset($item->food->food_image) : asset('favicon.png') }}" alt="{{ $item->food->food_name }}">
                                            </div>
                                            <div class="food_list_text">
                                                <h4>{{ $item->food->food_name }}</h4>
                                                <p>{{ $item->food->food_subtitle }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>₹{{ number_format($item->food->food_price, 2) }}</td>
                                    <td><strong>{{ $item->quantity }}</strong></td>
                                    <td><strong>₹{{ number_format($item->food->food_price * $item->quantity, 2) }}</strong></td>
                                    <td>
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action_btn delete_btn" onclick="return confirm('Remove this item from your cart?')" style="border: none; cursor: pointer;">
                                                Remove
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div style="text-align: center; padding: 40px 20px;">
                    <div style="font-size: 36px; margin-bottom: 10px;">🛒</div>
                    <h3 style="font-size: 18px; color: #111827; margin-bottom: 6px;">Your cart is currently empty</h3>
                    <p style="color: #6b7280; font-size: 14px; margin-bottom: 18px;">Browse our menu to add some delicious food to your cart.</p>
                    <a href="http://localhost:5173/Menu" class="dashboard_top_btn">Browse Menu</a>
                </div>
            @endif
        </div>

        <div class="dashboard_side_boxes">
            <div class="small_dashboard_box">
                <div class="box_title_row">
                    <h3>Cart Summary</h3>
                </div>

                <div class="overview_item">
                    <span>Subtotal</span>
                    <strong>₹{{ number_format($subtotal, 2) }}</strong>
                </div>

                <div class="overview_item">
                    <span>Delivery Fee</span>
                    <strong style="color: #10b981;">FREE</strong>
                </div>

                <div class="overview_item" style="font-size: 16px; font-weight: 700; border-top: 2px solid #e5e7eb; margin-top: 10px; padding-top: 15px;">
                    <span>Total Amount</span>
                    <span style="color: #ff7e00;">₹{{ number_format($subtotal, 2) }}</span>
                </div>

                @if($cartItems->count())
                    <div style="margin-top: 20px;">
                        <a href="http://localhost:5173/cart" class="dashboard_top_btn" style="width: 100%; display: block; text-align: center; padding: 12px 16px; font-size: 15px;">
                            Proceed To Checkout →
                        </a>
                    </div>
                @endif
            </div>

            <div class="small_dashboard_box">
                <div class="box_title_row">
                    <h3>Quick Navigation</h3>
                </div>
                <div class="overview_item">
                    <a href="/wishlist" style="color: #ff7e00; text-decoration: none; font-weight: 500;">View My Wishlist →</a>
                </div>
                <div class="overview_item">
                    <a href="/orders" style="color: #ff7e00; text-decoration: none; font-weight: 500;">View Past Orders →</a>
                </div>
            </div>
        </div>

    </div>

    @include('components.usable.footer')

</div>

@endsection
