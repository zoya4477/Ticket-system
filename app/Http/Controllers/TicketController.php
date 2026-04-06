<?php
namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Category;
use App\Models\TicketHistory;
use App\Models\User;
use App\Models\Attachment;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TicketNotification;


class TicketController extends Controller
{
    // List tickets
    public function index(Request $request)
    {
        $user = Auth::user();
        $categories = Category::select('id', 'name')->get();
        
        // Base query with relations
        $query = Ticket::with(['category', 'user', 'agent', 'department']);

        // --- ROLE BASED LOGIC ---
        if ($user->role_id == 1 || ($user->role && $user->role->name == 'Admin')) {
            // No filter applied for Admin
        } 
        elseif ($user->role_id == 2 || ($user->role && $user->role->name == 'Agent')) {
            $query->where('agent_id', $user->id);
        } 
        else {
            $query->where('user_id', $user->id);
        }

        // --- FILTERS ---
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }
        if ($request->filled('agent_id')) {
            $query->where('agent_id', $request->agent_id);
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $tickets = $query->latest()->paginate(10)->withQueryString();
        
        return view('tickets.index', compact('tickets', 'categories'));
    }

    // Create ticket form
    public function create()
    {
        $categories = Category::all();
        return view('tickets.create', compact('categories'));
    }

    // Edit ticket
    public function edit(Ticket $ticket)
    {
        $categories = Category::all();
        $departments = Department::all();
        return view('tickets.edit', compact('ticket', 'categories', 'departments'));
    }

