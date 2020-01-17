@extends('layouts.app')

@section('content')
    <h1>Edit Comment</h1>
    <form method="POST" action="{{ route('comments.update',$comment->id)}}">
        @method('PUT')
        <div class="form-group">
            @csrf            
            <textarea class="form-control" name="commentsBody" cols="30" rows="2" placeholder="Write something...">{{$comment->commentsBody}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection