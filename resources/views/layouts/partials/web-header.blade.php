<!-- resources/views/layouts/partials/header.blade.php -->
<header class="header">
    <div class="header-left">
        <button class="toggle-sidebar" onclick="toggleSidebar()">
            <i class="bi bi-list"></i>
        </button>
        
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                @yield('breadcrumb')
            </ol>
        </nav>
    </div>

    <div class="header-right">
        <!-- Search -->
        <div class="d-none d-md-block">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search..." style="max-width: 250px;">
                <button class="btn btn-outline-secondary" type="button">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>

        <!-- Notifications -->
        <div class="dropdown">
            <button class="btn btn-link text-dark notification-badge" type="button" data-bs-toggle="dropdown">
                <i class="bi bi-bell" style="font-size: 1.25rem;"></i>
                <span class="badge bg-danger">3</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" style="min-width: 300px;">
                <li class="dropdown-header">
                    <strong>Notifications</strong>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item" href="#">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="bi bi-info-circle text-primary"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="mb-0 small">New updates</p>
                                <small class="text-muted">2 minutes ago</small>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="bi bi-exclamation-triangle text-warning"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="mb-0 small">New important</p>
                                <small class="text-muted">1 hour ago</small>
                            </div>
                        </div>
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item text-center small" href="#">View all updates</a>
                </li>
            </ul>
        </div>

        <!-- User Menu -->
        <div class="dropdown">
            <button class="btn btn-link p-0" type="button" data-bs-toggle="dropdown">
                <div class="user-avatar">
                    Services
                </div>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li class="dropdown-header">
                    <strong>ttcl</strong><br>
                    <small class="text-muted">contact us</small><br>
                    <span class="badge bg-primary mt-1">home network</span>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="bi bi-person-circle"></i> about us
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="bi bi-key"></i> our privacy
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="bi bi-gear"></i> Settings
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('login') }}">
                        <i class="bi bi-box-arrow-left"></i> Login
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>

            </ul>
        </div>
    </div>
</header>
