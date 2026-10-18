@extends('layouts.allAdmin')

@section('content')

<div class="main_allfood_container">

    <!-- HEADER -->
    <div class="pages_header allfood_header">
        <div>
            <p class="dashboard_small_text">FoodieHub Admin</p>
            <h1>Edit Category</h1>
            <p class="pages_desc">
                Update category details, change slug, or toggle category visibility.
            </p>
        </div>

        <div>
            <a href="{{ route('admin.category') }}" class="create_food_btn">← Back to Categories</a>
        </div>
    </div>

    <!-- FORM -->
    <div class="page_form_wrapper">
        <div class="main_form_box">

            <div class="form_card_title_row">
                <h3>Edit Category Details</h3>
                <p>Modify the category information below.</p>
            </div>

            <form method="POST" action="{{ route('admin.category.postUpdate', $category->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="form_group">
                    <label for="category_name">Category Name</label>
                    <input type="text" id="category_name" name="category_name" value="{{ old('category_name', $category->category_name) }}" placeholder="Enter category name" required>
                    @error('category_name')
                        <p style="color:red; font-size:13px; margin-top:4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form_group">
                    <label for="category_slug">Category Slug</label>
                    <input type="text" id="category_slug" name="category_slug" value="{{ old('category_slug', $category->category_slug) }}" placeholder="Enter category slug" required>
                    @error('category_slug')
                        <p style="color:red; font-size:13px; margin-top:4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form_group">
                    <label for="category_status">Status</label>
                    <select id="category_status" name="category_status" class="custom_select">
                        <option value="1" {{ old('category_status', $category->category_status) == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('category_status', $category->category_status) == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('category_status')
                        <p style="color:red; font-size:13px; margin-top:4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div class="page_form_submit_box">
                    <button type="submit" class="save_page_btn">Update Category</button>
                </div>
            </form>

        </div>
    </div>

    @include('components.usable.footer')

</div>

@endsection
