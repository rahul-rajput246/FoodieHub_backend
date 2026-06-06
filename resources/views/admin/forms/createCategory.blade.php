@extends('layouts.allAdmin')

@section('content')

<div class="main_allfood_container">

    <!-- HEADER -->
    <div class="pages_header allfood_header">
        <div>
            <p class="dashboard_small_text">FoodieHub Admin</p>
            <h1>Add New Category</h1>
            <p class="pages_desc">
                Create a new category for your food menu and control its status from here.
            </p>
        </div>

        <div>
            <a href="{{  route('admin.category') }}" class="create_food_btn">← Back to Categories</a>
        </div>
    </div>

    <!-- FORM -->
    <div class="page_form_wrapper">
        <div class="main_form_box">

            <div class="form_card_title_row">
                <h3>Category Details</h3>
                <p>Fill in the category information below.</p>
            </div>

            <form method="POST" action="{{ route('admin.category.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="form_group">
                    <label for="category_name">Category Name</label>
                    <input type="text" id="category_name" name="category_name" placeholder="Enter category name">
                </div>

                <div class="form_group">
                    <label for="category_slug">Category Slug</label>
                    <input type="text" id="category_slug" name="category_slug" placeholder="Enter category slug">
                </div>

                <div class="form_group">
                    <label for="category_status">Status</label>
                    <select id="category_status" name="category_status" class="custom_select">
                        <option value="">Select status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <div class="page_form_submit_box">
                    <button type="submit" class="save_page_btn">Save Category</button>
                </div>
            </form>

        </div>
    </div>

    @include('components.usable.footer')

</div>

@endsection