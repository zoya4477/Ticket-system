@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
:root {
    --bg:      #f0f4f8;
    --surface: #ffffff;
    --surface2:#f8fafc;
    --accent:  #3b6ff0;
    --accent2: #7c5cf6;
    --success: #0dab76;
    --text:    #1a202c;
    --muted:   #718096;
    --border:  rgba(0,0,0,0.08);
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body {
    background: var(--bg);
    font-family: 'DM Sans', sans-serif;
    color: var(--text);
    min-height: 100vh;
}

body::before {
    content: '';
    position: fixed; inset: 0;
    background-image: radial-gradient(rgba(59,111,240,0.07) 1px, transparent 1px);
    background-size: 28px 28px;
    pointer-events: none; z-index: 0;
}

/* ── Hero ── */
.kb-hero {
    position: relative; z-index: 1;
    padding: 80px 24px 100px;
    text-align: center;
    background: linear-gradient(160deg,
        rgba(59,111,240,0.06) 0%,
        rgba(124,92,246,0.04) 50%,
        transparent 100%);
    border-radius: 0 0 40px 40px;
    margin-bottom: 0;
}

.hero-badge {
    display: inline-flex; align-items: center; gap: 7px;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 50px;
    padding: 6px 16px;
    font-family: 'Syne', sans-serif;
    font-size: 0.72rem; font-weight: 700;
    letter-spacing: 0.1em; text-transform: uppercase;
    color: var(--accent);
    box-shadow: 0 2px 12px rgba(59,111,240,0.10);
    margin-bottom: 20px;
}

.hero-badge span {
    width: 7px; height: 7px; border-radius: 50%;
    background: var(--accent);
    animation: blink 1.8s ease infinite;
}

@keyframes blink {
    0%,100%{opacity:1;} 50%{opacity:0.3;}
}

.hero-title {
    font-family: 'Syne', sans-serif;
    font-size: clamp(2rem, 5vw, 3rem);
    font-weight: 800;
    letter-spacing: -1px;
    line-height: 1.15;
    margin-bottom: 14px;
    color: var(--text);
}

.hero-title .highlight {
    background: linear-gradient(135deg, var(--accent), var(--accent2));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-sub {
    font-size: 1rem; color: var(--muted);
    max-width: 480px; margin: 0 auto 36px;
}

/* ── Search ── */
.search-form { max-width: 640px; margin: 0 auto; }

.search-pill {
    background: var(--surface);
    border: 1.5px solid var(--border);
    border-radius: 18px;
    padding: 8px 8px 8px 20px;
    display: flex; align-items: center; gap: 12px;
    box-shadow: 0 8px 32px rgba(59,111,240,0.10);
    transition: border-color 0.25s, box-shadow 0.25s, transform 0.25s;
}

.search-pill:focus-within {
    border-color: var(--accent);
    box-shadow: 0 12px 40px rgba(59,111,240,0.18);
    transform: translateY(-2px);
}

.search-pill i { color: var(--muted); font-size: 1rem; flex-shrink: 0; }

.search-pill input {
    flex: 1; border: none; outline: none;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.95rem; color: var(--text);
    background: transparent;
}

.search-pill input::placeholder { color: #b0b8c7; }

.btn-search {
    background: linear-gradient(135deg, var(--accent), var(--accent2));
    border: none; border-radius: 12px;
    color: #fff; font-family: 'Syne', sans-serif;
    font-size: 0.8rem; font-weight: 700;
    letter-spacing: 0.05em;
    padding: 11px 22px; cursor: pointer;
    transition: opacity 0.2s, transform 0.15s;
    box-shadow: 0 4px 14px rgba(59,111,240,0.25);
    white-space: nowrap;
}

.btn-search:hover { opacity: 0.88; transform: translateY(-1px); }

/* ── Search result banner ── */
.search-result-bar {
    display: flex; align-items: center;
    justify-content: space-between; flex-wrap: wrap;
    gap: 10px;
    background: rgba(59,111,240,0.06);
    border: 1px solid rgba(59,111,240,0.15);
    border-radius: 12px;
    padding: 11px 18px;
    margin-bottom: 24px;
    font-size: 0.85rem; color: var(--text);
}

.search-result-bar strong { color: var(--accent); }

.search-clear {
    font-size: 0.78rem; color: var(--muted);
    text-decoration: none;
    display: flex; align-items: center; gap: 5px;
    transition: color 0.2s;
}
.search-clear:hover { color: var(--accent); }

/* ── Main layout ── */
.kb-body {
    position: relative; z-index: 1;
    max-width: 1200px; margin: 0 auto;
    padding: 52px 24px 80px;
    display: grid;
    grid-template-columns: 1fr 320px;
    gap: 32px;
    align-items: start;
}

@media (max-width: 900px) {
    .kb-body { grid-template-columns: 1fr; }
}

/* ── Section header ── */
.section-bar {
    display: flex; align-items: center;
    justify-content: space-between; flex-wrap: wrap;
    gap: 14px; margin-bottom: 28px;
}

.section-title {
    font-family: 'Syne', sans-serif;
    font-size: 1.15rem; font-weight: 800; color: var(--text);
}

.result-count {
    font-size: 0.8rem; color: var(--muted);
    background: var(--surface2);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 3px 10px;
}

.btn-create {
    background: linear-gradient(135deg, var(--accent), var(--accent2));
    border: none; border-radius: 12px;
    color: #fff; font-family: 'Syne', sans-serif;
    font-size: 0.78rem; font-weight: 700;
    letter-spacing: 0.05em;
    padding: 10px 20px; cursor: pointer;
    display: flex; align-items: center; gap: 7px;
    text-decoration: none;
    box-shadow: 0 4px 16px rgba(59,111,240,0.25);
    transition: opacity 0.2s, transform 0.15s;
}

.btn-create:hover { opacity: 0.9; transform: translateY(-1px); color: #fff; }

/* ── Article cards grid ── */
.articles-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

@media (max-width: 600px) { .articles-grid { grid-template-columns: 1fr; } }

.art-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 26px;
    display: flex; flex-direction: column;
    gap: 14px;
    box-shadow: 0 4px 20px rgba(59,111,240,0.05);
    transition: transform 0.25s, box-shadow 0.25s, border-color 0.25s;
    animation: cardUp 0.4s ease both;
    position: relative;
}

.art-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 40px rgba(59,111,240,0.12);
    border-color: rgba(59,111,240,0.25);
}

.art-card:nth-child(1){animation-delay:0.05s;}
.art-card:nth-child(2){animation-delay:0.10s;}
.art-card:nth-child(3){animation-delay:0.15s;}
.art-card:nth-child(4){animation-delay:0.20s;}

@keyframes cardUp {
    from{opacity:0;transform:translateY(16px);}
    to{opacity:1;transform:translateY(0);}
}

.art-icon {
    width: 44px; height: 44px; border-radius: 13px;
    background: rgba(59,111,240,0.08);
    color: var(--accent);
    display: flex; align-items: center; justify-content: center;
    font-size: 1rem; flex-shrink: 0;
}

/* highlight matched text */
.art-title mark, .art-excerpt mark {
    background: rgba(59,111,240,0.12);
    color: var(--accent);
    border-radius: 3px;
    padding: 0 2px;
}

.art-title {
    font-family: 'Syne', sans-serif;
    font-size: 0.97rem; font-weight: 700;
    color: var(--text); text-decoration: none;
    line-height: 1.4;
    display: block;
}

.art-title::after {
    content: '';
    position: absolute; inset: 0;
    border-radius: 20px;
}

.art-excerpt {
    font-size: 0.82rem; color: var(--muted);
    line-height: 1.6; flex: 1;
}

.art-footer {
    display: flex; align-items: center;
    justify-content: space-between;
    padding-top: 14px;
    border-top: 1px solid var(--border);
}

.read-more {
    font-family: 'Syne', sans-serif;
    font-size: 0.75rem; font-weight: 700;
    color: var(--accent); text-decoration: none;
    display: flex; align-items: center; gap: 5px;
    letter-spacing: 0.04em;
}

/* ── Empty state ── */
.empty-kb {
    grid-column: 1 / -1;
    text-align: center; padding: 60px 20px;
    color: var(--muted);
}

.empty-kb i { font-size: 2.5rem; opacity: 0.35; margin-bottom: 14px; display: block; }
.empty-kb p { margin-bottom: 14px; }

.btn-clear {
    display: inline-flex; align-items: center; gap: 6px;
    background: var(--surface);
    border: 1px solid rgba(59,111,240,0.25);
    border-radius: 10px;
    color: var(--accent); font-family: 'Syne', sans-serif;
    font-size: 0.78rem; font-weight: 700;
    padding: 9px 18px; text-decoration: none;
    transition: background 0.2s, transform 0.15s;
}
.btn-clear:hover { background: rgba(59,111,240,0.05); transform: translateY(-1px); color: var(--accent); }

/* ── Pagination ── */
.pagination-wrap { margin-top: 32px; }

/* ── Sidebar ── */
.kb-sidebar { display: flex; flex-direction: column; gap: 20px; }

.sidebar-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 26px;
    box-shadow: 0 4px 20px rgba(59,111,240,0.05);
    animation: cardUp 0.5s 0.1s ease both;
}

.sidebar-title {
    font-family: 'Syne', sans-serif;
    font-size: 0.88rem; font-weight: 800;
    color: var(--text); margin-bottom: 6px;
}

.sidebar-sub { font-size: 0.80rem; color: var(--muted); margin-bottom: 20px; }

.sidebar-link {
    display: flex; align-items: center; gap: 14px;
    padding: 13px 14px;
    border: 1px solid var(--border);
    border-radius: 14px;
    text-decoration: none; color: var(--text);
    margin-bottom: 10px;
    transition: border-color 0.2s, box-shadow 0.2s, transform 0.2s;
    background: var(--surface2);
}

.sidebar-link:last-of-type { margin-bottom: 0; }

.sidebar-link:hover {
    border-color: var(--accent);
    box-shadow: 0 4px 16px rgba(59,111,240,0.10);
    transform: translateX(4px);
}

.sidebar-link-icon {
    width: 38px; height: 38px; border-radius: 11px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1rem; flex-shrink: 0;
}

.sidebar-link-icon.blue  { background: rgba(59,111,240,0.10); color: var(--accent); }
.sidebar-link-icon.green { background: rgba(13,171,118,0.10); color: var(--success); }

.sidebar-link-label { font-weight: 600; font-size: 0.85rem; color: var(--text); }
.sidebar-link-sub   { font-size: 0.75rem; color: var(--muted); }

/* ── Newsletter card ── */
.newsletter-card {
    background: linear-gradient(135deg, var(--accent), var(--accent2));
    border-radius: 20px;
    padding: 26px;
    color: #fff;
    animation: cardUp 0.5s 0.2s ease both;
}

.newsletter-card h6 {
    font-family: 'Syne', sans-serif;
    font-size: 0.95rem; font-weight: 800; margin-bottom: 8px;
}

.newsletter-card p {
    font-size: 0.78rem; opacity: 0.78; margin-bottom: 18px; line-height: 1.5;
}

.newsletter-input-wrap {
    display: flex; gap: 8px;
}

.newsletter-input {
    flex: 1; background: rgba(255,255,255,0.18);
    border: 1.5px solid rgba(255,255,255,0.3);
    border-radius: 10px;
    color: #fff; font-family: 'DM Sans', sans-serif;
    font-size: 0.82rem; padding: 9px 13px; outline: none;
    transition: border-color 0.2s;
}

.newsletter-input::placeholder { color: rgba(255,255,255,0.55); }
.newsletter-input:focus { border-color: rgba(255,255,255,0.7); }

.newsletter-btn {
    background: #fff; border: none; border-radius: 10px;
    color: var(--accent); font-family: 'Syne', sans-serif;
    font-weight: 700; font-size: 0.78rem;
    padding: 9px 16px; cursor: pointer;
    transition: opacity 0.2s;
    white-space: nowrap;
}

.newsletter-btn:hover { opacity: 0.88; }

/* ── FAB mobile ── */
.fab {
    position: fixed; bottom: 24px; right: 24px;
    width: 54px; height: 54px; border-radius: 50%;
    background: linear-gradient(135deg, var(--accent), var(--accent2));
    border: none; color: #fff; font-size: 1.3rem;
    display: none; align-items: center; justify-content: center;
    box-shadow: 0 8px 24px rgba(59,111,240,0.35);
    cursor: pointer; z-index: 999;
    transition: transform 0.2s;
}

.fab:hover { transform: scale(1.08); }

@media (max-width: 900px) { .fab { display: flex; } }
</style>

{{-- Hero --}}
<div class="kb-hero">
    <div class="hero-badge"><span></span> Support Center</div>

    @if($searchTerm)
        <h1 class="hero-title">Results for <span class="highlight">"{{ $searchTerm }}"</span></h1>
        <p class="hero-sub">{{ $articles->total() }} article{{ $articles->total() !== 1 ? 's' : '' }} found</p>
    @else
        <h1 class="hero-title">How can we <span class="highlight">help you</span> today?</h1>
        <p class="hero-sub">Search our knowledge base or browse help topics below</p>
    @endif

    {{-- Search Form --}}
    <form action="{{ route('kb.index') }}" method="GET" class="search-form">
        <div class="search-pill">
            <i class="fas fa-search"></i>
            <input
                type="text"
                name="search"
                value="{{ $searchTerm ?? '' }}"
                placeholder="Describe your issue or ask a question..."
                autocomplete="off"
            >
            @if($searchTerm)
                {{-- X button to clear --}}
                <a href="{{ route('kb.index') }}" style="color:var(--muted);font-size:0.85rem;text-decoration:none;padding:4px 6px;flex-shrink:0;" title="Clear search">
                    <i class="fas fa-times"></i>
                </a>
            @endif
            <button type="submit" class="btn-search">
                <i class="fas fa-search" style="margin-right:5px;"></i> Search
            </button>
        </div>
    </form>
</div>

{{-- Body --}}
<div class="kb-body">

    {{-- Articles --}}
    <div>
        <div class="section-bar">
            <div style="display:flex;align-items:center;gap:10px;">
                <div class="section-title">
                    @if($searchTerm)
                        Search Results
                    @else
                        Popular Articles
                    @endif
                </div>
                @if($searchTerm)
                    <span class="result-count">{{ $articles->total() }} found</span>
                @endif
            </div>
            <a href="{{ route('kb.create') }}" class="btn-create">
                <i class="fas fa-plus"></i> Create Article
            </a>
        </div>

        {{-- Search result info bar --}}
        @if($searchTerm)
        <div class="search-result-bar">
            <span>Showing results for <strong>"{{ $searchTerm }}"</strong></span>
            <a href="{{ route('kb.index') }}" class="search-clear">
                <i class="fas fa-times-circle"></i> Clear search
            </a>
        </div>
        @endif

        <div class="articles-grid">
            @forelse($articles as $article)
            <div class="art-card">
                <div class="art-icon"><i class="fas fa-file-lines"></i></div>

                <a href="{{ route('kb.article', $article->id) }}" class="art-title">
                    @if($searchTerm)
                        {!! str_ireplace(
                            e($searchTerm),
                            '<mark>' . e($searchTerm) . '</mark>',
                            e($article->title)
                        ) !!}
                    @else
                        {{ $article->title }}
                    @endif
                </a>

                <p class="art-excerpt">
                    @if($searchTerm)
                        @php
                            $plain   = strip_tags($article->content);
                            $pos     = stripos($plain, $searchTerm);
                            $excerpt = $pos !== false
                                ? '...' . substr($plain, max(0, $pos - 40), 120) . '...'
                                : Str::limit($plain, 100);
                        @endphp
                        {!! str_ireplace(
                            e($searchTerm),
                            '<mark>' . e($searchTerm) . '</mark>',
                            e($excerpt)
                        ) !!}
                    @else
                        {{ Str::limit(strip_tags($article->content), 100) }}
                    @endif
                </p>

                <div class="art-footer">
                    <a href="{{ route('kb.article', $article->id) }}" class="read-more">
                        Read More <i class="fas fa-arrow-right fa-xs"></i>
                    </a>
                </div>
            </div>

            @empty
            <div class="empty-kb">
                @if($searchTerm)
                    <i class="fas fa-magnifying-glass"></i>
                    <p>No articles found for <strong>"{{ $searchTerm }}"</strong></p>
                    <a href="{{ route('kb.index') }}" class="btn-clear">
                        <i class="fas fa-arrow-left"></i> Back to all articles
                    </a>
                @else
                    <i class="fas fa-book-open"></i>
                    <p>No articles yet. Be the first to create one!</p>
                    <a href="{{ route('kb.create') }}" class="btn-clear">
                        <i class="fas fa-plus"></i> Create Article
                    </a>
                @endif
            </div>
            @endforelse
        </div>

        <div class="pagination-wrap">
            {{ $articles->links() }}
        </div>
    </div>

    {{-- Sidebar --}}
    <aside class="kb-sidebar">

        <div class="sidebar-card">
            <div class="sidebar-title">Community Support</div>
            <div class="sidebar-sub">Can't find what you're looking for? Reach out to our experts.</div>

            <a href="{{ route('kb.faq') }}" class="sidebar-link">
                <div class="sidebar-link-icon blue"><i class="fas fa-circle-question"></i></div>
                <div>
                    <div class="sidebar-link-label">Frequently Asked</div>
                    <div class="sidebar-link-sub">Common questions</div>
                </div>
            </a>

            <a href="{{ route('tickets.create') }}" class="sidebar-link">
                <div class="sidebar-link-icon green"><i class="fas fa-headset"></i></div>
                <div>
                    <div class="sidebar-link-label">Direct Help</div>
                    <div class="sidebar-link-sub">Open a support ticket</div>
                </div>
            </a>
        </div>

        <div class="newsletter-card">
            <h6>Get Tips & Updates</h6>
            <p>Stay updated with our latest documentation and feature releases.</p>
            <div class="newsletter-input-wrap">
                <input class="newsletter-input" type="email" placeholder="your@email.com">
                <button class="newsletter-btn">Join</button>
            </div>
        </div>

    </aside>
</div>

{{-- FAB mobile --}}
<button class="fab" onclick="window.location.href='{{ route('kb.create') }}'">
    <i class="fas fa-plus"></i>
</button>

@endsection