<div class="comment-form">
    <form action="{{ url('ticket/comment') }}" method="POST" class="form">
        {!! csrf_field() !!}
        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
        <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
            <textarea rows="10" id="comment" class="form-control" name="comment"></textarea>
            @if ($errors->has('comment'))
            <span class="help-block">
                <strong>{{ $errors->first('comment') }}</strong>
            </span>
            @endif
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Reply</button>
        </div>
    </form>
</div>