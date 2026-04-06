@extends('layouts.user')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:wght@300;400;500&display=swap');

:root {
    --bg: #f0f4fb;
    --surface: #ffffff;
    --surface-2: #f5f7ff;
    --border: rgba(79, 126, 255, 0.12);
    --accent: #4f7eff;
    --accent-soft: rgba(79, 126, 255, 0.09);
    --accent-glow: rgba(79, 126, 255, 0.18);
    --text: #1a1f36;
    --muted: #8a94a6;
    --green: #16a34a;
    --yellow: #d97706;
    --red: #dc2626;
    --green-soft: rgba(22,163,74,0.09);
    --yellow-soft: rgba(217,119,6,0.09);
    --red-soft: rgba(220,38,38,0.09);
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body, .dashboard-wrap {
    background: var(--bg);
    font-family: 'DM Sans', sans-serif;
    color: var(--text);
    min-height: 100vh;
}

.dashboard-wrap {
    padding: 1.5rem 1rem;
    max-width: 1400px;
    margin: 0 auto;
    width: 100%;
}

/* ══════════════════════════════
   HEADER
══════════════════════════════ */
.dash-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 1.25rem 1.5rem;
    margin-bottom: 1.5rem;
    position: relative;
    overflow: hidden;
    box-shadow: 0 2px 16px rgba(79,126,255,0.07);
}

.dash-header::before {
    content: '';
    position: absolute;
    top: -60px; left: -60px;
    width: 200px; height: 200px;
    background: radial-gradient(circle, var(--accent-glow) 0%, transparent 70%);
    pointer-events: none;
}

.dash-header h2 {
    font-family: 'Syne', sans-serif;
    font-size: clamp(1.1rem, 3vw, 1.55rem);
    font-weight: 700;
    color: var(--text);
    letter-spacing: -0.3px;
}

.dash-header p {
    font-size: clamp(0.75rem, 2vw, 0.85rem);
    color: var(--muted);
    margin-top: 4px;
}

.header-right {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: var(--surface-2);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 0.5rem 1rem;
    white-space: nowrap;
    flex-shrink: 0;
}

.header-right .date-str {
    font-size: clamp(0.72rem, 2vw, 0.85rem);
    font-weight: 500;
    color: var(--muted);
}

.header-right .divider { color: var(--muted); opacity: 0.4; }

.header-right #liveClock {
    font-family: 'Syne', sans-serif;
    font-size: clamp(0.82rem, 2vw, 1rem);
    font-weight: 700;
    color: var(--accent);
    letter-spacing: 1px;
}

/* ══════════════════════════════
   STATS GRID
══════════════════════════════ */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.stat-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 18px;
    padding: 1.2rem 1.4rem;
    display: flex;
    align-items: center;
    gap: 0.9rem;
    transition: border-color 0.2s, transform 0.2s, box-shadow 0.2s;
    cursor: default;
    box-shadow: 0 2px 12px rgba(79,126,255,0.06);
    min-width: 0;
}

.stat-card:hover {
    border-color: var(--accent);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(79,126,255,0.12);
}

.stat-icon {
    width: 46px; height: 46px;
    border-radius: 13px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.2rem;
    flex-shrink: 0;
}

.stat-icon.blue   { background: var(--accent-soft); color: var(--accent); }
.stat-icon.green  { background: var(--green-soft);  color: var(--green); }
.stat-icon.red    { background: var(--red-soft);    color: var(--red); }
.stat-icon.yellow { background: var(--yellow-soft); color: var(--yellow); }

.stat-info { min-width: 0; }

.stat-info .stat-label {
    font-size: 0.7rem;
    color: var(--muted);
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 3px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.stat-info .stat-value {
    font-family: 'Syne', sans-serif;
    font-size: clamp(1.4rem, 3vw, 1.9rem);
    font-weight: 800;
    line-height: 1;
    color: var(--text);
}

/* ══════════════════════════════
   MAIN GRID
══════════════════════════════ */
.main-grid {
    display: grid;
    grid-template-columns: 1fr 270px;
    gap: 1.25rem;
    align-items: start;
}

/* ══════════════════════════════
   TABLE CARD
══════════════════════════════ */
.table-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 2px 16px rgba(79,126,255,0.07);
    min-width: 0;
}

