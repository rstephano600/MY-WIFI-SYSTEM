@extends('layouts.app')

@section('title', 'Payment Details')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm p-4">
        <h4 class="mb-3">Payment Details</h4>

        <p><strong>Customer:</strong> {{ $payment->customer->full_name ?? 'N/A' }}</p>
        <p><strong>Subscription:</strong> {{ $payment->subscription->bundle->name ?? 'N/A' }}</p>
        <p><strong>Amount:</strong> TZS {{ number_format($payment->amount, 2) }}</p>
        <p><strong>Payment Method:</strong> {{ strtoupper($payment->payment_method) }}</p>
        <p><strong>Transaction ID:</strong> {{ $payment->transaction_id ?? '—' }}</p>
        <p><strong>Payment Date:</strong> {{ $payment->payment_date->format('d M Y, h:i A') }}</p>
        <hr>
        <a href="{{ route('payments.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
