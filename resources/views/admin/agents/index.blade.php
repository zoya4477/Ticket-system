@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-dark font-weight-bold">Agent Management</h1>
        <a href="{{ route('admin.agents.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus-circle mr-1"></i> Add New Agent
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted">
                        <tr>
                            <th class="pl-4">#</th>
                            <th>Agent Details</th>
                            <th>Department</th>
                            <th>Role</th>
                            <th>Joined Date</th>
                            <th class="text-center pr-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($agents as $agent)
                        <tr>
                            <td class="pl-4 text-muted">{{ $loop->iteration }}</td>
                            <td>
                                <div class="font-weight-bold">{{ $agent->name }}</div>
                                <small class="text-muted">{{ $agent->email }}</small>
                            </td>
                            <td>
                                <span class="badge badge-info shadow-sm py-1 px-2">
                                    <i class="fas fa-building mr-1 small"></i>
                                    {{ $agent->department->name ?? 'Unassigned' }}
                                </span>
                            </td>
                            <td>
                                @if(($agent->role->name ?? 'Agent') == 'Manager')
                                    <span class="badge badge-warning">Manager</span>
                                @else
                                    <span class="badge badge-secondary">Agent</span>
                                @endif
                            </td>
                            <td class="text-muted">{{ $agent->created_at->format('d M, Y') }}</td>
                            <td class="text-center pr-4">
                                <div class="d-flex justify-content-center align-items-center">
                                    <a href="{{ route('admin.agents.edit', $agent->id) }}" 
                                       class="btn btn-sm btn-outline-primary mr-2" 
                                       title="Edit Agent">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <form action="{{ route('admin.agents.destroy', $agent->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Are you sure you want to delete this agent?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Agent">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fas fa-users-slash fa-3x mb-3 d-block"></i>
                                No agents found in the system.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($agents->hasPages())
        <div class="card-footer bg-white border-top-0">
            {{ $agents->links() }}
        </div>
        @endif
    </div>
</div>
@endsection