.table-card-header {
    padding: 1.2rem 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 0.75rem;
    border-bottom: 1px solid var(--border);
    flex-wrap: wrap;
}

.table-card-header h5 {
    font-family: 'Syne', sans-serif;
    font-weight: 700;
    font-size: clamp(0.88rem, 2vw, 1rem);
    color: var(--text);
}

.table-card-header .badge-count {
    background: var(--accent-soft);
    color: var(--accent);
    font-size: 0.72rem;
    font-weight: 600;
    padding: 3px 10px;
    border-radius: 20px;
    font-family: 'Syne', sans-serif;
    white-space: nowrap;
}

.table-scroll-wrap {
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

.dash-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 480px;
}

.dash-table thead th {
    padding: 0.8rem 1.2rem;
    font-size: 0.68rem;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: var(--muted);
    font-weight: 600;
    background: #f8faff;
    white-space: nowrap;
}

.dash-table tbody tr {
    border-top: 1px solid var(--border);
    transition: background 0.15s;
}

.dash-table tbody tr:hover {
    background: rgba(79, 126, 255, 0.03);
}

.dash-table td {
    padding: 0.9rem 1.2rem;
    font-size: 0.85rem;
    vertical-align: middle;
}

.ticket-id-badge {
    font-family: 'Syne', sans-serif;
    font-size: 0.78rem;
    font-weight: 700;
    color: var(--accent);
    background: var(--accent-soft);
    padding: 3px 9px;
    border-radius: 8px;
    letter-spacing: 0.5px;
    white-space: nowrap;
}

.ticket-title-text {
    color: var(--text);
    font-weight: 500;
    display: block;
    max-width: 220px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.ticket-category-text {
    color: var(--muted);
    font-size: 0.82rem;
    white-space: nowrap;
}

/* STATUS BADGES */
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 0.72rem;
    font-weight: 600;
    text-transform: capitalize;
    letter-spacing: 0.3px;
    white-space: nowrap;
}

.status-badge.resolved    { background: var(--green-soft);         color: var(--green); }
.status-badge.closed      { background: rgba(107,114,128,0.1);     color: #6b7280; }
.status-badge.in_progress { background: var(--yellow-soft);        color: var(--yellow); }
.status-badge.open        { background: var(--accent-soft);        color: var(--accent); }

.status-dot {
    width: 6px; height: 6px;
    border-radius: 50%;
    background: currentColor;
    flex-shrink: 0;
}

.btn-details {
    background: var(--surface-2);
    border: 1px solid var(--border);
    color: var(--text);
    padding: 5px 12px;
    border-radius: 9px;
    font-size: 0.78rem;
    font-weight: 500;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    transition: background 0.15s, border-color 0.15s, color 0.15s;
    white-space: nowrap;
}

.btn-details:hover {
    background: var(--accent);
    border-color: var(--accent);
    color: #fff;
}

.empty-row td {
    text-align: center;
    color: var(--muted);
    padding: 2.5rem;
    font-size: 0.88rem;
}

/* ══════════════════════════════
   SIDEBAR
══════════════════════════════ */
.sidebar-area {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.sidebar-assist {
    background: linear-gradient(145deg, #eef3ff 0%, #dce8ff 100%);
    border: 1px solid rgba(79,126,255,0.18);
    border-radius: 20px;
    padding: 1.6rem 1.4rem;
    text-align: center;
    position: relative;
    overflow: hidden;
    box-shadow: 0 2px 16px rgba(79,126,255,0.08);
}

.sidebar-assist::before {
    content: '';
    position: absolute;
    bottom: -50px; right: -50px;
    width: 160px; height: 160px;
    background: radial-gradient(circle, var(--accent-glow) 0%, transparent 70%);
    pointer-events: none;
}

.assist-icon-wrap {
    width: 56px; height: 56px;
    background: rgba(79,126,255,0.12);
    border: 1px solid rgba(79,126,255,0.25);
    border-radius: 16px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
    color: var(--accent);
    margin-bottom: 0.9rem;
}

.sidebar-assist h5 {
    font-family: 'Syne', sans-serif;
    font-size: 1rem;
    font-weight: 700;
    margin-bottom: 0.4rem;
    color: #1a1f36;
}

.sidebar-assist p {
    font-size: 0.8rem;
    color: #6b7a99;
    line-height: 1.55;
    margin-bottom: 1.2rem;
}

.btn-create-ticket {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    width: 100%;
    background: var(--accent);
    color: #fff;
    font-family: 'Syne', sans-serif;
    font-weight: 700;
    font-size: 0.86rem;
    padding: 0.7rem 1rem;
    border-radius: 12px;
    text-decoration: none;
    letter-spacing: 0.3px;
    transition: opacity 0.2s, transform 0.2s;
    box-shadow: 0 4px 18px var(--accent-glow);
    position: relative;
    z-index: 1;
}

.btn-create-ticket:hover {
    opacity: 0.9;
    transform: translateY(-1px);
    color: #fff;
}

/* ══════════════════════════════
   QUICK STATS
══════════════════════════════ */
.quick-stats {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 1.2rem 1.4rem;
    box-shadow: 0 2px 12px rgba(79,126,255,0.06);
}

.quick-stats h6 {
    font-family: 'Syne', sans-serif;
    font-size: 0.72rem;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: var(--muted);
    margin-bottom: 0.85rem;
}

.qs-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.55rem 0;
    border-bottom: 1px solid var(--border);
}
.qs-row:last-child { border-bottom: none; }

.qs-label { font-size: 0.8rem; color: var(--muted); }
.qs-val   { font-family: 'Syne', sans-serif; font-weight: 700; font-size: 0.9rem; color: var(--text); }

/* ══════════════════════════════
   ANIMATIONS
══════════════════════════════ */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(14px); }
    to   { opacity: 1; transform: translateY(0); }
}

