<?php

namespace JacobHyde\Tickets\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use JacobHyde\Tickets\App\Mailers\SupportMailer;
use JacobHyde\Tickets\App\Models\Ticket;

class CommentController extends Controller
{
    public function store(Request $request, SupportMailer $mailer)
    {
        $ticket = Ticket::findOrFail($request->ticket_id);

        $comment = $ticket->comments()->create([
            'user_id' => auth()->user() ? auth()->id() : null,
            'comment' => $request->comment,
        ]);

        $email = $ticket->email;
        $from = config('tickets.from_name');
        if (!auth()->check() || !auth()->user()->is_support) {
            $email = config('tickets.from_address');
            $from = $ticket->first_name . ' ' . $ticket->last_name;
        }

        $mailer->sendTicketComments($email, $from, $comment->ticket, $comment);

        return redirect()->back();
    }
}
