@extends('layouts.app')

@section('content')
<div class="container py-4 py-lg-5">
    <!-- Header Section with Gradient Background -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 pb-2 border-bottom border-primary border-opacity-25">
        <div>
            <h1 class="display-6 fw-bold text-gradient mb-0">All Tickets</h1>
            <p class="text-muted mt-1">Manage and track all support tickets efficiently</p>
        </div>
        <a href="{{ route('tickets.create') }}" class="btn btn-primary rounded-pill px-4 py-2 mt-3 mt-md-0 shadow-sm transition-hover">
            <i class="fas fa-plus-circle me-2"></i> Create Ticket
        </a>
    </div>

    <!-- Enhanced Filters with Card Design -->
    <div class="card shadow-sm border-0 rounded-4 mb-4">
        <div class="card-body p-3 p-lg-4">
            <form method="GET" action="{{ route('tickets.index') }}" id="filterForm">
                <div class="row g-3 align-items-end">
                    <div class="col-md-5">
                        <label for="category_id" class="form-label fw-semibold small text-uppercase text-muted mb-1">
                            <i class="fas fa-tag me-1"></i> Category
                        </label>
                        <select name="category_id" id="category_id" class="form-select form-select-lg rounded-3 border-0 bg-light">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                    {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label for="priority" class="form-label fw-semibold small text-uppercase text-muted mb-1">
                            <i class="fas fa-flag me-1"></i> Priority Level
                        </label>
                        <select name="priority" id="priority" class="form-select form-select-lg rounded-3 border-0 bg-light">
                            <option value="">All Priorities</option>
                            @foreach(['low','medium','high','urgent'] as $priority)
                                <option value="{{ $priority }}" 
                                    {{ request('priority') == $priority ? 'selected' : '' }}>
                                    {{ ucfirst($priority) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100 rounded-3 py-2 shadow-sm transition-hover">
                            <i class="fas fa-filter me-2"></i> Apply
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Stats Row (Dynamic Matches Count) -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <div class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-2 mb-sm-0">
            <i class="fas fa-ticket-alt me-1"></i> {{ $tickets->total() }} Matches Found
        </div>
        <div class="text-muted small">
            <i class="far fa-clock me-1"></i> Last updated: {{ now()->format('h:i A') }}
        </div>
    </div>

    <!-- Modern Responsive Table Card -->
    <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr class="border-0">
                        <th scope="col" class="ps-4 py-3 fw-semibold">ID</th>
                        <th scope="col" class="py-3 fw-semibold">Title</th>
                        <th scope="col" class="py-3 fw-semibold">Priority</th>
                        <th scope="col" class="py-3 fw-semibold">Category</th>
                        <th scope="col" class="py-3 fw-semibold">Status</th>
                        <th scope="col" class="py-3 fw-semibold">Created</th>
                        <th scope="col" class="pe-4 py-3 fw-semibold text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tickets as $ticket)
                        <tr class="border-top">
                            <td class="ps-4 fw-bold text-primary">#{{ $ticket->id }}</td>
                            <td class="fw-medium">{{ $ticket->title }}</td>
                            <td>
                                @php
                                    $priorityColors = [
                                        'low' => 'success',
                                        'medium' => 'warning',
                                        'high' => 'danger',
                                        'urgent' => 'dark'
                                    ];
                                    $color = $priorityColors[$ticket->priority] ?? 'secondary';
                                @endphp
                                <span class="badge bg-{{ $color }}-subtle text-{{ $color }} rounded-pill px-3 py-1">
                                    <i class="fas fa-flag me-1"></i> {{ ucfirst($ticket->priority) }}
                                </span>
                            </td>
                            <td>
                                <span class="text-muted">
                                    <i class="fas fa-folder me-1"></i> {{ optional($ticket->category)->name ?? 'N/A' }}
                                </span>
                            </td>
                            <td>
                                @php
                                    $statusColors = [
                                        'open' => 'info',
                                        'in_progress' => 'primary',
                                        'resolved' => 'success',
                                        'closed' => 'secondary'
                                    ];
                                    $statusColor = $statusColors[$ticket->status] ?? 'secondary';
                                @endphp
                                <span class="badge bg-{{ $statusColor }}-subtle text-{{ $statusColor }} rounded-pill px-3 py-1">
                                    <i class="fas fa-circle me-1 small"></i> {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                                </span>
                            </td>
                            <td class="text-muted small">{{ $ticket->created_at->format('d M Y') }}</td>
                            <td class="pe-4">
                                <div class="d-flex flex-column flex-lg-row gap-2 justify-content-center">
                                    <!-- View Button -->
                                    <a href="{{ route('tickets.show', $ticket->id) }}" 
                                       class="btn btn-sm btn-outline-info rounded-3 px-3 transition-hover"
                                       data-bs-toggle="tooltip" title="View Details">
                                        <i class="fas fa-eye"></i> View
                                    </a>

                                    <!-- Edit Button -->
                                    <a href="{{ route('tickets.edit', $ticket->id) }}" 
                                       class="btn btn-sm btn-outline-warning rounded-3 px-3 transition-hover"
                                       data-bs-toggle="tooltip" title="Edit Ticket">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('tickets.destroy', $ticket->id) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger rounded-3 px-3 transition-hover" 
                                                onclick="return confirm('Are you sure you want to delete this ticket? This action cannot be undone.')"
                                                data-bs-toggle="tooltip" title="Delete Ticket">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fas fa-inbox fa-3x mb-3 opacity-50"></i>
                                <p class="mb-0">No tickets found matching your criteria.</p>
                                <a href="{{ route('tickets.index') }}" class="btn btn-link mt-2">Clear Filters</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination with Enhanced Styling -->
    <div class="d-flex justify-content-center mt-4">
        @if ($tickets->hasPages())
            <nav aria-label="Ticket pagination">
                {{ $tickets->withQueryString()->links() }}
            </nav>
        @endif
    </div>
</div>

<style>
    /* Custom Styles for Modern Look */
    .text-gradient {
        background: linear-gradient(135deg, #0d6efd, #0a58ca);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }
    
    .bg-success-subtle {
        background-color: #d1e7dd !important;
    }
    .text-success {
        color: #0f5132 !important;
    }
    .bg-warning-subtle {
        background-color: #fff3cd !important;
    }
    .text-warning {
        color: #664d03 !important;
    }
    .bg-danger-subtle {
        background-color: #f8d7da !important;
    }
    .text-danger {
        color: #842029 !important;
    }
    .bg-dark-subtle {
        background-color: #e9ecef !important;
    }
    .text-dark {
        color: #212529 !important;
    }
    .bg-info-subtle {
        background-color: #cff4fc !important;
    }
    .text-info {
        color: #055160 !important;
    }
    .bg-primary-subtle {
        background-color: #cfe2ff !important;
    }
    .text-primary {
        color: #084298 !important;
    }
    .bg-secondary-subtle {
        background-color: #e2e3e5 !important;
    }
    .text-secondary {
        color: #41464b !important;
    }
    
    .transition-hover {
        transition: all 0.2s ease-in-out;
    }
    .transition-hover:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }
    
    /* Responsive table adjustments */
    @media (max-width: 768px) {
        .table td, .table th {
            padding: 0.75rem;
        }
        .badge {
            font-size: 0.7rem;
        }
        .btn-sm {
            font-size: 0.75rem;
        }
    }
    
    /* Pagination styling override */
    .pagination {
        gap: 0.25rem;
    }
    .page-link {
        border-radius: 0.375rem !important;
        margin: 0 2px;
        color: #0d6efd;
        border: 1px solid #dee2e6;
        transition: all 0.2s;
    }
    .page-link:hover {
        background-color: #e9ecef;
        transform: translateY(-1px);
    }
    .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
    .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        background-color: #fff;
        border-color: #dee2e6;
    }
</style>

@push('scripts')
<script>
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
</script>
@endpush

@endsection