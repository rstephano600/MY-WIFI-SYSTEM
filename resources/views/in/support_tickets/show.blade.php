@extends('layouts.app')

@section('title', 'Ticket Details')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm p-4">
        <h4 class="mb-3">Ticket #{{ $support_ticket->id }}</h4>

        <p><strong>Customer:</strong> {{ $support_ticket->customer->full_name ?? 'N/A' }}</p>
        <p><strong>Subject:</strong> {{ $support_ticket->subject ?? 'No subject' }}</p>
        <p><strong>Message:</strong><br>{{ $support_ticket->message }}</p>
        <p>
            <strong>Status:</strong>
            @if ($support_ticket->status == 'open')
                <span class="badge bg-success">Open</span>
            @elseif ($support_ticket->status == 'in_progress')
                <span class="badge bg-warning text-dark">In Progress</span>
            @else
                <span class="badge bg-secondary">Closed</span>
            @endif
        </p>
        <p><strong>Created:</strong> {{ $support_ticket->created_at->format('d M Y, h:i A') }}</p>

        <hr>
        <a href="{{ route('support_tickets.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
