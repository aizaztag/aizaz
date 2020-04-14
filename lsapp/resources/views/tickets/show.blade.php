@extends('layouts.appOLD')

@section('title', 'Open Ticket')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Open New Ticket</div>

                <div class="panel-body">
                    @include('tickets.flash')
                    <table class="table-bordered">
                        <tr>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                        </tr>
                    @foreach($tickets as $ticket)
                        <tr>
                           <td> {{ $ticket->title }} </td>
                           <td> {{ $ticket->priority }} </td>
                           <td> {{ $ticket->category->name }} </td>
                           <td> {{ $ticket->category->name }} </td>
                        </tr>
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection