@extends('layouts.app')
@section('title', 'All Tickets')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tickets</h5>
                    @if ($tickets->isEmpty())
                    <p>There are currently no tickets.</p>
                    @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Last Updated</th>
                                <th style="text-align:center" colspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tickets as $ticket)
                            <tr>
                                <td>
                                    {{ $ticket->category->name }}
                                </td>
                                <td>
                                    <a href="{{ url('ticket/'. $ticket->id) }}">
                                        #{{ $ticket->ticket_id }} - {{ $ticket->title }}
                                    </a>
                                </td>
                                <td>
                                    @if ($ticket->status === 'Open')
                                    <span class="label label-success">{{ $ticket->status }}</span>
                                    @else
                                    <span class="label label-danger">{{ $ticket->status }}</span>
                                    @endif
                                </td>
                                <td>{{ $ticket->updated_at }}</td>
                                <td>
                                    @if($ticket->status === 'Open')
                                    <a href="{{ url('ticket/' . $ticket->id) }}" class="btn btn-primary">Comment</a>
                                    <form action="{{ url('ticket/' . $ticket->id) }}" method="PUT">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="status" value="Closed" />
                                        <input type="hidden" name="_method" value="PUT" />
                                        <button type="submit" class="btn btn-danger">Close</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection