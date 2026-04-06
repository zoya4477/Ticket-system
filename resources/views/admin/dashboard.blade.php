@extends('layouts.admin')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

<style>
:root {
    --ink: #0f1117;
    --ink-soft: #374151;
    --ink-muted: #6b7280;
    --surface: #ffffff;
    --surface-2: #f9fafb;
    --surface-3: #f3f4f6;
    --border: rgba(0,0,0,0.07);
    --border-strong: rgba(0,0,0,0.12);
    --accent: #2563eb;
    --accent-soft: #eff6ff;
    --accent-glow: rgba(37,99,235,0.12);
    --success: #059669;
    --success-soft: #ecfdf5;
    --warning: #d97706;
    --warning-soft: #fffbeb;
    --danger: #dc2626;
    --danger-soft: #fef2f2;
    --neutral: #64748b;
    --neutral-soft: #f1f5f9;
    --radius-sm: 8px;
    --radius-md: 12px;
    --radius-lg: 18px;
    --radius-xl: 24px;
    --shadow-xs: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
    --shadow-sm: 0 4px 16px rgba(0,0,0,0.06);
    --shadow-md: 0 8px 30px rgba(0,0,0,0.08);
    --font: 'Sora', sans-serif;
    --mono: 'JetBrains Mono', monospace;
}

*, *::before, *::after { box-sizing: border-box; }

.dash-wrap {
    font-family: var(--font);
    background: var(--surface-2);
    min-height: 100vh;
    padding: 28px 24px 48px;
    color: var(--ink);
    animation: fadeIn 0.4s ease;
}

@keyframes fadeIn { from { opacity:0; transform:translateY(6px); } to { opacity:1; transform:translateY(0); } }

/* ── TOP BAR ── */
.topbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 14px;
    margin-bottom: 32px;
}

.topbar-brand h4 {
    font-size: 1.35rem;
    font-weight: 700;
    color: var(--ink);
    margin: 0 0 2px;
    letter-spacing: -0.02em;
}

.topbar-brand p {
    font-size: 0.78rem;
    color: var(--ink-muted);
    margin: 0;
    font-weight: 400;
}

.topbar-actions { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }

.btn-new {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: var(--ink);
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: var(--radius-md);
    font-family: var(--font);
    font-size: 0.82rem;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    transition: background 0.2s, transform 0.15s;
    white-space: nowrap;
}
.btn-new:hover { background: #1a1f2e; transform: translateY(-1px); color: #fff; text-decoration: none; }
.btn-new i { font-size: 0.85rem; }

.date-badge {
    font-size: 0.78rem;
    color: var(--ink-muted);
    background: var(--surface);
    border: 1px solid var(--border-strong);
    padding: 8px 14px;
    border-radius: var(--radius-md);
    font-weight: 500;
}

/* ── STAT CARDS ── */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 14px;
    margin-bottom: 24px;
}

@media (max-width: 900px) { .stats-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 480px) { .stats-grid { grid-template-columns: 1fr 1fr; gap: 10px; } }

.stat-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 20px 22px;
    display: flex;
    align-items: center;
    gap: 16px;
    transition: box-shadow 0.25s, transform 0.25s;
    position: relative;
    overflow: hidden;
}
.stat-card:hover { box-shadow: var(--shadow-md); transform: translateY(-2px); }
.stat-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    border-radius: var(--radius-lg) var(--radius-lg) 0 0;
}
.stat-card.c-blue::before { background: var(--accent); }
.stat-card.c-orange::before { background: var(--warning); }
.stat-card.c-green::before { background: var(--success); }
.stat-card.c-gray::before { background: var(--neutral); }

.stat-icon-wrap {
    width: 46px;
    height: 46px;
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    flex-shrink: 0;
}
.stat-card.c-blue .stat-icon-wrap { background: var(--accent-soft); color: var(--accent); }
.stat-card.c-orange .stat-icon-wrap { background: var(--warning-soft); color: var(--warning); }
.stat-card.c-green .stat-icon-wrap { background: var(--success-soft); color: var(--success); }
.stat-card.c-gray .stat-icon-wrap { background: var(--neutral-soft); color: var(--neutral); }

.stat-val {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--ink);
    line-height: 1;
    margin-bottom: 3px;
    letter-spacing: -0.03em;
}
.stat-label {
    font-size: 0.7rem;
    font-weight: 600;
    color: var(--ink-muted);
    text-transform: uppercase;
    letter-spacing: 0.06em;
}

/* ── CHART + RIGHT PANEL ROW ── */
.mid-grid {
    display: grid;
    grid-template-columns: 1fr 340px;
    gap: 14px;
    margin-bottom: 24px;
}
@media (max-width: 1100px) { .mid-grid { grid-template-columns: 1fr; } }

