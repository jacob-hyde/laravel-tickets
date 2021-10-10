<?php

namespace JacobHyde\Tickets\App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use JacobHyde\Tickets\App\Http\Requests\Api\TicketRequest;
use JacobHyde\Tickets\App\Mailers\SupportMailer;
use JacobHyde\Tickets\App\Models\Ticket;

class TicketController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketRequest $request, SupportMailer $mailer)
    {
        $data = $request->validated();
        $data['priority'] = 'Medium';
        $data['status'] = 'Open';
        $data['ticket_id'] = Ticket::count() + 1;
        
        if (auth(config('tickets.create.user_guard'))->check()) {
            $data['user_id'] = auth(config('tickets.create.user_guard'))->user()->id;
        }
        
        $ticket = Ticket::create($data);

        $mailer->sendTicketInformation($ticket);

        if (config('tickets.created.email')) {
            $mailer->sendTicketInformation($ticket, true);
        }

        return response()->json(['success' => true], Response::HTTP_CREATED);
    }
}
