<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Tickets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --bg:        #f0f4f8;
            --surface:   #ffffff;
            --surface2:  #f8fafc;
            --border:    rgba(0,0,0,0.08);
            --accent:    #3b6ff0;
            --accent2:   #7c5cf6;
            --danger:    #e53e5a;
            --success:   #0dab76;
            --warn:      #d97706;
            --text:      #1a202c;
            --muted:     #718096;
            --radius:    14px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            background: var(--bg);
            font-family: 'DM Sans', sans-serif;
            color: var(--text);
            min-height: 100vh;
            padding: 40px 20px 80px;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: radial-gradient(rgba(59,111,240,0.07) 1px, transparent 1px);
            background-size: 28px 28px;
            pointer-events: none;
            z-index: 0;
        }

        .wrapper {
            position: relative;
            z-index: 1;
            max-width: 1200px;
            margin: 0 auto;
        }

        .page-header {
            margin-bottom: 32px;
        }

        .page-title {
            font-family: 'Syne', sans-serif;
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            background: linear-gradient(135deg, #1a202c 30%, var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .page-subtitle {
            font-size: 0.85rem;
            color: var(--muted);
            margin-top: 4px;
        }

        .alert-custom {
            background: rgba(13,171,118,0.08);
            border: 1px solid rgba(13,171,118,0.25);
            border-radius: var(--radius);
            padding: 14px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.88rem;
            color: var(--success);
            margin-bottom: 24px;
            animation: slideIn 0.4s ease;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-8px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .card-custom {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 40px rgba(59,111,240,0.08), 0 2px 8px rgba(0,0,0,0.06);
        }

        .table-wrap { overflow-x: auto; }

        table { width: 100%; border-collapse: collapse; }

        thead tr {
            background: var(--surface2);
            border-bottom: 1px solid var(--border);
        }

        thead th {
            padding: 16px 20px;
            font-family: 'Syne', sans-serif;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--muted);
            white-space: nowrap;
        }

        thead th:first-child { padding-left: 28px; }
        thead th:last-child  { padding-right: 28px; }

        tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background 0.2s;
            animation: rowFade 0.4s ease both;
        }

        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: rgba(59,111,240,0.03); }

        tbody td {
            padding: 18px 20px;
            font-size: 0.88rem;
            vertical-align: middle;
        }

        tbody td:first-child { padding-left: 28px; }
        tbody td:last-child  { padding-right: 28px; }

        @keyframes rowFade {
            from { opacity: 0; transform: translateX(-10px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        tbody tr:nth-child(1) { animation-delay: 0.05s; }
        tbody tr:nth-child(2) { animation-delay: 0.10s; }
        tbody tr:nth-child(3) { animation-delay: 0.15s; }
        tbody tr:nth-child(4) { animation-delay: 0.20s; }
        tbody tr:nth-child(5) { animation-delay: 0.25s; }
        tbody tr:nth-child(6) { animation-delay: 0.30s; }
        tbody tr:nth-child(7) { animation-delay: 0.35s; }

        .id-cell {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 0.8rem;
            color: var(--muted);
        }

        .user-cell { display: flex; align-items: center; gap: 10px; }

        .avatar {
            width: 32px; height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            display: flex; align-items: center; justify-content: center;
            font-family: 'Syne', sans-serif;
            font-weight: 700; font-size: 0.7rem; color: #fff; flex-shrink: 0;
        }

        .user-name { font-weight: 500; }

        .title-cell { font-weight: 400; color: #2d3748; max-width: 320px; }

        .priority {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 4px 12px; border-radius: 50px;
            font-size: 0.75rem; font-weight: 600;
            letter-spacing: 0.04em; text-transform: capitalize;
        }

        .priority.high   { background: rgba(229,62,90,0.10);  color: var(--danger); border: 1px solid rgba(229,62,90,0.22); }
        .priority.medium { background: rgba(217,119,6,0.10);  color: var(--warn);   border: 1px solid rgba(217,119,6,0.22); }
        .priority.low    { background: rgba(59,111,240,0.10); color: var(--accent); border: 1px solid rgba(59,111,240,0.22); }

        .priority::before {
            content: ''; width: 6px; height: 6px;
            border-radius: 50%; background: currentColor;
        }

        .agent-badge {
            display: inline-flex; align-items: center; gap: 6px;
            background: rgba(13,171,118,0.08); border: 1px solid rgba(13,171,118,0.22);
            color: var(--success); padding: 5px 12px; border-radius: 50px;
            font-size: 0.78rem; font-weight: 600;
        }

        .unassigned-badge {
            display: inline-flex; align-items: center; gap: 6px;
            background: rgba(229,62,90,0.08); border: 1px solid rgba(229,62,90,0.22);
            color: var(--danger); padding: 5px 12px; border-radius: 50px;
            font-size: 0.78rem; font-weight: 600;
        }

        .select-agent {
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 10px;
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.83rem;
            padding: 8px 32px 8px 12px;
            width: 100%; min-width: 150px;
            cursor: pointer;
            transition: border-color 0.2s, box-shadow 0.2s;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23718096' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
        }

        .select-agent:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(59,111,240,0.12);
        }

        .btn-assign {
            background: var(--accent);
            border: none; border-radius: 10px;
            color: #fff; font-family: 'Syne', sans-serif;
            font-weight: 700; font-size: 0.78rem;
            letter-spacing: 0.05em; padding: 9px 18px;
            cursor: pointer; white-space: nowrap;
            transition: background 0.2s, transform 0.1s, box-shadow 0.2s;
            box-shadow: 0 4px 14px rgba(59,111,240,0.25);
        }

        .btn-assign:hover {
            background: #2a5de0;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(59,111,240,0.35);
        }

        .btn-assign:active { transform: translateY(0); }

        .card-footer-custom {
            background: var(--surface2);
            border-top: 1px solid var(--border);
            padding: 14px 28px;
            display: flex; align-items: center; gap: 8px;
            font-size: 0.78rem; color: var(--muted);
        }

        @media (max-width: 768px) {
            .page-title { font-size: 1.5rem; }
            tbody td, thead th { padding: 14px 12px; font-size: 0.82rem; }
            tbody td:first-child, thead th:first-child { padding-left: 16px; }
            tbody td:last-child,  thead th:last-child  { padding-right: 16px; }
        }
    </style>
</head>
<body>

<div class="wrapper">

    {{-- Header --}}
    <div class="page-header">
        <div class="page-title">Assign Tickets</div>
        <div class="page-subtitle">Manage and reassign support tickets to agents</div>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
    <div class="alert-custom">
        <i class="bi bi-check-circle-fill"></i>
        {{ session('success') }}
    </div>
    @endif

    {{-- Table Card --}}
    <div class="card-custom">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Title</th>
                        <th>Priority</th>
                        <th>Current Agent</th>
                        <th>Assign Agent</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                    <tr>
                        <form action="{{ route('admin.tickets.assign.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                            <td class="id-cell">{{ $ticket->id }}</td>

                            <td>
                                <div class="user-cell">
                                    <div class="avatar">
                                        {{ strtoupper(substr($ticket->user->name ?? 'U', 0, 1)) }}
                                    </div>
                                    <span class="user-name">{{ $ticket->user->name ?? 'User' }}</span>
                                </div>
                            </td>

                            <td class="title-cell">{{ $ticket->title }}</td>

                            <td>
                                <span class="priority {{ $ticket->priority }}">
                                    {{ ucfirst($ticket->priority) }}
                                </span>
                            </td>

                            <td>
                                @if($ticket->agent)
                                    <span class="agent-badge">
                                        <i class="bi bi-person-check-fill"></i>
                                        {{ $ticket->agent->name }}
                                    </span>
                                @else
                                    <span class="unassigned-badge">
                                        <i class="bi bi-person-dash-fill"></i>
                                        Not Assigned
                                    </span>
                                @endif
                            </td>

                            <td>
                                <select name="agent_id" class="select-agent">
                                    <option value="">Select Agent</option>
                                    @foreach($agents as $agent)
                                        <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <td>
                                <button type="submit" class="btn-assign">
                                    <i class="bi bi-send-fill me-1"></i> Assign
                                </button>
                            </td>

                        </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer-custom">
            <i class="bi bi-info-circle"></i>
            Select an agent from the dropdown and click Assign to reassign a ticket.
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>