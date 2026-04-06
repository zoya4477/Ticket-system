@extends('layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap');

    :root {
        --bg:      #f0f4f8;
        --surface: #ffffff;
        --accent:  #3b6ff0;
        --accent2: #7c5cf6;
        --text:    #1a202c;
        --muted:   #718096;
        --border:  rgba(0,0,0,0.08);
        --danger:  #e53e5a;
        --input-bg:#f8fafc;
    }

    body {
        background: var(--bg);
        font-family: 'DM Sans', sans-serif;
        min-height: 100vh;
    }

    body::before {
        content: '';
        position: fixed;
        inset: 0;
        background-image: radial-gradient(rgba(59,111,240,0.07) 1px, transparent 1px);
        background-size: 28px 28px;
        pointer-events: none;
        z-index: 0;
    }

    .u-wrapper {
        position: relative;
        z-index: 1;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 48px 20px;
    }

    .u-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 24px;
        box-shadow: 0 8px 40px rgba(59,111,240,0.10), 0 2px 8px rgba(0,0,0,0.05);
        padding: 48px 44px;
        width: 100%;
        max-width: 500px;
        animation: cardIn 0.5s cubic-bezier(.22,.68,0,1.2) both;
    }

    @keyframes cardIn {
        from { opacity: 0; transform: translateY(24px) scale(0.97); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }

    /* Icon */
    .u-icon {
        width: 68px; height: 68px;
        border-radius: 20px;
        background: linear-gradient(135deg, var(--accent), var(--accent2));
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 24px;
        box-shadow: 0 8px 24px rgba(59,111,240,0.28);
        font-size: 1.5rem; color: #fff;
        animation: iconPop 0.5s 0.15s cubic-bezier(.22,.68,0,1.4) both;
    }

    @keyframes iconPop {
        from { opacity: 0; transform: scale(0.5); }
        to   { opacity: 1; transform: scale(1); }
    }

    .u-title {
        font-family: 'Syne', sans-serif;
        font-size: 1.6rem; font-weight: 800;
        letter-spacing: -0.4px; text-align: center;
        background: linear-gradient(135deg, #1a202c 30%, var(--accent));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 6px;
    }

    .u-subtitle {
        text-align: center;
        font-size: 0.83rem;
        color: var(--muted);
        margin-bottom: 36px;
    }

    /* Field group */
    .field-group { margin-bottom: 18px; }

    .field-label {
        display: block;
        font-family: 'Syne', sans-serif;
        font-size: 0.72rem; font-weight: 700;
        letter-spacing: 0.10em; text-transform: uppercase;
        color: var(--muted); margin-bottom: 7px;
    }

    /* Input row with icon */
    .input-wrap {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 14px; top: 50%; transform: translateY(-50%);
        color: #b0b8c7; font-size: 0.85rem;
        pointer-events: none;
        transition: color 0.2s;
    }

    .u-input, .u-select {
        width: 100%;
        background: var(--input-bg);
        border: 1.5px solid var(--border);
        border-radius: 12px;
        color: var(--text);
        font-family: 'DM Sans', sans-serif;
        font-size: 0.9rem;
        padding: 12px 14px 12px 38px;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        appearance: none;
    }

    .u-input::placeholder { color: #b0b8c7; }

    .u-input:focus, .u-select:focus {
        border-color: var(--accent);
        background: #fff;
        box-shadow: 0 0 0 4px rgba(59,111,240,0.10);
    }

    .u-input:focus ~ .input-icon,
    .u-select:focus ~ .input-icon {
        color: var(--accent);
    }

    /* Select arrow */
    .select-wrap::after {
        content: '';
        position: absolute;
        right: 14px; top: 50%; transform: translateY(-50%);
        width: 0; height: 0;
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-top: 5px solid #b0b8c7;
        pointer-events: none;
    }

    /* Error */
    .field-error {
        font-size: 0.78rem; color: var(--danger);
        margin-top: 6px;
        display: flex; align-items: center; gap: 4px;
    }

    /* Divider label */
    .section-divider {
        display: flex; align-items: center; gap: 12px;
        margin: 24px 0 20px;
    }

    .section-divider span {
        font-family: 'Syne', sans-serif;
        font-size: 0.68rem; font-weight: 700;
        letter-spacing: 0.12em; text-transform: uppercase;
        color: var(--muted); white-space: nowrap;
    }

    .section-divider::before,
    .section-divider::after {
        content: ''; flex: 1;
        height: 1px; background: var(--border);
    }

    /* Submit button */
    .btn-submit {
        width: 100%;
        background: linear-gradient(135deg, var(--accent), var(--accent2));
        border: none; border-radius: 12px;
        color: #fff;
        font-family: 'Syne', sans-serif;
        font-weight: 700; font-size: 0.9rem;
        letter-spacing: 0.05em;
        padding: 14px;
        cursor: pointer; margin-top: 10px;
        transition: opacity 0.2s, transform 0.15s, box-shadow 0.2s;
        box-shadow: 0 6px 20px rgba(59,111,240,0.28);
        display: flex; align-items: center; justify-content: center; gap: 8px;
    }

    .btn-submit:hover {
        opacity: 0.92;
        transform: translateY(-2px);
        box-shadow: 0 10px 28px rgba(59,111,240,0.38);
    }

    .btn-submit:active { transform: translateY(0); }

    /* Back link */
    .back-link {
        display: flex; align-items: center; justify-content: center; gap: 6px;
        margin-top: 22px; font-size: 0.82rem;
        color: var(--muted); text-decoration: none;
        transition: color 0.2s;
    }

    .back-link:hover { color: var(--accent); }

    .u-divider {
        border: none; border-top: 1px solid var(--border);
        margin: 28px 0 0;
    }

    /* Stagger animation for fields */
    .field-group:nth-child(1) { animation: fadeUp 0.4s 0.1s ease both; }
    .field-group:nth-child(2) { animation: fadeUp 0.4s 0.15s ease both; }
    .field-group:nth-child(3) { animation: fadeUp 0.4s 0.20s ease both; }
    .field-group:nth-child(4) { animation: fadeUp 0.4s 0.25s ease both; }
    .field-group:nth-child(5) { animation: fadeUp 0.4s 0.30s ease both; }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(10px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 500px) {
        .u-card { padding: 36px 22px; }
    }
</style>

<div class="u-wrapper">
    <div class="u-card">

        <!-- Icon -->
        <!-- <div class="u-icon">
            <i class="fas fa-user-plus"></i>
        </div> -->

        <!-- Title -->
        <div class="u-title">Create New User</div>
        <div class="u-subtitle">Fill in the details to add a new user</div>

        <!-- Form -->
        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            {{-- Name --}}
            <div class="field-group">
                <label class="field-label" for="name">Full Name</label>
                <div class="input-wrap">
                    <input type="text" name="name" id="name" class="u-input"
                        placeholder="John Doe" value="{{ old('name') }}" required>
                    <i class="fas fa-user input-icon"></i>
                </div>
                @error('name')
                    <div class="field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</div>
                @enderror
            </div>

            {{-- Email --}}
            <div class="field-group">
                <label class="field-label" for="email">Email Address</label>
                <div class="input-wrap">
                    <input type="email" name="email" id="email" class="u-input"
                        placeholder="john@example.com" value="{{ old('email') }}" required>
                    <i class="fas fa-envelope input-icon"></i>
                </div>
                @error('email')
                    <div class="field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="field-group">
                <label class="field-label" for="password">Password</label>
                <div class="input-wrap">
                    <input type="password" name="password" id="password" class="u-input"
                        placeholder="••••••••" required>
                    <i class="fas fa-lock input-icon"></i>
                </div>
                @error('password')
                    <div class="field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="section-divider"><span>Role & Access</span></div>

            {{-- Role --}}
            <div class="field-group">
                <label class="field-label" for="role">User Role</label>
                <div class="input-wrap select-wrap">
                    <select name="role_id" id="role" class="u-select" required>
                        <option value="" disabled selected>Select a role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    <i class="fas fa-shield-halved input-icon"></i>
                </div>
                @error('role_id')
                    <div class="field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</div>
                @enderror
            </div>

            {{-- Department --}}
            <div class="field-group">
                <label class="field-label" for="department">Department <span style="font-weight:400;text-transform:none;letter-spacing:0;color:#b0b8c7">(Optional)</span></label>
                <div class="input-wrap select-wrap">
                    <select name="department_id" id="department" class="u-select">
                        <option value="">No Department</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                    <i class="fas fa-building input-icon"></i>
                </div>
                @error('department_id')
                    <div class="field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</div>
                @enderror
            </div>

            <!-- Submit -->
            <button type="submit" class="btn-submit">
                <i class="fas fa-user-plus"></i> Create User
            </button>

        </form>

        <hr class="u-divider">

        <a href="{{ route('admin.users.index') }}" class="back-link">
            <i class="fas fa-arrow-left fa-sm"></i> Back to Users
        </a>

    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush