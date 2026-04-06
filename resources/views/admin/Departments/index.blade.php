@extends('layouts.app')

@section('content')
<div class="container py-5">

    <!-- Header + Add Department Button with modern design -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div class="title-section">
            <h2 class="fw-bold" style="background: linear-gradient(135deg, #1F3B4C, #2C5F7A); background-clip: text; -webkit-background-clip: text; color: transparent;">
                <i class="fas fa-building me-2" style="color: #2c7da0;"></i> Department Directory
            </h2>
            <p class="text-muted mt-1" style="font-size: 0.9rem;">
                <i class="fas fa-sitemap me-1"></i> Manage organizational departments & structure
            </p>
        </div>
        <a href="{{ route('admin.departments.create') }}" class="btn btn-success btn-lg rounded-pill px-4 shadow-sm" 
           style="background: linear-gradient(105deg, #1f6e8c, #2c8dad); border: none; transition: all 0.3s ease;">
            <i class="fas fa-plus-circle me-2"></i> Add Department
        </a>
    </div>

    <!-- Stats Summary Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 mb-1">Total Departments</h6>
                            <h3 class="text-white mb-0 fw-bold">{{ $departments->total() }}</h3>
                        </div>
                        <div class="bg-white bg-opacity-25 rounded-circle p-3">
                            <i class="fas fa-building fa-2x text-white"></i>
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
                            <h6 class="text-white-50 mb-1">Active Departments</h6>
                            <h3 class="text-white mb-0 fw-bold">{{ $departments->count() }}</h3>
                        </div>
                        <div class="bg-white bg-opacity-25 rounded-circle p-3">
                            <i class="fas fa-check-circle fa-2x text-white"></i>
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
                            <h6 class="text-white-50 mb-1">Department Types</h6>
                            <h3 class="text-white mb-0 fw-bold">{{ $departments->unique('name')->count() }}</h3>
                        </div>
                        <div class="bg-white bg-opacity-25 rounded-circle p-3">
                            <i class="fas fa-tags fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Departments Table Card - Modern Design -->
    <div class="card shadow-sm border-0 rounded-4 overflow-hidden" style="background: rgba(255,255,255,0.95); backdrop-filter: blur(2px);">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead style="background: #f8f9fa; border-bottom: 2px solid #e9ecef;">
                        <tr>
                            <th class="py-3 ps-4" style="font-weight: 700; font-size: 0.85rem; letter-spacing: 0.5px; color: #000000;">
                                <i class="fas fa-tag me-2"></i> Department Name
                            </th>
                            <th class="py-3 text-center" style="font-weight: 700; font-size: 0.85rem; letter-spacing: 0.5px; color: #000000; width: 200px;">
                                <i class="fas fa-cog me-2"></i> Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($departments as $department)
                        <tr class="table-row-card" style="transition: all 0.3s ease; border-bottom: 1px solid #ecf3f7;">
                            <td class="fw-bold ps-4 py-3" style="color: #1e2f3c;">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle p-2" style="background: linear-gradient(135deg, #eef3fa, #e2eaf0); width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-building" style="color: #2c7da0; font-size: 1.1rem;"></i>
                                    </div>
                                    <span>{{ $department->name }}</span>
                                </div>
                            </td>
                            <td class="text-center py-3">
                                <div class="d-flex gap-2 justify-content-center flex-wrap">
                                    <!-- Edit Button - Modern Style -->
                                    <a href="{{ route('admin.departments.edit', $department->id) }}" 
                                       class="btn btn-sm px-3 py-1 rounded-pill" 
                                       style="background: #e9f5ef; color: #2c7a4d; transition: all 0.2s; border: none;"
                                       onmouseover="this.style.background='#d0ecd9'; this.style.transform='translateY(-2px)'"
                                       onmouseout="this.style.background='#e9f5ef'; this.style.transform='translateY(0)'"
                                       title="Edit Department">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>

                                    <!-- Delete Button - Modern Style -->
                                    <form method="POST" action="{{ route('admin.departments.destroy', $department->id) }}" 
                                          style="display:inline" 
                                          onsubmit="return confirm('Are you sure you want to delete department "{{ $department->name }}"? This action cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm px-3 py-1 rounded-pill" 
                                                style="background: #fef1f0; color: #bc5a5a; transition: all 0.2s; border: none;"
                                                onmouseover="this.style.background='#ffe0de'; this.style.transform='translateY(-2px)'"
                                                onmouseout="this.style.background='#fef1f0'; this.style.transform='translateY(0)'"
                                                title="Delete Department">
                                            <i class="fas fa-trash-alt me-1"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-building-slash fa-3x mb-3 opacity-50"></i>
                                    <p class="mb-0">No departments found. Click "Add Department" to create one.</p>
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
        @if ($departments->hasPages())
            <nav aria-label="Page navigation">
                <ul class="pagination pagination-sm justify-content-center gap-1">
                    {{-- Previous Page Link --}}
                    @if ($departments->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link rounded-pill" style="background: #f0f2f5; color: #adb5bd; border: none;">&laquo;</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link rounded-pill" href="{{ $departments->previousPageUrl() }}" style="background: white; color: #2c7da0; border: none; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">&laquo;</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($departments->links()->elements[0] as $page => $url)
                        @if ($page == $departments->currentPage())
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
                    @if ($departments->hasMorePages())
                        <li class="page-item">
                            <a class="page-link rounded-pill" href="{{ $departments->nextPageUrl() }}" style="background: white; color: #2c7da0; border: none; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">&raquo;</a>
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

    /* Responsive Design */
    @media (max-width: 768px) {
        .container {
            padding-left: 1rem;
            padding-right: 1rem;
        }
        
        .table-responsive {
            border-radius: 1rem;
        }
        
        .table-row-card td {
            padding: 1rem;
        }
        
        .d-flex.gap-2 {
            gap: 0.5rem !important;
        }
        
        .btn-sm {
            padding: 0.4rem 0.8rem;
            font-size: 0.75rem;
        }
    }

    @media (max-width: 576px) {
        .title-section h2 {
            font-size: 1.5rem;
        }
        
        .title-section p {
            font-size: 0.8rem;
        }
        
        .btn-lg {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }
        
        /* Stack buttons on mobile */
        .d-flex.gap-2 {
            flex-direction: column;
            align-items: center;
        }
        
        .btn-sm {
            width: 100%;
            min-width: 120px;
        }
        
        /* Better table display on mobile */
        .table thead {
            display: none;
        }
        
        .table, .table tbody, .table tr, .table td {
            display: block;
            width: 100%;
        }
        
        .table tr {
            margin-bottom: 1rem;
            border: 1px solid #e9ecef;
            border-radius: 12px;
            overflow: hidden;
        }
        
        .table td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 1rem;
            text-align: right;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .table td:before {
            content: attr(data-label);
            font-weight: 600;
            text-align: left;
            margin-right: 1rem;
            color: #2c7da0;
        }
        
        .table td:last-child {
            border-bottom: none;
        }
        
        .table td.text-center {
            justify-content: flex-end;
        }
        
        .table td .d-flex {
            width: 100%;
            justify-content: flex-end;
        }
        
        /* Stats cards responsive */
        .row.g-3 {
            gap: 0.75rem;
        }
        
        .col-md-4 {
            padding: 0 0.5rem;
        }
        
        .card-body.py-3 h3 {
            font-size: 1.5rem;
        }
        
        .card-body.py-3 h6 {
            font-size: 0.7rem;
        }
        
        .bg-white.bg-opacity-25.rounded-circle.p-3 {
            padding: 0.5rem;
        }
        
        .bg-white.bg-opacity-25.rounded-circle.p-3 i {
            font-size: 1.2rem;
        }
    }

    /* Tablet Responsive */
    @media (min-width: 577px) and (max-width: 992px) {
        .btn-sm {
            padding: 0.35rem 0.7rem;
            font-size: 0.75rem;
        }
        
        .table th, .table td {
            padding: 0.75rem;
        }
        
        .rounded-circle.p-2 {
            width: 35px;
            height: 35px;
        }
        
        .rounded-circle.p-2 i {
            font-size: 0.9rem;
        }
    }

    /* Animation for empty state */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .text-muted i {
        animation: fadeIn 0.5s ease;
    }
</style>
@endpush

@push('scripts')
<!-- FontAwesome 6 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

<script>
    // Add data-label attributes for responsive table on mobile
    document.addEventListener('DOMContentLoaded', function() {
        const tables = document.querySelectorAll('.table');
        
        tables.forEach(table => {
            const headers = table.querySelectorAll('thead th');
            
            table.querySelectorAll('tbody tr').forEach(row => {
                row.querySelectorAll('td').forEach((cell, index) => {
                    if (headers[index]) {
                        cell.setAttribute('data-label', headers[index].innerText.replace(/[^\w\s]/g, '').trim());
                    }
                });
            });
        });
    });
</script>
@endpush

@endsection