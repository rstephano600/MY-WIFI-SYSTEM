@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid py-4">

    {{-- ✅ Summary Cards --}}
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body position-relative overflow-hidden">
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(13, 110, 253, 0.1) 0%, transparent 100%);"></div>
                    <div class="position-relative">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h6 class="text-muted mb-1 fw-normal">Total Customers</h6>
                                <h2 class="mb-0 fw-bold text-primary">{{ number_format($totalCustomers) }}</h2>
                            </div>
                            <div class="bg-primary bg-opacity-10 p-3 rounded-3">
                                <i class="bi bi-people-fill fs-4 text-primary"></i>
                            </div>
                        </div>
                        <small class="text-muted"><i class="bi bi-arrow-up text-success"></i> Active users</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body position-relative overflow-hidden">
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(25, 135, 84, 0.1) 0%, transparent 100%);"></div>
                    <div class="position-relative">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h6 class="text-muted mb-1 fw-normal">Active Subscriptions</h6>
                                <h2 class="mb-0 fw-bold text-success">{{ number_format($activeSubscriptions) }}</h2>
                            </div>
                            <div class="bg-success bg-opacity-10 p-3 rounded-3">
                                <i class="bi bi-check-circle-fill fs-4 text-success"></i>
                            </div>
                        </div>
                        <small class="text-muted"><i class="bi bi-arrow-up text-success"></i> Currently active</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body position-relative overflow-hidden">
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(255, 193, 7, 0.1) 0%, transparent 100%);"></div>
                    <div class="position-relative">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h6 class="text-muted mb-1 fw-normal">Monthly Revenue</h6>
                                <h2 class="mb-0 fw-bold text-warning">TZS {{ number_format($monthlyRevenue, 0) }}</h2>
                            </div>
                            <div class="bg-warning bg-opacity-10 p-3 rounded-3">
                                <i class="bi bi-currency-dollar fs-4 text-warning"></i>
                            </div>
                        </div>
                        <small class="text-muted"><i class="bi bi-calendar3"></i> This month</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body position-relative overflow-hidden">
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(220, 53, 69, 0.1) 0%, transparent 100%);"></div>
                    <div class="position-relative">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h6 class="text-muted mb-1 fw-normal">Open Support Tickets</h6>
                                <h2 class="mb-0 fw-bold text-danger">{{ number_format($openTickets) }}</h2>
                            </div>
                            <div class="bg-danger bg-opacity-10 p-3 rounded-3">
                                <i class="bi bi-ticket-detailed-fill fs-4 text-danger"></i>
                            </div>
                        </div>
                        <small class="text-muted"><i class="bi bi-exclamation-circle text-danger"></i> Needs attention</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 📈 Charts Section --}}
    <!-- <div class="row g-4 mb-4">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-0 pt-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="fw-bold mb-1">Revenue Overview</h5>
                            <p class="text-muted small mb-0">Monthly revenue trends</p>
                        </div>
                        <div class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                            <i class="bi bi-graph-up"></i> Last 12 Months
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="revenueChart" height="100"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-0 pt-4">
                    <h5 class="fw-bold mb-1">Bundle Distribution</h5>
                    <p class="text-muted small mb-0">Active subscriptions by bundle</p>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <canvas id="bundleChart" height="250"></canvas>
                </div>
            </div>
        </div>
    </div> -->

    {{-- 🧑‍💻 Recent Data --}}
    <div class="row g-4 mb-4">
        {{-- Recent Customers --}}
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-0 pt-4 d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="fw-bold mb-1">Recent Customers</h5>
                        <p class="text-muted small mb-0">Latest registrations</p>
                    </div>
                    <a href="{{ route('customers.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                        <i class="bi bi-eye"></i> View All
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0 px-4 py-3 text-muted fw-semibold small">#</th>
                                    <th class="border-0 py-3 text-muted fw-semibold small">Name</th>
                                    <th class="border-0 py-3 text-muted fw-semibold small">Phone</th>
                                    <th class="border-0 py-3 text-muted fw-semibold small">Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentCustomers as $customer)
                                    <tr>
                                        <td class="px-4 py-3">
                                            <span class="badge bg-primary bg-opacity-10 text-primary">{{ $customer->id }}</span>
                                        </td>
                                        <td class="py-3 fw-semibold">{{ $customer->full_name }}</td>
                                        <td class="py-3 text-muted">{{ $customer->phone }}</td>
                                        <td class="py-3">
                                            <small class="text-muted">
                                                <i class="bi bi-clock"></i> {{ $customer->created_at->diffForHumans() }}
                                            </small>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-5">
                                            <i class="bi bi-inbox fs-1 d-block mb-2 opacity-25"></i>
                                            No recent customers.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Recent Tickets --}}
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-0 pt-4 d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="fw-bold mb-1">Recent Support Tickets</h5>
                        <p class="text-muted small mb-0">Latest support requests</p>
                    </div>
                    <a href="{{ route('support_tickets.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                        <i class="bi bi-eye"></i> View All
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0 px-4 py-3 text-muted fw-semibold small">#</th>
                                    <th class="border-0 py-3 text-muted fw-semibold small">Customer</th>
                                    <th class="border-0 py-3 text-muted fw-semibold small">Subject</th>
                                    <th class="border-0 py-3 text-muted fw-semibold small">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentTickets as $ticket)
                                    <tr>
                                        <td class="px-4 py-3">
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary">{{ $ticket->id }}</span>
                                        </td>
                                        <td class="py-3 fw-semibold">
                                            {{ $ticket->customer->full_name ?? '' }}
                                        </td>
                                        <td class="py-3 text-muted">{{ Str::limit($ticket->subject ?? 'N/A', 30) }}</td>
                                        <td class="py-3">
                                            <span class="badge rounded-pill
                                                @if($ticket->status === 'open') bg-danger
                                                @elseif($ticket->status === 'in_progress') bg-warning text-dark
                                                @else bg-success
                                                @endif">
                                                {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-5">
                                            <i class="bi bi-inbox fs-1 d-block mb-2 opacity-25"></i>
                                            No recent tickets.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 📜 Recent Activity --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-0 pt-4">
            <h5 class="fw-bold mb-1">Recent Activity</h5>
            <p class="text-muted small mb-0">System activity log</p>
        </div>
        <div class="card-body">
            <div class="list-group list-group-flush">
                @foreach($recentActivity as $activity)
                    <div class="list-group-item border-0 px-0 py-3">
                        <div class="d-flex align-items-start">
                            <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-3">
                                <i class="bi bi-person-fill text-primary"></i>
                            </div>
                            <div class="flex-grow-1">
                                <p class="mb-1">
                                    <strong class="text-dark">{{ $activity['user'] }}</strong>
                                    <span class="text-muted">{{ $activity['action'] }}:</span>
                                    <span class="text-muted">{{ $activity['details'] }}</span>
                                </p>
                                <small class="text-muted">
                                    <i class="bi bi-clock"></i>
                                    {{ \Carbon\Carbon::parse($activity['timestamp'])->diffForHumans() }}
                                </small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Chart.js default settings
    Chart.defaults.font.family = '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif';
    Chart.defaults.color = '#6c757d';

    // ✅ Revenue Chart (Line Chart with Area Fill)
    const revenueData = @json($revenueData);
    const revenueCtx = document.getElementById('revenueChart');
    
    if (revenueCtx) {
        const gradient = revenueCtx.getContext('2d').createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(13, 110, 253, 0.2)');
        gradient.addColorStop(1, 'rgba(13, 110, 253, 0.01)');

        new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: revenueData.labels || [],
                datasets: [{
                    label: 'Revenue (TZS)',
                    data: revenueData.data || [],
                    borderColor: '#0d6efd',
                    backgroundColor: gradient,
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#0d6efd',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    pointHoverBackgroundColor: '#0d6efd',
                    pointHoverBorderColor: '#fff',
                    pointHoverBorderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        borderColor: '#0d6efd',
                        borderWidth: 1,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return 'TZS ' + context.parsed.y.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                size: 11
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                size: 11
                            },
                            callback: function(value) {
                                return 'TZS ' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    }

    // ✅ Bundle Distribution Chart (Doughnut Chart)
    const bundleData = @json($bundleData);
    const bundleCtx = document.getElementById('bundleChart');
    
    if (bundleCtx && bundleData && bundleData.length > 0) {
        new Chart(bundleCtx, {
            type: 'doughnut',
            data: {
                labels: bundleData.map(b => b.bundle || 'Unknown'),
                datasets: [{
                    data: bundleData.map(b => b.count || 0),
                    backgroundColor: [
                        '#0d6efd',
                        '#198754',
                        '#ffc107',
                        '#dc3545',
                        '#6f42c1',
                        '#fd7e14',
                        '#20c997',
                        '#d63384'
                    ],
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                cutout: '65%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 15,
                            usePointStyle: true,
                            pointStyle: 'circle',
                            font: {
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        borderColor: 'rgba(255, 255, 255, 0.2)',
                        borderWidth: 1,
                        displayColors: true,
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.parsed || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = ((value / total) * 100).toFixed(1);
                                return label + ': ' + value + ' (' + percentage + '%)';
                            }
                        }
                    }
                }
            }
        });
    }
</script>
@endsection