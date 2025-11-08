@extends('layouts.app')

@section('title', 'Subscription Details')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">📄 Subscription Details</h5>
        </div>
        <div class="card-body">
            <p><strong>Customer:</strong> {{ $subscription->customer->full_name ?? 'N/A' }}</p>
            <p><strong>Bundle:</strong> {{ $subscription->bundle->name ?? 'N/A' }}</p>
            <p><strong>Start Date:</strong> {{ $subscription->start_date->format('d M Y') }}</p>
            <p><strong>End Date:</strong> {{ $subscription->end_date->format('d M Y') }}</p>
            <p><strong>Status:</strong> 
                <span class="badge {{ $subscription->isActive() ? 'bg-success' : 'bg-danger' }}">
                    {{ ucfirst($subscription->status) }}
                </span>
            </p>
            <p><strong>Remaining Data:</strong> {{ $subscription->remaining_data_gb }} GB</p>
            <p><strong>Days Remaining:</strong> {{ $subscription->daysRemaining() }} days</p>

            <div class="mt-3">
                <div class="progress" style="height: 10px;">
                    <div class="progress-bar" style="width: {{ $subscription->dataUsagePercentage() }}%"></div>
                </div>
                <small>{{ number_format($subscription->dataUsagePercentage(), 1) }}% used</small>
            </div>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('subscriptions.index') }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('subscriptions.edit', $subscription) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>
@endsection
