@extends('layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap');

    :root {
        --ink: #0d0d0f;
        --paper: #f7f6f2;
        --accent: #e84b2a;
        --accent-soft: #fdeae6;
        --muted: #8a8880;
        --line: #e2e0da;
        --input-bg: #ffffff;
        --focus: #e84b2a;
        --success-bg: #edfaf4;
        --success-text: #1a7a50;
    }

    .create-wrap {
        font-family: 'DM Sans', sans-serif;
        background: var(--paper);
        min-height: 100vh;
        padding: 56px 40px 80px;
    }

    /* ── Page Header ── */
    .page-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 40px;
        padding-bottom: 24px;
        border-bottom: 2px solid var(--ink);
    }

    .page-header .headline {
        font-family: 'Syne', sans-serif;
        font-size: clamp(1.8rem, 3.5vw, 2.8rem);
        font-weight: 800;
        color: var(--ink);
        line-height: 1;
        letter-spacing: -0.03em;
        margin: 0;
    }

    .page-header .headline span { color: var(--accent); }

    .page-header .sub {
        font-size: 0.875rem;
        color: var(--muted);
        margin-top: 6px;
        font-weight: 300;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: transparent;
        color: var(--ink);
        font-family: 'Syne', sans-serif;
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        padding: 11px 20px;
        border: 1.5px solid var(--ink);
        text-decoration: none;
        transition: all 0.18s;
        border-radius: 0;
    }

    .btn-back:hover {
        background: var(--ink);
        color: #fff;
    }

    /* ── Alert ── */
    .alert-success-custom {
        background: var(--success-bg);
        color: var(--success-text);
        border-left: 4px solid #2ecc71;
        padding: 14px 20px;
        font-size: 0.875rem;
        font-weight: 500;
        margin-bottom: 28px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* ── Form Card ── */
    .form-card {
        background: #fff;
        border: 1.5px solid var(--line);
        overflow: hidden;
        animation: cardIn 0.4s ease both;
    }

    @keyframes cardIn {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ── Form Card Header ── */
    .form-card-header {
        background: var(--ink);
        padding: 22px 36px;
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .form-card-header .header-icon {
        width: 38px;
        height: 38px;
        background: var(--accent);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .form-card-header .header-icon svg { color: #fff; }

    .form-card-header h4 {
        font-family: 'Syne', sans-serif;
        font-size: 1rem;
        font-weight: 700;
        color: #fff;
        margin: 0;
        letter-spacing: 0.02em;
    }

    .form-card-header .step-hint {
        font-size: 0.75rem;
        color: rgba(255,255,255,0.4);
        margin-top: 2px;
        font-weight: 300;
    }

    /* ── Form Body ── */
    .form-body {
        padding: 40px 36px;
    }

    /* ── Field Groups ── */
    .field-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        margin-bottom: 28px;
    }

    .field-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .field-group.full { margin-bottom: 28px; }

    .field-label {
        font-family: 'Syne', sans-serif;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--ink);
    }

    .field-label .required {
        color: var(--accent);
        margin-left: 3px;
    }

    /* ── Inputs ── */
    .field-input,
    .field-select,
    .field-textarea {
        font-family: 'DM Sans', sans-serif;
        font-size: 0.9rem;
        font-weight: 400;
        color: var(--ink);
        background: var(--input-bg);
        border: 1.5px solid var(--line);
        border-radius: 0;
        padding: 13px 16px;
        outline: none;
        transition: border-color 0.18s, box-shadow 0.18s;
        width: 100%;
        appearance: none;
        -webkit-appearance: none;
    }

    .field-input::placeholder,
    .field-textarea::placeholder { color: #bbb; font-weight: 300; }

    .field-input:focus,
    .field-select:focus,
    .field-textarea:focus {
        border-color: var(--focus);
        box-shadow: 0 0 0 3px rgba(232,75,42,0.08);
    }

    /* custom select arrow */
    .select-wrap {
        position: relative;
    }

    .select-wrap::after {
        content: '';
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        width: 0;
        height: 0;
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-top: 6px solid var(--muted);
        pointer-events: none;
    }

    .field-textarea {
        resize: vertical;
        min-height: 160px;
        line-height: 1.6;
    }

    /* ── Validation errors ── */
    .field-error {
        font-size: 0.78rem;
        color: var(--accent);
        margin-top: 4px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* ── Divider ── */
    .form-divider {
        border: none;
        border-top: 1px solid var(--line);
        margin: 32px 0;
    }

    /* ── Footer ── */
    .form-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 24px 36px;
        background: #fafaf8;
        border-top: 1.5px solid var(--line);
    }

    .form-footer .hint {
        font-size: 0.8rem;
        color: var(--muted);
        font-weight: 300;
    }

    .form-footer .hint span {
        color: var(--accent);
        font-weight: 500;
    }

    .btn-save {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: var(--ink);
        color: #fff;
        font-family: 'Syne', sans-serif;
        font-size: 0.85rem;
        font-weight: 700;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        padding: 14px 32px;
        border: 2px solid var(--ink);
        cursor: pointer;
        transition: all 0.18s;
        border-radius: 0;
    }

    .btn-save:hover {
        background: var(--accent);
        border-color: var(--accent);
        transform: translateY(-2px);
    }

    .btn-save svg { transition: transform 0.18s; }
    .btn-save:hover svg { transform: translateX(3px); }

    /* ── CKEditor override ── */
    .cke_chrome {
        border: 1.5px solid var(--line) !important;
        border-radius: 0 !important;
        box-shadow: none !important;
    }

    .cke_top {
        background: #f7f6f2 !important;
        border-bottom: 1px solid var(--line) !important;
    }

    /* ── Responsive ── */
    @media (max-width: 640px) {
        .create-wrap { padding: 32px 20px 60px; }
        .field-row { grid-template-columns: 1fr; }
        .form-body { padding: 28px 20px; }
        .form-footer { flex-direction: column; gap: 16px; align-items: flex-start; }
        .form-card-header { padding: 18px 20px; }
    }
</style>

<div class="create-wrap">

    {{-- ── Page Header ── --}}
    <div class="page-header">
        <div>
            <h2 class="headline">New <span>Article</span></h2>
            <p class="sub">Fill in the details to publish a new article</p>
        </div>
        <a href="{{ route('admin.articles.index') }}" class="btn-back">
            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24"
                 fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6"/>
            </svg>
            Back
        </a>
    </div>

    {{-- ── Success Alert ── --}}
    @if(session('success'))
        <div class="alert-success-custom">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                 fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- ── Form Card ── --}}
    <div class="form-card">

        {{-- Header --}}
        <div class="form-card-header">
            <div class="header-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 20h9"/>
                    <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/>
                </svg>
            </div>
            <div>
                <h4>Create New Article</h4>
                <div class="step-hint">All fields marked * are required</div>
            </div>
        </div>

        {{-- Form --}}
        <form action="{{ route('admin.articles.store') }}" method="POST">
            @csrf

            <div class="form-body">

                {{-- Title + Category row --}}
                <div class="field-row">

                    {{-- Article Title --}}
                    <div class="field-group">
                        <label class="field-label" for="title">
                            Article Title <span class="required">*</span>
                        </label>
                        <input
                            type="text"
                            id="title"
                            name="title"
                            class="field-input"
                            placeholder="Enter article title…"
                            value="{{ old('title') }}"
                            required
                        >
                        @error('title')
                            <div class="field-error">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Category --}}
                    <div class="field-group">
                        <label class="field-label" for="category_id">
                            Category <span class="required">*</span>
                        </label>
                        <div class="select-wrap">
                            <select id="category_id" name="category_id" class="field-select" required>
                                <option value="">Select a category…</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('category_id')
                            <div class="field-error">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>

                {{-- Content --}}
                <div class="field-group full">
                    <label class="field-label" for="editor">
                        Article Content <span class="required">*</span>
                    </label>
                    <textarea
                        id="editor"
                        name="content"
                        class="field-textarea"
                        placeholder="Write your article content here…"
                        rows="10"
                    >{{ old('content') }}</textarea>
                    @error('content')
                        <div class="field-error">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                            </svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

            </div>{{-- /form-body --}}

            {{-- Footer --}}
            <div class="form-footer">
                <p class="hint">
                    <span>*</span> Required fields must be filled before saving.
                </p>
                <button type="submit" class="btn-save">
                    Save Article
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"/>
                        <polyline points="12 5 19 12 12 19"/>
                    </svg>
                </button>
            </div>

        </form>
    </div>{{-- /form-card --}}

</div>

{{-- CKEditor --}}
<script src="https://cdn.ckeditor.com/4.25.1-lts/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor', {
        toolbar: [
            { name: 'basicstyles', items: ['Bold','Italic','Underline','Strike','-','RemoveFormat'] },
            { name: 'paragraph',   items: ['NumberedList','BulletedList','-','Blockquote'] },
            { name: 'links',       items: ['Link','Unlink'] },
            { name: 'insert',      items: ['Image','Table','HorizontalRule'] },
            { name: 'styles',      items: ['Styles','Format'] },
            { name: 'tools',       items: ['Maximize'] }
        ],
        height: 320,
        removePlugins: 'elementspath',
        resize_enabled: true,
    });
</script>

@endsection