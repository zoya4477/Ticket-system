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
        --badge-bg: #eef2ff;
        --badge-text: #4f5ce0;
        --success-bg: #edfaf4;
        --success-text: #1a7a50;
    }

    .articles-wrap {
        font-family: 'DM Sans', sans-serif;
        background: var(--paper);
        min-height: 100vh;
        padding: 56px 40px 80px;
    }

    /* ── Header ── */
    .articles-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 48px;
        padding-bottom: 28px;
        border-bottom: 2px solid var(--ink);
    }

    .articles-header .headline {
        font-family: 'Syne', sans-serif;
        font-size: clamp(2rem, 4vw, 3.2rem);
        font-weight: 800;
        color: var(--ink);
        line-height: 1;
        letter-spacing: -0.03em;
        margin: 0;
    }

    .articles-header .headline span {
        color: var(--accent);
    }

    .articles-header .sub {
        font-size: 0.875rem;
        color: var(--muted);
        margin-top: 6px;
        font-weight: 300;
        letter-spacing: 0.02em;
    }

    .btn-new {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--ink);
        color: #fff;
        font-family: 'Syne', sans-serif;
        font-size: 0.85rem;
        font-weight: 700;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        padding: 13px 24px;
        border-radius: 0;
        text-decoration: none;
        transition: background 0.2s, transform 0.15s;
        border: 2px solid var(--ink);
    }

    .btn-new:hover {
        background: var(--accent);
        border-color: var(--accent);
        transform: translateY(-2px);
        color: #fff;
    }

    .btn-new i {
        font-size: 0.75rem;
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

    /* ── Table Card ── */
    .table-card {
        background: #fff;
        border: 1.5px solid var(--line);
        overflow: hidden;
    }

    /* ── Table Head ── */
    .articles-table thead tr {
        background: var(--ink);
    }

    .articles-table thead th {
        font-family: 'Syne', sans-serif;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: rgba(255,255,255,0.5);
        padding: 16px 20px;
        border: none;
    }

    .articles-table thead th:first-child { padding-left: 32px; }
    .articles-table thead th:last-child  { padding-right: 32px; text-align: right; }

    /* ── Table Body ── */
    .articles-table tbody tr {
        border-bottom: 1px solid var(--line);
        transition: background 0.15s;
    }

    .articles-table tbody tr:last-child { border-bottom: none; }
    .articles-table tbody tr:hover { background: #fdfcf9; }

    .articles-table td {
        padding: 20px 20px;
        vertical-align: middle;
        border: none;
    }

    .articles-table td:first-child { padding-left: 32px; }
    .articles-table td:last-child  { padding-right: 32px; }

    /* ── Article Info Cell ── */
    .article-avatar {
        width: 42px;
        height: 42px;
        background: var(--ink);
        color: #fff;
        font-family: 'Syne', sans-serif;
        font-weight: 800;
        font-size: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-right: 16px;
    }

    .article-title {
        font-weight: 500;
        color: var(--ink);
        font-size: 0.925rem;
        line-height: 1.3;
    }

    .article-id {
        font-size: 0.75rem;
        color: var(--muted);
        margin-top: 3px;
        font-family: 'DM Mono', monospace;
        letter-spacing: 0.03em;
    }

    /* ── Category Badge ── */
    .cat-badge {
        display: inline-block;
        background: var(--badge-bg);
        color: var(--badge-text);
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        padding: 5px 12px;
        border-radius: 2px;
        border: 1px solid #d4d8f7;
    }

    .cat-badge.general   { background: #eef6ff; color: #1d6fcc; border-color: #c5daf8; }
    .cat-badge.technical { background: #fff4e6; color: #b45309; border-color: #f8d9a8; }
    .cat-badge.account   { background: #f0fdf4; color: #166534; border-color: #bbf7d0; }

    /* ── Date ── */
    .date-cell {
        font-size: 0.825rem;
        color: var(--muted);
        font-weight: 300;
        white-space: nowrap;
    }

    /* ── Actions ── */
    .actions-cell {
        text-align: right;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        background: #fff;
        border: 1.5px solid var(--line);
        cursor: pointer;
        transition: all 0.18s;
        color: #555;
        text-decoration: none;
        margin-left: 6px;
        border-radius: 4px;
        font-size: 0.8rem;
    }

    .action-btn i {
        font-size: 0.8rem !important;
        pointer-events: none;
    }

    .action-btn.edit   { color: #d97706; border-color: #fcd34d; background: #fffbeb; }
    .action-btn.delete { color: #e84b2a; border-color: #fca5a5; background: #fff1f0; }

    .action-btn.edit:hover   { background: #f59e0b; border-color: #f59e0b; color: #fff; }
    .action-btn.delete:hover { background: var(--accent); border-color: var(--accent); color: #fff; }

    .action-btn[type="submit"] {
        background: #fff1f0;
        border: 1.5px solid #fca5a5;
        color: #e84b2a;
        border-radius: 4px;
    }

    .action-btn[type="submit"]:hover {
        background: var(--accent);
        border-color: var(--accent);
        color: #fff;
    }

    /* ── Empty State ── */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
    }

    .empty-icon {
        width: 64px;
        height: 64px;
        margin: 0 auto 20px;
        background: var(--paper);
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1.5px solid var(--line);
    }

    .empty-icon i { font-size: 1.4rem; color: var(--muted); }

    .empty-state p {
        color: var(--muted);
        font-size: 0.9rem;
        font-weight: 300;
        margin: 0;
    }

    /* ── Row entrance animation ── */
    @keyframes rowIn {
        from { opacity: 0; transform: translateY(10px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .articles-table tbody tr {
        animation: rowIn 0.35s ease both;
    }

    .articles-table tbody tr:nth-child(1) { animation-delay: 0.05s; }
    .articles-table tbody tr:nth-child(2) { animation-delay: 0.10s; }
    .articles-table tbody tr:nth-child(3) { animation-delay: 0.15s; }
    .articles-table tbody tr:nth-child(4) { animation-delay: 0.20s; }
    .articles-table tbody tr:nth-child(5) { animation-delay: 0.25s; }
</style>

<div class="articles-wrap">

    {{-- ── Header ── --}}
    <div class="articles-header">
        <div>
            <h2 class="headline">Arti<span>cles</span></h2>
            <p class="sub">Manage your blog posts and content</p>
        </div>
        <a href="{{ route('admin.articles.create') }}" class="btn-new">
            <i class="fas fa-plus"></i> New Article
        </a>
    </div>

    {{-- ── Success Alert ── --}}
    @if(session('success'))
        <div class="alert-success-custom">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- ── Table Card ── --}}
    <div class="table-card">
        <table class="articles-table table mb-0">
            <thead>
                <tr>
                    <th>Article Info</th>
                    <th>Category</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($articles as $article)
                    <tr>
                        {{-- Article Info --}}
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="article-avatar">
                                    {{ strtoupper(substr($article->title, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="article-title">{{ $article->title }}</div>
                                    <div class="article-id">#{{ $article->id }}</div>
                                </div>
                            </div>
                        </td>

                        {{-- Category --}}
                        <td>
                            @php
                                $cat = strtolower($article->category->name ?? '');
                                $cls = in_array($cat, ['general','technical','account']) ? $cat : '';
                            @endphp
                            <span class="cat-badge {{ $cls }}">
                                {{ $article->category->name ?? 'Uncategorized' }}
                            </span>
                        </td>

                        {{-- Created --}}
                        <td class="date-cell">
                            {{ $article->created_at->format('M d, Y') }}
                        </td>

                        {{-- Actions --}}
                        <td class="actions-cell">
                            <a href="{{ route('admin.articles.edit', $article->id) }}"
                               class="action-btn edit" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                </svg>
                            </a>

                            <form action="{{ route('admin.articles.destroy', $article->id) }}"
                                  method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="action-btn delete"
                                        onclick="return confirm('Delete this article?')"
                                        title="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6"/>
                                        <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                        <path d="M10 11v6M14 11v6"/>
                                        <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="4">
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <p>No articles found in the database.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection