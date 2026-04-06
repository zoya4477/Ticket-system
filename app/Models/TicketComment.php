<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketComment extends Model
{
    use HasFactory;

    // Mass assignable fields
    protected $fillable = [
        'ticket_id',
        'user_id',
        'comment'
    ];

    /**
     * Comment belongs to a ticket
     */
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    /**
     * Comment belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}