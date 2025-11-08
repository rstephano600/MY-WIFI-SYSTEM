@extends('layouts.app')

@section('title', 'Customer Dashboard')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">Welcome, {{ $customer->first_name }} 👋</h2>
        <a href="{{ route('profile.index') }}" class="btn btn-outline-primary btn-sm">Edit Profile</a>
    </div>

    {{-- 🌐 Active Subscription --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">Active Subscription</div>
        <div class="card-body">
            @if($activeSubscription)
                <h5 class="card-title">{{ $activeSubscription->bundle->name }}</h5>
                <p class="mb-1"><strong>Data:</strong> {{ $activeSubscription->bundle->data_size_gb }} GB</p>
                <p class="mb-1"><strong>Remaining:</strong> {{ $activeSubscription->remaining_data_gb }} GB</p>
                <p class="mb-1"><strong>Status:</strong> 
                    <span class="badge bg-success text-uppercase">{{ $activeSubscription->status }}</span>
                </p>
                <p><strong>Ends:</strong> {{ $activeSubscription->end_date->format('d M Y') }}</p>

                <div class="progress" style="height: 10px;">
                    @php
                        $usage = $activeSubscription->dataUsagePercentage();
                    @endphp
                    <div class="progress-bar bg-success" style="width: {{ $usage }}%;" role="progressbar"></div>
                </div>
                <small class="text-muted">{{ number_format($usage, 0) }}% used</small>
            @else
                <p class="text-muted mb-0">You have no active subscription.</p>
                <a href="#" class="btn btn-sm btn-primary mt-2">Buy Bundle</a>
            @endif
        </div>
    </div>

    {{-- 💳 Recent Payments --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light">
            <strong>Recent Payments</strong>
        </div>
        <div class="card-body">
            @if($recentPayments->count())
                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Date</th>
                                <th>Amount (TZS)</th>
                                <th>Method</th>
                                <th>Transaction ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentPayments as $pay)
                                <tr>
                                    <td>{{ $pay->payment_date->format('d M Y H:i') }}</td>
                                    <td>{{ number_format($pay->amount, 0) }}</td>
                                    <td>{{ strtoupper($pay->payment_method) }}</td>
                                    <td>{{ $pay->transaction_id ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted mb-0">No payments found.</p>
            @endif
        </div>
    </div>

    {{-- 🎟️ Support Tickets --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light">
            <strong>Support Tickets</strong>
        </div>
        <div class="card-body">
            @if($recentTickets->count())
                <ul class="list-group list-group-flush">
                    @foreach($recentTickets as $ticket)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $ticket->subject ?? 'No Subject' }}</strong><br>
                                <small class="text-muted">{{ Str::limit($ticket->message, 50) }}</small>
                            </div>
                            <span class="badge 
                                {{ $ticket->status == 'open' ? 'bg-warning' : ($ticket->status == 'closed' ? 'bg-secondary' : 'bg-info') }}">
                                {{ ucfirst($ticket->status) }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted mb-0">No support tickets yet.</p>
                <a href="{{ route('support_tickets.create') }}" class="btn btn-sm btn-outline-primary mt-2">
                    Create Ticket
                </a>
            @endif
        </div>
    </div>

</div>
@endsection
