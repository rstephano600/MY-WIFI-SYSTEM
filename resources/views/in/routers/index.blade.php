@extends('layouts.app')

@section('title', 'Routers Management')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Routers Management</h3>
        @if(in_array($userRole, ['admin', 'manager']))
        <a href="{{ route('routers.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Router
        </a>
        @endif
    </div>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Serial Number</th>
                        <th>Model</th>
                        <th>WiFi Name</th>
                        <th>Status</th>
                        <th>Customer</th>
                        <th>Registered</th>
                        @if(in_array($userRole, ['admin', 'manager']))
                        <th>Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($routers as $router)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $router->serial_number }}</td>
                            <td>{{ $router->model }}</td>
                            <td>{{ $router->wifi_name }}</td>
                            <td>
                                <span class="badge {{ $router->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ ucfirst($router->status) }}
                                </span>
                            </td>
                            <td>{{ $router->customer?->full_name ?? 'Unassigned' }}</td>
                            <td>{{ $router->registered_date->format('Y-m-d') }}</td>
                            @if(in_array($userRole, ['admin', 'manager']))
                            <td>
                                <a href="{{ route('routers.show', $router) }}" class="btn btn-sm btn-info text-white">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('routers.edit', $router) }}" class="btn btn-sm btn-warning text-white">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('routers.destroy', $router) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this router?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No routers found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $routers->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
