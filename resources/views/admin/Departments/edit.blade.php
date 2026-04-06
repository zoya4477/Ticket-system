@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <!-- Card -->
            <div class="card shadow-lg border-0 rounded-4 px-4 py-5">

                <!-- Header -->
                <div class="text-center mb-4">
                    <div class="icon-circle bg-warning text-white mb-2">
                        <i class="fas fa-building fa-2x"></i>
                    </div>
                    <h3 class="fw-bold text-secondary">Edit Department</h3>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('admin.departments.update', $department->id) }}">
                    @csrf
                    @method('PUT')

                    {{-- Department Name --}}
                    <div class="form-floating mb-4">
                        <input type="text" name="name" value="{{ old('name', $department->name) }}" class="form-control rounded-3" id="name" placeholder="Department Name" required>
                        <label for="name">Department Name</label>
                    </div>

                    {{-- Submit --}}
                    <div class="d-grid">
                        <button type="submit" class="btn btn-warning btn-lg rounded-pill fw-bold">
                            <i class="fas fa-edit me-2"></i> Update Department
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    body {
        background: #eef2f7;
    }

    .icon-circle {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .form-control {
        box-shadow: none;
        border: 1px solid #d1d3e2;
        transition: all .3s ease;
    }

    .form-control:focus {
        border-color: #f6c23e !important;
        box-shadow: 0 0 0 .2rem rgba(246,194,62,.25);
    }

    .btn-warning {
        background: #f6c23e;
        border: none;
    }

    .btn-warning:hover {
        background: #dda20a;
    }

    .card {
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.75rem 1.5rem rgba(0,0,0,0.15);
    }
</style>
@endpush

@push('scripts')
<!-- FontAwesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
@endpush