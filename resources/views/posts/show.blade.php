@extends('layouts.app')

@section('content')
    <a href="javascript:history.back()" class="btn btn-primary">Go Back</a>
    <!--    <a href="/posts" class="btn btn-primary">Go Back</a>    -->
    <br><br>
    <div class="card card-inverse" style="background-color: #89ABE3FF; border-color: #89ABE5FF;">
        <div class="card-block">
            <h4 class="card-title">{{$post->title}}</h4>
            <hr>
            <p class="card-text">{!!$post->body!!}</p>
            <br>
            @if($post->cover_image != "noimage.jpg")
            <img style ="width:100%" src="/storage/cover_image/{{$post->cover_image}}">
            @endif
            <small>Written on {{$post->created_at}} By {{$post->user->name}}</small>
        </div>
    </div>
    <hr>

    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
            <form method="POST" action="{{ route('posts.destroy',$post->id)}}">
                @method('DELETE')
                @csrf
                <!-- Edit Button -->
                <a href = "/posts/{{$post->id}}/edit" class ="btn btn-primary">Edit</a>
                <!-- Delete Button -->            
                <button type="submit" class="btn btn-danger float">Delete</button>
            </form>
        @endif
        <hr>
        <!--Display Comments-->   
        <h4>Display Comments</h4>
        @include('posts.commentsDisplay', ['comments' => $post->comments, 'post_id' => $post->id])
        <hr>
        <h4>Add comment</h4>
        <form method="POST" action="{{route('comments.store')}}">
            <div class="form-group">
                @csrf            
                <textarea class="form-control" name="commentsBody" cols="30" rows="2" placeholder="Write something..."></textarea>
                <input type="hidden" name="post_id" value="{{ $post->id }}" />
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Add Comment" />
            </div>
        </form>
    @endif
    
    <br><br>
@endsection