@extends('layouts.app')

@section('content')
<div class="container py-5">

    <!-- Header / Breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary fw-bold">Department Details</h2>
        <div>
            <a href="{{ route('admin.departments.index') }}" class="btn btn-info me-2">
                <i class="fas fa-list"></i> All Departments
            </a>
            <a href="{{ route('admin.departments.create') }}" class="btn btn-success me-2">
                <i class="fas fa-plus"></i> Add Department
            </a>
            <a href="{{ route('admin.departments.edit', $department->id) }}" class="btn btn-warning me-2">
                <i class="fas fa-edit"></i> Edit
            </a>
            <form action="{{ route('admin.departments.destroy', $department->id) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                    <i class="fas fa-trash-alt"></i> Delete
                </button>
            </form>
        </div>
    </div>

    <!-- Department Info -->
    <div class="card shadow-sm border-0 rounded-4 p-4">
        <h4 class="fw-bold">Department Name:</h4>
        <p>{{ $department->name }}</p>
    </div>

</div>
@endsection

@push('scripts')
<!-- FontAwesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
@endpush