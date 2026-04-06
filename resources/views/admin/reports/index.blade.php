@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    :root {
        --bg:      #f0f4f8;
        --surface: #ffffff;
        --surface2:#f8fafc;
        --accent:  #3b6ff0;
        --accent2: #7c5cf6;
        --success: #0dab76;
        --warning: #d97706;
        --danger:  #e53e5a;
        --text:    #1a202c;
        --muted:   #718096;
        --border:  rgba(0,0,0,0.08);
    }

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

    .r-wrapper {
        position: relative; z-index: 1;
        max-width: 1200px;
        margin: 0 auto;
        padding: 44px 24px 80px;
    }

    /* ── Page Header ── */
    .r-header {
        display: flex; align-items: flex-start;
        justify-content: space-between;
        flex-wrap: wrap; gap: 16px;
        margin-bottom: 40px;
        animation: fadeDown 0.5s ease both;
    }

    @keyframes fadeDown {
        from { opacity: 0; transform: translateY(-12px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .r-title {
        font-family: 'Syne', sans-serif;
        font-size: 2rem; font-weight: 800;
        letter-spacing: -0.5px;
        background: linear-gradient(135deg, #1a202c 30%, var(--accent));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .r-subtitle {
        font-size: 0.85rem; color: var(--muted); margin-top: 4px;
    }

    .header-actions { display: flex; gap: 10px; flex-wrap: wrap; }

    .btn-outline-r {
        background: var(--surface);
        border: 1.5px solid var(--border);
        border-radius: 11px;
        color: var(--muted);
        font-family: 'Syne', sans-serif;
        font-size: 0.78rem; font-weight: 700;
        letter-spacing: 0.05em;
        padding: 10px 18px;
        cursor: pointer;
        display: flex; align-items: center; gap: 7px;
        text-decoration: none;
        transition: border-color 0.2s, color 0.2s, box-shadow 0.2s;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .btn-outline-r:hover {
        border-color: var(--accent); color: var(--accent);
        box-shadow: 0 4px 14px rgba(59,111,240,0.12);
    }

    .btn-export {
        background: linear-gradient(135deg, var(--accent), var(--accent2));
        border: none; border-radius: 11px;
        color: #fff;
        font-family: 'Syne', sans-serif;
        font-size: 0.78rem; font-weight: 700;
        letter-spacing: 0.05em;
        padding: 10px 20px;
        cursor: pointer;
        display: flex; align-items: center; gap: 7px;
        text-decoration: none;
        box-shadow: 0 4px 16px rgba(59,111,240,0.28);
        transition: opacity 0.2s, transform 0.15s;
        position: relative;
    }

    .btn-export:hover { opacity: 0.9; transform: translateY(-1px); color: #fff; }

    .dropdown-menu-r {
        position: absolute; top: calc(100% + 8px); right: 0;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 14px;
        box-shadow: 0 12px 32px rgba(0,0,0,0.10);
        padding: 8px;
        min-width: 180px;
        z-index: 999;
        display: none;
        animation: popIn 0.2s ease;
    }

    @keyframes popIn {
        from { opacity: 0; transform: translateY(-6px) scale(0.97); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }

    .dropdown-wrap:hover .dropdown-menu-r { display: block; }

    .dropdown-item-r {
        display: flex; align-items: center; gap: 10px;
        padding: 10px 14px;
        border-radius: 9px;
        font-size: 0.83rem; font-weight: 500;
        color: var(--text); text-decoration: none;
        transition: background 0.15s;
    }

    .dropdown-item-r:hover { background: var(--surface2); }

    /* ── Stats Cards ── */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 28px;
    }

    @media (max-width: 768px) { .stats-grid { grid-template-columns: 1fr; } }

    .stat-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 24px;
        display: flex; align-items: center; gap: 18px;
        box-shadow: 0 4px 20px rgba(59,111,240,0.06);
        transition: transform 0.2s, box-shadow 0.2s;
        animation: cardUp 0.5s ease both;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(59,111,240,0.12);
    }

    .stat-card:nth-child(1) { animation-delay: 0.05s; }
    .stat-card:nth-child(2) { animation-delay: 0.12s; }
    .stat-card:nth-child(3) { animation-delay: 0.19s; }

    @keyframes cardUp {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .stat-icon {
        width: 52px; height: 52px;
        border-radius: 16px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.2rem; flex-shrink: 0;
    }

    .stat-icon.blue   { background: rgba(59,111,240,0.10); color: var(--accent); }
    .stat-icon.yellow { background: rgba(217,119,6,0.10);  color: var(--warning); }
    .stat-icon.green  { background: rgba(13,171,118,0.10); color: var(--success); }

    .stat-label {
        font-family: 'Syne', sans-serif;
        font-size: 0.68rem; font-weight: 700;
        letter-spacing: 0.12em; text-transform: uppercase;
        color: var(--muted); margin-bottom: 4px;
    }

    .stat-value {
        font-family: 'Syne', sans-serif;
        font-size: 1.8rem; font-weight: 800;
        color: var(--text); line-height: 1;
    }

    /* ── Chart Card ── */
    .chart-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 28px;
        margin-bottom: 28px;
        box-shadow: 0 4px 20px rgba(59,111,240,0.06);
        animation: cardUp 0.5s 0.1s ease both;
    }

    .chart-header {
        display: flex; align-items: center;
        justify-content: space-between;
        margin-bottom: 24px; flex-wrap: wrap; gap: 10px;
    }

    .chart-title {
        font-family: 'Syne', sans-serif;
        font-size: 1rem; font-weight: 700; color: var(--text);
    }

    .live-badge {
        display: inline-flex; align-items: center; gap: 6px;
        background: rgba(13,171,118,0.10);
        border: 1px solid rgba(13,171,118,0.22);
        color: var(--success);
        padding: 5px 12px; border-radius: 50px;
        font-size: 0.72rem; font-weight: 700;
        letter-spacing: 0.05em; text-transform: uppercase;
    }

    .live-dot {
        width: 7px; height: 7px; border-radius: 50%;
        background: var(--success);
        animation: pulse 1.5s ease infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50%       { opacity: 0.5; transform: scale(0.7); }
    }

    /* ── Table Card ── */
    .table-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(59,111,240,0.06);
        animation: cardUp 0.5s 0.2s ease both;
    }

    .table-head-bar {
        background: var(--surface2);
        padding: 18px 28px;
        border-bottom: 1px solid var(--border);
        display: flex; align-items: center;
        justify-content: space-between; flex-wrap: wrap; gap: 10px;
    }

    .table-head-title {
        font-family: 'Syne', sans-serif;
        font-size: 0.95rem; font-weight: 700; color: var(--text);
    }

    table { width: 100%; border-collapse: collapse; }

    thead th {
        padding: 14px 24px;
        font-family: 'Syne', sans-serif;
        font-size: 0.68rem; font-weight: 700;
        letter-spacing: 0.12em; text-transform: uppercase;
        color: var(--muted); background: var(--surface2);
        border-bottom: 1px solid var(--border);
        white-space: nowrap;
    }

    tbody tr {
        border-bottom: 1px solid var(--border);
        transition: background 0.2s;
        animation: rowIn 0.4s ease both;
    }

    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: rgba(59,111,240,0.02); }

    @keyframes rowIn {
        from { opacity: 0; transform: translateX(-8px); }
        to   { opacity: 1; transform: translateX(0); }
    }

    tbody tr:nth-child(1)  { animation-delay: 0.05s; }
    tbody tr:nth-child(2)  { animation-delay: 0.10s; }
    tbody tr:nth-child(3)  { animation-delay: 0.15s; }
    tbody tr:nth-child(4)  { animation-delay: 0.20s; }
    tbody tr:nth-child(5)  { animation-delay: 0.25s; }

    tbody td {
        padding: 18px 24px;
        font-size: 0.87rem; vertical-align: middle;
    }

    /* Agent avatar */
    .agent-cell { display: flex; align-items: center; gap: 12px; }

    .agent-avatar {
        width: 38px; height: 38px; border-radius: 12px;
        background: linear-gradient(135deg, var(--accent), var(--accent2));
        display: flex; align-items: center; justify-content: center;
        font-family: 'Syne', sans-serif;
        font-weight: 800; font-size: 0.78rem; color: #fff; flex-shrink: 0;
    }

    .agent-name { font-weight: 600; color: var(--text); }
    .agent-id   { font-size: 0.75rem; color: var(--muted); }

    /* Progress bar */
    .progress-wrap { display: flex; align-items: center; gap: 12px; min-width: 180px; }

    .progress-track {
        flex: 1; height: 6px; border-radius: 99px;
        background: #edf2f7; overflow: hidden;
    }

    .progress-fill {
        height: 100%; border-radius: 99px;
        transition: width 0.8s ease;
    }

    .progress-fill.green  { background: linear-gradient(90deg, var(--success), #34d399); }
    .progress-fill.yellow { background: linear-gradient(90deg, var(--warning), #fbbf24); }
    .progress-fill.red    { background: linear-gradient(90deg, var(--danger),  #fb7185); }

    .progress-pct {
        font-family: 'Syne', sans-serif;
        font-size: 0.78rem; font-weight: 700; min-width: 36px;
    }

    .pct-green  { color: var(--success); }
    .pct-yellow { color: var(--warning); }
    .pct-red    { color: var(--danger); }

    /* Status badge */
    .status-badge {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 5px 13px; border-radius: 50px;
        font-family: 'Syne', sans-serif;
        font-size: 0.68rem; font-weight: 700; letter-spacing: 0.06em;
    }

    .status-badge.excellent { background: rgba(13,171,118,0.10); color: var(--success); border: 1px solid rgba(13,171,118,0.22); }
    .status-badge.average   { background: rgba(217,119,6,0.10);  color: var(--warning); border: 1px solid rgba(217,119,6,0.22); }
    .status-badge.critical  { background: rgba(229,62,90,0.10);  color: var(--danger);  border: 1px solid rgba(229,62,90,0.22); }

    .status-badge::before {
        content: ''; width: 5px; height: 5px;
        border-radius: 50%; background: currentColor;
    }

    /* Number cells */
    .num-cell { font-family: 'Syne', sans-serif; font-weight: 700; }

    /* Empty state */
    .empty-state {
        padding: 60px 20px; text-align: center; color: var(--muted);
    }

    .empty-state i { font-size: 2rem; margin-bottom: 12px; opacity: 0.4; }

    /* table-responsive scroll */
    .table-scroll { overflow-x: auto; }

    /* Footer bar */
    .table-footer {
        background: var(--surface2);
        border-top: 1px solid var(--border);
        padding: 13px 28px;
        display: flex; align-items: center; gap: 8px;
        font-size: 0.78rem; color: var(--muted);
    }

    @media print { .no-print { display: none !important; } }
</style>

<div class="r-wrapper">

    {{-- ── Header ── --}}
    <div class="r-header no-print">
        <div>
            <div class="r-title">Performance Report</div>
            <div class="r-subtitle">Analyzing agent efficiency and ticket throughput metrics</div>
        </div>

        <div class="header-actions">
            <button class="btn-outline-r" onclick="window.print()">
                <i class="fas fa-print"></i> Print
            </button>

            <div class="dropdown-wrap" style="position:relative;">
                <a href="#" class="btn-export">
                    <i class="fas fa-download"></i> Export Data
                    <i class="fas fa-chevron-down" style="font-size:0.65rem;"></i>
                </a>
                <div class="dropdown-menu-r">
                    <a href="{{ route('admin.reports.exportCSV') }}" class="dropdown-item-r">
                        <i class="fas fa-file-csv" style="color:var(--success);"></i> CSV Export
                    </a>
                    <a href="{{ route('admin.reports.exportPDF') }}" class="dropdown-item-r">
                        <i class="fas fa-file-pdf" style="color:var(--danger);"></i> PDF Document
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Stats ── --}}
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon blue"><i class="fas fa-users"></i></div>
            <div>
                <div class="stat-label">Active Agents</div>
                <div class="stat-value">{{ count($reportData) }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon yellow"><i class="fas fa-ticket-alt"></i></div>
            <div>
                <div class="stat-label">Tickets Handled</div>
                <div class="stat-value">{{ number_format($reportData->sum('tickets_handled')) }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green"><i class="fas fa-check-double"></i></div>
            <div>
                <div class="stat-label">Successfully Resolved</div>
                <div class="stat-value">{{ number_format($reportData->sum('resolved_tickets')) }}</div>
            </div>
        </div>
    </div>

    {{-- ── Chart ── --}}
    <div class="chart-card">
        <div class="chart-header">
            <div class="chart-title">Resolution Trend per Agent</div>
            <div class="live-badge">
                <div class="live-dot"></div> Live Performance
            </div>
        </div>
        <div style="height: 280px;">
            <canvas id="performanceChart"></canvas>
        </div>
    </div>

    {{-- ── Table ── --}}
    <div class="table-card">
        <div class="table-head-bar">
            <div class="table-head-title">Agent Performance Breakdown</div>
            <div style="font-size:0.78rem;color:var(--muted);">
                {{ count($reportData) }} agents total
            </div>
        </div>

        <div class="table-scroll">
            <table>
                <thead>
                    <tr>
                        <th>Agent Profile</th>
                        <th style="text-align:center;">Handled</th>
                        <th style="text-align:center;">Resolved</th>
                        <th>Efficiency Rate</th>
                        <th style="text-align:right;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reportData as $data)
                        @php
                            $rate = $data->tickets_handled > 0
                                ? ($data->resolved_tickets / $data->tickets_handled) * 100
                                : 0;
                            $color  = $rate > 75 ? 'green'  : ($rate > 40 ? 'yellow' : 'red');
                            $label  = $rate > 75 ? 'EXCELLENT' : ($rate > 40 ? 'AVERAGE' : 'CRITICAL');
                            $cls    = $rate > 75 ? 'excellent' : ($rate > 40 ? 'average' : 'critical');
                        @endphp
                        <tr>
                            <td>
                                <div class="agent-cell">
                                    <div class="agent-avatar">
                                        {{ strtoupper(substr($data->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div class="agent-name">{{ $data->name }}</div>
                                        <div class="agent-id">ID #{{ $data->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td style="text-align:center;" class="num-cell" style="color:var(--muted);">
                                {{ $data->tickets_handled }}
                            </td>
                            <td style="text-align:center;" class="num-cell">
                                {{ $data->resolved_tickets }}
                            </td>
                            <td>
                                <div class="progress-wrap">
                                    <div class="progress-track">
                                        <div class="progress-fill {{ $color }}" style="width: {{ $rate }}%;"></div>
                                    </div>
                                    <span class="progress-pct pct-{{ $color }}">{{ number_format($rate, 0) }}%</span>
                                </div>
                            </td>
                            <td style="text-align:right;">
                                <span class="status-badge {{ $cls }}">{{ $label }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <div><i class="fas fa-chart-bar"></i></div>
                                    No agent data found for this period.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="table-footer">
            <i class="fas fa-info-circle"></i>
            Efficiency rate = resolved tickets ÷ total handled tickets × 100
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('performanceChart').getContext('2d');

    const gradBlue = ctx.createLinearGradient(0, 0, 0, 280);
    gradBlue.addColorStop(0, 'rgba(59,111,240,0.25)');
    gradBlue.addColorStop(1, 'rgba(59,111,240,0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($reportData->pluck('name')) !!},
            datasets: [{
                label: 'Resolved Tickets',
                data: {!! json_encode($reportData->pluck('resolved_tickets')) !!},
                borderColor: '#3b6ff0',
                borderWidth: 2.5,
                backgroundColor: gradBlue,
                fill: true,
                tension: 0.45,
                pointRadius: 5,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#3b6ff0',
                pointBorderWidth: 2,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1a202c',
                    padding: 12,
                    titleFont: { size: 13, family: 'Syne, sans-serif', weight: '700' },
                    bodyFont:  { size: 12, family: 'DM Sans, sans-serif' },
                    cornerRadius: 10,
                    displayColors: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { color: '#718096', font: { size: 11 }, padding: 8 },
                    grid: { color: '#f0f4f8', borderDash: [4, 4] }
                },
                x: {
                    ticks: { color: '#718096', font: { size: 11 }, padding: 8 },
                    grid: { display: false }
                }
            }
        }
    });
});
</script>

@endsection