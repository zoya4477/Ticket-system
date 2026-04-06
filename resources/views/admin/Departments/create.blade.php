@extends('layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap');

    :root {
        --bg:       #f0f4f8;
        --surface:  #ffffff;
        --accent:   #3b6ff0;
        --accent2:  #7c5cf6;
        --text:     #1a202c;
        --muted:    #718096;
        --border:   rgba(0,0,0,0.08);
        --danger:   #e53e5a;
    }

    body {
        background: var(--bg);
        font-family: 'DM Sans', sans-serif;
        min-height: 100vh;
    }

    /* Dot pattern background */
    body::before {
        content: '';
        position: fixed;
        inset: 0;
        background-image: radial-gradient(rgba(59,111,240,0.07) 1px, transparent 1px);
        background-size: 28px 28px;
        pointer-events: none;
        z-index: 0;
    }

    .dept-wrapper {
        position: relative;
        z-index: 1;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }

    .dept-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 24px;
        box-shadow: 0 8px 40px rgba(59,111,240,0.10), 0 2px 8px rgba(0,0,0,0.05);
        padding: 48px 44px;
        width: 100%;
        max-width: 460px;
        animation: cardIn 0.5s cubic-bezier(.22,.68,0,1.2) both;
    }

    @keyframes cardIn {
        from { opacity: 0; transform: translateY(24px) scale(0.97); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }

    /* Icon */
    .icon-wrap {
        width: 68px;
        height: 68px;
        border-radius: 20px;
        background: linear-gradient(135deg, var(--accent), var(--accent2));
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
        box-shadow: 0 8px 24px rgba(59,111,240,0.30);
        font-size: 1.6rem;
        color: #fff;
        animation: iconPop 0.5s 0.15s cubic-bezier(.22,.68,0,1.4) both;
    }

    @keyframes iconPop {
        from { opacity: 0; transform: scale(0.5); }
        to   { opacity: 1; transform: scale(1); }
    }

    /* Title */
    .dept-title {
        font-family: 'Syne', sans-serif;
        font-size: 1.6rem;
        font-weight: 800;
        letter-spacing: -0.4px;
        text-align: center;
        background: linear-gradient(135deg, #1a202c 30%, var(--accent));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 6px;
    }

    .dept-subtitle {
        text-align: center;
        font-size: 0.83rem;
        color: var(--muted);
        margin-bottom: 36px;
    }

    /* Label */
    .field-label {
        display: block;
        font-family: 'Syne', sans-serif;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.10em;
        text-transform: uppercase;
        color: var(--muted);
        margin-bottom: 8px;
    }

    /* Input */
    .dept-input {
        width: 100%;
        background: #f8fafc;
        border: 1.5px solid var(--border);
        border-radius: 12px;
        color: var(--text);
        font-family: 'DM Sans', sans-serif;
        font-size: 0.92rem;
        padding: 13px 16px;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
    }

    .dept-input::placeholder { color: #b0b8c7; }

    .dept-input:focus {
        border-color: var(--accent);
        background: #fff;
        box-shadow: 0 0 0 4px rgba(59,111,240,0.10);
    }

    /* Error */
    .field-error {
        font-size: 0.78rem;
        color: var(--danger);
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* Button */
    .btn-dept {
        width: 100%;
        background: linear-gradient(135deg, var(--accent), var(--accent2));
        border: none;
        border-radius: 12px;
        color: #fff;
        font-family: 'Syne', sans-serif;
        font-weight: 700;
        font-size: 0.9rem;
        letter-spacing: 0.05em;
        padding: 14px;
        cursor: pointer;
        margin-top: 28px;
        transition: opacity 0.2s, transform 0.15s, box-shadow 0.2s;
        box-shadow: 0 6px 20px rgba(59,111,240,0.30);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-dept:hover {
        opacity: 0.92;
        transform: translateY(-2px);
        box-shadow: 0 10px 28px rgba(59,111,240,0.38);
    }

    .btn-dept:active { transform: translateY(0); }

    /* Back link */
    .back-link {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        margin-top: 22px;
        font-size: 0.82rem;
        color: var(--muted);
        text-decoration: none;
        transition: color 0.2s;
    }

    .back-link:hover { color: var(--accent); }

    /* Divider */
    .dept-divider {
        border: none;
        border-top: 1px solid var(--border);
        margin: 28px 0 0;
    }

    @media (max-width: 500px) {
        .dept-card { padding: 36px 24px; }
    }
</style>

<div class="dept-wrapper">
    <div class="dept-card">

        <!-- Icon -->
        <!-- <div class="icon-wrap">
            <i class="fas fa-building"></i>
        </div> -->

        <!-- Title -->
        <div class="dept-title">Create Department</div>
        <div class="dept-subtitle">Add a new department to your organization</div>

        <!-- Form -->
        <form method="POST" action="{{ route('admin.departments.store') }}">
            @csrf

            <div>
                <label class="field-label" for="name">Department Name</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="dept-input"
                    placeholder="e.g. Human Resources"
                    value="{{ old('name') }}"
                    required
                    autofocus
                >
                @error('name')
                    <div class="field-error">
                        <i class="fas fa-circle-exclamation"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn-dept">
                <i class="fas fa-save"></i> Save Department
            </button>

        </form>

        <hr class="dept-divider">

        <a href="{{ route('admin.departments.index') }}" class="back-link">
            <i class="fas fa-arrow-left fa-sm"></i> Back to Departments
        </a>

    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush