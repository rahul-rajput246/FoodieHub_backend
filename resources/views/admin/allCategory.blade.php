@extends('layouts.allAdmin')

@section('content')

<div class="main_allfood_container">

    <!-- HEADER -->
    <div class="pages_header allfood_header">
        <div>
            <p class="dashboard_small_text">FoodieHub Admin</p>
            <h1>All Categories</h1>
            <p class="pages_desc">
                Manage your food categories, organize menu sections and control visibility from here.
            </p>
        </div>

        <div>
            <a href="{{ route('admin.create.category') }}" class="create_food_btn">+ Create New Category</a>
        </div>
    </div>

    <!-- OVERVIEW -->
    <div class="pages_overview_cards">
        <div class="mini_overview_card">
            <h3>Total Categories</h3>
            <h2>{{ $category->count() }}</h2>
            <p>All categories in database</p>
        </div>

        <div class="mini_overview_card">
            <h3>Active Categories</h3>
            <h2>{{ $category->where('category_status', 1)->count() }}</h2>
            <p>Currently visible on website</p>
        </div>

        <div class="mini_overview_card">
            <h3>Hidden Categories</h3>
            <h2>{{ $category->where('category_status', 0)->count() }}</h2>
            <p>Not visible for customers</p>
        </div>
    </div>

    <!-- TABLE -->
    <div class="allfood_table_box">

        <div class="box_title_row">
            <h3>Category Listing</h3>
        </div>

        <div class="dashboard_table_wrapper">
            <table class="dashboard_table allfood_table category_table">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Slug</th>
                        <th>Total Items</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($category as $cat)

                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <div class="category_list_info">
                                <div class="category_list_text">
                                    <h4>{{ $cat->category_name }}</h4>
                                </div>
                            </div>
                        </td>
                        <td>{{$cat->category_slug}}</td>
                        <td><span class="category_count_badge">{{ $cat->foods_count }} Items</span></td>
                        <td>
                            <span class="food_status {{ $cat->category_status ? 'active' : 'inactive'}}">{{$cat->category_status ? 'Active' : 'Inactive'}}</span>
                        </td>
                        <td>
                            <div class="action_btn_group">
                                <a href="#" class="action_btn edit_btn">Edit</a>
                                <a href="#" class="action_btn delete_btn">Delete</a>
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