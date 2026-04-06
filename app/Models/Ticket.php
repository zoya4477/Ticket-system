<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'agent_id',
        'category_id',
        'title',
        'description',
        'category',
        'status',
        'priority'
    ];

    // Ticket creator (user)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Assigned agent
    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }
    
     //Department
    
     public function department()
    {
        return $this->belongsTo(Department::class);
    }
    // Ticket category
   
    public function category()
{
      return $this->belongsTo(Category::class);
}

    // Ticket comments
    public function comments()
    {
        return $this->hasMany(TicketComment::class);
    }

    // Ticket attachments
    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    // Ticket histories
    public function histories()
    {
        return $this->hasMany(TicketHistory::class);
    }

    // Internal notes (for agents/admin)
    public function internalNotes()
    {
        return $this->hasMany(InternalNote::class);
    }

    public function chatMessages()
    {
       return $this->hasMany(ChatMessage::class);
    }
}