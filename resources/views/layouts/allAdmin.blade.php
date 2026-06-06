<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodieHub Dashboard</title>

    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('./favicon.png') }}">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Css -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>

    <div class="admin_layout">

        @include('components.usable.navbar')

        <div class="main_container">

            @include('components.usable.aside')

            @yield('content')

        </div>

    </div>

    <!-- Jquery CDN -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
    $(document).ready(function() {

        // profile toggle

        $(".admin_profile").click(function() {
            $(".dropdown_menu").toggle();
        });

        // Navbar toggle

        $('.sidebar_toggle_box').click(function() {
            $('.admin_sidebar').slideToggle();
        });

        // sidebar active class toggle

        $('#click_dropdown > a').click(function(e){
            e.preventDefault();
            $('.orders_dropdown').slideToggle();
        });

        if (window.location.pathname.includes('/admin/orders')) {
            $('.orders_dropdown').show();
        }

        // Home Why Choose Us Add

        let index = $('.add_wcu_box .faq_box').length;

        $('#add_wcu').click(function() {
            let html = `
                <div class="faq_box form_group mb-3">
                    
                    <label>Add More Title ${index + 1}</label>
                    <input type="text" name="home_wcu_items[${index}][title]" placeholder="Enter section title">

                    <label>Add More Icon ${index + 1}</label>
                    <select class="wcu_icon" name="home_wcu_items[${index}][icon]">
                        <option value="">Select Icon</option>
                        <option value="delivery">Delivery</option>
                        <option value="fresh">Fresh</option>
                        <option value="quality">Payment</option>
                        <option value="support">Expert Chefs</option>
                    </select>

                    <lable>Add More Description ${index + 1}</lable>
                    <textarea name="home_wcu_items[${index}][desc]" rows="4" placeholder="Enter section description"></textarea>

                    <button type="button" class="remove_wcu btn btn-danger mt-2">Remove</button>

                </div>
            `;

            $('.add_wcu_box').append(html);

            index++;

        });

        // Home Why Choose Us Remove

        $(document).on('click', '.remove_wcu', function() {
            $(this).closest('.faq_box').remove();
        });

        // Home How It Works Add

        let hiwIndex = $('.home_hiw_box .faq_box').length;

        $('#add_hiw').click(function() {
            let hiw_html = `
            <div class="faq_box form_group mb-3">
                <div class="form_group">
                    <label>Section Box Title ${hiwIndex + 1}</label>
                    <input type="text" name="home_hiw_items[${hiwIndex}][title]" placeholder="Enter section title">
                </div>

                <div class="form_group">
                    <label>Steps ${hiwIndex + 1}</label>
                    <input type="number" name="home_hiw_items[${hiwIndex}][step]" placeholder="Enter Steps">
                </div>

                <div class="form_group">
                    <label>Icon ${hiwIndex + 1}</label>
                    <select class="wcu_icon" name="home_hiw_items[${hiwIndex}][icon]">
                        <option value="">Select Icon</option>
                        <option value="Choose">Choose</option>
                        <option value="Fresh">Fresh</option>
                        <option value="fastDelivery">fastDelivery</option>
                    </select>
                </div>

                <div class="form_group">
                    <label>Section Box Description ${hiwIndex + 1}</label>
                    <textarea name="home_hiw_items[${hiwIndex}][desc]" rows="4" placeholder="Enter section description"></textarea>
                </div>

                <button type="button" class="remove_hiw btn btn-danger mt-2">Remove</button>
            </div>
        `;

            $('.home_hiw_box').append(hiw_html);
            hiwIndex++;
        });

        // Home How It Works Remove

        $(document).on('click', '.remove_hiw', function() {
            $(this).closest('.faq_box').remove();
        });

        // Home Testomonial Add

        let testomIndex = $('.home_testom_box .faq_box').length;

        $('#add_testom').click(function() {

            let testomHtml = `
            <div class="faq_box form_group mb-3">

                <div class="form_group">
                    <label>Testimonial Box Name ${testomIndex + 1}</label>
                    <input type="text" name="home_testom_items[${testomIndex}][name]" placeholder="Enter testimonial title">
                </div>

                <div class="form_group">
                    <label>Testimonial Box Subtitle ${testomIndex + 1}</label>
                    <input type="text" name="home_testom_items[${testomIndex}][emotion]" placeholder="Enter testimonial subtitle">
                </div>

                <div class="form_group">
                    <label>Testimonial Box Rating 1</label>
                    <input type="number" min="1" max="5" name="home_testom_items[${testomIndex}][rating]"
                    placeholder="Enter testimonial rating">
                </div>

                <div class="form_group">
                    <label>Testimonial Box Description ${testomIndex + 1}</label>
                    <textarea name="home_testom_items[${testomIndex}][desc]" rows="4" placeholder="Enter testimonial description">
                    </textarea>
                </div>

                <div class="form_group">
                    <label> Testomonial Box Image </label>
                    <input type="file" name="home_testom_items[${testomIndex}][image]">
                </div>
                
                <button type="button" class="remove_testom btn btn-danger mt-2">Remove</button>

            </div>
        `;

            $('.home_testom_box').append(testomHtml);

            testomIndex++;

        });

        //Home Testomonial Remove

        $(document).on('click', '.remove_testom', function() {
            $(this).closest('.faq_box').remove();
        });

        // Home FAQ Add

        let faqIndex = $('.home_faq_box .faq_box').length;

        $('#add_faq').click(function() {
            let faqHtml = `
        
            <div class="faq_box form_group">
                    
                <div class="form_group">
                    <label>FAQ Q-${ faqIndex + 1 }</label>
                    <input type="text" name="home_faq_items[${faqIndex}][question]" placeholder="Enter section title">
                </div>

                <div class="form_group">
                    <label>FAQ A-${ faqIndex + 1 }</label>
                    <input type="text" name="home_faq_items[${faqIndex}][answer]" placeholder="Enter section title">
                </div>

                <button type="button" class="remove_faq btn btn-danger mt-2">Remove</button>

            </div>

        `;

            $('.home_faq_box').append(faqHtml);

            faqIndex++;

        });

        // Home FAQ Remove

        $(document).on('click', '.remove_faq', function() {
            $(this).closest('.faq_box').remove();
        });

        // Contact Info Add

        let contactInfoIndex = $('.home_faq_box , .faq_box').length;

        $('#add_con_info').click(function() {
            let contactInfoHtml = `
        
            <div class="form_group">

                <div class="form_group faq_box">
                    <label>Location Title ${ contactInfoIndex + 1}</label>
                    <input type="text" name="contact_info_items[${ contactInfoIndex }}][title]"
                        placeholder="Enter Location Title">
                </div>

                <div class="form_group">
                    <label>Location Subtitle ${ contactInfoIndex + 1}</label>
                    <input type="text" name="contact_info_items[${ contactInfoIndex }}][subtitle]"
                        placeholder="Enter Location Subtitle">
                </div>

                <div class="form_group">
                    <label>Location Icon ${ contactInfoIndex + 1}</label>
                    <input type="text" name="contact_info_items[${ contactInfoIndex }}][icon]"
                        placeholder="Enter Location Subtitle">
                </div>

                 <button type="button" class="remove_contactInfo btn btn-danger mt-2">Remove</button>

            </div>
        
        `;

            $('.home_faq_box').append(contactInfoHtml);

            contactInfoIndex++;

        });

        // Contact Info Remove

        $(document).on('click', '.remove_contactInfo', function() {
            $(this).closest('.faq_box').remove();
        });

        // About Specialist Add

        let aboutSpecIndex = $('.about_spec_box , .faq_box').length;

        $('#add_spec').click(function() {
            let aboutSpecHtml = `

            <div class="form_group faq_box">

                <div class="form_group">
                    <label>Our Specialities Box ${ aboutSpecIndex + 1 }</label>
                    <input type="text" name="about_spec_items[${ aboutSpecIndex }][box_title]" placeholder="Enter banner subtitle">
                </div>

                <div class="form_group">
                    <label>Our Specialities Box ${ aboutSpecIndex + 1 }</label>
                    <input type="text" name="about_spec_items[${ aboutSpecIndex }][box_desc]" placeholder="Enter banner subtitle">
                </div>

                <label>Our Specialisation Image ${ aboutSpecIndex + 1 }</label>
                <input type="file" name="about_spec_items[${ aboutSpecIndex }][image]">

                <button type="button" class="remove_about_spec btn btn-danger mt-2">Remove</button>

            </div>
        
        `;

            $('.about_spec_box').append(aboutSpecHtml);

            aboutSpecIndex++;

        });

        // About Specialist Remove

        $(document).on('click', '.remove_about_spec', function() {
            $(this).closest('.faq_box').remove();
        });

    });
    </script>
</body>

</html>