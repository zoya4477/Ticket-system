<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Ticket Support System</title>
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
            --radius: 14px;
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

        /* subtle dot grid bg */
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
            width: 960px;
            min-height: 560px;
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
            flex: 0 0 380px;
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

        /* illustration area */
        .illustration {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 14px;
        }

        .agent-desk {
            width: 220px;
            height: 160px;
            position: relative;
        }

        /* CSS-drawn support agent desk */
        .desk-surface {
            position: absolute;
            bottom: 10px;
            left: 20px;
            width: 180px; height: 6px;
            background: rgba(255,255,255,0.3);
            border-radius: 3px;
        }
        .monitor {
            position: absolute;
            bottom: 16px; left: 62px;
            width: 70px; height: 52px;
            background: rgba(255,255,255,0.18);
            border-radius: 6px;
            border: 2px solid rgba(255,255,255,0.3);
        }
        .monitor::after {
            content: '';
            position: absolute;
            bottom: -8px; left: 50%;
            transform: translateX(-50%);
            width: 18px; height: 8px;
            background: rgba(255,255,255,0.2);
        }
        .monitor-screen {
            position: absolute;
            inset: 6px;
            background: linear-gradient(135deg, rgba(79,110,247,0.5), rgba(56,193,114,0.3));
            border-radius: 3px;
        }

        .bubble {
            position: absolute;
            background: rgba(255,255,255,0.15);
            border: 1.5px solid rgba(255,255,255,0.3);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.75rem;
            color: white;
            backdrop-filter: blur(4px);
        }
        .bubble-q  { top: 18px; left: 14px; width: 40px; height: 34px; }
        .bubble-24 { top: 2px;  left: 64px; width: 48px; height: 34px; font-size: 0.65rem; font-weight: 700; }
        .bubble-mail{ top: 50px; left: 8px;  width: 40px; height: 34px; }
        .bubble-set { top: 28px; right: 22px; width: 40px; height: 34px; }
        .bubble-dots{ bottom: 36px; right: 16px; width: 40px; height: 28px; letter-spacing: 2px; }

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
            padding: 56px 52px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        /* decorative dots top-right */
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
            font-size: 1.85rem;
            font-weight: 800;
            color: var(--text);
            letter-spacing: -.6px;
            margin-bottom: 6px;
        }

        .form-sub {
            font-size: 0.85rem;
            color: var(--gray-500);
            margin-bottom: 32px;
        }

        .form-sub a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
        }

        .form-group {
            position: relative;
            margin-bottom: 18px;
        }

        .form-group input {
            width: 100%;
            padding: 13px 44px 13px 16px;
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

        .form-icon {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-300);
            pointer-events: none;
        }

    
   /* CHECKBOX FIX */
        .form-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.83rem;
            color: var(--gray-700);
            cursor: pointer;
            user-select: none;
        }

        .checkbox-label input {
            display: none;
        }

        .custom-check {
            width: 18px;
            height: 18px;
            border-radius: 5px;
            background: transparent;
            border: 2px solid var(--gray-300);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.2s;
        }

        .custom-check svg {
            width: 11px;
            height: 11px;
            display: none;
        }

        .checkbox-label input:checked + .custom-check {
            background: var(--accent);
            border-color: var(--accent);
        }

        .checkbox-label input:checked + .custom-check svg {
            display: block;
        }

        .forgot-link {
            font-size: 0.83rem;
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
        }
        .forgot-link:hover { text-decoration: underline; }

        .btn-login {
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
        }

        .btn-login:hover {
            opacity: 0.93;
            transform: translateY(-1px);
            box-shadow: 0 12px 32px rgba(37,71,184,0.4);
        }

        .btn-login:active { transform: translateY(0); }

        .btn-login svg { width: 18px; height: 18px; }

        .register-link {
            margin-top: 22px;
            text-align: center;
            font-size: 0.83rem;
            color: var(--gray-500);
        }

        .register-link a {
            color: var(--accent);
            font-weight: 600;
            text-decoration: none;
        }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 780px) {
            body { padding: 16px; }
            .card { flex-direction: column; width: 100%; min-height: auto; border-radius: 18px; }
            .panel-left { flex: none; padding: 36px 28px; }
            .illustration { display: none; }
            .panel-right { padding: 36px 28px; }
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

        <div class="illustration">
            <div class="agent-desk">
                <div class="bubble bubble-q">❓</div>
                <div class="bubble bubble-24">24/7</div>
                <div class="bubble bubble-mail">✉️</div>
                <div class="bubble bubble-set">⚙️</div>
                <div class="bubble bubble-dots">···</div>
                <div class="monitor"><div class="monitor-screen"></div></div>
                <div class="desk-surface"></div>
            </div>
        </div>

        <div class="features">
            <div class="feature-item"><span class="feature-dot"></span> Auto ticket creation from emails</div>
            <div class="feature-item"><span class="feature-dot"></span> Real-time agent assignment</div>
            <div class="feature-item"><span class="feature-dot"></span> 24/7 customer support tracking</div>
        </div>
    </div>

    <!-- RIGHT PANEL -->
    <div class="panel-right">

        <!-- decorative dots -->
        <div class="deco-dots">
            @for($i = 0; $i < 25; $i++)
                <span></span>
            @endfor
        </div>

        <h2 class="form-heading">Hello, Ticket Support</h2>
        <p class="form-sub">Login to your Thunder account to get back your codes. Or new user? <a href="{{ route('register') }}">Sign Up</a></p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <input
                    type="text"
                    name="email"
                    placeholder="User Name / Email"
                    value="{{ old('email') }}"
                    autocomplete="username"
                    required
                >
                <span class="form-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="18" height="18" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                    </svg>
                </span>
                @error('email')
                    <small style="color:#e55; font-size:.77rem; margin-top:4px; display:block;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <input
                    type="password"
                    name="password"
                    placeholder="Password"
                    autocomplete="current-password"
                    required
                >
                <span class="form-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="18" height="18" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/>
                    </svg>
                </span>
                @error('password')
                    <small style="color:#e55; font-size:.77rem; margin-top:4px; display:block;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-row">
                <label class="checkbox-label">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span class="custom-check">
                        <svg viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 6l3 3 5-5" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                    Remember Me
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">Forgot Password</a>
                @endif
            </div>

            <button type="submit" class="btn-login">
                Login
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                </svg>
            </button>
        </form>

        <p class="register-link">
            Don't have an account? <a href="{{ route('register') }}">Create one now</a>
        </p>
    </div>

</div>

</body>
</html>