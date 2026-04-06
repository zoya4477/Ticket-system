@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-9">
            
            <div class="card shadow border-0">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0 font-weight-bold text-primary">
                        <i class="fas fa-user-shield mr-2"></i> Register New Support Agent
                    </h5>
                </div>

                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger shadow-sm">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li><i class="fas fa-exclamation-triangle mr-2"></i> {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.agents.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="font-weight-bold">Full Name</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-user"></i></span></div>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required placeholder="e.g. Ali Ahmed">
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="font-weight-bold">Email Address</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-envelope"></i></span></div>
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="agent@support.com">
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="font-weight-bold text-info">Assign Department</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-sitemap"></i></span></div>
                                    <select name="department_id" class="form-control custom-select" required>
                                        <option value="" disabled selected>Select a department...</option>
                                        @foreach($departments as $dept)
                                            <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <small class="text-muted text-xs">Agent will only see tickets from this department.</small>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="font-weight-bold text-info">Access Role</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-user-tag"></i></span></div>
                                    <select name="role" class="form-control custom-select">
                                        <option value="agent" selected>Standard Agent</option>
                                        <option value="manager">Team Lead / Manager</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="font-weight-bold">Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-lock"></i></span></div>
                                    <input type="password" name="password" class="form-control" required placeholder="Minimum 8 characters">
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="font-weight-bold">Confirm Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-check-double"></i></span></div>
                                    <input type="password" name="password_confirmation" class="form-control" required placeholder="Repeat password">
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.agents.index') }}" class="btn btn-link text-muted p-0">
                                <i class="fas fa-chevron-left mr-1"></i> Cancel and Go Back
                            </a>
                            <button type="submit" class="btn btn-primary px-5 shadow-sm">
                                <i class="fas fa-save mr-2"></i> Register Agent
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection