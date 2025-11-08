@extends('layouts.app')

@section('title', 'Edit Router')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Edit Router Details</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('routers.update', $router) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Serial Number</label>
                        <input type="text" name="serial_number" class="form-control" value="{{ old('serial_number', $router->serial_number) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Model</label>
                        <input type="text" name="model" class="form-control" value="{{ old('model', $router->model) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">WiFi Name</label>
                        <input type="text" name="wifi_name" class="form-control" value="{{ old('wifi_name', $router->wifi_name) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">WiFi Password</label>
                        <input type="text" name="wifi_password" class="form-control" value="{{ old('wifi_password', $router->wifi_password) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Customer</label>
                        <select name="customer_id" class="form-select">
                            <option value="">-- Unassigned --</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}" {{ $customer->id == $router->customer_id ? 'selected' : '' }}>
                                    {{ $customer->full_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="active" {{ $router->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $router->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Registered Date</label>
                        <input type="date" name="registered_date" class="form-control" value="{{ old('registered_date', $router->registered_date->toDateString()) }}" required>
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <a href="{{ route('routers.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-arrow-repeat"></i> Update Router
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
