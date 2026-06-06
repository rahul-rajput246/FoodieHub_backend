@extends('layouts.allAdmin')

@section('content')

<div class="main_dashboard">

    <div class="pages_header">
        <div class="pages_header_left">
            <p class="dashboard_small_text">FoodieHub Admin</p>
            <h1>Manage menu Page</h1>
            <p class="pages_desc">
                Update menupage banner, section headings, special offer content, and testimonial section text.
            </p>
        </div>
    </div>

    <form action="{{ route('menu_update') }}" method="POST" enctype="multipart/form-data" class="page_form_wrapper">
        @csrf

        <div class="page_form_grid">

            <!-- MENU BANNER -->

            <div class="main_form_box">

            <input type="hidden" name="pages" value="menu">

                <div class="form_card_title_row">
                    <h3>Menu Banner</h3>
                    <p>Main hero section content</p>
                </div>

                <div class="page_form_card">

                    <div class="form_group">
                        <label>Banner Subtitle</label>
                        <input type="text" name="menu_banner_subtitle" placeholder="Enter banner subtitle" value="{{ old('subtitle', $content['menu_banner']['subtitle']) }}">
                    </div>

                    <div class="form_group">
                        <label>Banner Title First</label>
                        <input type="text" name="menu_banner_title" placeholder="Enter first title"
                            value="{{ old('title1', $content['menu_banner']['title1']) }}">
                    </div>

                    <div class="form_group">
                        <label>Banner Title Second ( color title )</label>
                        <input type="text" name="menu_banner_title_second" placeholder="Enter second title"
                            value="{{ old('title2', $content['menu_banner']['title2']) }}">
                    </div>

                     <div class="form_group">
                        <label>Banner Title Third</label>
                        <input type="text" name="menu_banner_title_third" placeholder="Enter third title"
                            value="{{ old('color_title' , $content['menu_banner']['color_title'] ?? '') }}">
                    </div>

                    <div class="form_group">
                        <label>Banner Description</label>
                        <textarea name="menu_banner_description" rows="4"
                            placeholder="Enter banner description">{{ old('desc', $content['menu_banner']['desc']) }}</textarea>
                    </div>

                    <div class="form_row_2">
                        <div class="form_group">
                            <label>Button 1 Text</label>
                            <input type="text" name="menu_banner_btn1_text" placeholder="Enter button 1 text"
                                value="{{ old('btn_text1', $content['menu_banner']['btn_text1']) }}">
                        </div>

                        <div class="form_group">
                            <label>Button 1 Link</label>
                            <input type="text" name="menu_banner_btn1_link" placeholder="/cart"
                                value="{{ old('btn_url1', $content['menu_banner']['btn_url1']) }}">
                        </div>
                    </div>

                    <div class="form_row_2">
                        <div class="form_group">
                            <label>Button 2 Text</label>
                            <input type="text" name="menu_banner_btn2_text" placeholder="Enter button 2 text"
                                value="{{ old('btn_text2', $content['menu_banner']['btn_text2']) }}">
                        </div>

                        <div class="form_group">
                            <label>Button 2 Link</label>
                            <input type="text" name="menu_banner_btn2_link" placeholder="/category"
                                value="{{ old('btn_url2', $content['menu_banner']['btn_url2']) }}">
                        </div>
                    </div>

                    <div class="form_group">

                        @if(!empty($content['menu_banner']['image']))
                        <div style="margin-bottom:10px;">
                            <img src="{{ asset('storage/' . $content['menu_banner']['image'] ?? '') }}" width="120"
                                height="120" object-fit=contain alt="Menu Banner">
                        </div>
                        @endif

                        <label>Banner Image</label>
                        <input type="file" name="menu_banner_image">
                    </div>
                </div>
            </div>

        <div class="page_form_submit_box">
            <button type="submit" class="save_page_btn">Save menu Page Content</button>
        </div>

    </form>

    @include('components.usable.footer')

</div>

@endsection