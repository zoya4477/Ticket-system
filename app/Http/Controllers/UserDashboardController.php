<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Category;
use App\Models\InternalNote;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();

        // Summary counts (variable names simplified)
        $myTickets     = Ticket::where('user_id', $userId)->count();
        $openTickets   = Ticket::where('user_id', $userId)->where('status', 'open')->count();
        $closedTickets = Ticket::where('user_id', $userId)->where('status', 'closed')->count();
        $highPriority  = Ticket::where('user_id', $userId)
                                ->whereIn('priority', ['high', 'urgent'])->count();

        // Tickets query with optional filters
        $query = Ticket::where('user_id', $userId)->with('category');

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->priority) {
            $query->where('priority', $request->priority);
        }

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        $tickets = $query->orderBy('created_at', 'desc')->paginate(10);

        // Recent activity
        $recentNotes = InternalNote::whereHas('ticket', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->latest()->take(5)->get();

        // Categories for filters
        $categories = Category::all();

        return view('dashboard', compact(
            'myTickets',
            'openTickets',
            'closedTickets',
            'highPriority',
            'tickets',
            'recentNotes',
            'categories'
        ));
    }
}