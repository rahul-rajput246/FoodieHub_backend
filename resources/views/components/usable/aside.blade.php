<div class="admin_sidebar">
    <div class="sidebar_brand">
        <div class="brand_icon">
            <img src="{{ asset('assets/images/our_team_img3.png') }}" alt="logo">
        </div>
        <div class="brand_text">
            <h2>FoodieHub</h2>
            <p>Admin Panel</p>
        </div>
    </div>

    <div class="sidebar_menu_title">MAIN MENU</div>

    <ul class="sidebar_menu">
        <li>
            <a href="/admin/dashboard" class="toggle_class {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <span class="menu_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                        fill="#fff">
                        <path
                            d="M530-600v-220h290v220H530ZM140-460v-360h290v360H140Zm390 320v-360h290v360H530Zm-390 0v-220h290v220H140Zm60-380h170v-240H200v240Zm390 320h170v-240H590v240Zm0-460h170v-100H590v100ZM200-200h170v-100H200v100Zm170-320Zm220-140Zm0 220ZM370-300Z" />
                    </svg>
                </span>
                <span class="menu_text">Dashboard</span>
            </a>
        </li>

        <li>
            <a href="/admin/allPages" class="toggle_class {{ request()->is('admin/allPages') ? 'active' : '' }}">
                <span class="menu_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                        fill="#fff">
                        <path
                            d="M172.31-180q-29.83 0-51.07-21.24Q100-222.48 100-252.31v-375.38q0-29.83 21.24-51.07Q142.48-700 172.31-700h226.54l80-80h308.84q29.83 0 51.07 21.24Q860-737.52 860-707.69v455.38q0 29.83-21.24 51.07Q817.52-180 787.69-180H172.31Zm46.46-255.38h213.54q5.38 0 8.84-3.47 3.47-3.46 3.47-8.84v-213.54L218.77-435.38ZM160-461.15 338.85-640H172.31q-5.39 0-8.85 3.46t-3.46 8.85v166.54Zm0 85.76v123.08q0 5.39 3.46 8.85t8.85 3.46h615.38q5.39 0 8.85-3.46t3.46-8.85v-455.38q0-5.39-3.46-8.85t-8.85-3.46H504.61v272.31q0 29.82-21.24 51.06-21.24 21.24-51.06 21.24H160ZM450-510Z" />
                    </svg>
                </span>
                <span class="menu_text">All Pages</span>
            </a>
        </li>

        <li>
            <a href="/admin/allFood" class="toggle_class {{ request()->is('admin/allFood') ? 'active' : '' }}">
                <span class="menu_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                        fill="#fff">
                        <path
                            d="M620-177.23 463.85-333.38 506-375.54l114 114 226.77-226.77 42.15 42.16L620-177.23ZM820-560h-60v-187.69q0-4.62-3.85-8.46-3.84-3.85-8.46-3.85H660v104.61H300V-760h-87.69q-4.62 0-8.46 3.85-3.85 3.84-3.85 8.46v535.38q0 4.62 3.85 8.46 3.84 3.85 8.46 3.85H440v60H212.31q-29.92 0-51.12-21.19Q140-182.39 140-212.31v-535.38q0-29.92 21.19-51.12Q182.39-820 212.31-820h176.23q8.31-29.23 33.96-48.46t57.5-19.23q33.08 0 58.42 19.23 25.35 19.23 33.66 48.46h175.61q29.92 0 51.12 21.19Q820-777.61 820-747.69V-560ZM505.81-765.73q10.34-10.35 10.34-25.81 0-15.46-10.34-25.81-10.35-10.34-25.81-10.34-15.46 0-25.81 10.34-10.34 10.35-10.34 25.81 0 15.46 10.34 25.81 10.35 10.35 25.81 10.35 15.46 0 25.81-10.35Z" />
                    </svg>
                </span>
                <span class="menu_text">All Food Items</span>
            </a>
        </li>


        <li>
            <a href="/admin/allCategory" class="toggle_class {{ request()->is('admin/allCategory') ? 'active' : '' }}">
                <span class="menu_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                        fill="#ffffff">
                        <path
                            d="M287.69-535.39 480-850.77l192.31 315.38H287.69ZM700-95.39q-68.85 0-116.73-47.88-47.88-47.88-47.88-116.73t47.88-116.73q47.88-47.88 116.73-47.88t116.73 47.88q47.88 47.88 47.88 116.73t-47.88 116.73Q768.85-95.39 700-95.39Zm-564.61-20v-289.22h289.22v289.22H135.39Zm564.6-39.99q43.93 0 74.28-30.34t30.35-74.27q0-43.93-30.34-74.28t-74.27-30.35q-43.93 0-74.28 30.34t-30.35 74.27q0 43.93 30.34 74.28t74.27 30.35Zm-504.61-20h169.24v-169.24H195.38v169.24Zm198.16-420h172.92L480-734.46l-86.46 139.08Zm86.46 0ZM364.62-344.62ZM700-260Z" />
                    </svg>
                </span>
                <span class="menu_text">Categories</span>
            </a>
        </li>

        <li id="click_dropdown">
            <a class="toggle_class {{ request()->is('admin/orders*') ? 'active' : '' }}">
                <span class="menu_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ffffff"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h168q13-36 43.5-58t68.5-22q38 0 68.5 22t43.5 58h168q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h560v-560H200v560Zm80-80h280v-80H280v80Zm0-160h400v-80H280v80Zm0-160h400v-80H280v80Zm221.5-198.5Q510-807 510-820t-8.5-21.5Q493-850 480-850t-21.5 8.5Q450-833 450-820t8.5 21.5Q467-790 480-790t21.5-8.5ZM200-200v-560 560Z"/></svg>
                </span>
                <span class="menu_text">Orders</span>
            </a>
            <div class="orders_dropdown">
                <a href="/admin/orders" class="toggle_class {{ request()->is('admin/orders') ? 'active' : '' }}">All Orders</a>
                <a href="/admin/orders/pending" class="toggle_class {{ request()->is('admin/orders/pending') ? 'active' : '' }}">Pending Orders</a>
                <a href="/admin/orders/completed" class="toggle_class {{ request()->is('admin/orders/completed') ? 'active' : '' }}">Completed Orders</a>
                <a href="/admin/orders/cancelled" class="toggle_class {{ request()->is('admin/orders/cancelled') ? 'active' : '' }}">Cancelled Orders</a>
            </div>
        </li>

        <li>
            <a href="/admin/allUsers" class="toggle_class {{ request()->is('admin/allUsers') ? 'active' : '' }}">
                <span class="menu_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                        fill="#ffffff">
                        <path
                            d="M451.54-295.39h56.92l9.69-54.61q17.39-5 30-11.85 12.62-6.84 24.77-18.31l52.62 18 28.84-48.76-41.77-35.39q4.31-17.84 4.31-33.69 0-15.85-4.31-33.69l41.77-35.39-28.84-48.76-52.62 18q-12.15-11.47-24.77-18.31-12.61-6.85-30-11.85l-9.69-54.61h-56.92L441.85-610q-17.39 5-30 11.85-12.62 6.84-24.77 18.31l-52.62-18-28.84 48.76 41.77 35.39q-4.31 17.84-4.31 33.69 0 15.85 4.31 33.69l-41.77 35.39 28.84 48.76 52.62-18q12.15 11.47 24.77 18.31 12.61 6.85 30 11.85l9.69 54.61ZM423.5-423.5Q400-447 400-480t23.5-56.5Q447-560 480-560t56.5 23.5Q560-513 560-480t-23.5 56.5Q513-400 480-400t-56.5-23.5ZM212.31-140Q182-140 161-161q-21-21-21-51.31v-535.38Q140-778 161-799q21-21 51.31-21h535.38Q778-820 799-799q21 21 21 51.31v535.38Q820-182 799-161q-21 21-51.31 21H212.31Zm0-60h535.38q4.62 0 8.46-3.85 3.85-3.84 3.85-8.46v-535.38q0-4.62-3.85-8.46-3.84-3.85-8.46-3.85H212.31q-4.62 0-8.46 3.85-3.85 3.84-3.85 8.46v535.38q0 4.62 3.85 8.46 3.84 3.85 8.46 3.85ZM200-760v560-560Z" />
                    </svg>
                </span>
                <span class="menu_text">All Users</span>
            </a>
        </li>

        <li>
            <a href="/profile" class="toggle_class {{ request()->is('profile') ? 'active' : '' }}">
                <span class="menu_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                        fill="#ffffff">
                        <path
                            d="M451.54-295.39h56.92l9.69-54.61q17.39-5 30-11.85 12.62-6.84 24.77-18.31l52.62 18 28.84-48.76-41.77-35.39q4.31-17.84 4.31-33.69 0-15.85-4.31-33.69l41.77-35.39-28.84-48.76-52.62 18q-12.15-11.47-24.77-18.31-12.61-6.85-30-11.85l-9.69-54.61h-56.92L441.85-610q-17.39 5-30 11.85-12.62 6.84-24.77 18.31l-52.62-18-28.84 48.76 41.77 35.39q-4.31 17.84-4.31 33.69 0 15.85 4.31 33.69l-41.77 35.39 28.84 48.76 52.62-18q12.15 11.47 24.77 18.31 12.61 6.85 30 11.85l9.69 54.61ZM423.5-423.5Q400-447 400-480t23.5-56.5Q447-560 480-560t56.5 23.5Q560-513 560-480t-23.5 56.5Q513-400 480-400t-56.5-23.5ZM212.31-140Q182-140 161-161q-21-21-21-51.31v-535.38Q140-778 161-799q21-21 51.31-21h535.38Q778-820 799-799q21 21 21 51.31v535.38Q820-182 799-161q-21 21-51.31 21H212.31Zm0-60h535.38q4.62 0 8.46-3.85 3.85-3.84 3.85-8.46v-535.38q0-4.62-3.85-8.46-3.84-3.85-8.46-3.85H212.31q-4.62 0-8.46 3.85-3.85 3.84-3.85 8.46v535.38q0 4.62 3.85 8.46 3.84 3.85 8.46 3.85ZM200-760v560-560Z" />
                    </svg>
                </span>
                <span class="menu_text">Settings</span>
            </a>
        </li>

        <li>
            <form class="toggle_form" method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="toggle_class {{ request()->is('logout') ? 'active' : '' }}">
                    <span class="menu_icon">↪</span>
                    <span class="menu_text">Logout</span>
                </button>
            </form>
        </li>
    </ul>
</div>