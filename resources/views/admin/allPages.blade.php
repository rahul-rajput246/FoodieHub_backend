@extends('layouts.allAdmin')

@section('content')

<div class="main_dashboard">

    <div class="pages_header">
        <div class="pages_header_left">
            <p class="dashboard_small_text">FoodieHub Admin</p>
            <h1>All Pages</h1>
            <p class="pages_desc">
                Manage banner, text, sections, images, and content of all frontend pages from one place.
            </p>
        </div>
    </div>

    <div class="pages_overview_cards">
        <div class="mini_overview_card">
            <h3>Total Pages</h3>
            <h2>04</h2>
            <p>Website pages available</p>
        </div>

        <div class="mini_overview_card">
            <h3>Editable Sections</h3>
            <h2>16+</h2>
            <p>Banners, headings, images, buttons</p>
        </div>

        <div class="mini_overview_card">
            <h3>Quick Access</h3>
            <h2>100%</h2>
            <p>Manage everything easily</p>
        </div>
    </div>

    <div class="all_pages_grid">

        <div class="single_page_card">
            <div class="page_card_top">
                <div class="page_icon_box">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ff9138"><path d="M220-180v-380h180v380H220Zm340 0v-220h180v220H560ZM220-620v-160h520v160H220Zm60-60h400v-40H280v40Zm0 440h60v-260h-60v260Zm340 0h60v-100h-60v100ZM280-680v-40 40Zm60 180Zm340 160Z"/></svg>
                </div>

                <span class="page_status">Live</span>
            </div>

            <h3>Home Page</h3>
            <p>
                Edit homepage banner, category section, why choose us, featured food, offers, testimonials, FAQ and more.
            </p>

            <div class="editable_tags">
                <span>Banner</span>
                <span>Sections</span>
                <span>Images</span>
                <span>Buttons</span>
            </div>

            <div class="page_card_btns">
                <a href="{{ Route('admin.home')}}" class="manage_page_btn">Manage Content</a>
            </div>
        </div>

        <div class="single_page_card">
            <div class="page_card_top">
                <div class="page_icon_box">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ff9138"><path d="M280-160v-80h400v80H280Zm-80-120v-440h560v440H200Zm80-80h400v-280H280v280Zm0 0v-280 280Zm80-80h240v-80H360v80Zm0-120h240v-80H360v80Z"/></svg>
                </div>

                <span class="page_status">Live</span>
            </div>

            <h3>About Page</h3>
            <p>
                Edit about banner, story section, mission, why choose us content, images, and promotional sections.
            </p>

            <div class="editable_tags">
                <span>Banner</span>
                <span>Story</span>
                <span>Images</span>
                <span>Text</span>
            </div>

            <div class="page_card_btns">
                <a href="{{ Route('admin.about')}}" class="manage_page_btn">Manage Content</a>
            </div>
        </div>

        <div class="single_page_card">
            <div class="page_card_top">
                <div class="page_icon_box">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ff9138"><path d="M280-120q-33 0-56.5-23.5T200-200v-440q0-33 23.5-56.5T280-720h400q33 0 56.5 23.5T760-640v440q0 33-23.5 56.5T680-120H280Zm0-80h400v-440H280v440Zm80-80h240v-80H360v80Zm0-120h240v-80H360v80Zm0-120h160v-80H360v80ZM280-640v440-440Z"/></svg>
                </div>

                <span class="page_status">Live</span>
            </div>

            <h3>Menu Page</h3>
            <p>
                Edit menu page banner, menu intro text, filter section text, popular dishes content and offer sections.
            </p>

            <div class="editable_tags">
                <span>Banner</span>
                <span>Menu Intro</span>
                <span>Offers</span>
                <span>Content</span>
            </div>

            <div class="page_card_btns">
                <a href="{{ Route('admin.menu')}}" class="manage_page_btn">Manage Content</a>
            </div>
        </div>

        <div class="single_page_card">
            <div class="page_card_top">
                <div class="page_icon_box">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ff9138"><path d="M480-480Zm0 360q-151 0-255.5-104.5T120-480q0-151 104.5-255.5T480-840q151 0 255.5 104.5T840-480q0 151-104.5 255.5T480-120Zm0-60q54 0 103.5-17t90.5-49l-94-94q-22 15-47 22.5T480-310q-71 0-120.5-49.5T310-480q0-28 8-53t23-47l-95-95q-32 41-49 90.5T180-480q0 125 87.5 212.5T480-180Zm234-106q32-41 49-90.5t17-103.5q0-125-87.5-212.5T480-780q-54 0-103.5 17T286-714l95 95q22-15 47-23t52-8q71 0 120.5 49.5T650-480q0 27-8 52t-23 47l95 95ZM480-370q46 0 78-32t32-78q0-46-32-78t-78-32q-46 0-78 32t-32 78q0 46 32 78t78 32Z"/></svg>
                </div>

                <span class="page_status">Live</span>
            </div>

            <h3>Contact Page</h3>
            <p>
                Edit contact banner, support text, contact details, form section, map section and CTA content.
            </p>

            <div class="editable_tags">
                <span>Banner</span>
                <span>Contact Info</span>
                <span>Form</span>
                <span>Map</span>
            </div>

            <div class="page_card_btns">
                <a href="{{ Route('admin.contact')}}" class="manage_page_btn">Manage Content</a>
            </div>
        </div>

    </div>

    @include('components.usable.footer')

</div>

@endsection