@extends('layouts.app')

@section('title', 'Edit Subscription')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0">✏️ Edit Subscription</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('subscriptions.update', $subscription) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Customer</label>
                    <select name="customer_id" class="form-select" required>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" 
                                {{ $subscription->customer_id == $customer->id ? 'selected' : '' }}>
                                {{ $customer->full_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Bundle</label>
                    <select name="bundle_id" class="form-select" required>
                        @foreach($bundles as $bundle)
                            <option value="{{ $bundle->id }}" 
                                {{ $subscription->bundle_id == $bundle->id ? 'selected' : '' }}>
                                {{ $bundle->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Start Date</label>
                        <input type="date" name="start_date" value="{{ $subscription->start_date->format('Y-m-d') }}" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">End Date</label>
                        <input type="date" name="end_date" value="{{ $subscription->end_date->format('Y-m-d') }}" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Remaining Data (GB)</label>
                    <input type="number" step="0.01" name="remaining_data_gb" value="{{ $subscription->remaining_data_gb }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="active" {{ $subscription->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="expired" {{ $subscription->status == 'expired' ? 'selected' : '' }}>Expired</option>
                        <option value="pending" {{ $subscription->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>

                <div class="text-end">
                    <a href="{{ route('subscriptions.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-warning">Update Subscription</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
