<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ticketing Admin | Panel</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .nav-sidebar .nav-link p { font-size: 0.95rem; }
        .brand-link { border-bottom: 1px solid #4b545c !important; }

        /* Fix: Ensures smooth icon-only transition when sidebar is collapsed */
        .sidebar-collapse .nav-sidebar .nav-link p {
            display: none;
        }
        .sidebar-collapse .nav-header {
            display: none;
        }
        /* Optional: Hide the small 'Administrator' text when collapsed */
        .sidebar-collapse .user-panel .info {
            display: none !important;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom-0 shadow-sm">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    @if(auth()->user()->unreadNotifications->count() > 0)
                        <span class="badge badge-danger navbar-badge">{{ auth()->user()->unreadNotifications->count() }}</span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">{{ auth()->user()->unreadNotifications->count() }} Notifications</span>
                    <div class="dropdown-divider"></div>
                    <div style="max-height: 300px; overflow-y: auto;">
                        @forelse(auth()->user()->unreadNotifications as $notification)
                            <a href="{{ route('tickets.show', $notification->data['ticket_id'] ?? '#') }}" class="dropdown-item">
                                <i class="fas fa-envelope mr-2 text-primary"></i> 
                                {{ Str::limit($notification->data['title'] ?? 'Ticket Update', 20) }}
                                <span class="float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
                            </a>
                        @empty
                            <a href="#" class="dropdown-item text-center">No new notifications</a>
                        @endforelse
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ route('admin.dashboard') }}" class="brand-link">
            <img src="https://adminlte.io/docs/3.2/assets/img/AdminLTELogo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Admin Panel</span>
        </a>

        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
                <div class="image text-white">
                  <i class="fas fa-user-circle fa-2x"></i>
                </div>
                <div class="info ml-2">
                  <a href="{{ route('profile.edit') }}" class="d-block text-white fw-bold text-decoration-none">
                    {{ auth()->user()->name }}
                  </a>
                  <small class="text-muted" style="font-size: 10px;">Administrator</small>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                    
                    <li class="nav-header">MAIN MANAGEMENT</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Customer Users</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.agents.index') }}" class="nav-link {{ request()->routeIs('admin.agents.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-tie"></i>
                            <p>Support Agents</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.departments.index') }}" class="nav-link {{ request()->routeIs('admin.departments.*') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-building"></i>
                          <p>Departments</p>
                        </a>
                    </li>

                    <li class="nav-header">TICKETING SYSTEM</li>
                    <li class="nav-item">
                        <a href="{{ route('tickets.index') }}" class="nav-link {{ request()->routeIs('tickets.index') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-ticket-alt"></i>
                            <p>All Tickets</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.tickets.assign') }}" class="nav-link {{ request()->routeIs('admin.tickets.assign') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tasks"></i>
                            <p>Assign Tickets</p>
                        </a>
                    </li>

                    <li class="nav-header">ANALYTICS</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.reports.index') }}" class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-chart-bar"></i>
                            <p>Performance Reports</p>
                        </a>
                    </li>
                     
                    <li class="nav-item">
                     <a href="{{ route('kb.index') }}" class="nav-link {{ request()->routeIs('kb.*') ? 'active' : '' }}">
                         <i class="nav-icon fas fa-book-open"></i>
                         <p>Knowledge Base</p>
                     </a>
                   </li>

                    <li class="nav-item mt-4 border-top">
                        <form method="POST" action="{{ route('logout') }}" id="logout-form">
                            @csrf
                            <a href="#" onclick="document.getElementById('logout-form').submit();" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
                                <p class="text-danger font-weight-bold">Sign Out</p>
                            </a>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <div class="content-wrapper bg-light">
        <div class="content-header">
            <div class="container-fluid">
                @yield('header')
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
    </div>

    <footer class="main-footer text-sm">
        <strong>Copyright &copy; 2026 <a href="#">Ticketing System</a>.</strong> All rights reserved.
    </footer>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

</body>
</html>