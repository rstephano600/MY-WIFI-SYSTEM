@extends('layouts.app')

@section('title', 'Support Tickets')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Support Tickets</h3>
        <a href="{{ route('support_tickets.create') }}" class="btn btn-primary btn-sm">+ New Ticket</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Subject</th>
                <th>Status</th>
                <th>Created</th>
                @if($userRole !== 'customer')
                <th>Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->customer->full_name ?? 'N/A' }}</td>
                    <td>{{ $ticket->subject ?? 'No subject' }}</td>
                    <td>
                        @if ($ticket->status == 'open')
                            <span class="badge bg-success">Open</span>
                        @elseif ($ticket->status == 'in_progress')
                            <span class="badge bg-warning text-dark">In Progress</span>
                        @else
                            <span class="badge bg-secondary">Closed</span>
                        @endif
                    </td>
                    <td>{{ $ticket->created_at->format('d M Y') }}</td>
                    @if($userRole !== 'customer')
                    <td>
                        <a href="{{ route('support_tickets.show', $ticket) }}" class="btn btn-sm btn-success">View</a>
                        <a href="{{ route('support_tickets.edit', $ticket) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('support_tickets.destroy', $ticket) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Delete this ticket?')" class="btn btn-sm btn-danger">Del</button>
                        </form>
                    </td>
                    @endif
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted">No tickets found.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $tickets->links() }}
</div>
@endsection
