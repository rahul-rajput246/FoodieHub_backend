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
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>

    <div class="admin_layout">

        @include('components.usable.userNavbar')

        <div class="main_container">

            <div class="user_layout">

                @include('components.usable.userAside')

                <main class="user_content">
                    @yield('userContent')
                </main>

            </div>

        </div>

    </div>

    <!-- Jquery CDN -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $(document).ready(function(){

            // Dropdown Profile Toggle

            $("#user-menu-btn").click(function(e){
                e.stopPropagation();
                $("#user-dropdown").toggle();
            });

            $(document).click(function(){
                $("#user-dropdown").hide();
            });

            // Toggle sidebar on mobile

            $("#menu-toggle").click(function(){
                $(".user_sidebar").toggleClass("active");
            });

            $("#sidebar-overlay").click(function(){
                $(".user_sidebar").removeClass("active");
            });

        });
    </script>
</body>

</html>