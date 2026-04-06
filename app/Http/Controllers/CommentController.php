<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\TicketHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function destroy(Comment $comment)
    {
        $user = Auth::user();

        if($user->id === $comment->user_id || in_array($user->role->name, ['Admin', 'Agent'])) {
            // Track deletion in ticket history
            TicketHistory::create([
                'ticket_id' => $comment->ticket_id,
                'user_id' => $user->id,
                'action' => 'comment_deleted',
                'description' => 'Comment deleted by '.$user->name
            ]);

            $comment->delete();
            return back()->with('success','Comment deleted successfully.');
        }

        return back()->with('error','You are not authorized to delete this comment.');
    }
}