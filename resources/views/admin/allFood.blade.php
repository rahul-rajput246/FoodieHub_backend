@extends('layouts.allAdmin')

@section('content')

<div class="main_allfood_container">

    <!-- HEADER -->
    <div class="pages_header allfood_header">
        <div>
            <p class="dashboard_small_text">FoodieHub Admin</p>
            <h1>All Food Items</h1>
            <p class="pages_desc">
                Manage your food items, pricing, stock and availability from here.
            </p>
        </div>

        <div>
            <a href="{{ route('admin.forms.createFood') }}" class="create_food_btn">+ Create New Food</a>
        </div>
    </div>

    <!-- OVERVIEW -->
    <div class="pages_overview_cards">
        <div class="mini_overview_card">
            <h3>Total Foods</h3>
            <h2>{{ $foods->count() }}</h2>
            <p>All items in database</p>
        </div>

        <div class="mini_overview_card">
            <h3>In Stock</h3>
            <h2>{{ $foods->where('food_stock', '>', 0)->count() }}</h2>
            <p>Available items</p>
        </div>

        <div class="mini_overview_card">
            <h3>Out of Stock</h3>
            <h2>{{ $foods->where('food_stock', '<=', 0)->count() }}</h2>
            <p>Unavailable items</p>
        </div>
    </div>

    <!-- TABLE -->
    <div class="allfood_table_box">

        <div class="box_title_row">
            <h3>Food Listing</h3>
        </div>

        <div class="dashboard_table_wrapper">
            <table class="dashboard_table allfood_table">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Food</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($foods as $food)

                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            <div class="food_list_info">
                                <div class="food_list_img">
                                    @if($food->food_image)
                                        <img src="{{ asset($food->food_image) }}">
                                    @endif
                                </div>
                                <div class="food_list_text">
                                    <h4>{{ $food->food_name }}</h4>
                                    <p>Crispy & spicy burger</p>
                                </div>
                            </div>
                        </td>

                        <td>{{ $food->category_name }}</td>
                        <td>{{ $food->food_price }}</td>

                        <td>
                            <span class="stock_badge in_stock">{{ $food->food_stock }}</span>
                        </td>

                        <td>
                            <span class="food_status {{ $food->food_status ? 'active' : 'inactive' }}">{{ $food->food_status ? 'Active' : 'Inactive' }}</span>
                        </td>

                        <td>
                            <div class="action_btn_group">
                                <a href="{{ route('food.edit', $food->id) }}" class="action_btn edit_btn">Edit</a>
                                <a href="{{ route('admin.food.delete', $food->id) }}" class="action_btn delete_btn"
                                    onclick="return confirm('Are you sure you want to delete this item?')">
                                    Delete
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