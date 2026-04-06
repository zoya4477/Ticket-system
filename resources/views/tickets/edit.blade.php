@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Ticket</h4>
        </div>

        <div class="card-body">

            <form method="POST" action="{{ route('tickets.update', $ticket->id) }}">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" 
                           name="title" 
                           class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', $ticket->title) }}" 
                           required>

                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description"
                              class="form-control @error('description') is-invalid @enderror"
                              rows="4"
                              required>{{ old('description', $ticket->description) }}</textarea>

                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Priority -->
                <div class="mb-3">
                    <label class="form-label">Priority</label>
                    <select name="priority"
                            class="form-select @error('priority') is-invalid @enderror"
                            required>
                        @foreach(['low','medium','high','urgent'] as $p)
                            <option value="{{ $p }}" {{ old('priority', $ticket->priority) == $p ? 'selected' : '' }}>
                                {{ ucfirst($p) }}
                            </option>
                        @endforeach
                    </select>

                    @error('priority')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Category -->
                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category_id"
                            class="form-select @error('category_id') is-invalid @enderror"
                            required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $ticket->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    @php
                        $statusOptions = [
                            'open' => 'Open',
                            'in_progress' => 'In Progress',
                            'closed' => 'Closed'
                        ];
                        // Only Admin/Agent can mark as resolved
                        if(in_array(auth()->user()->role->name, ['Admin','Agent'])){
                            $statusOptions['resolved'] = 'Resolved';
                        }
                    @endphp
                    <select name="status"
                            class="form-select @error('status') is-invalid @enderror"
                            required>
                        @foreach($statusOptions as $value => $label)
                            <option value="{{ $value }}" {{ old('status', $ticket->status) == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>

                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('tickets.index') }}" class="btn btn-secondary">
                        Back
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Update Ticket
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .form-label {
        font-weight: 500;
    }
    textarea.form-control {
        resize: none;
    }
</style>
@endpush