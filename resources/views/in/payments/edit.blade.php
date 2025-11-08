@extends('layouts.app')

@section('title', 'Edit Payment')

@section('content')
<div class="container mt-4">
    <h3>Edit Payment</h3>
    <form action="{{ route('payments.update', $payment) }}" method="POST" class="card p-4 shadow-sm">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="form-label">Customer</label>
            <select name="customer_id" class="form-select">
                @foreach($customers as $c)
                    <option value="{{ $c->id }}" {{ $payment->customer_id == $c->id ? 'selected' : '' }}>{{ $c->full_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Subscription</label>
            <select name="subscription_id" class="form-select">
                <option value="">None</option>
                @foreach($subscriptions as $s)
                    <option value="{{ $s->id }}" {{ $payment->subscription_id == $s->id ? 'selected' : '' }}>
                        {{ $s->bundle->name ?? 'Bundle' }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Amount (TZS)</label>
            <input type="number" name="amount" value="{{ $payment->amount }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Payment Method</label>
            <select name="payment_method" class="form-select">
                @foreach(['cash','mpesa','airtelmoney','ttcl_app'] as $method)
                    <option value="{{ $method }}" {{ $payment->payment_method == $method ? 'selected' : '' }}>
                        {{ ucfirst($method) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Transaction ID</label>
            <input type="text" name="transaction_id" value="{{ $payment->transaction_id }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Payment Date</label>
            <input type="datetime-local" name="payment_date" class="form-control"
                   value="{{ $payment->payment_date->format('Y-m-d\TH:i') }}">
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('payments.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
