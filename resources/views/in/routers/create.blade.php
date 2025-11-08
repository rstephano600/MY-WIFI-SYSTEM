@extends('layouts.app')

@section('title', 'Register Router')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Register New Router</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('routers.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Serial Number</label>
                        <input type="text" name="serial_number" class="form-control" value="{{ old('serial_number') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Model</label>
                        <input type="text" name="model" class="form-control" value="{{ old('model') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">WiFi Name</label>
                        <input type="text" name="wifi_name" class="form-control" value="{{ old('wifi_name') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">WiFi Password</label>
                        <input type="text" name="wifi_password" class="form-control" value="{{ old('wifi_password') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Customer</label>
                        <select name="customer_id" class="form-select">
                            <option value="">-- Unassigned --</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Registered Date</label>
                        <input type="date" name="registered_date" class="form-control" value="{{ old('registered_date', now()->toDateString()) }}" required>
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <a href="{{ route('routers.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Save Router
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
