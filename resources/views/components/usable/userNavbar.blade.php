<nav class="navbar">
    <div class="nav-container">

        <!-- Logo -->
        <div class="logo">
            <a href="http://localhost:5173">Foodie<span>Hub</span></a>
        </div>

        <!-- User Section -->
        <div class="user-section">

            <button id="user-menu-btn" class="user-btn">
                
                <!-- Profile Image -->
                <img 
                    src="{{ Auth::user()->user_image 
                        ? asset('storage/' . Auth::user()->user_image) 
                        : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}" 
                    alt="user"
                >

                <!-- Name -->
                <span class="user-name">{{ Auth::user()->name }}</span>

                <!-- Clean Arrow SVG -->
                <svg class="arrow-icon" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" 
                        d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" 
                        clip-rule="evenodd" />
                </svg>

            </button>

            <button id="menu-toggle" class="menu-toggle">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none">
                    <path d="M3 6h18M3 12h18M3 18h18" 
                        stroke="#333" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </button>

            <!-- Dropdown -->
            <div id="user-dropdown" class="dropdown-menu">

                <a href="/user/profile">
                    <svg viewBox="0 0 24 24" class="icon">
                        <path d="M12 12a5 5 0 100-10 5 5 0 000 10zm0 2c-4.4 0-8 2.2-8 5v1h16v-1c0-2.8-3.6-5-8-5z"/>
                    </svg>
                    Profile
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">
                        <svg viewBox="0 0 24 24" class="icon">
                            <path d="M16 17l5-5-5-5v3H9v4h7v3zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 
                            1.1.9 2 2 2h8v-2H4V5z"/>
                        </svg>
                        Logout
                    </button>
                </form>

            </div>

        </div>

    </div>
</nav>