@extends('layouts.app')

@section('content')
<div class="container py-5">

    <!-- Header + Add User Button with modern design -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div class="title-section">
            <h2 class="fw-bold" style="background: linear-gradient(135deg, #1F3B4C, #2C5F7A); background-clip: text; -webkit-background-clip: text; color: transparent;">
                <i class="fas fa-users-gear me-2" style="color: #2c7da0;"></i> User Directory
            </h2>
            <p class="text-muted mt-1" style="font-size: 0.9rem;">
                <i class="fas fa-shield-alt me-1"></i> Manage roles, departments & access
            </p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn btn-success btn-lg rounded-pill px-4 shadow-sm" 
           style="background: linear-gradient(105deg, #1f6e8c, #2c8dad); border: none; transition: all 0.3s ease;">
            <i class="fas fa-plus-circle me-2"></i> Add User
        </a>
    </div>

    <!-- Stats Summary Cards (Dynamic) -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 mb-1">Total Members</h6>
                            <h3 class="text-white mb-0 fw-bold">{{ $users->total() }}</h3>
                        </div>
                        <div class="bg-white bg-opacity-25 rounded-circle p-3">
                            <i class="fas fa-users fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <div class="card-body py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 mb-1">Admins</h6>
                            <h3 class="text-white mb-0 fw-bold">{{ $users->where('role.name', 'Admin')->count() }}</h3>
                        </div>
                        <div class="bg-white bg-opacity-25 rounded-circle p-3">
                            <i class="fas fa-user-tie fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <div class="card-body py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 mb-1">Agents</h6>
                            <h3 class="text-white mb-0 fw-bold">{{ $users->where('role.name', 'Agent')->count() }}</h3>
                        </div>
                        <div class="bg-white bg-opacity-25 rounded-circle p-3">
                            <i class="fas fa-headset fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Table Card - Modern Design -->
    <div class="card shadow-sm border-0 rounded-4 overflow-hidden" style="background: rgba(255,255,255,0.95); backdrop-filter: blur(2px);">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead style="background: #f8f9fa; border-bottom: 2px solid #e9ecef;">
                        <tr>
                            <th class="py-3 ps-4" style="font-weight: 700; font-size: 0.85rem; letter-spacing: 0.5px; color: #000000;">Name</th>
                            <th class="py-3" style="font-weight: 700; font-size: 0.85rem; letter-spacing: 0.5px; color: #000000;">Email</th>
                            <th class="py-3" style="font-weight: 700; font-size: 0.85rem; letter-spacing: 0.5px; color: #000000;">Role</th>
                            <th class="py-3" style="font-weight: 700; font-size: 0.85rem; letter-spacing: 0.5px; color: #000000;">Department</th>
                            <th class="py-3 text-center" style="font-weight: 700; font-size: 0.85rem; letter-spacing: 0.5px; color: #000000;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr class="table-row-card" style="transition: all 0.3s ease; border-bottom: 1px solid #ecf3f7;">
                            <td class="fw-bold ps-4 py-3" style="color: #1e2f3c;">
                                <i class="fas fa-user-circle me-2" style="color: #2c7da0;"></i>
                                {{ $user->name }}
                            </td>
                            <td class="py-3" style="color: #4b6f86;">
                                <i class="fas fa-envelope me-2" style="font-size: 0.8rem; color: #8ba9c2;"></i>
                                {{ $user->email }}
                            </td>
                            <td class="py-3">
                                @if($user->role)
                                    @php
                                        $roleColors = [
                                            'Admin' => ['bg' => '#fef3e8', 'color' => '#f39c12', 'icon' => 'fa-crown'],
                                            'Agent' => ['bg' => '#e8f4fd', 'color' => '#3498db', 'icon' => 'fa-user-headset'],
                                            'Customer' => ['bg' => '#e8f8f5', 'color' => '#1abc9c', 'icon' => 'fa-user'],
                                        ];
                                        $roleInfo = $roleColors[$user->role->name] ?? ['bg' => '#eef2f5', 'color' => '#7f8c8d', 'icon' => 'fa-user'];
                                    @endphp
                                    <span class="badge px-3 py-2 rounded-pill" style="background: {{ $roleInfo['bg'] }}; color: {{ $roleInfo['color'] }}; font-weight: 500;">
                                        <i class="fas {{ $roleInfo['icon'] }} me-1"></i> {{ $user->role->name }}
                                    </span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="py-3">
                                @if($user->department)
                                    <span class="badge px-3 py-2 rounded-pill" style="background: #eef3fa; color: #2c627c; font-weight: 500;">
                                        <i class="fas fa-building me-1"></i> {{ $user->department->name }}
                                    </span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center py-3">
                                <div class="d-flex gap-2 justify-content-center">
                                    <!-- Edit Button - Modern Style -->
                                    <a href="{{ route('admin.users.edit', $user->id) }}" 
                                       class="btn btn-sm px-3 py-1 rounded-pill" 
                                       style="background: #e9f5ef; color: #2c7a4d; transition: all 0.2s; border: none;"
                                       onmouseover="this.style.background='#d0ecd9'; this.style.transform='translateY(-2px)'"
                                       onmouseout="this.style.background='#e9f5ef'; this.style.transform='translateY(0)'"
                                       title="Edit User">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>

                                    <!-- Delete Button - Modern Style -->
                                    <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" style="display:inline" onsubmit="return confirm('Delete \"{{ $user->name }}\"? This action cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm px-3 py-1 rounded-pill" 
                                                style="background: #fef1f0; color: #bc5a5a; transition: all 0.2s; border: none;"
                                                onmouseover="this.style.background='#ffe0de'; this.style.transform='translateY(-2px)'"
                                                onmouseout="this.style.background='#fef1f0'; this.style.transform='translateY(0)'"
                                                title="Delete User">
                                            <i class="fas fa-trash-alt me-1"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-users-slash fa-3x mb-3 opacity-50"></i>
                                    <p class="mb-0">No users found. Click "Add User" to create one.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination - Modern Styling -->
    <div class="mt-4 d-flex justify-content-center">
        @if ($users->hasPages())
            <nav aria-label="Page navigation">
                <ul class="pagination pagination-sm justify-content-center gap-1">
                    {{-- Previous Page Link --}}
                    @if ($users->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link rounded-pill" style="background: #f0f2f5; color: #adb5bd; border: none;">&laquo;</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link rounded-pill" href="{{ $users->previousPageUrl() }}" style="background: white; color: #2c7da0; border: none; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">&laquo;</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($users->links()->elements[0] as $page => $url)
                        @if ($page == $users->currentPage())
                            <li class="page-item active">
                                <span class="page-link rounded-pill" style="background: linear-gradient(135deg, #1f6e8c, #2c8dad); color: white; border: none;">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link rounded-pill" href="{{ $url }}" style="background: white; color: #2c7da0; border: none; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($users->hasMorePages())
                        <li class="page-item">
                            <a class="page-link rounded-pill" href="{{ $users->nextPageUrl() }}" style="background: white; color: #2c7da0; border: none; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">&raquo;</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link rounded-pill" style="background: #f0f2f5; color: #adb5bd; border: none;">&raquo;</span>
                        </li>
                    @endif
                </ul>
            </nav>
        @endif
    </div>

</div>

<!-- Custom Styling -->
@push('styles')
<style>
    body {
        background: linear-gradient(135deg, #f4f7fc 0%, #eef2f5 100%);
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
    }

    /* Table Row Hover Effect */
    .table-row-card {
        transition: all 0.3s ease;
        background: #fff;
    }
    
    .table-row-card:hover {
        background: #f9fefd;
        transform: translateX(4px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    /* Custom Button Hover Effects */
    .btn-edit:hover, .btn-delete:hover {
        transform: translateY(-2px);
    }

    /* Smooth Card Transitions */
    .card {
        transition: transform 0.3s, box-shadow 0.3s;
    }
    
    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 1rem 2rem rgba(0,0,0,0.1) !important;
    }

    /* Badge Enhancements */
    .badge {
        font-size: 0.8rem;
        font-weight: 500;
        letter-spacing: 0.2px;
    }

    /* Table Styling */
    .table {
        border-collapse: separate;
        border-spacing: 0;
    }

    thead th {
        border-bottom: none;
        font-weight: 700;
        letter-spacing: 0.3px;
    }

    /* Pagination Hover Effects */
    .page-link:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transition: all 0.2s;
    }

    /* Scrollbar Styling */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb {
        background: #2c7da0;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #1f6e8c;
    }
</style>
@endpush

@push('scripts')
<!-- FontAwesome 6 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
@endpush

@endsection