@extends('layouts.allAdmin')

@section('content')

<div class="main_dashboard">

    <div class="pages_header">
        <div class="pages_header_left">
            <p class="dashboard_small_text">FoodieHub Admin</p>
            <h1>Manage About Page</h1>
            <p class="pages_desc">
                Update aboutpage banner, section headings, special offer content, and testimonial section text.
            </p>
        </div>
    </div>

    <form action="{{ route('about_update') }}" method="POST" enctype="multipart/form-data" class="page_form_wrapper">
        @csrf

        <div class="page_form_grid">

            <!-- About BANNER -->

            <div class="main_form_box">

                <input type="hidden" name="pages" value="about">

                <div class="form_card_title_row">
                    <h3>About Banner</h3>
                    <p>Main hero section content</p>
                </div>

                <div class="page_form_card">

                    <div class="form_group">
                        <label>Banner Subtitle</label>
                        <input type="text" name="about_banner_subtitle" placeholder="Enter banner subtitle"
                            value="{{ old('subtitle' , $content['about_banner']['subtitle']) }}">
                    </div>

                    <div class="form_group">
                        <label>Banner Title First</label>
                        <input type="text" name="about_banner_title" placeholder="Enter first title"
                            value="{{ old('title1' , $content['about_banner']['title1']) }}">
                    </div>

                    <div class="form_group">
                        <label>Banner Title Second ( color title )</label>
                        <input type="text" name="about_banner_title_second" placeholder="Enter second title"
                            value="{{ old('title2', $content['about_banner']['title2']) }}">
                    </div>

                    <div class="form_group">
                        <label>Banner Title Third</label>
                        <input type="text" name="about_banner_title_third" placeholder="Enter third title"
                            value="{{ old('color_title', $content['about_banner']['color_title']) }}">
                    </div>

                    <div class="form_group">
                        <label>Banner Description</label>
                        <textarea name="about_banner_description" rows="4"
                            placeholder="Enter banner description">{{ old('desc', $content['about_banner']['desc'] ?? '') }}</textarea>
                    </div>

                    <div class="form_row_2">
                        <div class="form_group">
                            <label>Button 1 Text</label>
                            <input type="text" name="about_banner_btn1_text" placeholder="Enter button 1 text"
                                value="{{ old('btn_text1', $content['about_banner']['btn_text1']) }}">
                        </div>

                        <div class="form_group">
                            <label>Button 1 Link</label>
                            <input type="text" name="about_banner_btn1_link" placeholder="/cart"
                                value="{{ old('btn_url1', $content['about_banner']['btn_url1']) }}">
                        </div>
                    </div>

                    <div class="form_row_2">
                        <div class="form_group">
                            <label>Button 2 Text</label>
                            <input type="text" name="about_banner_btn2_text" placeholder="Enter button 2 text"
                                value="{{ old('btn_text2', $content['about_banner']['btn_text2']) }}">
                        </div>

                        <div class="form_group">
                            <label>Button 2 Link</label>
                            <input type="text" name="about_banner_btn2_link" placeholder="/contact"
                                value="{{ old('btn_url2', $content['about_banner']['btn_url2']) }}">
                        </div>
                    </div>

                    <div class="form_group">

                        @if(!empty($content['about_banner']['image']))
                        <div style="margin-bottom:10px;">
                            <img src="{{ asset('storage/' . $content['about_banner']['image'] ?? '') }}" width="120"
                                height="120" object-fit=contain alt="About Banner">
                        </div>
                        @endif

                        <label>Banner Image</label>
                        <input type="file" name="about_banner_image">
                    </div>
                </div>
            </div>

            <!-- About Our Story -->

            <div class="main_form_box">

                <div class="form_card_title_row">
                    <h3>About Our Story</h3>
                    <p>Main hero section content</p>
                </div>

                <div class="page_form_card">

                    <div class="form_group">
                        <label>Our Story Subtitle</label>
                        <input type="text" name="about_our_story_subtitle" placeholder="Enter banner subtitle"
                            value="{{ old('subtitle' , $content['About_Our_Story']['subtitle']) }}">
                    </div>

                    <div class="form_group">
                        <label>Our Story Title</label>
                        <input type="text" name="about_our_story_title" placeholder="Enter title"
                            value="{{ old('title',$content['About_Our_Story']['title']) }}">
                    </div>

                    <div class="form_group">
                        <label>Our Story Description 1</label>
                        <input type="text" name="about_our_story_description1" placeholder="Enter description 1"
                            value="{{ old('desc1',$content['About_Our_Story']['desc1']) }}">
                    </div>

                    <div class="form_group">
                        <label>Our Story Description 2</label>
                        <input type="text" name="about_our_story_description2" placeholder="Enter description 2"
                            value="{{ old('desc2',$content['About_Our_Story']['desc2']) }}">
                    </div>

                    <div class="form_row_2">
                        <div class="form_group">
                            <label>Button 1 Text</label>
                            <input type="text" name="about_our_story_btn1_text" placeholder="Enter button 1 text"
                                value="{{ old('btn_text',$content['About_Our_Story']['btn_text']) }}">
                        </div>

                        <div class="form_group">
                            <label>Button 1 Link</label>
                            <input type="text" name="about_our_story_btn1_link" placeholder="/menu"
                                value="{{ old('btn_url',$content['About_Our_Story']['btn_url']) }}">
                        </div>
                    </div>

                    <div class="form_group">

                        @if(!empty($content['about_banner']['image'] ?? ''))
                        <div style="margin-bottom:10px;">
                            <img src="{{ asset('storage/' . $content['about_our_story']['image'] ?? '') }}" width="120"
                                height="120" object-fit=contain alt="About Banner">
                        </div>
                        @endif

                        <label>Our Story Image</label>
                        <input type="file" name="about_our_story_image">
                    </div>

                </div>
            </div>

            <!-- About Our Specialisation -->

            <div class="main_form_box">

                <div class="form_card_title_row">
                    <h3>About Our Specialities</h3>
                    <p>Main hero section content</p>
                </div>

                <div class="page_form_card about_spec_box">

                    <div class="form_group">
                        <label>Our Specialities Subtitle</label>
                        <input type="text" name="about_our_spec_subtitle" placeholder="Enter banner subtitle"
                            value="{{ old('subtitle' , $content['about_special']['subtitle']) }}">
                    </div>

                    <div class="form_group">
                        <label>Our Specialities Title</label>
                        <input type="text" name="about_our_spec_title" placeholder="Enter title"
                            value="{{ old('title', $content['about_special']['title']) }}">
                    </div>

                    <div class="form_group">
                        <label>Our Specialities Description</label>
                        <input type="text" name="about_our_spec_description" placeholder="Enter description"
                            value="{{ old('desc', $content['about_special']['desc']) }}">
                    </div>

                    @php

                    $about_spec = old('about_spec_items' , $content['about_special']['items'] ?? []);

                    if(count($about_spec) < 4){ $about_spec=array_pad($about_spec , 4 , ['box_title'=> '' , 'box_desc'
                        => '']);
                        }

                        @endphp

                        @foreach($about_spec as $index => $item)

                            <div class="form_group faq_box">
                                <label>Our Specialities Box {{ $index + 1 }}</label>
                                <input type="text" name="about_spec_items[{{ $index }}][box_title]"
                                    placeholder="Enter banner subtitle" value="{{ $item['box_title'] ?? '' }}">
                            </div>

                            <div class="form_group">
                                <label>Our Specialities Box {{ $index + 1 }}</label>
                                <input type="text" name="about_spec_items[{{ $index }}][box_desc]"
                                    placeholder="Enter banner subtitle" value="{{ $item['box_desc'] ?? '' }}">
                            </div>

                            <div class="form_group">

                                @if(!empty($item['image']))
                                <div style="margin-bottom:10px;">
                                    <img src="{{ asset('storage/' . $item['image']) }}"
                                        width="80" height="50" object-fit=contain alt="About Banner">
                                </div>
                                @endif

                                <input type="hidden" name="about_spec_items[{{ $index }}][old_image]" value="{{ $item['image'] ?? '' }}">

                                <label>Our Specialisation Image {{ $index + 1 }}</label>
                                <input type="file" name="about_spec_items[{{ $index }}][image]">
                            </div>

                        @endforeach

                </div>

                <div class="wcu_add_more_btn_box">
                    <button type="button" id="add_spec" class="btn btn-primary">Add More</button>
                </div>

            </div>

            <!-- SPECIAL OFFER -->

            <div class="main_form_box">

                <div class="form_card_title_row">
                    <h3>About Special Offer Section</h3>
                    <p>Offer banner content</p>
                </div>

                <div class="page_form_card">

                    <div class="form_group">
                        <label>About Offer Subtitle</label>
                        <input type="text" name="about_offer_subtitle" placeholder="Enter offer subtitle"
                            value="{{ old('subtitle',$content['aboutOffer']['subtitle'] ?? '') }}">
                    </div>

                    <div class="form_group">
                        <label>About Offer Title</label>
                        <input type="text" name="about_offer_title" placeholder="Enter offer title"
                            value="{{ old('title',$content['aboutOffer']['subtitle'] ?? '') }}">
                    </div>

                    <div class="form_group">
                        <label>About Offer Description</label>
                        <textarea name="about_offer_description" rows="4"
                            placeholder="Enter offer description">{{ old('desc',$content['aboutOffer']['desc'] ?? '') }}</textarea>
                    </div>

                    <div class="form_row_2">
                        <div class="form_group">
                            <label>About Offer Button Text</label>
                            <input type="text" name="about_offer_btn_text" placeholder="Order Now"
                                value="{{ old('btn_text1',$content['aboutOffer']['btn_text1'] ?? '') }}">
                        </div>

                        <div class="form_group">
                            <label>Offer Button Link</label>
                            <input type="text" name="about_offer_btn_link" placeholder="/cart"
                                value="{{ old('btn_url1',$content['aboutOffer']['btn_url1'] ?? '') }}">
                        </div>
                    </div>

                    <div class="form_row_2">
                        <div class="form_group">
                            <label>About Offer Button Text 2</label>
                            <input type="text" name="about_offer_btn_text2" placeholder="Order Now"
                                value="{{ old('btn_text2',$content['aboutOffer']['btn_text2'] ?? '') }}">
                        </div>

                        <div class="form_group">
                            <label>Offer Button Link 2</label>
                            <input type="text" name="about_offer_btn_link2" placeholder="/menu"
                                value="{{ old('btn_url2',$content['aboutOffer']['btn_url2'] ?? '') }}">
                        </div>
                    </div>

                </div>
            </div>

            <div class="page_form_submit_box">
                <button type="submit" class="save_page_btn">Save about Page Content</button>
            </div>

    </form>

    @include('components.usable.footer')

</div>

@endsection