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
<!-- Notifications -->
<div class="dropdown" id="notificationDropdown">
    <button class="btn btn-link text-dark notification-badge position-relative" type="button" data-bs-toggle="dropdown">
        <i class="bi bi-bell" style="font-size: 1.25rem;"></i>
        <span class="badge bg-danger position-absolute top-0 start-100 translate-middle p-1 rounded-circle" id="notificationCount">0</span>
    </button>

    <ul class="dropdown-menu dropdown-menu-end" style="min-width: 320px;" id="notificationList">
        <li class="dropdown-header">
            <strong>Notifications</strong>
        </li>
        <li><hr class="dropdown-divider"></li>
        <li class="text-center text-muted small p-2">Loading...</li>
    </ul>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    fetchNotifications();

    // Auto refresh every 60s
    setInterval(fetchNotifications, 60000);

    function fetchNotifications() {
        fetch('{{ route('notifications.index') }}')
            .then(response => response.json())
            .then(data => {
                const list = document.getElementById('notificationList');
                const count = document.getElementById('notificationCount');
                list.innerHTML = '';

                if (data.length === 0) {
                    list.innerHTML = '<li class="text-center text-muted small p-2">No new notifications</li>';
                    count.textContent = 0;
                    count.style.display = 'none';
                    return;
                }

                count.textContent = data.length;
                count.style.display = 'inline-block';

                data.forEach(n => {
                    const icon = getIcon(n.type);
                    const li = `
                        <li>
                            <a class="dropdown-item" href="#" onclick="markAsRead(${n.id})">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">${icon}</div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="mb-0 small fw-bold">${n.title ?? 'Notification'}</p>
                                        <p class="mb-0 small">${n.message}</p>
                                        <small class="text-muted">${timeAgo(n.created_at)}</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                    `;
                    list.insertAdjacentHTML('beforeend', li);
                });

                list.insertAdjacentHTML('beforeend', `
                    <li><a class="dropdown-item text-center small text-primary" href="{{ url('/notifications') }}">View all</a></li>
                `);
            });
    }

    function markAsRead(id) {
        fetch(`/notifications/${id}/read`, {
            method: 'POST',
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
        }).then(() => fetchNotifications());
    }

    function getIcon(type) {
        switch(type) {
            case 'warning': return '<i class="bi bi-exclamation-triangle text-warning"></i>';
            case 'success': return '<i class="bi bi-check-circle text-success"></i>';
            case 'danger':  return '<i class="bi bi-x-circle text-danger"></i>';
            default:        return '<i class="bi bi-info-circle text-primary"></i>';
        }
    }

    function timeAgo(timestamp) {
        const time = new Date(timestamp);
        const diff = (new Date() - time) / 1000;
        if (diff < 60) return `${Math.floor(diff)}s ago`;
        if (diff < 3600) return `${Math.floor(diff/60)}m ago`;
        if (diff < 86400) return `${Math.floor(diff/3600)}h ago`;
        return `${Math.floor(diff/86400)}d ago`;
    }
});
</script>


        <!-- User Menu -->
        <div class="dropdown">
            <button class="btn btn-link p-0" type="button" data-bs-toggle="dropdown">
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                </div>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li class="dropdown-header">
                    <strong>{{ auth()->user()->name }}</strong><br>
                    <small class="text-muted">{{ auth()->user()->email }}</small><br>
                    <span class="badge bg-primary mt-1">{{ ucfirst(auth()->user()->role) }}</span>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="bi bi-person-circle"></i> Profile
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('change-password') }}">
                        <i class="bi bi-key"></i> Change Password
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="bi bi-gear"></i> Settings
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>
