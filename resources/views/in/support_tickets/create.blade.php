@extends('layouts.app')

@section('title', 'New Support Ticket')

@section('content')
<div class="container mt-4">
    <h3>Create Support Ticket</h3>

    @php
                    $userRole = auth()->user()->role;
                @endphp


                @if(in_array($userRole, ['admin', 'manager']))
    <form action="{{ route('support_tickets.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf

        <div class="mb-3">
            <label class="form-label">Customer</label>
            <select name="customer_id" class="form-select" required>
                <option value="">Select Customer</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->full_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Subject</label>
            <input type="text" name="subject" class="form-control" placeholder="Enter subject (optional)">
        </div>

        <div class="mb-3">
            <label class="form-label">Message</label>
            <textarea name="message" rows="4" class="form-control" required></textarea>
        </div>

        <button class="btn btn-primary">Create Ticket</button>
        <a href="{{ route('support_tickets.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
    @endif
    
    <form action="{{ route('support_tickets.store') }}" method="POST">
                        @csrf

                        {{-- Customer ID (hidden or auto-detected) --}}
                        <input type="hidden" name="customer_id" value="{{ auth()->user()->customer->id ?? '' }}">

                        {{-- Subject --}}
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" name="subject" id="subject" 
                                   class="form-control @error('subject') is-invalid @enderror"
                                   placeholder="Enter a brief subject">
                            @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Message --}}
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea name="message" id="message" rows="5" 
                                      class="form-control @error('message') is-invalid @enderror"
                                      placeholder="Describe your issue or question in detail"></textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('support_tickets.index') }}" class="btn btn-secondary me-2">
                                <i class="bi bi-arrow-left-circle"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-send"></i> Submit Ticket
                            </button>
                        </div>

                    </form>

</div>
@endsection
