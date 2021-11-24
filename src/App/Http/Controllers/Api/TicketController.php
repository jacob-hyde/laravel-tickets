<?php

namespace JacobHyde\Tickets\App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use JacobHyde\Tickets\App\Actions\CreateTicket;
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
    public function store(TicketRequest $request)
    {
        $data = $request->validated();
        
        CreateTicket::run($data);

        return response()->json(['success' => true], Response::HTTP_CREATED);
    }
}
