@extends('layouts.admin') 
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12 mb-4">
            <h2 class="fw-bold text-dark">User Settings</h2>
            <p class="text-muted">Manage your account information and security.</p>
        </div>
    </div>

    <div class="row g-4">
        {{-- Profile Information --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                <div class="card-header bg-white py-3" style="border-radius: 15px 15px 0 0;">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-user-edit me-2 text-primary"></i> Profile Information</h5>
                </div>
                <div class="card-body p-4">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>
        </div>

        {{-- Update Password --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                <div class="card-header bg-white py-3" style="border-radius: 15px 15px 0 0;">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-key me-2 text-warning"></i> Change Password</h5>
                </div>
                <div class="card-body p-4">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>
        </div>

        {{-- Delete Account --}}
        <div class="col-12 mt-4">
            <div class="card border-0 shadow-sm border-start border-danger border-4" style="border-radius: 15px;">
                <div class="card-body p-4 d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="fw-bold text-danger mb-1">Danger Zone</h5>
                        <p class="text-muted mb-0 small">Once you delete your account, there is no going back. Please be certain.</p>
                    </div>
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Breeze forms ke Tailwind styles ko Bootstrap ke saath adjust karne ke liye */
    .max-w-xl form {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }
    .max-w-xl input[type="text"], 
    .max-w-xl input[type="email"], 
    .max-w-xl input[type="password"] {
        width: 100%;
        padding: 0.5rem 0.75rem;
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
    }
    .max-w-xl button {
        background: #4361ee;
        color: white;
        border: none;
        padding: 0.5rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        width: fit-content;
    }
</style>
@endsection