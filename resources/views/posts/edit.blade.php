@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1>
    <form method="POST" action="{{ route('posts.update',$post->id)}}" enctype = "multipart/form-data">
        <div class="form-group">
            @method('PUT')
            @csrf            
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" placeholder="Title" value = "{{$post->title}}"/>
        </div>
        <div class="form-group">
            <label for="body">Body</label>
        <textarea class="form-control" name="body" id = "article-ckeditor" cols="30" rows="10" placeholder="Body Text">{{$post->body}}</textarea>
        </div>
        <div class="form-group">          
            <input type="file" name = "cover_image">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection