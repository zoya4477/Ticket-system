@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
:root {
    --bg:      #f0f4f8;
    --surface: #ffffff;
    --surface2:#f8fafc;
    --accent:  #3b6ff0;
    --accent2: #7c5cf6;
    --success: #0dab76;
    --danger:  #e53e5a;
    --text:    #1a202c;
    --muted:   #718096;
    --border:  rgba(0,0,0,0.08);
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body {
    background: var(--bg);
    font-family: 'DM Sans', sans-serif;
    color: var(--text); min-height: 100vh;
}

/* Hidden Class for Show More/Less */
.faq-hidden { 
    display: none !important; 
}

body::before {
    content: '';
    position: fixed; inset: 0;
    background-image: radial-gradient(rgba(59,111,240,0.07) 1px, transparent 1px);
    background-size: 28px 28px;
    pointer-events: none; z-index: 0;
}

/* ── Hero ── */
.faq-hero {
    position: relative; z-index: 1;
    padding: 72px 24px 90px;
    text-align: center;
    background: linear-gradient(160deg,
        rgba(59,111,240,0.06) 0%,
        rgba(124,92,246,0.04) 50%,
        transparent 100%);
    border-radius: 0 0 40px 40px;
}

.hero-badge {
    display: inline-flex; align-items: center; gap: 7px;
    background: var(--surface); border: 1px solid var(--border);
    border-radius: 50px; padding: 6px 16px;
    font-family: 'Syne', sans-serif;
    font-size: 0.72rem; font-weight: 700;
    letter-spacing: 0.1em; text-transform: uppercase;
    color: var(--accent);
    box-shadow: 0 2px 12px rgba(59,111,240,0.10);
    margin-bottom: 20px;
}

.faq-title {
    font-family: 'Syne', sans-serif;
    font-size: clamp(1.8rem, 5vw, 2.6rem);
    font-weight: 800; letter-spacing: -0.8px; line-height: 1.15;
    margin-bottom: 12px; color: var(--text);
}

.faq-title .hl {
    background: linear-gradient(135deg, var(--accent), var(--accent2));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.faq-sub { font-size: 0.95rem; color: var(--muted); margin-bottom: 36px; }

/* ── Search ── */
.search-pill {
    max-width: 580px; margin: 0 auto;
    background: var(--surface);
    border: 1.5px solid var(--border);
    border-radius: 16px;
    padding: 10px 10px 10px 20px;
    display: flex; align-items: center; gap: 12px;
    box-shadow: 0 8px 32px rgba(59,111,240,0.10);
    transition: border-color 0.25s, box-shadow 0.25s, transform 0.25s;
}

.search-pill:focus-within {
    border-color: var(--accent);
    box-shadow: 0 12px 40px rgba(59,111,240,0.18);
    transform: translateY(-2px);
}

.search-pill i { color: var(--muted); flex-shrink: 0; }

.search-pill input {
    flex: 1; border: none; outline: none;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.93rem; color: var(--text);
    background: transparent;
}

/* ── Body ── */
.faq-body {
    position: relative; z-index: 1;
    max-width: 820px; margin: 0 auto;
    padding: 48px 24px 80px;
}

/* ── Accordion ── */
.faq-list { display: flex; flex-direction: column; gap: 12px; }

.faq-item {
    background: var(--surface);
    border: 1.5px solid var(--border);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 2px 12px rgba(59,111,240,0.04);
    transition: border-color 0.25s, box-shadow 0.25s;
}

.faq-item:hover {
    border-color: rgba(59,111,240,0.25);
}

.faq-item.active { border-color: var(--accent); }

.faq-question {
    width: 100%; display: flex; align-items: center;
    justify-content: space-between; gap: 14px;
    padding: 20px 22px;
    background: transparent; border: none;
    text-align: left; cursor: pointer;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.93rem; font-weight: 600;
    color: var(--text);
    transition: background 0.2s;
}

.faq-question:hover { background: var(--surface2); }
.faq-item.active .faq-question { background: rgba(59,111,240,0.04); color: var(--accent); }

.faq-q-left { display: flex; align-items: center; gap: 14px; }

.faq-num {
    width: 30px; height: 30px; border-radius: 9px;
    background: rgba(59,111,240,0.08);
    color: var(--accent);
    font-family: 'Syne', sans-serif;
    font-size: 0.72rem; font-weight: 800;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}

.faq-item.active .faq-num { background: var(--accent); color: #fff; }

.faq-chevron {
    width: 28px; height: 28px; border-radius: 8px;
    background: var(--surface2);
    display: flex; align-items: center; justify-content: center;
    color: var(--muted); font-size: 0.75rem;
    transition: all 0.3s;
}

.faq-item.active .faq-chevron {
    background: var(--accent); color: #fff;
    transform: rotate(180deg);
}

.faq-answer {
    max-height: 0; overflow: hidden;
    transition: max-height 0.4s cubic-bezier(0.4,0,0.2,1), padding 0.3s;
    padding: 0 22px;
}

.faq-answer.open {
    max-height: 1000px;
    padding: 0 22px 22px;
}

.faq-answer-inner {
    padding-top: 14px;
    border-top: 1px solid var(--border);
    font-size: 0.88rem; line-height: 1.75; color: var(--muted);
}

/* ── Load more ── */
.load-more-wrap { text-align: center; margin-top: 28px; }

.btn-load-more {
    background: var(--surface);
    border: 1.5px solid var(--border);
    border-radius: 12px;
    color: var(--accent);
    font-family: 'Syne', sans-serif;
    font-size: 0.78rem; font-weight: 700;
    padding: 11px 26px; cursor: pointer;
    box-shadow: 0 2px 12px rgba(59,111,240,0.08);
    transition: all 0.2s;
    display: inline-flex; align-items: center; gap: 7px;
}

.btn-load-more:hover {
    border-color: var(--accent);
    transform: translateY(-1px);
}

/* ── No results ── */
.no-results {
    display: none;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 48px 20px;
    text-align: center; color: var(--muted);
}

/* ── CTA ── */
.faq-cta {
    margin-top: 48px;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 24px;
    padding: 44px 32px;
    text-align: center;
}

.btn-cta {
    display: inline-flex; align-items: center; gap: 8px;
    background: linear-gradient(135deg, var(--accent), var(--accent2));
    border: none; border-radius: 12px;
    color: #fff; font-family: 'Syne', sans-serif;
    font-weight: 700; font-size: 0.85rem;
    padding: 13px 30px; text-decoration: none;
    transition: all 0.2s;
}
</style>

{{-- Hero --}}
<div class="faq-hero">
    <div class="hero-badge"><i class="fas fa-circle-question fa-xs"></i> Help Center</div>
    <h1 class="faq-title">Find your <span class="hl">answers</span> here</h1>
    <p class="faq-sub">Browse frequently asked questions or use search</p>

    <div class="search-pill">
        <i class="fas fa-search"></i>
        <input type="text" id="faqSearch" placeholder="Search questions...">
    </div>
</div>

{{-- FAQ Body --}}
<div class="faq-body">
    <div class="faq-list" id="faqList">
        @forelse($faqs as $index => $faq)
            {{-- Initial state: hide items beyond index 4 (show 5 total) --}}
            <div class="faq-item {{ $index >= 5 ? 'faq-hidden' : '' }}" 
                 data-text="{{ strtolower($faq->question . ' ' . $faq->answer) }}">
                <button class="faq-question" onclick="toggleFaq(this)">
                    <div class="faq-q-left">
                        <div class="faq-num">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
                        <span>{{ $faq->question }}</span>
                    </div>
                    <div class="faq-chevron"><i class="fas fa-chevron-down"></i></div>
                </button>
                <div class="faq-answer">
                    <div class="faq-answer-inner">{{ $faq->answer }}</div>
                </div>
            </div>
        @empty
            <div class="no-results" style="display:block;">
                <i class="fas fa-inbox fa-2x"></i>
                <h5>No questions yet</h5>
            </div>
        @endforelse
    </div>

    <div id="noResults" class="no-results">
        <i class="fas fa-magnifying-glass fa-2x"></i>
        <h5>No matches found</h5>
    </div>

    @if(count($faqs) > 5)
    <div class="load-more-wrap" id="loadMoreDiv">
        <button class="btn-load-more" id="btnLoadMore">
            <i class="fas fa-plus"></i> <span id="loadText">Show More Questions</span>
        </button>
    </div>
    @endif

    <div class="faq-cta">
        <h4>Still need help?</h4>
        <p>Our support team is happy to assist.</p>
        <a href="{{ route('tickets.create') }}" class="btn-cta">
            <i class="fas fa-headset"></i> Create a Ticket
        </a>
    </div>
</div>

<script>
    // Accordion Toggle Logic
    function toggleFaq(btn) {
        const item = btn.closest('.faq-item');
        const answer = item.querySelector('.faq-answer');
        const isOpen = item.classList.contains('active');

        // Close all other open items
        document.querySelectorAll('.faq-item.active').forEach(el => {
            if (el !== item) {
                el.classList.remove('active');
                el.querySelector('.faq-answer').classList.remove('open');
            }
        });

        // Toggle current item
        item.classList.toggle('active');
        answer.classList.toggle('open');
    }

    // Show More / Show Less Logic
    const btnLoadMore = document.getElementById('btnLoadMore');
    const loadText = document.getElementById('loadText');
    const loadMoreDiv = document.getElementById('loadMoreDiv');

    if (btnLoadMore) {
        btnLoadMore.addEventListener('click', function() {
            const isExpanded = this.classList.contains('expanded');
            const hiddenItems = document.querySelectorAll('.faq-item:nth-child(n+6)');
            const icon = this.querySelector('i');

            if (!isExpanded) {
                // Show All
                hiddenItems.forEach(el => el.classList.remove('faq-hidden'));
                loadText.innerText = "Show Less Questions";
                icon.className = "fas fa-minus";
                this.classList.add('expanded');
            } else {
                // Hide Extra
                hiddenItems.forEach(el => el.classList.add('faq-hidden'));
                loadText.innerText = "Show More Questions";
                icon.className = "fas fa-plus";
                this.classList.remove('expanded');
                // Optional: Scroll back to top
                document.getElementById('faqList').scrollIntoView({ behavior: 'smooth' });
            }
        });
    }

    // Live Search Logic
    const searchInput = document.getElementById('faqSearch');
    const noResults = document.getElementById('noResults');

    searchInput.addEventListener('input', function() {
        const term = this.value.toLowerCase().trim();
        const allItems = document.querySelectorAll('.faq-item');
        let hasResults = false;

        allItems.forEach((item, index) => {
            const text = item.dataset.text || '';
            const isMatch = text.includes(term);

            if (term.length > 0) {
                // While searching
                if (loadMoreDiv) loadMoreDiv.style.display = 'none';
                item.style.setProperty('display', isMatch ? 'block' : 'none', 'important');
                item.classList.remove('faq-hidden');
                if (isMatch) hasResults = true;
            } else {
                // Reset to default (first 5 or expanded state)
                if (loadMoreDiv) loadMoreDiv.style.display = 'block';
                item.style.display = ''; 
                
                const isExpanded = btnLoadMore && btnLoadMore.classList.contains('expanded');
                if (index >= 5 && !isExpanded) {
                    item.classList.add('faq-hidden');
                } else {
                    item.classList.remove('faq-hidden');
                }
                hasResults = true;
            }
        });

        noResults.style.display = (term.length > 0 && !hasResults) ? 'block' : 'none';
    });
</script>

@endsection