<?php

namespace JacobHyde\Tickets\App\Mailers;

use JacobHyde\Tickets\App\Models\Ticket;
use Illuminate\Contracts\Mail\Mailer;
use JacobHyde\Tickets\App\Models\Comment;

class SupportMailer
{
    protected $mailer;
    protected $fromAddress;
    protected $fromName;
    protected $to;
    protected $subject;
    protected $view;
    protected $data = [];
    /**
     * AppMailer constructor.
     * @param $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
        $this->fromAddress = config('tickets.from_address');
        $this->fromName = config('tickets.from_name');
    }

    public function sendTicketInformation(Ticket $ticket)
    {
        $this->to = $ticket->email;
        $this->subject = "[Ticket ID: $ticket->ticket_id] $ticket->title";
        $this->view = 'tickets::emails.ticket_info';
        $this->data = compact('ticket');
        return $this->deliver();
    }

    public function sendTicketComments(string $email, string $from, Ticket $ticket, Comment $comment)
    {
        $this->to = $email;
        $this->subject = "RE: $ticket->title (Ticket ID: $ticket->ticket_id)";
        $this->view = 'tickets::emails.ticket_comment';
        $this->data = compact('from', 'ticket', 'comment');
        return $this->deliver();
    }

    public function sendTicketStatusNotification(Ticket $ticket)
    {
        $this->to = $ticket->email;
        $this->subject = "RE: $ticket->title (Ticket ID: $ticket->ticket_id)";
        $this->view = 'tickets::emails.ticket_status';
        $from = config('tickets.from_name');
        $this->data = compact('from', 'ticket');
        return $this->deliver();
    }
    
    public function deliver()
    {
        $this->mailer->send($this->view, $this->data, function ($message) {
            $message->from($this->fromAddress, $this->fromName)
                ->to($this->to)->subject($this->subject);
        });
    }
}
