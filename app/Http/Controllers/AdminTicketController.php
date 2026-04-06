<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;

class AdminTicketController extends Controller
{

public function index()
{
    $tickets = Ticket::with(['user','agent'])->get();

    $agents = User::where('role_id',2)->get();

    return view('admin.assign-tickets',compact('tickets','agents'));
}

public function assignTicket(Request $request)
{

$request->validate([
'ticket_id' => 'required',
'agent_id' => 'required'
]);

$ticket = Ticket::findOrFail($request->ticket_id);

$ticket->agent_id = $request->agent_id;
$ticket->status = "in_progress";

$ticket->save();

return redirect()->back()->with('success','Ticket Assigned Successfully');

}

}