@extends('layouts.app')

@section('title', 'Subscriptions List')

@section('content')
<div class="container mt-4">

@if(in_array($userRole, ['admin', 'manager']))
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">📡 Subscriptions</h3>
        <a href="{{ route('subscriptions.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Subscription
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Bundle</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Data Used</th>
                        @if(in_array($userRole, ['admin', 'manager']))
                        <th class="text-end">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($subscriptions as $subscription)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $subscription->customer->full_name ?? 'N/A' }}</td>
                            <td>{{ $subscription->bundle->name ?? 'N/A' }}</td>
                            <td>{{ $subscription->start_date->format('d M Y') }}</td>
                            <td>{{ $subscription->end_date->format('d M Y') }}</td>
                            <td>
                                <span class="badge 
                                    {{ $subscription->isActive() ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($subscription->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar" role="progressbar" 
                                         style="width: {{ $subscription->dataUsagePercentage() }}%">
                                    </div>
                                </div>
                                <small>{{ $subscription->remaining_data_gb }}GB left</small>
                            </td>
                            @if(in_array($userRole, ['admin', 'manager']))
                            <td class="text-end">
                                <a href="{{ route('subscriptions.show', $subscription) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('subscriptions.edit', $subscription) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form action="{{ route('subscriptions.destroy', $subscription) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this subscription?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="text-center">No subscriptions found.</td></tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $subscriptions->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
