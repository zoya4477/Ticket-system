<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use App\Models\Ticket;

class TicketNotification extends Notification
{
    use Queueable;

    protected $ticket;
    protected $type;

    public function __construct(Ticket $ticket, string $type)
    {
        $this->ticket = $ticket;
        $this->type = $type; // created, status_updated, assigned, comment_added, high_priority, reopened, attachment_uploaded
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast', 'mail'];
    }

    public function toMail($notifiable)
    {
        $subject = 'Ticket Update';
        $line = "Ticket #{$this->ticket->id} has an update.";

        switch ($this->type) {
            case 'created':
                $subject = 'New Ticket Created';
                $line = "Ticket #{$this->ticket->id}: {$this->ticket->title} has been created.";
                break;
            case 'status_updated':
                $subject = 'Ticket Status Updated';
                $line = "Ticket #{$this->ticket->id} status changed to {$this->ticket->status}.";
                break;
            case 'assigned':
                $subject = 'Ticket Assigned';
                $line = "Ticket #{$this->ticket->id} has been assigned to you.";
                break;
            case 'comment_added':
                $subject = 'New Comment Added';
                $line = "Ticket #{$this->ticket->id} has a new comment.";
                break;
            case 'high_priority':
                $subject = 'High Priority Ticket';
                $line = "Ticket #{$this->ticket->id} is high priority!";
                break;
            case 'reopened':
                $subject = 'Ticket Reopened';
                $line = "Ticket #{$this->ticket->id} has been reopened.";
                break;
            case 'attachment_uploaded':
                $subject = 'New Attachment Uploaded';
                $line = "A new attachment has been added to Ticket #{$this->ticket->id}.";
                break;
        }

        return (new MailMessage)
                    ->subject($subject)
                    ->line($line)
                    ->action('View Ticket', url("/tickets/{$this->ticket->id}"));
    }

    public function toDatabase($notifiable)
    {
        return [
            'ticket_id' => $this->ticket->id,   // used for marking as read
            'title' => $this->ticket->title,
            'status' => $this->ticket->status,
            'type' => $this->type,
            'link' => url("/tickets/{$this->ticket->id}") // optional for quick access
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'ticket_id' => $this->ticket->id,
            'title' => $this->ticket->title,
            'status' => $this->ticket->status,
            'type' => $this->type,
            'link' => url("/tickets/{$this->ticket->id}")
        ]);
    }
}