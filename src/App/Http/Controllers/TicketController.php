<?php

namespace JacobHyde\Tickets\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use JacobHyde\Tickets\App\Http\Requests\TicketUpdateRequest;
use JacobHyde\Tickets\App\Mailers\SupportMailer;
use JacobHyde\Tickets\App\Models\Ticket;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::paginate(10);
        return view('tickets::index')->with('tickets', $tickets);
    }

    public function show(Ticket $ticket)
    {
        return view('tickets::show')->with('ticket', $ticket);
    }

    public function update(Ticket $ticket, TicketUpdateRequest $request, SupportMailer $mailer)
    {
        $ticket->update($request->all());

        if ($request->get('status') == 'Closed') {
            $mailer->sendTicketStatusNotification($ticket);
        }

        return redirect()->route('tickets.show', $ticket);
    }
}