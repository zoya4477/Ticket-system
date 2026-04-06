@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Hero Section with Gradient -->
    <div class="text-center mb-3">
        <h2 class="display-5 fw-bold mb-3" style="background: linear-gradient(135deg, #1e3c72 0%, #2b4c7c 100%); background-clip: text; -webkit-background-clip: text; color: transparent;">
            Create New Ticket
        </h2>
        <p class="text-muted fs-5">Submit your ticket and it will be processed automatically.</p>
    </div>

    <!-- Success Message (Fallback if SweetAlert fails) -->
    @if(session('success') && !session('department'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 rounded-3" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 rounded-3" role="alert">
            <div class="d-flex align-items-start">
                <i class="bi bi-exclamation-triangle-fill me-3 fs-4"></i>
                <div>
                    <strong class="d-block mb-1">Please fix the following errors:</strong>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Modern Form Card with Glassmorphism Effect -->
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <!-- Card Header with Decorative Line -->
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <!-- <div class="d-flex align-items-center gap-2 mb-2">
                        <div class="bg-primary rounded-circle p-1" style="width: 8px; height: 8px;"></div>
                        <div class="bg-primary bg-opacity-50 rounded-circle p-1" style="width: 6px; height: 6px;"></div>
                        <div class="bg-primary bg-opacity-25 rounded-circle p-1" style="width: 4px; height: 4px;"></div>
                        - <span class="small text-muted ms-2">Fill out the form below</span> --
                    </div> -->
                    <h5 class="card-title fw-semibold mb-1">Ticket Information</h5>
                    <p class="text-muted small mt-0">All fields are required unless noted otherwise</p>
                </div>

                <div class="card-body p-4 p-lg-5 pt-0">
                    <form method="POST" action="{{ route('tickets.store') }}" id="ticketForm">
                        @csrf

                        <!-- Title Input with Icon -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold mb-2">
                                <i class="bi bi-chat-text me-1 text-primary"></i> Ticket Title
                            </label>
                            <input type="text"
                                   name="title"
                                   class="form-control form-control-lg @error('title') is-invalid @enderror"
                                   placeholder="Please enter your issue here..."
                                   value="{{ old('title') }}"
                                   required
                                   style="border-radius: 12px; background-color: #f8fafc; border: 1px solid #e2e8f0;">
                            <div class="form-text">Provide a clear and concise summary of your issue.</div>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description Textarea with Character Count -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold mb-2">
                                <i class="bi bi-file-text me-1 text-primary"></i> Description
                            </label>
                            <textarea name="description"
                                      id="description"
                                      rows="5"
                                      class="form-control @error('description') is-invalid @enderror"
                                      placeholder="Please describe your issue in detail. Include any steps to reproduce, error messages, or screenshots if possible..."
                                      required
                                      style="border-radius: 12px; background-color: #f8fafc; border: 1px solid #e2e8f0;">{{ old('description') }}</textarea>
                            <div class="form-text d-flex justify-content-between mt-1">
                                <span>Provide as much detail as possible for faster resolution.</span>
                                <span id="charCount" class="text-muted small">0 / 2000</span>
                            </div>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Priority Select with Colored Options -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold mb-2">
                                <i class="bi bi-flag me-1 text-primary"></i> Priority Level
                            </label>
                            <select name="priority"
                                    class="form-select form-select-lg @error('priority') is-invalid @enderror"
                                    required
                                    style="border-radius: 12px; background-color: #f8fafc; border: 1px solid #e2e8f0;">
                                <option value="" disabled selected>Select Priority</option>
                                <option value="low" {{ old('priority')=='low' ? 'selected' : '' }}>🟢 Low - General inquiry or minor issue</option>
                                <option value="medium" {{ old('priority')=='medium' ? 'selected' : '' }}>🟡 Medium - Affects workflow but has workaround</option>
                                <option value="high" {{ old('priority')=='high' ? 'selected' : '' }}>🔴 High - Critical impact, needs immediate attention</option>
                            </select>
                            @error('priority')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Category Select with Icons -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold mb-2">
                                <i class="bi bi-folder me-1 text-primary"></i> Category
                            </label>
                            <select name="category_id"
                                    class="form-select form-select-lg @error('category_id') is-invalid @enderror"
                                    required
                                    style="border-radius: 12px; background-color: #f8fafc; border: 1px solid #e2e8f0;">
                                <option value="" disabled selected>Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id')==$category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button with Loading State -->
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" id="submitBtn" class="btn btn-primary btn-lg shadow-sm rounded-3 py-3 fw-semibold" style="background: linear-gradient(135deg, #1e3c72 0%, #2b4c7c 100%); border: none;">
                                <i class="bi bi-send me-2"></i> Submit Ticket
                                <div class="spinner-border spinner-border-sm d-none ms-2" role="status" id="loadingSpinner">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </button>
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary rounded-3 py-2">
                                <i class="bi bi-arrow-left me-1"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Helpful Tips Card -->
            <div class="card border-0 bg-light rounded-4 mt-4 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex align-items-start gap-3">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-lightbulb text-primary fs-4"></i>
                        </div>
                        <div>
                            <h6 class="fw-semibold mb-1">Tips for a Faster Resolution</h6>
                            <ul class="text-muted small mb-0 ps-3">
                                <li>Use a descriptive title that summarizes your issue</li>
                                <li>Include steps to reproduce the problem</li>
                                <li>Mention any error messages you received</li>
                                <li>Select the appropriate priority and category</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 and Custom Scripts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Character counter for description
    const descriptionField = document.getElementById('description');
    const charCountSpan = document.getElementById('charCount');
    const maxChars = 2000;

    if (descriptionField && charCountSpan) {
        function updateCharCount() {
            const currentLength = descriptionField.value.length;
            charCountSpan.textContent = `${currentLength} / ${maxChars}`;
            if (currentLength > maxChars) {
                charCountSpan.style.color = 'red';
                descriptionField.style.borderColor = 'red';
            } else {
                charCountSpan.style.color = '#6c757d';
                descriptionField.style.borderColor = '#e2e8f0';
            }
        }

        descriptionField.addEventListener('input', updateCharCount);
        updateCharCount(); // Initial count
    }

    // Form submission with loading state
    const form = document.getElementById('ticketForm');
    const submitBtn = document.getElementById('submitBtn');
    const loadingSpinner = document.getElementById('loadingSpinner');

    if (form && submitBtn) {
        form.addEventListener('submit', function(e) {
            // Only show loading if the form is valid (browser validation)
            if (form.checkValidity()) {
                submitBtn.disabled = true;
                loadingSpinner.classList.remove('d-none');
                // Optional: change button text
                const btnText = submitBtn.querySelector('.bi-send')?.parentNode;
                if (btnText) {
                    btnText.innerHTML = '<i class="bi bi-hourglass-split me-2"></i> Submitting...';
                }
            }
        });
    }

    // SweetAlert for success message with department info
    @if(session('success') && session('department'))
        Swal.fire({
            title: '🎫 Ticket Created Successfully!',
            html: `
                <div class="text-center">
                    <div class="mb-3">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                    </div>
                    <p class="mb-2">Your ticket has been sent to</p>
                    <h5 class="fw-bold text-primary">{{ session('department') }}</h5>
                    <p class="text-muted small mt-3">A confirmation email has been sent to your registered email address.</p>
                </div>
            `,
            icon: 'success',
            confirmButtonColor: '#1e3c72',
            confirmButtonText: 'View My Tickets',
            showCancelButton: true,
            cancelButtonText: 'Create Another',
            backdrop: true,
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('tickets.index') }}";
            } else {
                // Reset form for creating another ticket
                document.getElementById('ticketForm').reset();
                // Reset character counter if needed
                if (descriptionField && charCountSpan) {
                    updateCharCount();
                }
            }
        });
    @endif
</script>

<!-- Additional CSS for better styling -->
<style>
    /* Custom focus styles */
    .form-control:focus, .form-select:focus {
        border-color: #2b4c7c;
        box-shadow: 0 0 0 0.2rem rgba(43, 76, 124, 0.15);
    }

    /* Smooth transitions */
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.1) !important;
    }

    /* Custom scrollbar for textarea */
    textarea::-webkit-scrollbar {
        width: 8px;
    }

    textarea::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    textarea::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    textarea::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* Disabled button styling */
    .btn-primary:disabled {
        background: #94a3b8 !important;
        cursor: not-allowed;
    }

    /* Alert animations */
    .alert {
        animation: slideDown 0.3s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Badge styling */
    .badge.bg-primary.bg-opacity-10 {
        background-color: rgba(30, 60, 114, 0.1) !important;
    }
</style>

<!-- Bootstrap Icons CDN (if not already included in your layout) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endsection