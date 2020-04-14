@extends('layouts.appOLD')
@section('content')
    <h1>Index</h1>
    <h1>{{ $title }}</h1>
    @if(count($services) > 0)
        <ul>
        @foreach($services as $service)
          <li> {{$service}} </li>
        @endforeach
        </ul>
    @endif
@endsection