    // Store ticket
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high,urgent',
            'category_id' => 'required|exists:categories,id'
        ]);

        $category = Category::findOrFail($request->category_id);
        $department_id = $category->department_id;

        $ticket = Ticket::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'category_id' => $category->id,
            'department_id' => $department_id,
            'status' => 'open'
        ]);

        TicketHistory::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'action' => 'created',
            'description' => 'Ticket created'
        ]);

        $agent = User::where('role_id', 2)
                     ->where('department_id', $department_id)
                     ->first();

        if ($agent) {
            $ticket->agent_id = $agent->id;
            $ticket->status = 'in_progress';
            $ticket->save();

            TicketHistory::create([
                'ticket_id' => $ticket->id,
                'user_id' => Auth::id(),
                'action' => 'assigned',
                'description' => "Ticket auto-assigned to agent {$agent->name}"
            ]);

            $agent->notify(new TicketNotification($ticket, 'assigned'));
        }

        $admins = User::where('role_id', 1)->get();
        Notification::send($admins, new TicketNotification($ticket, 'created'));

        return redirect()->route('tickets.index')
                ->with('success', 'Ticket created successfully.');
    }

    // Update ticket
    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high,urgent',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:open,in_progress,resolved,closed,reopened,escalated',
        ]);

        $category = Category::findOrFail($request->category_id);

        $ticket->update([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'category_id' => $request->category_id,
            'department_id' => $category->department_id,
            'status' => $request->status,
            'resolved_at' => $request->status == 'resolved' ? now() : null
        ]);

        TicketHistory::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'action' => 'updated',
            'description' => 'Ticket updated by ' . Auth::user()->name
        ]);

        if ($ticket->agent && $ticket->agent->id != Auth::id()) {
            $ticket->agent->notify(new TicketNotification($ticket, 'updated'));
        }
        if ($ticket->user_id != Auth::id()) {
            $ticket->user->notify(new TicketNotification($ticket, 'updated'));
        }

        return redirect()->route('tickets.index')
                ->with('success', 'Ticket updated successfully.');
    }

    // Show ticket
    public function show(Ticket $ticket)
    {
        $ticket->load('category.department', 'user', 'agent', 'comments.user', 'attachments', 'histories', 'department');

        if (Auth::user()->unreadNotifications) {
            Auth::user()->unreadNotifications
                ->where('data.ticket_id', $ticket->id)
                ->markAsRead();
        }

        return view('tickets.show', compact('ticket'));
    }

    // Add comment
    public function addComment(Request $request, Ticket $ticket)
    {
        $request->validate(['comment' => 'required|string|max:1000']);

        $ticket->comments()->create([
            'user_id' => Auth::id(),
            'comment' => $request->comment
        ]);

        TicketHistory::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'action' => 'comment_added',
            'description' => 'Comment added by ' . Auth::user()->name
        ]);

        if (Auth::user()->role->name == 'Agent' && $ticket->status != 'resolved') {
            $ticket->status = 'resolved';
            $ticket->resolved_at = now();
            $ticket->save();

            TicketHistory::create([
                'ticket_id' => $ticket->id,
                'user_id' => Auth::id(),
                'action' => 'resolved',
                'description' => 'Ticket automatically resolved after agent comment by ' . Auth::user()->name
            ]);

            if ($ticket->user_id != Auth::id()) {
                $ticket->user->notify(new TicketNotification($ticket, 'resolved'));
            }
        }

        if ($ticket->agent && $ticket->agent->id != Auth::id()) {
            $ticket->agent->notify(new TicketNotification($ticket, 'comment_added'));
        }
        if ($ticket->user_id != Auth::id()) {
            $ticket->user->notify(new TicketNotification($ticket, 'comment_added'));
        }

        return back()->with('success', 'Comment added successfully.');
    }

    /**
     * NEW: Method to handle attachment uploads.
     */
    public function uploadAttachment(Request $request, Ticket $ticket)
    {
        $request->validate([
            'attachment' => 'required|file|max:5120', // 5MB Limit
        ]);

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $path = $file->store('attachments', 'public');

            $ticket->attachments()->create([
                'file_path'   => $path,
                'uploaded_by' => Auth::id(),
            ]);

            TicketHistory::create([
                'ticket_id'   => $ticket->id,
                'user_id'     => Auth::id(),
                'action'      => 'attachment_added',
                'description' => 'Attachment uploaded by ' . Auth::user()->name
            ]);

            return back()->with('success', 'Attachment uploaded successfully.');
        }

        return back()->with('error', 'Please select a valid file.');
    }

    // Resolve ticket manually
    public function resolve(Ticket $ticket)
    {
        if (auth()->user()->role->name != 'Agent' || auth()->user()->id != $ticket->agent_id) {
            abort(403);
        }

        $ticket->status = 'resolved';
        $ticket->resolved_at = now();
        $ticket->save();

        TicketHistory::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'action' => 'resolved',
            'description' => 'Ticket resolved by ' . Auth::user()->name
        ]);

        if ($ticket->user_id != Auth::id()) {
            $ticket->user->notify(new TicketNotification($ticket, 'resolved'));
        }

        return back()->with('success', 'Ticket resolved successfully.');
    }

    // Delete ticket
    public function destroy(Ticket $ticket)
    {
        if (Auth::user()->role->name != 'Admin' && $ticket->user_id != Auth::id()) {
            return back()->with('error', 'Not authorized');
        }

        foreach ($ticket->attachments as $attachment) {
            if (Storage::disk('public')->exists($attachment->file_path)) {
                Storage::disk('public')->delete($attachment->file_path);
            }
            $attachment->delete();
        }

        $ticket->histories()->delete();
        $ticket->delete();

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket deleted successfully.');
    }

    // Confirm/Close ticket
    public function confirmTicket(Ticket $ticket)
    {
        if (Auth::user()->role->name != 'Customer') {
            return back()->with('error', 'Only employees can confirm tickets.');
        }

        if ($ticket->status == 'closed') {
            return back()->with('info', 'Ticket is already closed.');
        }

        $ticket->status = 'closed';
        $ticket->closed_at = now();
        $ticket->closed_by = Auth::id();
        $ticket->save();

        TicketHistory::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'action' => 'closed',
            'description' => 'Ticket confirmed and closed by employee ' . Auth::user()->name
        ]);

        if ($ticket->agent_id && $ticket->agent_id != Auth::id()) {
            $ticket->agent->notify(new TicketNotification($ticket, 'closed'));
        }

        $admins = User::where('role_id', 1)->get();
        Notification::send($admins, new TicketNotification($ticket, 'closed'));

        return back()->with('success', 'Ticket confirmed and closed successfully.');
    }
}