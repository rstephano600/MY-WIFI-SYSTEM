@extends('layouts.app')

@section('title', 'Payments')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Payments</h3>
        @if(in_array($userRole, ['admin', 'manager']))
        <a href="{{ route('payments.create') }}" class="btn btn-primary btn-sm">+ Add Payment</a>
        @endif
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Subscription</th>
                <th>Amount (TZS)</th>
                <th>Method</th>
                <th>Transaction ID</th>
                <th>Date</th>
                @if(in_array($userRole, ['admin', 'manager']))
                <th>Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse($payments as $payment)
                <tr>
                    <td>{{ $payment->id }}</td>
                    <td>{{ $payment->customer->full_name ?? 'N/A' }}</td>
                    <td>{{ $payment->subscription->bundle->name ?? 'N/A' }}</td>
                    <td>{{ number_format($payment->amount, 2) }}</td>
                    <td><span class="badge bg-info">{{ strtoupper($payment->payment_method) }}</span></td>
                    <td>{{ $payment->transaction_id ?? '—' }}</td>
                    <td>{{ $payment->payment_date->format('d M Y, h:i A') }}</td>

                    @if(in_array($userRole, ['admin', 'manager']))
                    <td>
                        <a href="{{ route('payments.show', $payment) }}" class="btn btn-sm btn-success">View</a>
                        <a href="{{ route('payments.edit', $payment) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('payments.destroy', $payment) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Delete this payment?')" class="btn btn-sm btn-danger">Del</button>
                        </form>
                    </td>
                    @endif
                </tr>
            @empty
                <tr><td colspan="8" class="text-center text-muted">No payments found.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $payments->links() }}
</div>
@endsection
