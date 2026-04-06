@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6">

            <!-- Card -->
            <div class="card shadow-lg border-0 rounded-4 px-4 py-5">

                <!-- Header -->
                <div class="text-center mb-4">
                    <div class="icon-circle bg-warning text-white mb-2">
                        <i class="fas fa-user-edit fa-2x"></i>
                    </div>
                    <h3 class="fw-bold text-secondary">Edit User</h3>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    {{-- Name --}}
                    <div class="form-floating mb-3">
                        <input type="text" name="name" value="{{ $user->name }}" class="form-control rounded-3" id="name" placeholder="Name" required>
                        <label for="name">Full Name</label>
                    </div>

                    {{-- Email --}}
                    <div class="form-floating mb-3">
                        <input type="email" name="email" value="{{ $user->email }}" class="form-control rounded-3" id="email" placeholder="Email" required>
                        <label for="email">Email Address</label>
                    </div>

                    {{-- Role --}}
                    <div class="form-floating mb-3">
                        <select name="role_id" class="form-select rounded-3" id="role" required>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        <label for="role">User Role</label>
                    </div>

                    {{-- Department --}}
                    <div class="form-floating mb-4">
                        <select name="department_id" class="form-select rounded-3" id="department">
                            <option value="">Select Department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ $user->department_id == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                        <label for="department">Department (Optional)</label>
                    </div>

                    {{-- Submit --}}
                    <div class="d-grid">
                        <button type="submit" class="btn btn-warning btn-lg rounded-pill fw-bold">
                            Update User
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- Custom Styling -->
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
    .form-control, .form-select {
        box-shadow: none;
        border: 1px solid #d1d3e2;
        transition: all .3s ease;
    }
    .form-control:focus, .form-select:focus {
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
</style>
@endpush

@push('scripts')
<!-- FontAwesome Icons -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
@endpush
@endsection