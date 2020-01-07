@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-primary">Go Back</a>
    <br><br>
    <div class="card card-inverse" style="background-color: #89ABE3FF; border-color: #89ABE5FF;">
        <div class="card-block">
        <h4 class="card-title">{{$post->title}}</h4>
        <hr>
        <p class="card-text">{!!$post->body!!}</p>
        <small>Written on {{$post->created_at}}</small>
        </div>
    </div>
@endsection

