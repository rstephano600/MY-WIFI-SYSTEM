@extends('layouts.app')

@section('title', 'Edit Ticket')

@section('content')
<div class="container mt-4">
    <h3>Edit Ticket</h3>
    <form action="{{ route('support_tickets.update', $support_ticket) }}" method="POST" class="card p-4 shadow-sm">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="form-label">Customer</label>
            <select name="customer_id" class="form-select">
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" {{ $support_ticket->customer_id == $customer->id ? 'selected' : '' }}>
                        {{ $customer->full_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Subject</label>
            <input type="text" name="subject" value="{{ $support_ticket->subject }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Message</label>
            <textarea name="message" rows="4" class="form-control">{{ $support_ticket->message }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="open" {{ $support_ticket->status == 'open' ? 'selected' : '' }}>Open</option>
                <option value="in_progress" {{ $support_ticket->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="closed" {{ $support_ticket->status == 'closed' ? 'selected' : '' }}>Closed</option>
            </select>
        </div>

        <button class="btn btn-primary">Update Ticket</button>
        <a href="{{ route('support_tickets.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
