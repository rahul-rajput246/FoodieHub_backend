@extends('layouts.allAdmin')

@section('content')

<div class="main_dashboard">

    <div class="pages_header">
        <div class="pages_header_left">
            <p class="dashboard_small_text">FoodieHub Admin</p>
            <h1>Manage contact Page</h1>
            <p class="pages_desc">
                Update contactpage banner, section headings, special offer content, and testimonial section text.
            </p>
        </div>
    </div>

    <form action="{{ route('contact_update') }}" method="POST" enctype="multipart/form-data" class="page_form_wrapper">
        @csrf

        <div class="page_form_grid">

            <!-- Contact BANNER -->

            <div class="main_form_box">

            <input type="hidden" name="pages" value="contact">

                <div class="form_card_title_row">
                    <h3>Contact Banner</h3>
                    <p>Main hero section content</p>
                </div>

                <div class="page_form_card">

                    <div class="form_group">
                        <label>Banner Subtitle</label>
                        <input type="text" name="contact_banner_subtitle" placeholder="Enter banner subtitle" value="{{ old('contact_banner_subtitle',$content['contact_banner']['subtitle'] ?? '') }}">
                    </div>

                    <div class="form_group">
                        <label>Banner Title First</label>
                        <input type="text" name="contact_banner_title" placeholder="Enter first title"
                            value="{{ old('contact_banner_title',$content['contact_banner']['title1'] ?? '') }}">
                    </div>

                    <div class="form_group">
                        <label>Banner Title Second</label>
                        <input type="text" name="contact_banner_title_second" placeholder="Enter second title"
                            value="{{ old('banner_title_second',$content['contact_banner']['title2'] ?? '') }}">
                    </div>

                     <div class="form_group">
                        <label>Banner Title Third ( color title )</label>
                        <input type="text" name="contact_banner_title_third" placeholder="Enter third title"
                            value="{{ old('banner_title_third',$content['contact_banner']['color_title'] ?? '') }}">
                    </div>

                    <div class="form_group">
                        <label>Banner Description</label>
                        <textarea name="contact_banner_description" rows="4"
                            placeholder="Enter banner description">{{ old('banner_description',$content['contact_banner']['desc'] ?? '') }}</textarea>
                    </div>

                    <div class="form_row_2">
                        <div class="form_group">
                            <label>Button 1 Text</label>
                            <input type="text" name="contact_banner_btn1_text" placeholder="Enter button 1 text"
                                value="{{ old('banner_btn1_text',$content['contact_banner']['btn_text1'] ?? '') }}">
                        </div>

                        <div class="form_group">
                            <label>Button 1 Link</label>
                            <input type="text" name="contact_banner_btn1_link" placeholder="/menu"
                                value="{{ old('banner_btn1_link',$content['contact_banner']['btn_url1'] ?? '') }}">
                        </div>
                    </div>

                    <div class="form_row_2">
                        <div class="form_group">
                            <label>Button 2 Text</label>
                            <input type="text" name="contact_banner_btn2_text" placeholder="Enter button 2 text"
                                value="{{ old('banner_btn2_text',$content['contact_banner']['btn_text2'] ?? '') }}">
                        </div>

                        <div class="form_group">
                            <label>Button 2 Link</label>
                            <input type="text" name="contact_banner_btn2_link" placeholder="/contact#contact-form"
                                value="{{ old('banner_btn2_link',$content['contact_banner']['btn_url2'] ?? '') }}">
                        </div>
                    </div>

                    <div class="form_group">

                        @if(!empty($content['contact_banner']['image']))
                        <div style="margin-bottom:10px;">
                            <img src="{{ asset('storage/' . $content['contact_banner']['image'] ?? '') }}" width="120"
                                height="120" object-fit=contain alt="About Banner">
                        </div>
                        @endif

                        <label>Banner Image</label>
                        <input type="file" name="contact_banner_image">

                    </div>
                </div>
            </div>

            <!-- Contact Info Section -->

            <div class="main_form_box">

                <div class="form_card_title_row">
                    <h3>contact Info</h3>
                    <p>Main hero section content</p>
                </div>

                <div class="page_form_card home_faq_box">

                @php

                $contactInfoItems = old('contact_info_items' , $content['contact_info']['items'] ?? []);
                   if(count($contactInfoItems) < 4){
                    $contactInfoItems = array_pad($contactInfoItems, 4, [
                        'title' => '',
                        'subtitle' => '',
                        'icon' => '',
                    ]);
                }

                @endphp

                @foreach($contactInfoItems as $index => $item)

                <div class="form_group">

                    <div class="form_group faq_box">
                        <label>Location Title {{ $index + 1}}</label>
                        <input type="text" name="contact_info_items[{{ $index }}][title]"
                            placeholder="Enter Location Title" value="{{ $item['title'] ?? ''}}">
                    </div>

                    <div class="form_group">
                        <label>Location Subtitle {{ $index + 1}}</label>
                        <input type="text" name="contact_info_items[{{ $index }}][subtitle]"
                            placeholder="Enter Location Subtitle" value="{{ $item['title'] ?? '' }}">
                    </div>

                    <div class="form_group">
                        <label>Location Icon {{ $index + 1}}</label>
                        <input type="text" name="contact_info_items[{{ $index }}][icon]"
                            placeholder="Enter Location Subtitle" value="{{ $item['icon'] ?? '' }}">
                    </div>

                </div>

                    @endforeach

                </div>

                <div class="wcu_add_more_btn_box">
                    <button type="button" id="add_con_info" class="btn btn-primary">Add More</button>
                </div>

            </div>

            <!-- Contact Form Section -->

            <div class="main_form_box">

                <div class="form_card_title_row">
                    <h3>contact Form</h3>
                    <p>Main hero section content</p>
                </div>

                <div class="page_form_card">

                     <div class="form_group">
                        <label>Form Subtitle</label>
                        <input type="text" name="contact_form_subtitle" placeholder="Enter Form Subtitle" value="{{ old('banner_subtitle',$content['contact_form']['subtitle'] ?? '') }}">
                    </div>

                    <div class="form_group">
                        <label>Form Title</label>
                        <input type="text" name="contact_form_title" placeholder="Enter Form Title" value="{{ old('banner_subtitle',$content['contact_form']['title'] ?? '') }}">
                    </div>

                    <div class="form_group">
                        <label>Form Second ( Color Title )</label>
                        <input type="text" name="contact_form_sec_title" placeholder="Enter Form Second Title" value="{{ old('banner_subtitle',$content['contact_form']['color_title'] ?? '') }}">
                    </div>

                     <div class="form_group">
                        <label>Contact Form Description</label>
                        <textarea name="contact_form_description" rows="4"
                            placeholder="Enter Contact Form description">{{ old('banner_description',$content['contact_form']['desc'] ?? '') }}</textarea>
                    </div>

                    <div class="form_group">
                        <label>Form Point 1</label>
                        <input type="text" name="contact_form_point1" placeholder="Enter Form Point 1" value="{{ old('banner_subtitle',$content['contact_form']['point1'] ?? '') }}">
                    </div>

                    <div class="form_group">
                        <label>Form Point 2</label>
                        <input type="text" name="contact_form_point2" placeholder="Enter Form Point 2" value="{{ old('banner_subtitle',$content['contact_form']['point2'] ?? '') }}">
                    </div>

                     <div class="form_group">
                        <label>Form Point 3</label>
                        <input type="text" name="contact_form_point3" placeholder="Enter Form Point 3" value="{{ old('banner_subtitle', $content['contact_form']['point3'] ?? '') }}">
                    </div>

                    <div class="form_row_2">
                        <div class="form_group">
                            <label>Button 1 Text</label>
                            <input type="text" name="contact_form_btn_text" placeholder="Enter button 1 text"
                                value="{{ old('contact_banner_btn1_text' , $content['contact_form']['btn_text'] ?? '') }}">
                        </div>

                        <div class="form_group">
                            <label>Button 1 Link</label>
                            <input type="text" name="contact_form_btn_url" placeholder="/menu"
                                value="{{ old('contact_banner_btn1_link', $content['contact_form']['btn_url'] ?? '') }}">
                        </div>
                    </div>
                
                </div>
            </div>

            <!-- Contact Visit Us Section -->

            <div class="main_form_box">

                <div class="form_card_title_row">
                    <h3>contact Visit Us</h3>
                    <p>Main hero section content</p>
                </div>

                <div class="page_form_card">

                     <div class="form_group">
                        <label>Visit Subtitle</label>
                        <input type="text" name="contact_visit_subtitle" placeholder="Enter Visit Subtitle" value="{{ old('banner_subtitle',$content['contact_visit']['subtitle'] ?? '') }}">
                    </div>

                    <div class="form_group">
                        <label>Visit Title</label>
                        <input type="text" name="contact_visit_title" placeholder="Enter Visit Title" value="{{ old('banner_subtitle',$content['contact_visit']['title'] ?? '') }}">
                    </div>

                    <div class="form_group">
                        <label>Visit Description</label>
                        <textarea name="contact_visit_description" rows="4"
                            placeholder="Enter Contact Visit Description">{{ old('banner_description',$content['contact_visit']['desc'] ?? '') }}</textarea>
                    </div>

                    <div class="form_group">
                        <label>Location Title</label>
                        <input type="text" name="contact_visit_location_title" placeholder="Enter Visit Title" value="{{ old('contact_visit_location_title' , $content['contact_visit']['locationTitle'] ?? '') }}">
                    </div>

                    <div class="form_group">
                        <label>Location Subtitle</label>
                        <input type="text" name="contact_visit_location_subtitle" placeholder="Enter Visit Title" value="{{ old('contact_visit_location_subtitle' , $content['contact_visit']['locationSubtitle'] ?? '') }}">
                    </div>

                    <div class="form_group">
                        <label>Timing title</label>
                        <input type="text" name="contact_visit_timing_title" placeholder="Enter Visit Title" value="{{ old('contact_visit_timing_title' , $content['contact_visit']['timingTitle'] ?? '') }}">
                    </div>

                     <div class="form_group">
                        <label>Timing Subtitle</label>
                        <input type="text" name="contact_visit_timing_subtitle" placeholder="Enter Visit Title" value="{{ old('contact_visit_timing_subtitle' , $content['contact_visit']['timingSubtitle'] ?? '') }}">
                    </div>

                    <div class="form_group">
                        <label>Contact title</label>
                        <input type="text" name="contact_visit_contact_title" placeholder="Enter Visit Title" value="{{ old('contact_visit_contact_title' , $content['contact_visit']['contactTitle'] ?? '') }}">
                    </div>

                     <div class="form_group">
                        <label>Contact Subtitle</label>
                        <input type="text" name="contact_visit_contact_subtitle" placeholder="Enter Visit Title" value="{{ old('contact_visit_contact_subtitle' , $content['contact_visit']['contactSubtitle'] ?? '') }}">
                    </div>

                    <div class="form_row_2">
                        <div class="form_group">
                            <label>Button Text</label>
                            <input type="text" name="contact_visit_btn_text" placeholder="Enter button text"
                                value="{{ old('banner_btn2_text',$content['contact_visit']['btn_text'] ?? '') }}">
                        </div>

                        <div class="form_group">
                            <label>Button Link</label>
                            <input type="text" name="contact_visit_btn_link" placeholder="Enter button Link"
                                value="{{ old('banner_btn2_link',$content['contact_visit']['btn_url'] ?? '') }}">
                        </div>
                    </div>
                
                </div>
            </div>

             <div class="page_form_submit_box">
                <button type="submit" class="save_page_btn">Save contact Page Content</button>
            </div>

    </form>

    @include('components.usable.footer')

</div>

@endsection