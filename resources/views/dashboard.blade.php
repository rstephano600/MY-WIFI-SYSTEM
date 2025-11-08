
<!-- resources/views/customer/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Customer Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="page-header">
    <h1 class="page-title">My Dashboard</h1>
    <p class="text-muted">Welcome back, {{ auth()->user()->name }}!</p>
</div>

<!-- Quick Stats -->
<div class="row g-3 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="card border-0 shadow-sm bg-primary text-white">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <i class="bi bi-wifi fs-1"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-1 text-white-50">Connection Status</h6>
                        <h4 class="mb-0">Active</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card border-0 shadow-sm bg-success text-white">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <i class="bi bi-calendar-check fs-1"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-1 text-white-50">Days Remaining</h6>
                        <h4 class="mb-0">15 Days</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card border-0 shadow-sm bg-warning text-white">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <i class="bi bi-database fs-1"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-1 text-white-50">Data Remaining</h6>
                        <h4 class="mb-0">18.5 GB</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card border-0 shadow-sm bg-info text-white">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <i class="bi bi-speedometer2 fs-1"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-1 text-white-50">Current Speed</h6>
                        <h4 class="mb-0">45 Mbps</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <!-- Current Subscription -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Current Subscription</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="mb-3">Premium 50GB Bundle</h4>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle text-success"></i> <strong>Data:</strong> 50 GB</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success"></i> <strong>Speed:</strong> Up to 50 Mbps</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success"></i> <strong>Duration:</strong> 30 Days</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success"></i> <strong>Price:</strong> $50.00</li>
                        </ul>
                        <div class="mt-3">
                            <span class="badge bg-success px-3 py-2">Active</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6 class="mb-3">Subscription Details</h6>
                        <div class="mb-3">
                            <small class="text-muted d-block mb-1">Start Date</small>
                            <strong>October 13, 2024</strong>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted d-block mb-1">End Date</small>
                            <strong>November 12, 2024</strong>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted d-block mb-1">Renewal Date</small>
                            <strong>November 12, 2024</strong>
                        </div>
                        <a href="#" class="btn btn-primary mt-2">
                            <i class="bi bi-arrow-repeat"></i> Renew Now
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Usage Chart -->
        <div class="card border-0 shadow-sm mt-3">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Data Usage</h5>
            </div>
            <div class="card-body">
                <canvas id="dataUsageChart" height="80"></canvas>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Data Usage Progress -->
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Data Usage</h5>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    <h2 class="mb-0">37%</h2>
                    <p class="text-muted mb-0">Used</p>
                </div>
                <div class="progress mb-2" style="height: 20px;">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 37%"></div>
                </div>
                <div class="d-flex justify-content-between">
                    <small class="text-muted">18.5 GB remaining</small>
                    <small class="text-muted">50 GB total</small>
                </div>
            </div>
        </div>

        <!-- Router Info -->
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">My Router</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted">Serial Number</small>
                    <p class="mb-0"><strong>RTR-2024-00145</strong></p>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Model</small>
                    <p class="mb-0"><strong>TP-Link Archer C6</strong></p>
                </div>
                <div class="mb-3">
                    <small class="text-muted">WiFi Name</small>
                    <p class="mb-0"><strong>TTCL-WIFI-145</strong></p>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Status</small>
                    <p class="mb-0"><span class="badge bg-success">Online</span></p>
                </div>
                <a href="#" class="btn btn-outline-primary w-100">
                    <i class="bi bi-gear"></i> Manage Router
                </a>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="#" class="btn btn-outline-primary">
                        <i class="bi bi-box-seam"></i> Browse Bundles
                    </a>
                    <a href="#" class="btn btn-outline-success">
                        <i class="bi bi-credit-card"></i> Make Payment
                    </a>
                    <a href="#" class="btn btn-outline-warning">
                        <i class="bi bi-receipt"></i> Payment History
                    </a>
                    <a href="#" class="btn btn-outline-danger">
                        <i class="bi bi-headset"></i> Contact Support
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Available Bundles -->
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Available Bundles</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-lg-3 col-md-6">
                        <div class="card border">
                            <div class="card-body text-center">
                                <h5>Basic</h5>
                                <h2 class="text-primary">$15</h2>
                                <p class="text-muted">10 GB / 15 Days</p>
                                <ul class="list-unstyled text-start">
                                    <li class="mb-2"><i class="bi bi-check text-success"></i> 10 GB Data</li>
                                    <li class="mb-2"><i class="bi bi-check text-success"></i> 15 Days Validity</li>
                                    <li class="mb-2"><i class="bi bi-check text-success"></i> 24/7 Support</li>
                                </ul>
                                <a href="#" class="btn btn-outline-primary w-100">Select</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card border">
                            <div class="card-body text-center">
                                <h5>Standard</h5>
                                <h2 class="text-primary">$30</h2>
                                <p class="text-muted">25 GB / 30 Days</p>
                                <ul class="list-unstyled text-start">
                                    <li class="mb-2"><i class="bi bi-check text-success"></i> 25 GB Data</li>
                                    <li class="mb-2"><i class="bi bi-check text-success"></i> 30 Days Validity</li>
                                    <li class="mb-2"><i class="bi bi-check text-success"></i> 24/7 Support</li>
                                </ul>
                                <a href="#" class="btn btn-outline-primary w-100">Select</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card border border-primary">
                            <div class="card-body text-center">
                                <span class="badge bg-primary mb-2">Popular</span>
                                <h5>Premium</h5>
                                <h2 class="text-primary">$50</h2>
                                <p class="text-muted">50 GB / 30 Days</p>
                                <ul class="list-unstyled text-start">
                                    <li class="mb-2"><i class="bi bi-check text-success"></i> 50 GB Data</li>
                                    <li class="mb-2"><i class="bi bi-check text-success"></i> 30 Days Validity</li>
                                    <li class="mb-2"><i class="bi bi-check text-success"></i> Priority Support</li>
                                </ul>
                                <a href="#" class="btn btn-primary w-100">Select</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card border">
                            <div class="card-body text-center">
                                <h5>Ultimate</h5>
                                <h2 class="text-primary">$85</h2>
                                <p class="text-muted">100 GB / 30 Days</p>
                                <ul class="list-unstyled text-start">
                                    <li class="mb-2"><i class="bi bi-check text-success"></i> 100 GB Data</li>
                                    <li class="mb-2"><i class="bi bi-check text-success"></i> 30 Days Validity</li>
                                    <li class="mb-2"><i class="bi bi-check text-success"></i> VIP Support</li>
                                </ul>
                                <a href="#" class="btn btn-outline-primary w-100">Select</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Payments -->
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Recent Payments</h5>
                <a href="#" class="btn btn-sm btn-primary">View All</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Date</th>
                                <th>Bundle</th>
                                <th>Amount</th>
                                <th>Payment Method</th>
                                <th>Transaction ID</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2024-10-13</td>
                                <td>Premium 50GB</td>
                                <td>$50.00</td>
                                <td>M-Pesa</td>
                                <td>TXN123456789</td>
                                <td><span class="badge bg-success">Completed</span></td>
                            </tr>
                            <tr>
                                <td>2024-09-13</td>
                                <td>Premium 50GB</td>