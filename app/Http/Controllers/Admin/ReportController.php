<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; // Assuming agents are Users
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf; // Required for PDF export

class ReportController extends Controller
{
    /**
     * Display the Performance Report View
     */
    public function index()
    {
        $reportData = $this->getPerformanceData();

        return view('admin.reports.index', compact('reportData'));
    }

    /**
     * Common method to fetch performance metrics
     * Calculates tickets handled and resolved per agent
     */
    private function getPerformanceData()
    {
        return DB::table('users')
            ->join('tickets', 'users.id', '=', 'tickets.agent_id')
            ->select(
                'users.id',
                'users.name',
                DB::raw('count(tickets.id) as tickets_handled'),
                DB::raw('sum(case when tickets.status = "resolved" then 1 else 0 end) as resolved_tickets')
            )
            ->groupBy('users.id', 'users.name')
            ->get();
    }

    /**
     * Export Report Data to CSV
     */
    public function exportCSV()
    {
        $fileName = 'performance_report_' . now()->format('Y-m-d') . '.csv';
        $data = $this->getPerformanceData();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = ['Agent ID', 'Agent Name', 'Tickets Handled', 'Resolved', 'Efficiency %'];

        $callback = function() use($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($data as $row) {
                $rate = $row->tickets_handled > 0 ? ($row->resolved_tickets / $row->tickets_handled) * 100 : 0;
                
                fputcsv($file, [
                    $row->id,
                    $row->name,
                    $row->tickets_handled,
                    $row->resolved_tickets,
                    number_format($rate, 2) . '%'
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Export Report View to PDF
     */
    public function exportPDF()
    {
        $reportData = $this->getPerformanceData();
        
        // Use the same blade view but DomPDF will render it
        $pdf = Pdf::loadView('admin.reports.pdf', compact('reportData'))
                  ->setPaper('a4', 'landscape');

        return $pdf->download('performance_report.pdf');
    }
}