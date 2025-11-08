@extends('layouts.app')

@section('title', 'Add Subscription')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">➕ New Subscription</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('subscriptions.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="customer_id" class="form-label">Customer</label>
                    <select name="customer_id" class="form-select" required>
                        <option value="">-- Select Customer --</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->full_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="bundle_id" class="form-label">Bundle</label>
                    <select name="bundle_id" class="form-select" required>
                        <option value="">-- Select Bundle --</option>
                        @foreach($bundles as $bundle)
                            <option value="{{ $bundle->id }}">
                                {{ $bundle->name }} ({{ $bundle->data_size_gb }}GB / {{ $bundle->duration_days }} days)
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" name="start_date" class="form-control" required>
                </div>

                <div class="text-end">
                    <a href="{{ route('subscriptions.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Create Subscription</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
