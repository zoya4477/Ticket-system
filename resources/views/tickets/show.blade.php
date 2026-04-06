@extends('layouts.app')

@section('content')
<div class="container py-5">

    <div class="position-relative mb-5">
        <div class="position-absolute top-0 start-0 w-100 h-100 rounded-5" style="background: linear-gradient(135deg, rgba(13,110,253,0.05) 0%, rgba(13,202,240,0.05) 100%); filter: blur(60px); z-index: -1;"></div>
        
        <div class="card shadow-2xl rounded-5 border-0 overflow-hidden backdrop-blur-sm" style="background: rgba(255,255,255,0.96);">
            <div class="position-relative" style="height: 8px; background: linear-gradient(90deg, 
                {{ $ticket->status == 'open' ? '#0d6efd, #0dcaf0, #0d6efd' : ($ticket->status == 'pending' ? '#ffc107, #fd7e14, #ffc107' : ($ticket->status == 'closed' ? '#198754, #20c997, #198754' : '#6c757d, #adb5bd, #6c757d')) }};
                background-size: 200% 100%; animation: shimmer 3s infinite;">
            </div>

            <div class="card-body p-4 p-lg-5">
                <div class="d-flex flex-wrap justify-content-between align-items-start gap-4">
                    <div class="d-flex gap-3 align-items-start flex-grow-1">
                        <div class="rounded-4 bg-gradient-primary p-3 shadow-lg d-none d-md-block" style="background: linear-gradient(135deg, #0d6efd, #0dcaf0);">
                            <i class="bi bi-ticket-detailed-fill text-white fs-1"></i>
                        </div>
                        <div>
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="badge px-3 py-2 rounded-pill" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                    <i class="bi bi-tag-fill me-1"></i> {{ $ticket->category->name ?? 'General' }}
                                </span>
                                <span class="badge px-3 py-2 rounded-pill" style="background: {{ $ticket->priority == 'high' ? '#dc3545' : ($ticket->priority == 'medium' ? '#fd7e14' : '#198754') }};">
                                    <i class="bi bi-flag-fill me-1"></i> {{ ucfirst($ticket->priority ?? 'Normal') }}
                                </span>
                            </div>
                            
                            <h1 class="display-6 fw-bold mb-2" style="color: #000000 !important; background: none; -webkit-text-fill-color: initial;">
                                {{ $ticket->title }}
                            </h1>
                            <p class="lead text-secondary mb-0">{{ $ticket->description }}</p>
                        </div>
                    </div>

                    <div class="d-flex gap-2 align-items-center">
                        @if(Auth::user()->role->name == 'Customer' && $ticket->status != 'closed')
                        <form action="{{ route('tickets.confirm', $ticket->id) }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="btn btn-success rounded-pill px-4 py-2 shadow-sm border-0">
                                <i class="bi bi-check2-circle me-2"></i> Confirm & Close
                            </button>
                        </form>
                        @endif

                        @if(in_array(auth()->user()->role->name, ['Admin', 'Agent']))
                        <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-outline-dark rounded-pill px-4 py-2 shadow-sm">
                            <i class="bi bi-pencil-square me-2"></i> Edit Ticket
                        </a>
                        @endif
                    </div>
                </div>

                <div class="row g-3 mt-4">
                    <div class="col-6 col-md-3">
                        <div class="p-3 bg-light rounded-4 text-center">
                            <small class="text-muted d-block">Status</small>
                            <span class="fw-bold text-capitalize">{{ $ticket->status }}</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="p-3 bg-light rounded-4 text-center">
                            <small class="text-muted d-block">Department</small>
                            <span class="fw-bold">{{ $ticket->category->department->name ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="p-3 bg-light rounded-4 text-center">
                            <small class="text-muted d-block">User</small>
                            <span class="fw-bold">{{ $ticket->user->name ?? 'User' }}</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="p-3 bg-light rounded-4 text-center">
                            <small class="text-muted d-block">Created</small>
                            <span class="fw-bold text-nowrap">{{ $ticket->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <ul class="nav nav-pills mb-4 gap-2" id="ticketTab" role="tablist">
        <li class="nav-item">
            <button class="nav-link active rounded-pill px-4 fw-semibold" id="comments-tab" data-bs-toggle="tab" data-bs-target="#comments" type="button">
                <i class="bi bi-chat-dots-fill me-2"></i> Comments ({{ $ticket->comments->count() }})
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link rounded-pill px-4 fw-semibold" id="attachments-tab" data-bs-toggle="tab" data-bs-target="#attachments" type="button">
                <i class="bi bi-paperclip me-2"></i> Files ({{ $ticket->attachments->count() }})
            </button>
        </li>
        @if(in_array(auth()->user()->role->name, ['Admin', 'Agent']))
        <li class="nav-item">
            <button class="nav-link rounded-pill px-4 fw-semibold" id="notes-tab" data-bs-toggle="tab" data-bs-target="#notes" type="button" style="background-color: #fff3cd; color: #856404;">
                <i class="bi bi-journal-lock-fill me-2"></i> Internal Notes
            </button>
        </li>
        @endif
    </ul>

    <div class="tab-content" id="ticketTabContent">
        
        <div class="tab-pane fade show active" id="comments">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-body p-4">
                    @forelse($ticket->comments as $comment)
                    <div class="d-flex gap-3 mb-4">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center flex-shrink-0" style="width: 45px; height: 45px;">
                            {{ substr($comment->user->name, 0, 1) }}
                        </div>
                        <div class="flex-grow-1 bg-light p-3 rounded-4">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <strong class="small">{{ $comment->user->name }}</strong>
                                <small class="text-muted">{{ $comment->created_at->format('M d, H:i') }}</small>
                            </div>
                            <p class="mb-0 small">{{ $comment->comment }}</p>
                        </div>
                    </div>
                    @empty
                    <p class="text-center text-muted py-4">No comments found.</p>
                    @endforelse

                    <form method="POST" action="{{ route('tickets.comment', $ticket->id) }}" class="mt-4 border-top pt-4">
                        @csrf
                        <textarea name="comment" class="form-control rounded-4 mb-2" rows="3" placeholder="Add a reply..." required></textarea>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary rounded-pill px-4">Post Comment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="attachments">
            <div class="card border-0 shadow-lg rounded-4 p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0">Attached Files</h5>
                    <form action="{{ route('tickets.uploadAttachment', $ticket->id) }}" method="POST" enctype="multipart/form-data" class="d-flex gap-2">
                        @csrf
                        <input type="file" name="attachment" class="form-control form-control-sm rounded-pill">
                        <button type="submit" class="btn btn-sm btn-primary rounded-pill">Upload</button>
                    </form>
                </div>
                <div class="row g-3">
                    @forelse($ticket->attachments as $attachment)
                    <div class="col-md-4">
                        <div class="p-3 border rounded-4 d-flex align-items-center gap-2">
                            <i class="bi bi-file-earmark-pdf fs-4 text-danger"></i>
                            <a href="{{ Storage::url($attachment->file_path) }}" class="text-decoration-none text-dark small text-truncate">{{ basename($attachment->file_path) }}</a>
                        </div>
                    </div>
                    @empty
                    <p class="text-muted text-center py-4">No attachments.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="notes">
            <div class="card border-0 shadow-lg rounded-4 p-4" style="background-color: #fff9e6;">
                <h5 class="fw-bold text-warning-emphasis mb-3">Internal Staff Notes</h5>
                @forelse($ticket->internalNotes as $note)
                <div class="mb-3 p-3 bg-white rounded-4 shadow-sm border-start border-4 border-warning">
                    <div class="d-flex justify-content-between mb-1">
                        <small class="fw-bold text-warning">{{ $note->user->name }}</small>
                        <small class="text-muted small">{{ $note->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="mb-0 small text-dark">{{ $note->note }}</p>
                </div>
                @empty
                <p class="text-muted text-center py-3">No internal notes yet.</p>
                @endforelse

                <form method="POST" action="{{ route('internal-notes.store') }}" class="mt-3">
                    @csrf
                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                    <textarea name="note" class="form-control rounded-4 mb-2" rows="2" placeholder="Confidential note..." required></textarea>
                    <button type="submit" class="btn btn-warning rounded-pill px-4 text-white">Save Note</button>
                </form>
            </div>
        </div>

    </div>
</div>

<div class="container pb-5">
    <a href="{{ route('tickets.index') }}" class="btn btn-link text-decoration-none text-dark p-0">
        <i class="bi bi-arrow-left me-2"></i> Back to Tickets
    </a>
</div>

@endsection

@push('styles')
<style>
/* Black Title override */
h1.display-6 {
    color: #000000 !important;
    font-weight: 800 !important;
}

.shadow-2xl {
    box-shadow: 0 20px 40px -10px rgba(0,0,0,0.1);
}

.nav-pills .nav-link.active {
    background: #0d6efd !important;
    color: white !important;
}

.nav-pills .nav-link {
    background: #f8f9fa;
    color: #495057;
}
</style>
@endpush