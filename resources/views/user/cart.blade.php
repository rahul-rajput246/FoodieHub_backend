@extends('layouts.allUser')

@section('userContent')
<div class="dashboard_container">

    <div class="dashboard_top modern_top">
        <div>
            <h2>My Cart</h2>
            <p>Review your selected items before placing your order.</p>
        </div>
    </div>

    <div class="cart_layout">
        <div class="dashboard_section modern_section">
            <div class="section_header">
                <h3>Cart Items</h3>
            </div>

            @if($cartItems->count())
                <div class="cart_list">
                    @foreach($cartItems as $item)
                        @if($item->food)
                            <div class="cart_item_card">
                                <div class="cart_item_left">
                                    <img
                                        src="{{ $item->food->food_image ? asset($item->food->food_image) : asset('favicon.png') }}"
                                        alt="{{ $item->food->food_name }}"
                                        class="cart_item_img"
                                    >

                                    <div>
                                        <h4>{{ $item->food->food_name }}</h4>
                                        <p>{{ $item->food->food_subtitle }}</p>
                                        <strong>Rs. {{ number_format($item->food->food_price, 2) }}</strong>
                                    </div>
                                </div>

                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="remove_btn"
                                        onclick="return confirm('Remove this item?')">
                                        Remove
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endforeach
                </div>
            @else
                <div style="padding: 20px 0;">
                    <p style="margin-bottom: 20px;">Your cart is empty.</p>
                    <a href="http://localhost:5173/Menu" class="btn_primary">Browse Menu</a>
                </div>
            @endif
        </div>

        <div class="profile_box modern_profile cart_summary_box">
            <h3 style="margin-bottom: 15px;">Cart Summary</h3>
            <p><strong>Subtotal:</strong> Rs. {{ number_format($subtotal, 2) }}</p>
            <p><strong>Delivery:</strong> Free</p>
            <p><strong>Total:</strong> Rs. {{ number_format($subtotal, 2) }}</p>
             @if($cartItems->count())
                <div>
                    <a href="http://localhost:5173/cart" class="btn_primary cart_btn" style="width: 100%; display: inline-block; text-align: center; margin-left: 0;">
                        Buy Now
                    </a>
                </div>
            @endif

        </div>
    </div>

</div>
@endsection