.dash-header { animation: fadeUp 0.4s ease both; }
.stats-grid  { animation: fadeUp 0.4s 0.1s ease both; }
.main-grid   { animation: fadeUp 0.4s 0.2s ease both; }

/* ══════════════════════════════
   RESPONSIVE
══════════════════════════════ */

/* Large tablets ≤1100px */
@media (max-width: 1100px) {
    .main-grid { grid-template-columns: 1fr 240px; }
}

/* Tablets ≤900px — sidebar moves below table, goes 2-col */
@media (max-width: 900px) {
    .main-grid { grid-template-columns: 1fr; }
    .sidebar-area { flex-direction: row; }
    .sidebar-assist, .quick-stats { flex: 1; }
}

/* Small tablets ≤768px */
@media (max-width: 768px) {
    .dashboard-wrap { padding: 1rem 0.75rem; }
    .stats-grid { grid-template-columns: repeat(2, 1fr); gap: 0.75rem; }
    .dash-header, .table-card, .sidebar-assist, .quick-stats { border-radius: 16px; }
    .dash-header { padding: 1rem 1.2rem; }
}

/* Mobile ≤600px — sidebar goes back to column */
@media (max-width: 600px) {
    .sidebar-area { flex-direction: column; }
}

/* Mobile ≤576px */
@media (max-width: 576px) {
    .dashboard-wrap { padding: 0.75rem 0.6rem; }

    .dash-header {
        flex-direction: column;
        align-items: flex-start;
        padding: 1rem;
        border-radius: 14px;
        gap: 0.75rem;
    }

    .header-right {
        width: 100%;
        justify-content: space-between;
    }

    .stats-grid { gap: 0.6rem; margin-bottom: 1rem; }

    .stat-card { padding: 1rem; border-radius: 14px; gap: 0.7rem; }
    .stat-icon { width: 40px; height: 40px; border-radius: 11px; font-size: 1rem; }
    .stat-info .stat-value { font-size: 1.5rem; }

    .main-grid { gap: 0.85rem; }

    .table-card-header { padding: 1rem 1.1rem; }
    .dash-table thead th,
    .dash-table td { padding: 0.75rem 1rem; }

    .ticket-title-text { max-width: 130px; }
}

/* Extra small ≤400px */
@media (max-width: 400px) {
    .stat-card {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.4rem;
        padding: 0.85rem;
    }
    .stat-info .stat-value { font-size: 1.35rem; }
    .header-right { flex-wrap: wrap; gap: 0.3rem; }
}
</style>

