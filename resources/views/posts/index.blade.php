@extends('layouts.app')

@section('content')
    <h1>All Posts:</h1>
    @if(count($posts) > 0)
        @foreach($posts as $post)
            <div class="card card-inverse" style="background-color: #89ABE3FF; border-color: #89ABE5FF;">
                <div class="card-block">
                <h3 class="card-title"><a href = "/posts/{{$post->id}}">{{$post->title}}</a></h3>
                <small>Written on {{$post->created_at}}</small>
                </div>
            </div>
            <br>
        @endforeach
        {{$posts->links()}}
    @else
        <p>No posts found</p>
    @endif
@endsection
<!--<p class="card-text">This text will be written on a grey background inside a Card.</p>
<a href="#" class="btn btn-primary">This is a Button</a>-->