.card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    overflow: hidden;
}

.card-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 22px;
    border-bottom: 1px solid var(--border);
}
.card-title {
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--ink);
    margin: 0;
    letter-spacing: -0.01em;
}
.chip {
    font-size: 0.7rem;
    font-weight: 500;
    color: var(--ink-muted);
    background: var(--surface-3);
    padding: 4px 10px;
    border-radius: 50px;
}

.chart-wrap { padding: 20px 22px; height: 300px; position: relative; }

.right-col { display: flex; flex-direction: column; gap: 14px; }

/* Donut */
.donut-wrap { padding: 18px 22px 20px; }
.donut-inner { height: 190px; position: relative; }

/* Leaderboard */
.agent-list { padding: 8px 0; }
.agent-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 22px;
    transition: background 0.15s;
}
.agent-row:hover { background: var(--surface-2); }
.agent-info { display: flex; align-items: center; gap: 12px; }
.agent-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    font-weight: 700;
    color: #fff;
    flex-shrink: 0;
    font-family: var(--font);
}
.agent-name { font-size: 0.84rem; font-weight: 600; color: var(--ink); }
.agent-sub { font-size: 0.7rem; color: var(--ink-muted); margin-top: 1px; }
.ticket-count {
    font-size: 0.78rem;
    font-weight: 600;
    color: var(--ink-soft);
    background: var(--surface-3);
    border: 1px solid var(--border-strong);
    padding: 4px 10px;
    border-radius: 50px;
    font-family: var(--mono);
}

/* ── TABLE ── */
.table-header-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 14px;
    flex-wrap: wrap;
    gap: 8px;
}
.section-title {
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--ink);
    letter-spacing: -0.01em;
}
.view-all {
    font-size: 0.78rem;
    font-weight: 600;
    color: var(--accent);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    transition: gap 0.2s;
}
.view-all:hover { gap: 8px; text-decoration: none; color: var(--accent); }

.tickets-card { border-radius: var(--radius-lg); overflow: hidden; border: 1px solid var(--border); }

.tbl {
    width: 100%;
    border-collapse: collapse;
    font-family: var(--font);
}
.tbl thead tr {
    background: var(--surface-2);
    border-bottom: 1px solid var(--border-strong);
}
.tbl thead th {
    padding: 12px 16px;
    font-size: 0.67rem;
    font-weight: 700;
    color: var(--ink-muted);
    text-transform: uppercase;
    letter-spacing: 0.07em;
    white-space: nowrap;
    text-align: left;
}
.tbl tbody tr {
    border-bottom: 1px solid var(--border);
    background: var(--surface);
    transition: background 0.15s;
    cursor: pointer;
}
.tbl tbody tr:last-child { border-bottom: none; }
.tbl tbody tr:hover { background: var(--surface-2); }
.tbl td { padding: 14px 16px; vertical-align: middle; }

.ref-id {
    font-family: var(--mono);
    font-size: 0.78rem;
    font-weight: 500;
    color: var(--accent);
    white-space: nowrap;
}
.ticket-title-text {
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--ink);
    margin-bottom: 2px;
    white-space: nowrap;
    max-width: 240px;
    overflow: hidden;
    text-overflow: ellipsis;
}
.ticket-cat {
    font-size: 0.7rem;
    color: var(--ink-muted);
}
.user-cell { display: flex; align-items: center; gap: 8px; }
.u-avatar {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.7rem;
    font-weight: 700;
    color: #fff;
    flex-shrink: 0;
}
.u-name { font-size: 0.82rem; font-weight: 500; color: var(--ink); white-space: nowrap; }

