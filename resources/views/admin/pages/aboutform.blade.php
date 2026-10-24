@extends('layouts.allAdmin')

@section('content')

@php
    $banner = $content['about_banner'] ?? [];
    $story = $content['about_our_story'] ?? $content['About_Our_Story'] ?? [];
    $special = $content['about_special'] ?? [];
    $offer = $content['aboutOffer'] ?? [];
@endphp

<div class="main_dashboard">

    <div class="pages_header">
        <div class="pages_header_left">
            <p class="dashboard_small_text">FoodieHub Admin</p>
            <h1>Manage About Page</h1>
            <p class="pages_desc">
                Update about page banner, our story section, specialities cards, and special offer banner.
            </p>
        </div>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
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
                            value="{{ old('about_banner_subtitle', $banner['subtitle'] ?? '') }}">
                    </div>

                    <div class="form_group">
                        <label>Banner Title First</label>
                        <input type="text" name="about_banner_title" placeholder="Enter first title"
                            value="{{ old('about_banner_title', $banner['title1'] ?? '') }}">
                    </div>

                    <div class="form_group">
                        <label>Banner Title Second ( color title )</label>
                        <input type="text" name="about_banner_title_second" placeholder="Enter second title"
                            value="{{ old('about_banner_title_second', $banner['title2'] ?? '') }}">
                    </div>

                    <div class="form_group">
                        <label>Banner Title Third</label>
                        <input type="text" name="about_banner_title_third" placeholder="Enter third title"
                            value="{{ old('about_banner_title_third', $banner['color_title'] ?? '') }}">
                    </div>

                    <div class="form_group">
                        <label>Banner Description</label>
                        <textarea name="about_banner_description" rows="4"
                            placeholder="Enter banner description">{{ old('about_banner_description', $banner['desc'] ?? '') }}</textarea>
                    </div>

                    <div class="form_row_2">
                        <div class="form_group">
                            <label>Button 1 Text</label>
                            <input type="text" name="about_banner_btn1_text" placeholder="Enter button 1 text"
                                value="{{ old('about_banner_btn1_text', $banner['btn_text1'] ?? '') }}">
                        </div>

                        <div class="form_group">
                            <label>Button 1 Link</label>
                            <input type="text" name="about_banner_btn1_link" placeholder="/cart"
                                value="{{ old('about_banner_btn1_link', $banner['btn_url1'] ?? '') }}">
                        </div>
                    </div>

                    <div class="form_row_2">
                        <div class="form_group">
                            <label>Button 2 Text</label>
                            <input type="text" name="about_banner_btn2_text" placeholder="Enter button 2 text"
                                value="{{ old('about_banner_btn2_text', $banner['btn_text2'] ?? '') }}">
                        </div>

                        <div class="form_group">
                            <label>Button 2 Link</label>
                            <input type="text" name="about_banner_btn2_link" placeholder="/contact"
                                value="{{ old('about_banner_btn2_link', $banner['btn_url2'] ?? '') }}">
                        </div>
                    </div>

                    <div class="form_group">

                        @if(!empty($banner['image']))
                        <div style="margin-bottom:10px;">
                            <img src="{{ imageUrl($banner['image']) }}" width="140"
                                height="100" style="object-fit: cover; border-radius: 12px; border: 1px solid #e5e7eb; box-shadow: 0 4px 12px rgba(0,0,0,0.06);" alt="About Banner">
                            <p style="font-size: 12px; color: #6b7280; margin-top: 4px;">Current banner image</p>
                        </div>
                        @endif

                        <label>Banner Image</label>
                        <input type="file" name="about_banner_image" accept="image/*">
                    </div>
                </div>
            </div>

            <!-- About Our Story -->

            <div class="main_form_box">

                <div class="form_card_title_row">
                    <h3>About Our Story</h3>
                    <p>Story section content and photo</p>
                </div>

                <div class="page_form_card">

                    <div class="form_group">
                        <label>Our Story Subtitle</label>
                        <input type="text" name="about_our_story_subtitle" placeholder="Enter story subtitle"
                            value="{{ old('about_our_story_subtitle', $story['subtitle'] ?? '') }}">
                    </div>

                    <div class="form_group">
                        <label>Our Story Title</label>
                        <input type="text" name="about_our_story_title" placeholder="Enter story title"
                            value="{{ old('about_our_story_title', $story['title'] ?? '') }}">
                    </div>

                    <div class="form_group">
                        <label>Our Story Description 1</label>
                        <textarea name="about_our_story_description1" rows="3" placeholder="Enter description 1">{{ old('about_our_story_description1', $story['desc1'] ?? '') }}</textarea>
                    </div>

                    <div class="form_group">
                        <label>Our Story Description 2</label>
                        <textarea name="about_our_story_description2" rows="3" placeholder="Enter description 2">{{ old('about_our_story_description2', $story['desc2'] ?? '') }}</textarea>
                    </div>

                    <div class="form_row_2">
                        <div class="form_group">
                            <label>Button 1 Text</label>
                            <input type="text" name="about_our_story_btn1_text" placeholder="Enter button 1 text"
                                value="{{ old('about_our_story_btn1_text', $story['btn_text'] ?? '') }}">
                        </div>

                        <div class="form_group">
                            <label>Button 1 Link</label>
                            <input type="text" name="about_our_story_btn1_link" placeholder="/menu"
                                value="{{ old('about_our_story_btn1_link', $story['btn_url'] ?? '') }}">
                        </div>
                    </div>

                    <div class="form_group">

                        @if(!empty($story['image']))
                        <div style="margin-bottom:10px;">
                            <img src="{{ imageUrl($story['image']) }}" width="140"
                                height="100" style="object-fit: cover; border-radius: 12px; border: 1px solid #e5e7eb; box-shadow: 0 4px 12px rgba(0,0,0,0.06);" alt="Our Story Image">
                            <p style="font-size: 12px; color: #6b7280; margin-top: 4px;">Current story image</p>
                        </div>
                        @endif

                        <label>Our Story Image</label>
                        <input type="file" name="about_our_story_image" accept="image/*">
                    </div>

                </div>
            </div>

            <!-- About Our Specialisation -->

            <div class="main_form_box">

                <div class="form_card_title_row">
                    <h3>About Our Specialities</h3>
                    <p>What we serve cards and icons</p>
                </div>

                <div class="page_form_card about_spec_box">

                    <div class="form_group">
                        <label>Our Specialities Subtitle</label>
                        <input type="text" name="about_our_spec_subtitle" placeholder="Enter specialities subtitle"
                            value="{{ old('about_our_spec_subtitle', $special['subtitle'] ?? '') }}">
                    </div>

                    <div class="form_group">
                        <label>Our Specialities Title</label>
                        <input type="text" name="about_our_spec_title" placeholder="Enter title"
                            value="{{ old('about_our_spec_title', $special['title'] ?? '') }}">
                    </div>

                    <div class="form_group">
                        <label>Our Specialities Description</label>
                        <textarea name="about_our_spec_description" rows="3" placeholder="Enter description">{{ old('about_our_spec_description', $special['desc'] ?? '') }}</textarea>
                    </div>

                    @php
                        $about_spec = old('about_spec_items', $special['items'] ?? []);
                        if(count($about_spec) < 4){
                            $about_spec = array_pad($about_spec, 4, ['box_title' => '', 'box_desc' => '']);
                        }
                    @endphp

                    @foreach($about_spec as $index => $item)

                        <div class="form_group faq_box" style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #f3f4f6;">
                            <label>Our Specialities Box {{ $index + 1 }} Title</label>
                            <input type="text" name="about_spec_items[{{ $index }}][box_title]"
                                placeholder="Enter card title" value="{{ $item['box_title'] ?? '' }}">
                        </div>

                        <div class="form_group">
                            <label>Our Specialities Box {{ $index + 1 }} Description</label>
                            <input type="text" name="about_spec_items[{{ $index }}][box_desc]"
                                placeholder="Enter card description" value="{{ $item['box_desc'] ?? '' }}">
                        </div>

                        <div class="form_group">

                            @if(!empty($item['image']))
                            <div style="margin-bottom:10px;">
                                <img src="{{ imageUrl($item['image']) }}"
                                    width="100" height="70" style="object-fit: cover; border-radius: 8px; border: 1px solid #e5e7eb;" alt="Card Image">
                            </div>
                            @endif

                            <input type="hidden" name="about_spec_items[{{ $index }}][old_image]" value="{{ $item['image'] ?? '' }}">

                            <label>Speciality Image {{ $index + 1 }}</label>
                            <input type="file" name="about_spec_items[{{ $index }}][image]" accept="image/*">
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
                            value="{{ old('about_offer_subtitle', $offer['subtitle'] ?? '') }}">
                    </div>

                    <div class="form_group">
                        <label>About Offer Title</label>
                        <input type="text" name="about_offer_title" placeholder="Enter offer title"
                            value="{{ old('about_offer_title', $offer['title'] ?? '') }}">
                    </div>

                    <div class="form_group">
                        <label>About Offer Description</label>
                        <textarea name="about_offer_description" rows="4"
                            placeholder="Enter offer description">{{ old('about_offer_description', $offer['desc'] ?? '') }}</textarea>
                    </div>

                    <div class="form_row_2">
                        <div class="form_group">
                            <label>About Offer Button Text</label>
                            <input type="text" name="about_offer_btn_text" placeholder="Order Now"
                                value="{{ old('about_offer_btn_text', $offer['btn_text1'] ?? '') }}">
                        </div>

                        <div class="form_group">
                            <label>Offer Button Link</label>
                            <input type="text" name="about_offer_btn_link" placeholder="/cart"
                                value="{{ old('about_offer_btn_link', $offer['btn_url1'] ?? '') }}">
                        </div>
                    </div>

                    <div class="form_row_2">
                        <div class="form_group">
                            <label>About Offer Button Text 2</label>
                            <input type="text" name="about_offer_btn_text2" placeholder="Explore Menu"
                                value="{{ old('about_offer_btn_text2', $offer['btn_text2'] ?? '') }}">
                        </div>

                        <div class="form_group">
                            <label>Offer Button Link 2</label>
                            <input type="text" name="about_offer_btn_link2" placeholder="/menu"
                                value="{{ old('about_offer_btn_link2', $offer['btn_url2'] ?? '') }}">
                        </div>
                    </div>

                </div>
            </div>

            <div class="page_form_submit_box">
                <button type="submit" class="save_page_btn">Save About Page Content</button>
            </div>

        </div>
    </form>

    @include('components.usable.footer')

</div>

@endsection