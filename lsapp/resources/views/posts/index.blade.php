@extends('layouts.appOLD')
@section('content')
    <h1>Posts</h1>
    @if(count($posts) > 0)
       @foreach($posts as $post)
          <div class="well">
              <h3> <a href="/posts/{{  $post->id  }}"> {{$post->title}}</h3>
              <p>By {{ $post->user->name  }}</p>
          </div>
       @endforeach
       <div class="col-md-12"> {{$posts->links() }} </div>
    @else
        <p>NO DATA</p>
    @endif
@endsection