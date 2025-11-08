@extends('layouts.app')

@section('title', 'Bundle Details')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">Bundle Details</div>
        <div class="card-body">
            <h5 class="fw-bold">{{ $bundle->name }}</h5>
            <p class="text-muted">{{ $bundle->description ?? 'No description provided.' }}</p>
            
            <table class="table table-bordered mt-3">
                <tr><th>Data Size</th><td>{{ $bundle->formatted_data_size }}</td></tr>
                <tr><th>Duration</th><td>{{ $bundle->duration_days }} days</td></tr>
                <tr><th>Price</th><td>{{ number_format($bundle->price, 2) }} TZS</td></tr>
            </table>

            <div class="mt-3">
                <a href="{{ route('bundles.edit', $bundle) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('bundles.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection
