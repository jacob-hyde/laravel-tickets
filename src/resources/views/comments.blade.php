<div class="comments">
    @foreach($ticket->comments as $comment)
    <div class="panel panel-@if(($comment->user_id) && optional($ticket->user)->id === $comment->user_id){{"default"}}@else{{"success"}}@endif">
        <div class="panel panel-heading">
            @if ($comment->user)
            {{ $comment->user->name }}
            @else
            {{ $ticket->email }}
            @endif
            <span class="pull-right">{{ $comment->created_at->format('Y-m-d') }}</span>
        </div>
        <div class="panel panel-body">
            {{ $comment->comment }}
        </div>
    </div>
    @endforeach
</div>