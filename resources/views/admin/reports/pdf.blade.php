<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Performance Report</title>
    <style>
        body { font-family: sans-serif; color: #333; font-size: 12px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #6366f1; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background-color: #f8fafc; color: #475569; padding: 12px; text-align: left; border: 1px solid #e2e8f0; text-transform: uppercase; }
        td { padding: 10px; border: 1px solid #e2e8f0; }
        .summary { margin-top: 30px; text-align: right; font-weight: bold; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 10px; color: #94a3b8; }
    </style>
</head>
<body>

<div class="header">
    <h2 style="margin:0; color:#1e293b;">Agent Performance Report</h2>
    <p style="margin:5px 0; color:#64748b;">Operational Metrics Summary</p>
</div>

<table>
    <thead>
        <tr>
            <th>Agent Name</th>
            <th style="text-align:center;">Handled</th>
            <th style="text-align:center;">Resolved</th>
            <th style="text-align:center;">Rate (%)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reportData as $data)
            @php
                $rate = $data->tickets_handled > 0 ? ($data->resolved_tickets / $data->tickets_handled) * 100 : 0;
            @endphp
            <tr>
                <td><strong>{{ $data->name }}</strong></td>
                <td style="text-align:center;">{{ $data->tickets_handled }}</td>
                <td style="text-align:center;">{{ $data->resolved_tickets }}</td>
                <td style="text-align:center;">{{ number_format($rate, 1) }}%</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="summary">
    Total Tickets: {{ $reportData->sum('tickets_handled') }} | 
    Avg Resolution: {{ number_format($reportData->sum('tickets_handled') ? ($reportData->sum('resolved_tickets') / $reportData->sum('tickets_handled')) * 100 : 0, 1) }}%
</div>

<div class="footer">
    Generated via Performance Pro on {{ date('d M, Y h:i A') }}
</div>

</body>
</html>