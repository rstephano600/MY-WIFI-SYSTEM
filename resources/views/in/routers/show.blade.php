@extends('layouts.app')

@section('title', 'Router Details')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Router Details</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-3">Serial Number</dt>
                <dd class="col-sm-9">{{ $router->serial_number }}</dd>

                <dt class="col-sm-3">Model</dt>
                <dd class="col-sm-9">{{ $router->model }}</dd>

                <dt class="col-sm-3">WiFi Name</dt>
                <dd class="col-sm-9">{{ $router->wifi_name }}</dd>

                <dt class="col-sm-3">WiFi Password</dt>
                <dd class="col-sm-9">{{ $router->wifi_password }}</dd>

                <dt class="col-sm-3">Status</dt>
                <dd class="col-sm-9">
                    <span class="badge {{ $router->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                        {{ ucfirst($router->status) }}
                    </span>
                </dd>

                <dt class="col-sm-3">Customer</dt>
                <dd class="col-sm-9">{{ $router->customer?->name ?? 'Unassigned' }}</dd>

                <dt class="col-sm-3">Registered Date</dt>
                <dd class="col-sm-9">{{ $router->registered_date->format('Y-m-d') }}</dd>
            </dl>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('routers.index') }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('routers.edit', $router) }}" class="btn btn-warning text-white">
                <i class="bi bi-pencil-square"></i> Edit
            </a>
        </div>
    </div>
</div>
@endsection
