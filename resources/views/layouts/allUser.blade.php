<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodieHub Dashboard</title>

    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('./favicon.png') }}">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

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
            @yield('userContent')

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

    });
    </script>
</body>

</html>