<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MyBase | Support Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    /* GLOBAL STYLES */
    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #f8fafc; /* light background */
        color: #1e293b;
    }

    /* CARD CUSTOM */
    .card-custom {
        background-color: #ffffff;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        padding: 15px;
    }

    /* ACTIVE LINK */
    .active-link {
        background-color: #3b82f6;
        color: white !important;
    }

    /* TOPBAR */
    .topbar {
        background: #2563eb;
        color: white;
        padding: 12px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .topbar .brand {
        font-weight: 800;
        font-size: 1.3rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .topbar .nav-links a {
        color: #e2e8f0;
        text-decoration: none;
        margin: 0 10px;
        font-weight: 500;
        font-size: 14px;
        padding: 6px 10px;
        border-radius: 8px;
        transition: 0.2s;
    }

    .topbar .nav-links a:hover {
        background: rgba(255,255,255,0.15);
    }

    .topbar .right {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .search-box input {
        border-radius: 20px;
        border: 1px solid #cbd5e1;
        padding: 6px 12px;
        font-size: 13px;
        outline: none;
    }

    .dropdown-menu {
        background: #ffffff;
        border: 1px solid #d1d5db;
    }

    .dropdown-menu a {
        color: #1e293b;
    }

    .dropdown-menu a:hover {
        background: #f1f5f9;
    }

    main {
        padding: 30px;
    }

    /* MOBILE MENU */
    .mobile-menu {
        display: none; /* hidden by default, will show on small screens */
        background-color: #ffffff;
        padding: 10px 15px;
        overflow-x: auto;
        white-space: nowrap;
        border-bottom: 1px solid #d1d5db;
    }

    .mobile-menu a {
        display: inline-block;
        color: #1e293b;
        text-decoration: none;
        margin-right: 10px;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        transition: 0.2s;
    }

    .mobile-menu a:hover {
        background: #e2e8f0;
    }

    .mobile-menu a.active-link {
        background: #3b82f6;
        color: white;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .nav-links {
            display: none;
        }
        .search-box {
            display: none;
        }
        .mobile-menu {
            display: flex;
            gap: 5px;
        }
    }
</style>
</head>

<body>

<!-- TOPBAR -->
<header class="topbar">

    <!-- LEFT -->
    <div class="brand">
        <i class="bi bi-shield-check"></i>
        MyBase
    </div>

    <!-- CENTER NAV -->
    <div class="nav-links">
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('tickets.index') }}">Tickets</a>
        <a href="{{ route('tickets.create') }}">New Request</a>
        <a href="{{ route('kb.index') }}">Help Center</a>
    </div>

    <!-- RIGHT -->
    <div class="right d-flex align-items-center gap-3">

        <!-- Search -->
        <div class="search-box">
            <i class="bi bi-search"></i>
            <input type="text" id="ticketSearchInput" placeholder="Search tickets by title, ID, or description..." autocomplete="off">
        </div>

        <!-- NOTIFICATIONS -->
        <div class="dropdown">
            <a class="text-white position-relative"
               href="#"
               role="button"
               data-bs-toggle="dropdown">
                <i class="bi bi-bell fs-5"></i>
                @if(auth()->user()->unreadNotifications->count() > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ auth()->user()->unreadNotifications->count() }}
                    </span>
                @endif
            </a>

            <ul class="dropdown-menu dropdown-menu-end mt-2 p-2" style="width: 320px; max-height: 300px; overflow-y: auto;">
                <li class="dropdown-header text-center text-dark">
                    {{ auth()->user()->unreadNotifications->count() }} Notifications
                </li>
                <li><hr class="dropdown-divider"></li>
                @forelse(auth()->user()->unreadNotifications as $notification)
                    <li>
                        <a class="dropdown-item d-flex justify-content-between align-items-start"
                           href="{{ route('tickets.show', $notification->data['ticket_id'] ?? '#') }}">
                            <div>
                                <i class="bi bi-envelope me-2 text-primary"></i>
                                {{ \Illuminate\Support\Str::limit($notification->data['title'] ?? 'Ticket Update', 25) }}
                            </div>
                            <small class="text-muted ms-2">
                                {{ $notification->created_at->diffForHumans() }}
                            </small>
                        </a>
                    </li>
                @empty
                    <li class="text-center text-muted p-2">No new notifications</li>
                @endforelse
            </ul>
        </div>

        <!-- USER DROPDOWN -->
        <div class="dropdown">
            <a class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
               href="#"
               role="button"
               data-bs-toggle="dropdown">
                <img src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name) }}"
                     class="rounded-circle me-2"
                     width="32" height="32">
                <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
            </a>

            <ul class="dropdown-menu dropdown-menu-end mt-2 p-2">
                <li>
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        <i class="bi bi-person me-2"></i> Profile
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item text-danger">
                            <i class="bi bi-box-arrow-right me-2"></i> Sign Out
                        </button>
                    </form>
                </li>
            </ul>
        </div>

    </div>

</header>

<!-- MOBILE MENU -->
<div class="mobile-menu px-2 py-2">
    <a href="{{ route('user.dashboard') }}"
       class="{{ request()->is('user/dashboard*') ? 'active-link' : '' }}">
        Dashboard
    </a>

    <a href="{{ route('tickets.index') }}"
       class="{{ request()->is('tickets*') ? 'active-link' : '' }}">
        Tickets
    </a>

    <a href="{{ route('tickets.create') }}"
       class="{{ request()->routeIs('tickets.create') ? 'active-link' : '' }}">
        New Request
    </a>

    <a href="{{ route('kb.index') }}"
       class="{{ request()->is('kb*') ? 'active-link' : '' }}">
        Help Center
    </a>
</div>

<!-- CONTENT -->
<main>
    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>