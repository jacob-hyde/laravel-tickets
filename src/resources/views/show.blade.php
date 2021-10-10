@extends('layouts.app')
@section('title', 'All Tickets')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Ticket #{{ $ticket->ticket_id }} - {{ $ticket->title }}</h5>
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="ticket-info">
                        <p>{{ $ticket->message }}</p>
                        <p>Category: {{ $ticket->category->name }}</p>
                        <p>
                            @if ($ticket->status === 'Open')
                            Status: <span class="label text-success">{{ $ticket->status }}</span>
                        <form action="{{ url('ticket/' . $ticket->id) }}" method="POST" class="form">
                            {!! csrf_field() !!}
                            <input type="hidden" name="status" value="Closed" />
                            <input type="hidden" name="_method" value="PUT" />
                            <button class="btn btn-danger" type="submit">Close Ticket</button>
                        </form>
                        @else
                        Status: <span class="label text-danger">{{ $ticket->status }}</span>
                        @endif
                        </p>
                        <p>Created on: {{ $ticket->created_at->diffForHumans() }}</p>
                        <hr />
                        @include('tickets::comments')
                        <hr>
                        @include('tickets::reply')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection