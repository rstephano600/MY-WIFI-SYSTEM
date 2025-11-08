@extends('layouts.app')

@section('title', 'View User Details')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">👤 User Details</h3>

    <a href="{{ route('users.index') }}" class="btn btn-secondary mb-3">← Back</a>

    <div class="card shadow p-4">
        <h5 class="text-primary mb-3">{{ $user->name }}</h5>

        <table class="table table-borderless">
            <tr>
                <th>Username:</th>
                <td>{{ $user->username }}</td>
            </tr>
            <tr>
                <th>Email:</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Role:</th>
                <td>{{ ucfirst(str_replace('_', ' ', $user->role)) }}</td>
            </tr>
            <tr>
                <th>Status:</th>
                <td>
                    <span class="badge {{ $user->status == 'active' ? 'bg-success' : 'bg-secondary' }}">
                        {{ ucfirst($user->status) }}
                    </span>
                </td>
            </tr>
            <tr>
                <th>Created At:</th>
                <td>{{ $user->created_at->format('d M Y, H:i A') }}</td>
            </tr>
        </table>

        <div class="mt-3">
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">✏️ Edit</a>
            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this user?')">🗑️ Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