/* Badges */
.badge-pill {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 50px;
    font-size: 0.68rem;
    font-weight: 700;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    white-space: nowrap;
}
.s-open { background: var(--danger-soft); color: var(--danger); }
.s-progress { background: var(--warning-soft); color: var(--warning); }
.s-resolved { background: var(--success-soft); color: var(--success); }
.s-closed { background: var(--neutral-soft); color: var(--neutral); }
.p-high { background: #fef2f2; color: #dc2626; }
.p-medium { background: #fffbeb; color: #d97706; }
.p-low { background: #eff6ff; color: #2563eb; }

.time-cell {
    font-size: 0.75rem;
    color: var(--ink-muted);
    white-space: nowrap;
    font-family: var(--mono);
}

.action-btns { display: flex; gap: 6px; justify-content: flex-end; }
.act-btn {
    width: 30px;
    height: 30px;
    border-radius: var(--radius-sm);
    border: 1px solid var(--border-strong);
    background: var(--surface);
    color: var(--ink-soft);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    text-decoration: none;
    transition: background 0.15s, color 0.15s, border-color 0.15s;
}
.act-btn:hover { background: var(--ink); color: #fff; border-color: var(--ink); }

.empty-state {
    text-align: center;
    padding: 48px 24px;
    color: var(--ink-muted);
    font-size: 0.85rem;
}

/* responsive table scroll */
.table-scroll { overflow-x: auto; }
@media (max-width: 700px) {
    .dash-wrap { padding: 16px 12px 40px; }
    .tbl thead th:nth-child(4),
    .tbl td:nth-child(4) { display: none; }
}
</style>

<div class="dash-wrap">

    {{-- TOP BAR --}}
   <header class="topbar">
       <section class="topbar-brand">
          <h4>Admin Dashboard</h4>
          <p>Support management &amp; system overview</p>
       </section>
       <nav class="topbar-actions">
           <span class="date-badge"><i class="fas fa-calendar-alt me-1"></i>{{ now()->format('d M Y') }}</span>
           <a href="{{ route('tickets.create') }}" class="btn-new">
              <i class="fas fa-plus"></i> New Ticket
           </a>
       </nav>
</header>

    {{-- STATS --}} 
    @php
        $stats = [
            ['label'=>'Open',        'val'=>$openTickets,       'icon'=>'fa-ticket-alt', 'cls'=>'c-blue'],
            ['label'=>'In Progress', 'val'=>$inProgressTickets, 'icon'=>'fa-spinner',    'cls'=>'c-orange'],
            ['label'=>'Resolved',    'val'=>$resolvedTickets,   'icon'=>'fa-check-double','cls'=>'c-green'],
            ['label'=>'Closed',      'val'=>$closedTickets,     'icon'=>'fa-archive',    'cls'=>'c-gray'],
        ];
    @endphp

    <div class="stats-grid">
        @foreach($stats as $s)
        <div class="stat-card {{ $s['cls'] }}">
            <div class="stat-icon-wrap"><i class="fas {{ $s['icon'] }}"></i></div>
            <div>
                <div class="stat-val">{{ $s['val'] }}</div>
                <div class="stat-label">{{ $s['label'] }}</div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- CHARTS ROW --}}
    <div class="mid-grid">

        {{-- Line Chart --}}
        <div class="card">
            <div class="card-head">
                <h6 class="card-title">Ticket Volume Trend</h6>
                <span class="chip">Last 10 Days</span>
            </div>
            <div class="chart-wrap">
                <canvas id="mainChart"></canvas>
            </div>
        </div>

        {{-- Right column --}}
        <div class="right-col">

            {{-- Donut --}}
            <div class="card">
                <div class="card-head">
                    <h6 class="card-title">Priority Distribution</h6>
                </div>
                <div class="donut-wrap">
                    <div class="donut-inner">
                        <canvas id="donutChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- Agents --}}
            <div class="card" style="flex:1;">
                <div class="card-head">
                    <h6 class="card-title">Top Agents</h6>
                    <span class="chip">This Month</span>
                </div>
                <div class="agent-list">
                    @forelse($topAgents as $agent)
                    <div class="agent-row">
                        <div class="agent-info">
                            <div class="agent-avatar" style="background: {{ $agent['color'] }}">
                                {{ strtoupper(substr($agent['name'],0,1)) }}
                            </div>
                            <div>
                                <div class="agent-name">{{ $agent['name'] }}</div>
                                <div class="agent-sub">Support Agent</div>
                            </div>
                        </div>
                        <span class="ticket-count">{{ $agent['tickets'] }}</span>
                    </div>
                    @empty
                    <div class="empty-state">No agents assigned yet.</div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

    {{-- RECENT TICKETS --}}
    <div class="table-header-row">
        <span class="section-title">Recent Inbound Tickets</span>
        <a href="{{ route('tickets.index') }}" class="view-all">View All <i class="fas fa-arrow-right"></i></a>
    </div>

    <div class="tickets-card">
        <div class="table-scroll">
            <table class="tbl">
                <thead>
                    <tr>
                        <th>Ref</th>
                        <th>Subject</th>
                        <th>User</th>
                        <th>Agent</th>
                        <th>Status</th>
                        <th>Priority</th>
                        <th>Submitted</th>
                        <th style="text-align:right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($latestTickets as $ticket)
                    @php
                        $st = $ticket->status;
                        $pr = strtolower($ticket->priority);
                        $stClass = $st == 'open' ? 's-open' : ($st == 'in_progress' ? 's-progress' : ($st == 'resolved' ? 's-resolved' : 's-closed'));
                        $prClass = $pr == 'high' ? 'p-high' : ($pr == 'medium' ? 'p-medium' : 'p-low');
                        $colors = ['#2563eb','#7c3aed','#059669','#d97706','#dc2626','#0891b2'];
                        $color  = $colors[$ticket->id % count($colors)];
                    @endphp
                    <tr onclick="window.location='{{ route('tickets.show', $ticket->id) }}'">
                        <td><span class="ref-id">#{{ $ticket->id }}</span></td>
                        <td>
                            <div class="ticket-title-text">{{ \Illuminate\Support\Str::limit($ticket->title, 48) }}</div>
                            <div class="ticket-cat">{{ $ticket->category->name ?? 'General' }}</div>
                        </td>
                        <td>
                            <div class="user-cell">
                                <div class="u-avatar" style="background: {{ $color }}">
                                    {{ strtoupper(substr($ticket->user->name ?? 'U', 0, 1)) }}
                                </div>
                                <span class="u-name">{{ $ticket->user->name ?? 'Guest' }}</span>
                            </div>
                        </td>
                        <td>
                            @if($ticket->agent)
                                <div class="user-cell">
                                    <div class="u-avatar" style="background:#6366f1">
                                        {{ strtoupper(substr($ticket->agent->name, 0, 1)) }}
                                    </div>
                                    <span class="u-name">{{ $ticket->agent->name }}</span>
                                </div>
                            @else
                                <span class="badge-pill s-closed">Unassigned</span>
                            @endif
                        </td>
                        <td><span class="badge-pill {{ $stClass }}">{{ ucfirst(str_replace('_',' ',$st)) }}</span></td>
                        <td><span class="badge-pill {{ $prClass }}">{{ ucfirst($pr) }}</span></td>
                        <td><span class="time-cell">{{ optional($ticket->created_at)->diffForHumans() }}</span></td>
                        <td>
                            <div class="action-btns" onclick="event.stopPropagation()">
                                <a href="{{ route('tickets.show', $ticket->id) }}" class="act-btn" title="View"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('tickets.edit', $ticket->id) }}" class="act-btn" title="Edit"><i class="fas fa-pen"></i></a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8"><div class="empty-state">No tickets found.</div></td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