<div class="dashboard-wrap">

    {{-- HEADER --}}
    <div class="dash-header">
        <div>
            <h2>Welcome Back, {{ explode(' ', Auth::user()->name)[0] }} 👋</h2>
            <p>Here's what's happening with your support requests today.</p>
        </div>
        <div class="header-right">
            <span class="date-str">{{ date('D, d M Y') }}</span>
            <span class="divider">|</span>
            <span id="liveClock"></span>
        </div>
    </div>

    {{-- STATS --}}
    @php
        $stats = [
            ['label' => 'Total Tickets', 'val' => $myTickets,    'icon' => 'bi-ticket-perforated',   'color' => 'blue'],
            ['label' => 'Open Now',      'val' => $openTickets,  'icon' => 'bi-lightning-charge',    'color' => 'green'],
            ['label' => 'High Priority', 'val' => $highPriority, 'icon' => 'bi-exclamation-octagon', 'color' => 'red'],
            ['label' => 'Resolved',      'val' => $closedTickets,'icon' => 'bi-check-all',            'color' => 'yellow'],
        ];
    @endphp
    <div class="stats-grid">
        @foreach($stats as $s)
        <div class="stat-card">
            <div class="stat-icon {{ $s['color'] }}">
                <i class="bi {{ $s['icon'] }}"></i>
            </div>
            <div class="stat-info">
                <div class="stat-label">{{ $s['label'] }}</div>
                <div class="stat-value">{{ $s['val'] }}</div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- MAIN GRID --}}
    <div class="main-grid">

        {{-- TABLE --}}
        <div class="table-card">
            <div class="table-card-header">
                <h5>Recent Activity</h5>
                <span class="badge-count">Last 5 tickets</span>
            </div>
            <div class="table-scroll-wrap">
                <table class="dash-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th style="text-align:right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($tickets->where('user_id', Auth::id())->take(5) as $ticket)
                        <tr class="ticket-row">
                            <td><span class="ticket-id-badge ticket-id">#{{ $ticket->id }}</span></td>
                            <td><span class="ticket-title-text ticket-title">{{ $ticket->title }}</span></td>
                            <td><span class="ticket-category-text ticket-category">{{ $ticket->category->name ?? 'General' }}</span></td>
                            <td>
                                @php $st = strtolower(str_replace(' ', '_', $ticket->status)); @endphp
                                <span class="status-badge {{ $st }} ticket-status">
                                    <span class="status-dot"></span>{{ $ticket->status }}
                                </span>
                            </td>
                            <td style="text-align:right">
                                <a href="{{ route('tickets.show', $ticket->id) }}" class="btn-details">
                                    <i class="bi bi-arrow-up-right"></i> Details
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr class="empty-row">
                            <td colspan="5">
                                <i class="bi bi-inbox" style="font-size:1.5rem;display:block;margin-bottom:8px;color:var(--muted)"></i>
                                No tickets found
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- SIDEBAR --}}
        <div class="sidebar-area">
            <div class="sidebar-assist">
                <div class="assist-icon-wrap">
                    <i class="bi bi-headset"></i>
                </div>
                <h5>Need Assistance?</h5>
                <p>Our agents are online and ready to resolve your issues quickly.</p>
                <a href="{{ route('tickets.create') }}" class="btn-create-ticket">
                    <i class="bi bi-plus-lg"></i> Create Ticket
                </a>
            </div>
        </div>

    </div>
</div>

{{-- CLOCK --}}
<script>
function updateClock() {
    document.getElementById('liveClock').textContent = new Date().toLocaleTimeString();
}
setInterval(updateClock, 1000);
updateClock();
</script>

{{-- SEARCH --}}
<script>
document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById('ticketSearchInput');
    if (!input) return;
    input.addEventListener('keyup', function () {
        const search = this.value.toLowerCase();
        let count = 0;
        document.querySelectorAll('.ticket-row').forEach(row => {
            const id       = row.querySelector('.ticket-id')?.innerText.toLowerCase()       || '';
            const title    = row.querySelector('.ticket-title')?.innerText.toLowerCase()    || '';
            const category = row.querySelector('.ticket-category')?.innerText.toLowerCase() || '';
            const status   = row.querySelector('.ticket-status')?.innerText.toLowerCase()   || '';
            const visible  = id.includes(search) || title.includes(search)
                          || category.includes(search) || status.includes(search);
            row.style.display = visible ? '' : 'none';
            if (visible) count++;
        });
        const resultBox = document.getElementById('searchResultCount');
        if (resultBox) {
            resultBox.innerText = count + " found";
            resultBox.classList.remove('d-none');
        }
    });
});
</script>

@endsection