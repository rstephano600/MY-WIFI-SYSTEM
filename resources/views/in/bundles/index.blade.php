@extends('layouts.app')

@section('title', 'Bundles')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold">Internet Bundles</h4>
        @if(in_array($userRole, ['admin', 'manager']))
        <a href="{{ route('bundles.create') }}" class="btn btn-primary btn-sm">+ New Bundle</a>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Data Size</th>
                        <th>Duration</th>
                        <th>Price (TZS)</th>
                        @if(in_array($userRole, ['admin', 'manager']))
                        <th>Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($bundles as $bundle)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $bundle->name }}</td>
                            <td>{{ $bundle->formatted_data_size }}</td>
                            <td>{{ $bundle->duration_days }} days</td>
                            <td>{{ number_format($bundle->price, 2) }}</td>
                            @if(in_array($userRole, ['admin', 'manager']))
                            <td>
                                <a href="{{ route('bundles.show', $bundle) }}" class="btn btn-sm btn-info text-white">View</a>
                                <a href="{{ route('bundles.edit', $bundle) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('bundles.destroy', $bundle) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                            @endif
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted">No bundles available</td></tr>
                    @endforelse
                </tbody>
            </table>

            {{ $bundles->links() }}
        </div>
    </div>
</div>
@endsection