(function(){
    const fontFamily = "'Sora', sans-serif";
    Chart.defaults.font.family = fontFamily;
    Chart.defaults.color = '#6b7280';

    /* Line Chart */
    new Chart(document.getElementById('mainChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: {!! json_encode(array_keys($ticketTrend)) !!},
            datasets: [
                {
                    label: 'Open',
                    data: {!! json_encode(array_values($trendsByStatus['open'])) !!},
                    borderColor: '#2563eb',
                    backgroundColor: 'rgba(37,99,235,0.06)',
                    borderWidth: 2.5,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#2563eb',
                    pointBorderWidth: 2,
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'In Progress',
                    data: {!! json_encode(array_values($trendsByStatus['in_progress'])) !!},
                    borderColor: '#d97706',
                    backgroundColor: 'rgba(217,119,6,0.04)',
                    borderWidth: 2.5,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#d97706',
                    pointBorderWidth: 2,
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Resolved',
                    data: {!! json_encode(array_values($trendsByStatus['resolved'])) !!},
                    borderColor: '#059669',
                    backgroundColor: 'rgba(5,150,105,0.04)',
                    borderWidth: 2.5,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#059669',
                    pointBorderWidth: 2,
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Closed',
                    data: {!! json_encode(array_values($trendsByStatus['closed'])) !!},
                    borderColor: '#94a3b8',
                    backgroundColor: 'rgba(148,163,184,0.04)',
                    borderWidth: 2.5,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#94a3b8',
                    pointBorderWidth: 2,
                    fill: true,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'circle',
                        padding: 20,
                        font: { size: 12, family: fontFamily, weight: '500' }
                    }
                },
                tooltip: {
                    backgroundColor: '#0f1117',
                    titleColor: '#f9fafb',
                    bodyColor: '#9ca3af',
                    padding: 12,
                    cornerRadius: 10,
                    callbacks: {
                        label: ctx => ' ' + ctx.dataset.label + ': ' + ctx.raw + ' tickets'
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1, precision: 0, font: { size: 11 } },
                    grid: { color: 'rgba(0,0,0,0.04)' }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 11 } }
                }
            }
        }
    });

    /* Donut Chart */
    new Chart(document.getElementById('donutChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: ['High', 'Medium', 'Low'],
            datasets: [{
                data: [{{ $highPriorityCount }}, {{ $mediumPriorityCount }}, {{ $lowPriorityCount }}],
                backgroundColor: ['#dc2626', '#d97706', '#2563eb'],
                borderWidth: 0,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '74%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'circle',
                        padding: 16,
                        font: { size: 11.5, family: fontFamily, weight: '500' }
                    }
                },
                tooltip: {
                    backgroundColor: '#0f1117',
                    titleColor: '#f9fafb',
                    bodyColor: '#9ca3af',
                    padding: 10,
                    cornerRadius: 10
                }
            }
        }
    });
})();
</script>

@endsection