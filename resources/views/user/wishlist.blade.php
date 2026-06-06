@extends('layouts.allUser')

@section('userContent')
<div class="dashboard_container">

    <div class="dashboard_top modern_top">
        <div>
            <h2>My Wishlist</h2>
            <p>Items you saved for later.</p>
        </div>
    </div>

    <div class="wish_layout">
        <div class="dashboard_section modern_section">
            <div class="section_header">
                <h3>Wishlist Items</h3>
            </div>

            @if($wishlistItems->count())
                <div class="cart_list">
                    @foreach($wishlistItems as $item)
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

                                <div class="cart_item_right">
                                    <form action="{{ route('wishlist.addToCart', $item->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn_primary">Add to Cart</button>
                                    </form>

                                    <form action="{{ route('wishlist.remove', $item->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn_outline">Remove</button>
                                    </form>
                                </div>

                            </div>
                        @endif
                    @endforeach
                </div>
            @else
                <div style="padding: 20px 0;">
                    <p style="margin-bottom: 20px;">Your wishlist is empty.</p>
                    <a href="http://localhost:5173/Menu" class="btn_primary">Browse Menu</a>
                </div>
            @endif
        </div>
    </div>

</div>
@endsection
