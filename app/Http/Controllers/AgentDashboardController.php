<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class AgentDashboardController extends Controller
{
    public function index(Request $request)
    {
        $agentId = Auth::id();

        // 1. Efficiency Logic (Safe calculation)
        if ($request->has('efficiency')) {
            $resolvedCount = Ticket::where('agent_id', $agentId)->where('status', 'closed')->count();
            $totalCount    = Ticket::where('agent_id', $agentId)->count();
            $efficiencyRate = $totalCount > 0 ? round(($resolvedCount / $totalCount) * 100) : 0;

            return view('agent.efficiency', compact('resolvedCount', 'totalCount', 'efficiencyRate'));
        }

        // 2. Dashboard Stats 
        $totalTickets      = Ticket::where('agent_id', $agentId)->count();
        $openTickets       = Ticket::where('agent_id', $agentId)->where('status', 'open')->count();
        $inProgressTickets = Ticket::where('agent_id', $agentId)->where('status', 'in_progress')->count();
        $closedTickets     = Ticket::where('agent_id', $agentId)->where('status', 'closed')->count();
        $escalatedTickets  = Ticket::where('agent_id', $agentId)->where('status', 'escalated')->count();

        // 3. Ticket Query with Filters
        $query = Ticket::with(['category', 'user']) // 
                       ->where('agent_id', $agentId);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        $tickets = $query->latest()->paginate(10)->withQueryString();

        // 4. Activity Logs
        $recentNotes = Activity::with('user')
            ->whereHas('ticket', function($q) use ($agentId){
                $q->where('agent_id', $agentId);
            })
            ->latest()
            ->take(5)
            ->get();

        return view('agent.dashboard', compact(
            'totalTickets', 'openTickets', 'inProgressTickets', 
            'closedTickets', 'escalatedTickets', 'tickets', 'recentNotes'
        ));
    }

    /**
     * 
     */
    public function resolve(Ticket $ticket)
    {
        // Security Check:
        if ($ticket->agent_id !== Auth::id()) {
            return back()->with('error', 'Unauthorized action.');
        }

        // Status update
        $ticket->update(['status' => 'closed']);

    

        return back()->with('success', 'Ticket #'. $ticket->id .' has been resolved.');
    }
}