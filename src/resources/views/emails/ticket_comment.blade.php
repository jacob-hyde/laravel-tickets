<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Support Ticket</title>
</head>

<body>
    <p>
        {{ $comment->comment }}
    </p>
    ---
    <p>Replied by: {{ $from }}</p>
    <p>Title: {{ $ticket->title }}</p>
    <p>Ticket ID: {{ $ticket->ticket_id }}</p>
    <p>Status: {{ $ticket->status }}</p>
    <p>
        You can view the ticket at any time at {{ url('ticket/'. $ticket->ticket_id) }}
    </p>
</body>

</html>