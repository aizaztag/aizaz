@extends('layouts.appOLD')
@section('content')
    <h1>{{$post->title}}</h1>
    <small> Written on {{$post->created_at}} </small>
    <p>By {{ $post->user->name  }}</p>

    <div>
        {!! $post->body !!}
    </div>
    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
            {!! Form::open(['action' => ['PostsController@destroy' , $post->id] , 'method' => 'POST']) !!}
            {{Form::hidden('_method' , 'DELETE')}}
            {{Form::submit('Delete' , ['class' => 'btn btn-danger'])}}
            {!! Form::close() !!}
        @endif
    @endif
@endsection