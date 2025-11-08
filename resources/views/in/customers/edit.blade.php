@extends('layouts.app')

@section('title', 'Edit Customer')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Customer: {{ $customer->full_name }}</h3>
                    <a href="{{ route('customers.index') }}" class="btn btn-secondary float-right">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
                <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>User Information</h5>
                                
                                <div class="form-group">
                                    <label for="name">Name *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name', $customer->user->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="username">Username *</label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror" 
                                           id="username" name="username" value="{{ old('username', $customer->user->username) }}" required>
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email *</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email', $customer->user->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                           id="password" name="password" placeholder="Leave blank to keep current password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" class="form-control" 
                                           id="password_confirmation" name="password_confirmation">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h5>Customer Information</h5>
                                
                                <div class="form-group">
                                    <label for="full_name">Full Name *</label>
                                    <input type="text" class="form-control @error('full_name') is-invalid @enderror" 
                                           id="full_name" name="full_name" value="{{ old('full_name', $customer->full_name) }}" required>
                                    @error('full_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone *</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" name="phone" value="{{ old('phone', $customer->phone) }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" 
                                              id="address" name="address" rows="3">{{ old('address', $customer->address) }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <input type="text" class="form-control @error('location') is-invalid @enderror" 
                                           id="location" name="location" value="{{ old('location', $customer->location) }}">
                                    @error('location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="router_serial">Router Serial</label>
                                    <select class="form-control @error('router_serial') is-invalid @enderror" 
                                            id="router_serial" name="router_serial">
                                        <option value="">No Router</option>
                                        @foreach($availableRouters as $router)
                                            <option value="{{ $router->serial_number }}" 
                                                {{ old('router_serial', $customer->router_serial) == $router->serial_number ? 'selected' : '' }}>
                                                {{ $router->serial_number }} ({{ $router->model }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('router_serial')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Router Management -->
                                @if($customer->router)
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h6 class="card-title">Current Router</h6>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Serial:</strong> {{ $customer->router->serial_number }}</p>
                                        <p><strong>Model:</strong> {{ $customer->router->model }}</p>
                                        <p><strong>WiFi Name:</strong> {{ $customer->router->wifi_name }}</p>
                                        <p><strong>Status:</strong> 
                                            <span class="badge badge-{{ $customer->router->status == 'active' ? 'success' : 'warning' }}">
                                                {{ $customer->router->status }}
                                            </span>
                                        </p>
                                        <form action="{{ route('customers.remove-router', $customer->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to remove this router?')">
                                                Remove Router
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Customer
                        </button>
                        <a href="{{ route('customers.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection