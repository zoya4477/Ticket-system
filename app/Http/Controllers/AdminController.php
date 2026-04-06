<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        /* ============================================================
            BASIC STATS
        ============================================================ */
        $openTickets       = Ticket::where('status', 'open')->count();
        $closedTickets     = Ticket::where('status', 'closed')->count();
        $inProgressTickets = Ticket::where('status', 'in_progress')->count();
        $resolvedTickets   = Ticket::where('status', 'resolved')->count();

        /* ============================================================
            PRIORITY COUNTS (DONUT)
        ============================================================ */
        $highPriorityCount   = Ticket::where('priority', 'high')->count();
        $mediumPriorityCount = Ticket::where('priority', 'medium')->count();
        $lowPriorityCount    = Ticket::where('priority', 'low')->count();

        /* ============================================================
            SLA COMPLIANCE
        ============================================================ */
        // $tickets = Ticket::all();

        // $slaBreached = 0;
        // $slaMet = 0;

        // foreach ($tickets as $ticket) {
        //     $created = Carbon::parse($ticket->created_at);
        //     $hours = $created->diffInHours(Carbon::now());

        //     if ($ticket->priority == 'high' && $hours > 4) {
        //         $slaBreached++;
        //     } elseif ($ticket->priority == 'medium' && $hours > 12) {
        //         $slaBreached++;
        //     } elseif ($ticket->priority == 'low' && $hours > 24) {
        //         $slaBreached++;
        //     } else {
        //         $slaMet++;
        //     }
        // }

        /* ============================================================
            HIGH PRIORITY ALERTS
        ============================================================ */
        $highPriorityIssues = Ticket::where('priority', 'high')
            ->whereIn('status', ['open', 'in_progress'])
            ->latest()
            ->take(5)
            ->get();

        /* ============================================================
            LATEST TICKETS
        ============================================================ */
        $latestTickets = Ticket::with(['user', 'agent', 'category'])
            ->latest()
            ->take(5)
            ->get();

        /* ============================================================
            TOP AGENTS
        ============================================================ */
        $topAgents = User::where('role_id', 2)
            ->withCount(['agentTickets as tickets_count'])
            ->orderBy('tickets_count', 'desc')
            ->take(5)
            ->get()
            ->map(function($agent, $index) {
                $colors = ['#6366f1', '#8b5cf6', '#ec4899', '#f59e0b', '#10b981'];
                return [
                    'name'    => $agent->name,
                    'tickets' => $agent->tickets_count,
                    'color'   => $colors[$index] ?? '#64748b'
                ];
            });

        /* ============================================================
            TREND DATA
        ============================================================ */
        $days = collect(range(0, 9))
            ->map(fn($i) => Carbon::now()->subDays(9 - $i)->format('Y-m-d'));

        $trends = Ticket::select(
                DB::raw('DATE(created_at) as date'),
                'status',
                DB::raw('COUNT(*) as count')
            )
            ->where('created_at', '>=', Carbon::now()->subDays(9)->startOfDay())
            ->groupBy('date', 'status')
            ->get();

        $statuses = ['open', 'in_progress', 'resolved', 'closed'];

        $trendsByStatus = [];
        foreach ($statuses as $status) {
            $trendsByStatus[$status] = $days->mapWithKeys(fn($d) => [$d => 0])->toArray();
        }

        foreach ($trends as $item) {
            if (isset($trendsByStatus[$item->status][$item->date])) {
                $trendsByStatus[$item->status][$item->date] = $item->count;
            }
        }

        $ticketTrend = [];
        foreach ($days as $day) {
            $ticketTrend[$day] = array_sum(array_map(fn($statusData) => $statusData[$day], $trendsByStatus));
        }

        return view('admin.dashboard', compact(
            'openTickets', 'closedTickets', 'inProgressTickets', 'resolvedTickets',
            'highPriorityCount', 'mediumPriorityCount', 'lowPriorityCount',
            // 'slaBraeched', 'slaMet',
            'highPriorityIssues',
            'latestTickets', 'topAgents',
            'ticketTrend', 'trendsByStatus'
        ));
    }
}