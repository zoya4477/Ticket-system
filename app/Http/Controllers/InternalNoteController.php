<?php

namespace App\Http\Controllers;

use App\Models\InternalNote;
use Illuminate\Http\Request;

class InternalNoteController extends Controller
{
    // Store a new internal note
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'note' => 'required|string|max:5000',
        ]);

        // Create the note
        InternalNote::create([
            'ticket_id' => $request->ticket_id,
            'user_id' => auth()->id(),
            'note' => $request->note,
        ]);

        // Redirect back with success
        return back()->with('success', 'Internal note added successfully!');
    }
}