
<!-- resources/views/layouts/partials/sidebar.blade.php -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <i class="bi bi-wifi"></i> TTCL ISP
    </div>

    <nav class="sidebar-menu">
        <ul class="nav flex-column">
            @auth
                @php
                    $userRole = auth()->user()->role;
                @endphp

                <!-- Common for all roles -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                @if(in_array($userRole, ['admin', 'manager']))
                    <!-- Admin & Manager Menu -->
                    <li class="nav-item">
                        <a href="{{ route('customers.index') }}" class="nav-link">
                            <i class="bi bi-people"></i>
                            <span>Customers</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('routers.index') }}" class="nav-link">
                            <i class="bi bi-router"></i>
                            <span>Routers</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('bundles.index') }}" class="nav-link">
                            <i class="bi bi-box-seam"></i>
                            <span>Bundles</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('subscriptions.index') }}" class="nav-link">
                            <i class="bi bi-calendar-check"></i>
                            <span>Subscriptions</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('payments.index') }}" class="nav-link">
                            <i class="bi bi-credit-card"></i>
                            <span>Payments</span>
                        </a>
                    </li>
                @endif

                @if(in_array($userRole, ['admin', 'manager', 'customer_care']))
                    <li class="nav-item">
                        <a href="{{ route('support_tickets.index') }}" class="nav-link">
                            <i class="bi bi-headset"></i>
                            <span>Support Tickets</span>
                        </a>
                    </li>
                @endif

                @if($userRole === 'admin')
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link">
                            <i class="bi bi-person-badge"></i>
                            <span>Users</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-clock-history"></i>
                            <span>System Logs</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-gear"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                @endif

                @if($userRole === 'customer')
                    <!-- Customer Menu -->
                    <li class="nav-item">
                        <a href="{{ route('subscriptions.index') }}" class="nav-link">
                            <i class="bi bi-calendar-check"></i>
                            <span>My Subscription</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('bundles.index') }}" class="nav-link">
                            <i class="bi bi-box-seam"></i>
                            <span>Available Bundles</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('payments.index') }}" class="nav-link">
                            <i class="bi bi-receipt"></i>
                            <span>Payment History</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('routers.index') }}" class="nav-link">
                            <i class="bi bi-router"></i>
                            <span>My Router</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('support_tickets.index') }}" class="nav-link">
                            <i class="bi bi-ticket-perforated"></i>
                            <span>Support</span>
                        </a>
                    </li>
                @endif

                @if(in_array($userRole, ['staff']))
                    <!-- Staff Menu -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-people"></i>
                            <span>Customers</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-credit-card"></i>
                            <span>Payments</span>
                        </a>
                    </li>
                @endif

                <!-- Common Menu Items -->
                <li class="nav-item">
                    <a href="{{ route('profile.index') }}" class="nav-link">
                        <i class="bi bi-person-circle"></i>
                        <span>Profile</span>
                    </a>
                </li>
            @endauth
        </ul>
    </nav>
</aside>

