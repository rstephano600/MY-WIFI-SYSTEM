@extends('layouts.app')

@section('title', 'Customer Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Customer Details: {{ $customer->full_name }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('customers.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-primary">
                                    <h4 class="card-title text-white">User Information</h4>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="30%">Name:</th>
                                            <td>{{ $customer->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Username:</th>
                                            <td>{{ $customer->user->username }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email:</th>
                                            <td>{{ $customer->user->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email Verified:</th>
                                            <td>
                                                @if($customer->user->email_verified_at)
                                                    <span class="badge badge-success">Verified</span>
                                                @else
                                                    <span class="badge badge-warning">Not Verified</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Registration Date:</th>
                                            <td>{{ $customer->user->created_at->format('M d, Y h:i A') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-success">
                                    <h4 class="card-title text-white">Customer Information</h4>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="30%">Full Name:</th>
                                            <td>{{ $customer->full_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Phone:</th>
                                            <td>{{ $customer->phone }}</td>
                                        </tr>
                                        <tr>
                                            <th>Address:</th>
                                            <td>{{ $customer->address ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Location:</th>
                                            <td>{{ $customer->location ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Registration Date:</th>
                                            <td>{{ $customer->registration_date->format('M d, Y h:i A') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Router Information -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-info">
                                    <h4 class="card-title text-white">Router Information</h4>
                                </div>
                                <div class="card-body">
                                    @if($customer->router)
                                        <div class="row">
                                            <div class="col-md-6">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th width="30%">Serial Number:</th>
                                                        <td>{{ $customer->router->serial_number }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Model:</th>
                                                        <td>{{ $customer->router->model ?? 'N/A' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>WiFi Name:</th>
                                                        <td>{{ $customer->router->wifi_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Status:</th>
                                                        <td>
                                                            <span class="badge badge-{{ $customer->router->status == 'active' ? 'success' : 'warning' }}">
                                                                {{ ucfirst($customer->router->status) }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-md-6">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th width="30%">WiFi Password:</th>
                                                        <td>
                                                            <div class="input-group">
                                                                <input type="password" class="form-control" id="wifiPassword" value="{{ $customer->router->wifi_password }}" readonly>
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                                                                        <i class="fas fa-eye"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Registered Date:</th>
                                                        <td>{{ $customer->router->registered_date->format('M d, Y h:i A') }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    @else
                                        <div class="alert alert-warning text-center">
                                            <h5>No Router Assigned</h5>
                                            <p>This customer doesn't have a router assigned yet.</p>
                                            <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-primary">
                                                Assign Router
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function togglePassword() {
    const passwordField = document.getElementById('wifiPassword');
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);
}
</script>
@endpush