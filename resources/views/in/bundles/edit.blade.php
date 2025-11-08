@extends('layouts.app')

@section('title', 'Edit Bundle')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">Edit Bundle</div>
        <div class="card-body">
            <form action="{{ route('bundles.update', $bundle) }}" method="POST">
                @csrf @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Bundle Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $bundle->name }}" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Data Size (GB)</label>
                        <input type="number" name="data_size_gb" class="form-control" value="{{ $bundle->data_size_gb }}" step="0.1" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Duration (Days)</label>
                        <input type="number" name="duration_days" class="form-control" value="{{ $bundle->duration_days }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Price (TZS)</label>
                        <input type="number" name="price" class="form-control" value="{{ $bundle->price }}" step="0.01" required>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="3" class="form-control">{{ $bundle->description }}</textarea>
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary">Update Bundle</button>
                    <a href="{{ route('bundles.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
