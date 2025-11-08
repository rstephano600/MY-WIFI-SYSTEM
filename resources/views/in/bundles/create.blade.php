@extends('layouts.app')

@section('title', 'Create Bundle')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">Add New Bundle</div>
        <div class="card-body">
            <form action="{{ route('bundles.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Bundle Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Data Size (GB)</label>
                        <input type="number" name="data_size_gb" class="form-control" step="0.1" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Duration (Days)</label>
                        <input type="number" name="duration_days" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Price (TZS)</label>
                        <input type="number" name="price" class="form-control" step="0.01" required>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="3" class="form-control"></textarea>
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-success">Save Bundle</button>
                    <a href="{{ route('bundles.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
