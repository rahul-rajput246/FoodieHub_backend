@if ($errors->any())
    <div style="color:red; margin-bottom:20px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@extends('layouts.allAdmin')

@section('content')

<div class="main_allfood_container">

    <div class="pages_header allfood_header">
        <div>
            <p class="dashboard_small_text">FoodieHub Admin</p>
            <h1>Create New Food</h1>
            <p class="pages_desc">
                Add a new food item with all important details like category, type, pricing, image, rating and status.
            </p>
        </div>
    </div>

    <div class="page_form_wrapper">
        <form action="{{ route('food.update' , $food->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="page_form_card">

                <!-- Basic Details -->
                <div class="main_form_box">
                    <div class="form_card_title_row">
                        <h3>Basic Details</h3>
                        <p>Enter main food information here.</p>
                    </div>

                    <div class="form_group">
                        <label for="name">Food Name</label>
                        <input type="text" id="name" name="food_name"
                            value="{{ old('food_name' , $food->food_name ?? '') }}">
                    </div>

                    <div class="form_group">
                        <label for="slug">Slug</label>
                        <input type="text" id="slug" name="food_slug" value="{{ old('food_slug' , $food->food_slug ?? '')  }}">
                    </div>

                    <div class=" form_group">
                        <label for="name">Subtitle</label>
                        <input type="text" id="name" name="food_subtitle" value="{{ old('food_subtitle' , $food->food_subtitle ?? '') }}">
                    </div>

                    <div class=" form_group">
                        <label for="description">Description</label>
                        <textarea id="description" name="food_desc"
                            placeholder="Write food description">{{ old('food_desc' , $food->food_desc ?? '') }}</textarea>
                    </div>

                    <div class="form_group">
                        @if($food->food_image)
                            <div style="margin-bottom:10px;">
                                <img src="{{ asset($food->food_image) }}" width="120"
                                    height="120" object-fit=contain alt="Home Banner">
                            </div>
                        @endif
                        <label for="image">Food Image</label>
                        <input type="file" id="image" name="food_image">
                    </div>
                </div>

                <!-- Category Details -->
                <div class="main_form_box">
                    <div class="form_card_title_row">
                        <h3>Category Details</h3>
                        <p>Select food category and related information.</p>
                    </div>

                    <div class="form_group">
                        <label for="category_id">Category</label>
                        <select name="category_id" id="category_id" class="custom_select">
                            <option value="">Select Category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $food->category_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form_group">
                        <label for="type">Type</label>
                        <select id="type" name="food_type" class="custom_select">
                            <option value="">Select Type</option>
                            <option value="0" {{old('food_type' , $food->food_type == 0 ? 'selected' : '')}}>Veg</option>
                            <option value="1" {{old('food_type' , $food->food_type == 1 ? 'selected' : '')}}>Non Veg</option>
                            <option value="2" {{old('food_type' , $food->food_type == 2 ? 'selected' : '')}}>Drink</option>
                            <option value="3" {{old('food_type' , $food->food_type == 3 ? 'selected' : '')}}>Dessert</option>
                        </select>
                    </div>

                    <div class="form_group">
                        <label for="name">Food Stock</label>
                        <input type="number" id="stock" name="food_stock" value="{{ old('food_stock' , $food->food_stock ?? '') }}">
                    </div>

                </div>

                <!-- Pricing Details -->
                <div class="main_form_box">
                    <div class="form_card_title_row">
                        <h3>Pricing Details</h3>
                        <p>Add food pricing and rating info.</p>
                    </div>

                    <div class="form_row_2">
                        <div class="form_group">
                            <label for="price">Price</label>
                            <input type="number" step="0.01" id="price" name="food_price" value="{{ old('food_price' , $food->food_price ?? '') }}">
                        </div>

                        <div class="form_group">
                            <label for="old_price">Old Price</label>
                            <input type="number" step="0.01" id="old_price" name="food_old_price"
                               value="{{ old('food_old_price' , $food->food_old_price ?? '') }}">
                        </div>
                    </div>

                    <div class="form_row_2">
                        <div class="form_group">
                            <label for="rating">Rating</label>
                            <input type="number" step="0.1" min="0" max="5" id="rating" name="food_rating" value="{{ old('food_rating' , $food->food_rating ?? '') }}">
                        </div>

                        <div class="form_group">
                            <label for="preparation_time">Preparation Time</label>
                            <input type="text" id="preparation_time" name="food_preparation_time" value="{{ old('food_preparation_time' , $food->food_preparation_time ?? '') }}">
                        </div>
                    </div>
                </div>

                <!-- Status Settings -->
                <div class="main_form_box">
                    <div class="form_card_title_row">
                        <h3>Status Settings</h3>
                        <p>Manage visibility and special flags.</p>
                    </div>

                    <div class="form_group">
                        <label for="is_popular">Is Popular</label>
                        <select id="is_popular" name="food_is_popular" class="custom_select">
                            <option value="">Select Option</option>
                            <option value="0" {{old('food_is_popular' , $food->food_is_popular == 0 ? 'selected' : '')}} >No</option>
                            <option value="1" {{old('food_is_popular' , $food->food_is_popular == 1 ? 'selected' : '')}} >Yes</option>
                        </select>
                    </div>

                    <div class="form_group">
                        <label for="is_featured">Is Featured</label>
                        <select id="is_featured" name="food_is_featured" class="custom_select">
                            <option value="">Select Option</option>
                            <option value="0" {{old('food_is_featured' , $food->food_is_featured == 0 ? 'selected' : '')}} >No</option>
                            <option value="1" {{old('food_is_featured' , $food->food_is_featured == 1 ? 'selected' : '')}} >Yes</option>
                        </select>
                    </div>

                    <div class="form_group">
                        <label for="status">Status</label>
                        <select id="status" name="food_status" class="custom_select">
                            <option value="">Select Status</option>
                            <option value="0" {{old('food_status' , $food->food_status == 0 ? 'selected' : '')}} >Inactive</option>
                            <option value="1" {{old('food_status' , $food->food_status == 1 ? 'selected' : '')}} >Active</option>
                        </select>
                    </div>
                </div>

            </div>

            <div class="page_form_submit_box">
                <button type="submit" class="save_page_btn" name="food_save">Save Food</button>
            </div>

        </form>
    </div>

    @include('components.usable.footer')

</div>

@endsection