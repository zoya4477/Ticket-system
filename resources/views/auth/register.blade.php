<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register — Ticket Support System</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --navy: #1a2e6b;
            --navy-dark: #0f1d4a;
            --blue-mid: #2547b8;
            --accent: #4f6ef7;
            --green: #38c172;
            --white: #ffffff;
            --gray-50: #f8f9fc;
            --gray-100: #eef0f7;
            --gray-300: #c8cedd;
            --gray-500: #7f8cab;
            --gray-700: #3a4568;
            --text: #1a2035;
            --font: 'Plus Jakarta Sans', sans-serif;
            --shadow: 0 20px 60px rgba(26, 46, 107, 0.12);
        }

        body {
            font-family: var(--font);
            background: var(--gray-50);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: radial-gradient(circle, #c8cedd 1px, transparent 1px);
            background-size: 28px 28px;
            opacity: 0.35;
            pointer-events: none;
        }

        .card {
            display: flex;
            width: 980px;
            min-height: 580px;
            border-radius: 22px;
            overflow: hidden;
            box-shadow: var(--shadow);
            position: relative;
            z-index: 1;
            animation: rise 0.6s cubic-bezier(.22,1,.36,1) both;
        }

        @keyframes rise {
            from { opacity: 0; transform: translateY(28px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ─── LEFT PANEL ─── */
        .panel-left {
            flex: 0 0 360px;
            background: linear-gradient(155deg, var(--blue-mid) 0%, var(--navy-dark) 100%);
            padding: 52px 44px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .panel-left::before {
            content: '';
            position: absolute;
            top: -80px; right: -80px;
            width: 260px; height: 260px;
            border-radius: 50%;
            background: rgba(255,255,255,0.06);
        }
        .panel-left::after {
            content: '';
            position: absolute;
            bottom: -60px; left: -60px;
            width: 200px; height: 200px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
        }

        .brand h1 {
            font-size: 1.55rem;
            font-weight: 800;
            color: var(--white);
            letter-spacing: -.5px;
            line-height: 1.2;
        }

        .brand p {
            margin-top: 12px;
            font-size: 0.82rem;
            color: rgba(255,255,255,0.65);
            line-height: 1.65;
        }

        .brand-divider {
            width: 36px; height: 3px;
            background: rgba(255,255,255,0.4);
            border-radius: 2px;
            margin-top: 18px;
        }

        .steps {
            position: relative; z-index: 1;
        }

        .steps-title {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: rgba(255,255,255,0.5);
            margin-bottom: 18px;
        }

        .step-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            margin-bottom: 20px;
        }

        .step-num {
            width: 28px; height: 28px;
            border-radius: 50%;
            background: rgba(255,255,255,0.15);
            border: 1.5px solid rgba(255,255,255,0.3);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.72rem;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .step-num.done {
            background: var(--green);
            border-color: var(--green);
        }

        .step-info strong {
            display: block;
            font-size: 0.84rem;
            color: rgba(255,255,255,0.9);
            font-weight: 600;
        }
        .step-info span {
            font-size: 0.76rem;
            color: rgba(255,255,255,0.5);
        }

        .features {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(255,255,255,0.8);
            font-size: 0.8rem;
        }

        .feature-dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            background: var(--green);
            flex-shrink: 0;
        }

        /* ─── RIGHT PANEL ─── */
        .panel-right {
            flex: 1;
            background: var(--white);
            padding: 48px 52px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        .deco-dots {
            position: absolute;
            top: 24px; right: 28px;
            display: grid;
            grid-template-columns: repeat(5,1fr);
            gap: 6px;
            opacity: 0.18;
        }
        .deco-dots span {
            width: 5px; height: 5px;
            background: var(--navy);
            border-radius: 50%;
            display: block;
        }

        .form-heading {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--text);
            letter-spacing: -.5px;
            margin-bottom: 5px;
        }

        .form-sub {
            font-size: 0.85rem;
            color: var(--gray-500);
            margin-bottom: 28px;
        }

        .form-sub a {
            color: var(--accent);
            font-weight: 600;
            text-decoration: none;
        }

        /* 2-col grid for name fields */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0 16px;
        }

        .form-group {
            position: relative;
            margin-bottom: 16px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 44px 12px 16px;
            border: 1.5px solid var(--gray-100);
            border-radius: 10px;
            font-family: var(--font);
            font-size: 0.87rem;
            color: var(--text);
            background: var(--gray-50);
            outline: none;
            transition: border-color .2s, box-shadow .2s, background .2s;
        }

        .form-group input::placeholder { color: var(--gray-300); }

        .form-group input:focus {
            border-color: var(--accent);
            background: var(--white);
            box-shadow: 0 0 0 4px rgba(79,110,247,0.1);
        }

        .form-group input.is-invalid {
            border-color: #e55;
        }

        .form-icon {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-300);
            pointer-events: none;
        }

        .error-msg {
            color: #e55;
            font-size: 0.75rem;
            margin-top: 4px;
            display: block;
        }

        /* password strength bar */
        .strength-bar {
            display: flex;
            gap: 4px;
            margin-top: 7px;
        }

        .strength-seg {
            flex: 1; height: 3px;
            border-radius: 2px;
            background: var(--gray-100);
            transition: background .3s;
        }

        .strength-seg.active-weak   { background: #e55; }
        .strength-seg.active-fair   { background: #f59e0b; }
        .strength-seg.active-strong { background: var(--green); }

        .btn-register {
            width: 100%;
            padding: 14px 24px;
            background: linear-gradient(135deg, var(--blue-mid), var(--navy));
            color: var(--white);
            border: none;
            border-radius: 10px;
            font-family: var(--font);
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: opacity .2s, transform .15s, box-shadow .2s;
            box-shadow: 0 8px 24px rgba(37,71,184,0.35);
            margin-top: 6px;
        }

        .btn-register:hover {
            opacity: 0.93;
            transform: translateY(-1px);
            box-shadow: 0 12px 32px rgba(37,71,184,0.4);
        }

        .btn-register:active { transform: translateY(0); }
        .btn-register svg { width: 18px; height: 18px; }

        .login-link {
            margin-top: 18px;
            text-align: center;
            font-size: 0.83rem;
            color: var(--gray-500);
        }

        .login-link a {
            color: var(--accent);
            font-weight: 600;
            text-decoration: none;
        }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 800px) {
            body { padding: 16px; }
            .card { flex-direction: column; width: 100%; min-height: auto; border-radius: 18px; }
            .panel-left { flex: none; padding: 36px 28px; }
            .steps { display: none; }
            .panel-right { padding: 36px 28px; }
            .form-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<div class="card">

    <!-- LEFT PANEL -->
    <div class="panel-left">
        <div class="brand">
            <h1>Ticket Support<br>System</h1>
            <p>An email ticketing system helps you convert customer emails to tickets, and compiles them in a single place so no customer complaint goes unnoticed.</p>
            <div class="brand-divider"></div>
        </div>

        <div class="steps">
            <p class="steps-title">Getting Started</p>
            <div class="step-item">
                <div class="step-num done">✓</div>
                <div class="step-info">
                    <strong>Create Account</strong>
                    <span>Fill in your details below</span>
                </div>
            </div>
            <div class="step-item">
                <div class="step-num">2</div>
                <div class="step-info">
                    <strong>Verify Email</strong>
                    <span>Check your inbox for a link</span>
                </div>
            </div>
            <div class="step-item">
                <div class="step-num">3</div>
                <div class="step-info">
                    <strong>Start Managing</strong>
                    <span>Submit & track support tickets</span>
                </div>
            </div>
        </div>

        <div class="features">
            <div class="feature-item"><span class="feature-dot"></span> Free to get started</div>
            <div class="feature-item"><span class="feature-dot"></span> No credit card required</div>
            <div class="feature-item"><span class="feature-dot"></span> Cancel anytime</div>
        </div>
    </div>

    <!-- RIGHT PANEL -->
    <div class="panel-right">

        <div class="deco-dots">
            @for($i = 0; $i < 25; $i++)
                <span></span>
            @endfor
        </div>

        <h2 class="form-heading">Create Account</h2>
        <p class="form-sub">Already have an account? <a href="{{ route('login') }}">Sign In</a></p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <input
                    type="text"
                    name="name"
                    placeholder="Full Name"
                    value="{{ old('name') }}"
                    class="{{ $errors->has('name') ? 'is-invalid' : '' }}"
                    autocomplete="name"
                    required
                >
                <span class="form-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="17" height="17" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"/>
                    </svg>
                </span>
                @error('name')
                    <small class="error-msg">{{ $message }}</small>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
                <input
                    type="email"
                    name="email"
                    placeholder="Email Address"
                    value="{{ old('email') }}"
                    class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                    autocomplete="email"
                    required
                >
                <span class="form-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="17" height="17" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/>
                    </svg>
                </span>
                @error('email')
                    <small class="error-msg">{{ $message }}</small>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group" id="pwGroup">
                <input
                    type="password"
                    name="password"
                    id="passwordInput"
                    placeholder="Password"
                    class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                    autocomplete="new-password"
                    required
                >
                <span class="form-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="17" height="17" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/>
                    </svg>
                </span>
                <!-- strength bar -->
                <div class="strength-bar">
                    <div class="strength-seg" id="s1"></div>
                    <div class="strength-seg" id="s2"></div>
                    <div class="strength-seg" id="s3"></div>
                    <div class="strength-seg" id="s4"></div>
                </div>
                @error('password')
                    <small class="error-msg">{{ $message }}</small>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Confirm Password"
                    autocomplete="new-password"
                    required
                >
                <span class="form-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="17" height="17" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/>
                    </svg>
                </span>
                @error('password_confirmation')
                    <small class="error-msg">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn-register">
                Create Account
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                </svg>
            </button>
        </form>

        <p class="login-link">
            Already registered? <a href="{{ route('login') }}">Login here</a>
        </p>
    </div>

</div>

<script>
    // Password strength indicator
    const pwInput = document.getElementById('passwordInput');
    const segs = [document.getElementById('s1'), document.getElementById('s2'), document.getElementById('s3'), document.getElementById('s4')];

    pwInput.addEventListener('input', function() {
        const val = this.value;
        let score = 0;
        if (val.length >= 6)  score++;
        if (val.length >= 10) score++;
        if (/[A-Z]/.test(val) && /[0-9]/.test(val)) score++;
        if (/[^A-Za-z0-9]/.test(val)) score++;

        const cls = score <= 1 ? 'active-weak' : score <= 2 ? 'active-fair' : 'active-strong';
        segs.forEach((s, i) => {
            s.className = 'strength-seg';
            if (i < score) s.classList.add(cls);
        });
    });
</script>

</body>
</html>