@extends('layouts.app')

@section('title', 'Add Payment')

@section('content')
<div class="container mt-4">
    <h3>Add Payment</h3>
    <form action="{{ route('payments.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf

        <div class="mb-3">
            <label class="form-label">Customer</label>
            <select name="customer_id" class="form-select" required>
                <option value="">Select Customer</option>
                @foreach($customers as $c)
                    <option value="{{ $c->id }}">{{ $c->full_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Subscription (Optional)</label>
            <select name="subscription_id" class="form-select">
                <option value="">None</option>
                @foreach($subscriptions as $s)
                    <option value="{{ $s->id }}">{{ $s->bundle->name ?? 'Bundle' }} - {{ $s->bundle->price ?? 0 }} - {{ $s->customer->full_name ?? '' }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Amount (TZS)</label>
            <input type="number" step="0.01" name="amount" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Payment Method</label>
            <select name="payment_method" class="form-select" required>
                <option value="ttcl_app">TTCL App</option>
                <option value="mpesa">M-Pesa</option>
                <option value="airtelmoney">Airtel Money</option>
                <option value="cash">Cash</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Transaction ID</label>
            <input type="text" name="transaction_id" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Payment Date</label>
            <input type="datetime-local" name="payment_date" class="form-control" value="{{ now()->format('Y-m-d\TH:i') }}">
        </div>

        <button class="btn btn-primary">Save Payment</button>
        <a href="{{ route('payments.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
