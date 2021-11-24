<?php

namespace JacobHyde\Tickets\App\Actions;

use JacobHyde\Tickets\App\Mailers\SupportMailer;
use JacobHyde\Tickets\App\Models\Ticket;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateTicket
{
    use AsAction;

    /**
     * @var SupportMailer
     */
    protected SupportMailer $mailer;

    public function __construct(SupportMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function handle(array $data)
    {
        $data['priority'] = 'Medium';
        $data['status'] = 'Open';
        $data['ticket_id'] = Ticket::count() + 1;

        if (auth(config('tickets.create.user_guard'))->check()) {
            $data['user_id'] = auth(config('tickets.create.user_guard'))->user()->id;
        }

        $ticket = Ticket::create($data);

        $this->mailer->sendTicketInformation($ticket);

        if (config('tickets.created.email')) {
            $this->mailer->sendTicketInformation($ticket, true);
        }

        if (config('tickets.created.callback')) {
            dispatch(new ${config('tickets.created.callback')}($ticket))->onQueue('normal');
        }

        return $ticket;
    }
}