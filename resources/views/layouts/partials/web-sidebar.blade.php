
<!-- resources/views/layouts/partials/sidebar.blade.php -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <i class="bi bi-wifi"></i> TTCL ISP
    </div>

    <nav class="sidebar-menu">
        <ul class="nav flex-column">

                <!-- Common for all roles -->
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        <i class="bi bi-house"></i>
                        <span>Home</span>
                    </a>
                </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-ticket-perforated"></i>
                            <span>Support</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">
                            <i class="bi bi-box-arrow-left"></i>
                            <span>Login</span>
                        </a>
                    </li>

        </ul>
    </nav>
</aside>

