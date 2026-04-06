<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AgentReportExport implements FromCollection, WithHeadings, WithMapping
{
    protected $reportData;

    public function __construct($reportData)
    {
        $this->reportData = $reportData;
    }

    public function collection()
    {
        return $this->reportData;
    }

    public function map($row): array
    {
        $rate = $row->tickets_handled > 0 ? ($row->resolved_tickets / $row->tickets_handled) * 100 : 0;
        
        return [
            $row->name,
            $row->tickets_handled,
            $row->resolved_tickets,
            number_format($rate, 1) . '%'
        ];
    }

    public function headings(): array
    {
        return [
            'Agent Name',
            'Tickets Handled',
            'Resolved Tickets',
            'Success Rate'
        ];
    }
}