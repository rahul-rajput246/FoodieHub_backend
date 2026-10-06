@extends('layouts.allAdmin')

@section('content')

<div class="main_dashboard">

    <div class="dashboard_header">
        <div class="dashboard_header_left">
            <p class="dashboard_small_text">Customer Portal</p>
            <h1>My Wishlist</h1>
            <p class="dashboard_desc">Your personal collection of saved favorite food items.</p>
        </div>

        <div class="dashboard_header_right">
            <a href="http://localhost:5173/Menu" class="dashboard_top_btn">+ Explore Menu</a>
            <a href="/cart" class="dashboard_top_btn" style="background: #374151;">View Cart</a>
        </div>
    </div>

    <div class="dashboard_table_box">
        <div class="box_title_row">
            <h3>Saved Items ({{ $wishlistItems->count() }})</h3>
        </div>

        @if($wishlistItems->count())
            <div class="dashboard_table_wrapper">
                <table class="dashboard_table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($wishlistItems as $item)
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
                                <td><strong>₹{{ number_format($item->food->food_price, 2) }}</strong></td>
                                <td>
                                    <div class="action_btn_group">
                                        <form action="{{ route('wishlist.addToCart', $item->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="action_btn edit_btn" style="border: none; cursor: pointer;">
                                                Add to Cart
                                            </button>
                                        </form>

                                        <form action="{{ route('wishlist.remove', $item->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="action_btn delete_btn" style="border: none; cursor: pointer;">
                                                Remove
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div style="text-align: center; padding: 40px 20px;">
                <div style="font-size: 36px; margin-bottom: 10px;">❤️</div>
                <h3 style="font-size: 18px; color: #111827; margin-bottom: 6px;">Your wishlist is empty</h3>
                <p style="color: #6b7280; font-size: 14px; margin-bottom: 18px;">Click the heart icon on any food item to save your favorites here!</p>
                <a href="http://localhost:5173/Menu" class="dashboard_top_btn">Explore Food Menu</a>
            </div>
        @endif
    </div>

    @include('components.usable.footer')

</div>

@endsection
