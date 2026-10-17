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

    <script>
        // Unregister any stale service workers on localhost
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.getRegistrations().then(function(registrations) {
                for (let r of registrations) {
                    r.unregister();
                }
            });
        }
    </script>
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
            setupDragAndDropUploaders();

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
            setupDragAndDropUploaders();

        });

        // About Specialist Remove

        $(document).on('click', '.remove_about_spec', function() {
            $(this).closest('.faq_box').remove();
        });

        // =========================================================
        // UNIVERSAL DRAG AND DROP FILE UPLOADER
        // =========================================================
        function setupDragAndDropUploaders() {
            $('input[type="file"]:not(.dropzone_initialized)').each(function() {
                const $input = $(this);
                $input.addClass('dropzone_initialized dropzone_hidden_input');

                // Check for existing image in the surrounding form group or card
                const $formGroup = $input.closest('.form_group, .page_form_card, .allfood_card_img_box');
                let existingImgSrc = '';

                if ($formGroup.length) {
                    const $img = $formGroup.find('img').first();
                    if ($img.length && $img.attr('src')) {
                        existingImgSrc = $img.attr('src');
                        // Hide old image wrapper if it's separate from dropzone
                        const $oldImgWrapper = $img.parent('div');
                        if ($oldImgWrapper.length && $oldImgWrapper[0] !== $formGroup[0]) {
                            $oldImgWrapper.hide();
                        } else {
                            $img.hide();
                        }
                    }
                }

                const $dropzone = $(`
                    <div class="dropzone_box" tabindex="0">
                        <div class="dropzone_default_content">
                            <div class="dropzone_icon_wrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                                </svg>
                            </div>
                            <p class="dropzone_prompt">Drag & drop your image here, or <strong>Browse</strong></p>
                            <p class="dropzone_subtext">Supports PNG, JPG, WEBP, SVG</p>
                        </div>
                    </div>
                `);

                function updatePreview(src, name = '', size = '', isNew = false) {
                    if (src) {
                        $dropzone.html(`
                            <div class="dropzone_preview_wrapper">
                                <img src="${src}" alt="Preview" class="dropzone_preview_thumb">
                                <div class="dropzone_preview_info">
                                    <span class="dropzone_preview_badge ${isNew ? 'badge_new' : 'badge_current'}">
                                        ${isNew ? '✓ New Image Selected' : 'Current Image'}
                                    </span>
                                    <p class="dropzone_preview_name">${name || 'Uploaded Image'}</p>
                                    <p class="dropzone_preview_size">${size || 'Drag & drop or click to replace'}</p>
                                </div>
                                <button type="button" class="dropzone_change_btn">Change</button>
                            </div>
                        `);
                    } else {
                        $dropzone.html(`
                            <div class="dropzone_default_content">
                                <div class="dropzone_icon_wrapper">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                                    </svg>
                                </div>
                                <p class="dropzone_prompt">Drag & drop your image here, or <strong>Browse</strong></p>
                                <p class="dropzone_subtext">Supports PNG, JPG, WEBP, SVG</p>
                            </div>
                        `);
                    }
                }

                if (existingImgSrc) {
                    updatePreview(existingImgSrc, '', '', false);
                }

                $input.after($dropzone);

                // Clicking anywhere on the dropzone triggers the file input
                $dropzone.on('click', function() {
                    $input.trigger('click');
                });

                // Keyboard support
                $dropzone.on('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        $input.trigger('click');
                    }
                });

                // Drag & Drop event handling
                $dropzone.on('dragenter dragover', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    $dropzone.addClass('drag_over');
                });

                $dropzone.on('dragleave dragend drop', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    $dropzone.removeClass('drag_over');
                });

                $dropzone.on('drop', function(e) {
                    const files = e.originalEvent.dataTransfer.files;
                    if (files && files.length > 0) {
                        const file = files[0];
                        if (file.type.match(/^image\//i)) {
                            const dt = new DataTransfer();
                            dt.items.add(file);
                            $input[0].files = dt.files;
                            $input.trigger('change');
                        } else {
                            alert('Please upload a valid image file (PNG, JPG, WEBP, SVG).');
                        }
                    }
                });

                // File input change (via Browse dialog or Drag & Drop)
                $input.on('change', function() {
                    if (this.files && this.files[0]) {
                        const file = this.files[0];
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const sizeFormatted = (file.size / 1024).toFixed(1) + ' KB';
                            updatePreview(e.target.result, file.name, sizeFormatted, true);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            });
        }

        // Initialize drag & drop uploader on page load
        setupDragAndDropUploaders();

    });
    </script>
</body>

</html>