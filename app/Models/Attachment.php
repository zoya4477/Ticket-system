<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = [
        'ticket_id',
        'file_path',
        'uploaded_by',
        
    ];

    // Relation to ticket
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    // Relation to user who uploaded
    public function user()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}