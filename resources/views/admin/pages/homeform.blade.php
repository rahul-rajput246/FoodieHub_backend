@extends('layouts.allAdmin')

@section('content')

<div class="main_dashboard">

    <div class="pages_header">
        <div class="pages_header_left">
            <p class="dashboard_small_text">FoodieHub Admin</p>
            <h1>Manage Home Page</h1>
            <p class="pages_desc">
                Update homepage banner, section headings, special offer content, and testimonial section text.
            </p>
        </div>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
    </div>

    <form action="{{ route('home_update') }}" method="POST" enctype="multipart/form-data" class="page_form_wrapper">
        @csrf

        <div class="page_form_grid">

            <!-- HOME BANNER -->
            <div class="main_form_box">

                <div class="form_card_title_row">
                    <h3>Home Banner</h3>
                    <p>Main hero section content</p>
                </div>

                <input type="hidden" name="pages" value="home">

                <div class="page_form_card">

                    <div class="form_group">
                        <label>Banner Subtitle</label>
                        <input type="text" name="home_banner_subtitle" placeholder="Enter banner subtitle"
                            value="{{ old('subtitle', $content['home_banner']['subtitle'] ?? '') }}">

                        @error('home_banner_subtitle')
                        <p style="color:red;">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="form_group">
                        <label>Banner Title First</label>
                        <input type="text" name="home_banner_title1" placeholder="Enter first title"
                            value="{{ old('title1', $content['home_banner']['title1'] ?? '') }}">

                        @error('home_banner_title1')
                        <p style="color:red;">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="form_group">
                        <label>Banner Title Second</label>
                        <input type="text" name="home_banner_title2" placeholder="Enter second title"
                            value="{{ old('title2', $content['home_banner']['title2'] ?? '') }}">

                        @error('home_banner_title2')
                        <p style="color:red;">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="form_group">
                        <label>Banner Title Third ( color title )</label>
                        <input type="text" name="home_banner_color_title" placeholder="Enter third title"
                            value="{{ old('color_title' , $content['home_banner']['color_title'] ?? '') }}">

                        @error('home_banner_color_title')
                        <p style="color:red;">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="form_group">
                        <label>Banner Description</label>
                        <textarea name="home_banner_desc" rows="4"
                            placeholder="Enter banner description">{{ old('desc' , $content['home_banner']['desc'] ?? '') }}</textarea>

                        @error('home_banner_desc')
                        <p style="color:red;">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="form_row_2">
                        <div class="form_group">
                            <label>Button 1 Text</label>
                            <input type="text" name="home_banner_btn_text1" placeholder="Enter button 1 text"
                                value="{{ old('btn_text1' , $content['home_banner']['btn_text1'] ?? '') }}">

                            @error('home_banner_btn_text1')
                            <p style="color:red;">{{ $message }}</p>
                            @enderror

                        </div>

                        <div class="form_group">
                            <label>Button 1 Link</label>
                            <input type="text" name="home_banner_btn_url1" placeholder="/menu"
                                value="{{ old('btn_url1' , $content['home_banner']['btn_url1'] ?? '') }}">

                            @error('home_banner_btn_url1')
                            <p style="color:red;">{{ $message }}</p>
                            @enderror

                        </div>
                    </div>

                    <div class="form_row_2">
                        <div class="form_group">
                            <label>Button 2 Text</label>
                            <input type="text" name="home_banner_btn_text2" placeholder="Enter button 2 text"
                                value="{{ old('btn_text2' , $content['home_banner']['btn_text2'] ?? '') }}">

                            @error('home_banner_btn_text2')
                            <p style="color:red;">{{ $message }}</p>
                            @enderror

                        </div>

                        <div class="form_group">
                            <label>Button 2 Link</label>
                            <input type="text" name="home_banner_btn_url2" placeholder="/contact"
                                value="{{ old('btn_url2' , $content['home_banner']['btn_url2'] ?? '') }}">

                            @error('home_banner_btn_url2')
                            <p style="color:red;">{{ $message }}</p>
                            @enderror

                        </div>
                    </div>

                    <div class="form_group">

                        @if(!empty($content['home_banner']['image']))
                        <div style="margin-bottom:10px;">
                            <img src="{{ asset('storage/' . $content['home_banner']['image'] ?? '') }}" width="120"
                                height="120" object-fit=contain alt="Home Banner">
                        </div>
                        @endif

                        <label>Banner Image</label>
                        <input type="file" name="home_banner_img">

                        @error('home_banner_img')
                        <p style="color:red;">{{ $message }}</p>
                        @enderror

                    </div>
                </div>
            </div>



            <!-- WHY CHOOSE US -->

            <div class="main_form_box">

                <div class="form_card_title_row">
                    <h3>Why Choose Us Section</h3>
                    <p>Only section heading content</p>
                </div>

                <div class="page_form_card add_wcu_box">

                    <div class="form_group">
                        <label>Section Title</label>
                        <input type="text" name="home_wcu_title" placeholder="Enter section title"
                            value="{{ old('home_wcu_title' , $content['home_wcu']['home_wcu_title'] ?? '') }}">

                        @error('home_wcu_title')
                            <p style="color:red;">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="form_group">
                        <label>Section Subtitle </label>
                        <input type="text" name="home_wcu_subtitle" placeholder="Enter section title"
                            value="{{ old('home_wcu_subtitle' , $content['home_wcu']['home_wcu_subtitle'] ?? '') }}">

                        @error('home_wcu_subtitle')
                        <p style="color:red;">{{ $message }}</p>
                        @enderror

                    </div>

                    
                    @php

                    $wcuItems = old('home_wcu_items' , $content['home_wcu']['items'] ?? []);

                    if(count($wcuItems) < 4){
                        $wcuItems = array_pad($wcuItems,4,['title' => '' , 'desc' => '' , 'icon' => '']);
                    }

                    @endphp

                    @foreach($wcuItems as $index => $item)
                    
                    <div class="form_group">
                        
                        <div class="faq_box form_group">
                            <label>Section Box Title {{ $index + 1 }}</label>
                            <input type="text" name="home_wcu_items[{{ $index }}][title]" placeholder="Enter section title"
                                value="{{ $item['title'] ?? '' }}">
                        </div>

                        <div class="form_group">
                            <label>Icon {{ $index + 1 }}</label>
                            <select class="wcu_icon" name="home_wcu_items[{{$index}}][icon]">
                                <option value="">Select Icon</option>
                                <option value="Delivery" {{ ($item['icon'] ?? '') == 'Delivery' ? 'selected' : '' }}>Delivery</option>
                                <option value="Fresh" {{($item['icon'] ?? '') == 'Fresh' ? 'selected' : ''}}>Fresh</option>
                                <option value="Payment" {{ ($item['icon'] ?? '') == 'Payment' ? 'selected' : '' }}>Payment</option>
                                <option value="ExpertChefs" {{ ($item['icon'] ?? '') == 'ExpertChefs' ? 'selected' : '' }}>ExpertChefs</option>
                            </select>
                        </div>

                        <div class="form_group">
                            <label>Section Box Description {{ $index + 1 }}</label>
                            <textarea name="home_wcu_items[{{ $index }}][desc]" rows="4" placeholder="Enter section description">{{ $item['desc'] ?? '' }}</textarea>
                        </div>
                        @if($index >= 4)
                            <button type="button" class="remove_faq btn btn-danger mt-2">Remove</button>
                        @endif

                    </div>

                    @endforeach

                    
                </div>
                <div class="wcu_add_more_btn_box">
                    <button type="button" id="add_wcu" class="btn btn-primary">Add More</button>
                </div>
            </div>

            <!-- How It Works -->

            <div class="main_form_box">

                <div class="form_card_title_row">
                    <h3>How It Works Section</h3>
                    <p>Only section heading content</p>
                </div>

                <div class="page_form_card home_hiw_box">

                    <div class="form_group">
                        <label>Section Subtitle</label>
                        <input type="text" name="home_hiw_subtitle" placeholder="Enter section subtitle"
                            value="{{ old('home_hiw_subtitle' , $content['home_hiw']['home_hiw_subtitle'] ?? '') }}">

                        @error('home_hiw_subtitle')
                        <p style="color:red;">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="form_group">
                        <label>Section Title</label>
                        <input type="text" name="home_hiw_title" placeholder="Enter section title"
                            value="{{ old('home_hiw_title' , $content['home_hiw']['home_hiw_title'] ?? '') }}">

                        @error('home_hiw_title')
                        <p style="color:red;">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="form_group">
                        <label>Section Description</label>
                        <textarea name="home_hiw_desc" rows="4"
                            placeholder="Enter section description">{{ old('home_hiw_desc' , $content['home_hiw']['home_hiw_desc'] ?? '') }}</textarea>

                        @error('home_hiw_desc')
                        <p style="color:red;">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="form_row_2">
                        <div class="form_group">
                            <label>Button Text</label>
                            <input type="text" name="home_hiw_btn_text" placeholder="Enter button 2 text"
                                value="{{ old('home_hiw_btn_text' , $content['home_hiw']['home_hiw_btn_text'] ?? '') }}">

                            @error('home_hiw_btn_text')
                            <p style="color:red;">{{ $message }}</p>
                            @enderror

                        </div>

                        <div class="form_group">
                            <label>Button Link</label>
                            <input type="text" name="home_hiw_btn_url" placeholder="/Menu"
                                value="{{ old('home_hiw_btn_url' , $content['home_hiw']['home_hiw_btn_url'] ?? '') }}">

                            @error('home_how_it_btn_link')
                            <p style="color:red;">{{ $message }}</p>
                            @enderror

                        </div>
                    </div>

                    @php 
                        $hiwItems = old('home_hiw_items', $content['home_hiw']['items']);
                        if(count($hiwItems) < 3){
                            $hiwItems = array_pad($hiwItems,3,['title' => '' , 'desc' => '', 'icon' => '' , 'step' => '']);
                        }
                    @endphp

                    @foreach($hiwItems as $index => $item)

                    <div class="form_group">
                        <div class="faq_box form_group">
                            <label>Section Box Title {{ $index + 1 }}</label>
                            <input type="text" name="home_hiw_items[{{ $index }}][title]" placeholder="Enter section title"
                            value="{{$item['title'] ?? '' }}">
                        </div>

                        <div class="form_group">
                            <label>Steps {{ $index + 1 }}</label>
                            <input type="number" name="home_hiw_items[{{ $index }}][step]" placeholder="Enter Steps" value="{{$item['step'] ?? '' }}">
                        </div>

                         <div class="form_group">
                            <label>Icon {{ $index + 1 }}</label>
                            <select class="wcu_icon" name="home_hiw_items[{{$index}}][icon]">
                                <option value="">Select Icon</option>
                                <option value="Choose" {{($item['icon'] ?? '') == 'Choose' ? 'selected' : ''}}>Choose</option>
                                <option value="Fresh" {{ ($item['icon'] ?? '') == 'Fresh' ? 'selected' : '' }}>Fresh</option>
                                <option value="fastDelivery" {{ ($item['icon'] ?? '') == 'fastDelivery' ? 'selected' : '' }}>fastDelivery</option>
                            </select>
                        </div>

                        <div class="form_group">
                            <label>Section Box Description {{ $index + 1 }}</label>
                            <textarea name="home_hiw_items[{{ $index }}][desc]" rows="4"
                            placeholder="Enter section description">{{$item['desc'] ?? '' }}</textarea>
                        </div>

                    </div>

                    @endforeach

                </div>
                <div class="wcu_add_more_btn_box">
                    <button type="button" id="add_hiw" class="btn btn-primary">Add More</button>
                </div>
            </div>



            <!-- SPECIAL OFFER -->

            <div class="main_form_box">

                <div class="form_card_title_row">
                    <h3>Special Offer Section</h3>
                    <p>Offer banner content</p>
                </div>

                <div class="page_form_card">

                    <div class="form_group">
                        <label>Offer Subtitle</label>
                        <input type="text" name="home_offer_subtitle" placeholder="Enter offer subtitle"
                            value="{{ old('home_offer_subtitle' , $content['home_specialOffer']['home_offer_subtitle'] ?? '') }}">

                        @error('home_offer_subtitle')
                        <p style="color:red;">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="form_group">
                        <label>Offer Title</label>
                        <input type="text" name="home_offer_title" placeholder="Enter offer title"
                            value="{{ old('home_offer_title' , $content['home_specialOffer']['home_offer_title'] ?? '') }}">

                        @error('home_offer_title')
                        <p style="color:red;">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="form_group">
                        <label>Offer Description</label>
                        <textarea name="home_offer_desc" rows="4"
                            placeholder="Enter offer description">{{ old('home_offer_desc' , $content['home_specialOffer']['home_offer_desc'] ?? '') }}</textarea>

                        @error('home_offer_desc')
                        <p style="color:red;">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="form_row_2">
                        <div class="form_group">
                            <label>Offer Button Text</label>
                            <input type="text" name="home_offer_btn_text" placeholder="Order Now"
                                value="{{ old('home_offer_btn_text' , $content['home_specialOffer']['home_offer_btn_text'] ?? '') }}">

                            @error('home_offer_btn_text')
                            <p style="color:red;">{{ $message }}</p>
                            @enderror

                        </div>

                        <div class="form_group">
                            <label>Offer Button Link</label>
                            <input type="text" name="home_offer_btn_url" placeholder="/menu"
                                value="{{ old('home_offer_btn_url' , $content['home_specialOffer']['home_offer_btn_url'] ?? '') }}">

                            @error('home_offer_btn_url')
                            <p style="color:red;">{{ $message }}</p>
                            @enderror

                        </div>
                    </div>

                    <div class="form_group">
                        @if(!empty($content['home_specialOffer']['image']))
                        <div style="margin-bottom:10px;">
                            <img src="{{ asset('storage/' . $content['home_specialOffer']['image'] ?? '') }}"
                                width="120" height="120" object-fit=contain alt="Home Offer">
                        </div>
                        @endif

                        <label>Offer Image</label>
                        <input type="file" name="home_offer_img">

                        @error('home_offer_img')
                        <p style="color:red;">{{ $message }}</p>
                        @enderror

                    </div>
                </div>
            </div>


            <!-- TESTIMONIAL SECTION -->

            <div class="main_form_box">

                <div class="form_card_title_row">
                    <h3>Testimonial Section</h3>
                    <p>Only heading and description</p>
                </div>

                <div class="page_form_card home_testom_box">

                    <div class="form_group">
                        <label>Testimonial Title </label>
                        <input type="text" name="home_testi_title" placeholder="Enter testimonial title"
                            value="{{ old('home_testi_title' , $content['home_testom']['home_testi_title'] ?? '') }}">

                        @error('home_testi_title')
                        <p style="color:red;">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="form_group">
                        <label>Testimonial Subtitle</label>
                        <input type="text" name="home_testi_subtitle" placeholder="Enter testimonial title"
                            value="{{ old('home_testi_subtitle' , $content['home_testom']['home_testi_subtitle'] ?? '') }}">

                        @error('home_testi_subtitle')
                        <p style="color:red;">{{ $message }}</p>
                        @enderror

                    </div>

                    @php

                        $testomItems = old('home_testom_items', $content['home_testom']['items']);
                        if(count($testomItems) < 3){
                            $testomItems = array_pad($testomItems,3,['desc' => '' , 'rating' => '' , 'name' => '' , 'emotion' => '' , 'image' => '']);
                        }

                    @endphp

                    @foreach($testomItems as $index => $item)

                    <div class="form_group ">
                        
                        <div class="form_group">
                            <label>Testimonial Box Name {{ $index + 1 }}</label>
                            <input type="text" name="home_testom_items[{{ $index }}][name]" placeholder="Enter testimonial title"
                            value="{{ $item['name'] ?? '' }}">
                        </div>

                        <div class="form_group">
                            <label>Testimonial Box Subtitle {{ $index + 1 }}</label>
                            <input type="text" name="home_testom_items[{{ $index }}][emotion]" placeholder="Enter testimonial subtitle" 
                            value="{{ $item['emotion'] ?? '' }}">
                        </div>

                        <div class="form_group">
                            <label>Testimonial Box Rating {{ $index + 1 }}</label>
                            <input type="number" min="1" max="5" name="home_testom_items[{{ $index }}][rating]"
                            placeholder="Enter testimonial rating"
                            value="{{ $item['rating'] ?? '' }}">
                        </div>

                        <div class="form_group">
                            <label>Testimonial Box Description {{ $index + 1 }}</label>
                            <textarea name="home_testom_items[{{ $index }}][desc]" rows="4" placeholder="Enter testimonial description">{{ $item['desc'] ?? '' }}
                            </textarea>
                        </div>

                        <div class="form_group">
                            @if(!empty($item['image']))
                                <img src="{{ asset('storage/'.$item['image']) }}" width="80">
                            @endif

                            <input type="file" name="home_testom_items[{{ $index }}][image]">

                            <input type="hidden" name="home_testom_items[{{ $index }}][old_image]" value="{{ $item['image'] ?? '' }}">

                        </div>


                    </div>

                    @endforeach

                </div>

                <div class="wcu_add_more_btn_box">
                    <button type="button" id="add_testom" class="btn btn-primary">Add More</button>
                </div>

            </div>

        <!-- FAQ Section -->

        <div class="main_form_box">

            <div class="form_card_title_row">
                <h3>FAQ Section</h3>
                <p>Only section heading content</p>
            </div>

            <div class="page_form_card home_faq_box">

                <div class="form_group">
                    <label>FAQ Subtitle {{ $index }}</label>
                    <input type="text" name="home_faq_subtitle" placeholder="Enter section subtitle"
                        value="{{ old('home_faq_subtitle' , $content['home_faq']['home_faq_subtitle'] ?? '') }}">

                    @error('home_faq_subtitle')
                    <p style="color:red;">{{ $message }}</p>
                    @enderror

                </div>

                <div class="form_group">
                    <label>FAQ Title</label>
                    <input type="text" name="home_faq_title" placeholder="Enter section title"
                        value="{{ old('home_faq_title' , $content['home_faq']['home_faq_title'] ?? '') }}">

                    @error('home_faq_title')
                    <p style="color:red;">{{ $message }}</p>
                    @enderror

                </div>

                <div class="form_group">
                    <label>FAQ Description</label>
                    <textarea name="home_faq_desc" rows="4"
                        placeholder="Enter section description">{{ old('home_faq_desc' , $content['home_faq']['home_faq_desc'] ?? '') }}</textarea>

                    @error('home_faq_desc')
                    <p style="color:red;">{{ $message }}</p>
                    @enderror

                </div>

                 <div class="form_group">
                    
                    <label>Faq Button Text</label>
                    <input type="text" name="home_faq_btn_text" placeholder="Enter Button Text"
                        value="{{ old('home_faq_btn_text',$content['home_faq']['home_faq_btn_text'] ?? '') }}">

                    @error('home_offer_btn_url')
                    <p style="color:red;">{{ $message }}</p>
                    @enderror

                </div>

                <div class="form_group">
                    
                    <label>Faq Button Url</label>
                    <input type="text" name="home_faq_btn_link" placeholder="/contact"
                        value="{{ old('home_faq_btn_link',$content['home_faq']['home_faq_btn_link'] ?? '') }}">

                    @error('home_offer_btn_url')
                    <p style="color:red;">{{ $message }}</p>
                    @enderror

                </div>

                @php 
                    
                    $faqItems = old('home_faq_items', $content['home_faq']['items']);
                    
                    if(count($faqItems) < 5){
                        $faqItems = array_pad($faqItems,5,['question' => '' , 'asnwer' => '']);
                    }
                    
                @endphp

                @foreach($faqItems as $index => $item)

                <div class="form_group">
                    
                    <div class="faq_box form_group">
                        <label>FAQ Q-{{ $index + 1 }}</label>
                        <input type="text" name="home_faq_items[{{ $index }}][question]" placeholder="Enter section title"
                        value="{{ $item['question'] ?? '' }}">
                    </div>

                   <div class="form_group">
                        <label>FAQ A-{{ $index + 1 }}</label>
                        <input type="text" name="home_faq_items[{{ $index }}][answer]" placeholder="Enter section title"
                        value="{{ $item['answer'] ?? '' }}">
                    </div>

                </div>

                @endforeach

            </div>

            <div class="wcu_add_more_btn_box">
                <button type="button" id="add_faq" class="btn btn-primary">Add More</button>
            </div>

        </div>

        <div class="page_form_submit_box">
            <button type="submit" class="save_page_btn">Save Home Page Content</button>
        </div>
    </form>



    @include('components.usable.footer')

</div>

@endsection