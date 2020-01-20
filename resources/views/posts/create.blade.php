@extends('layouts.app')

@section('content')
<div class="container">
    <br>
    @if(Auth::user()->user_type == 1)
        <h1>Create Notice</h1>
        <form method="post" action="{{ route('notices.store') }}" enctype = "multipart/form-data">
            <div class="form-group">
                @csrf            
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" placeholder="Title"/>
            </div>
            <div class="form-group">          
                <input type="file" name = "notice_image">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @else
        <h1>Create Post</h1>
        <form method="post" action="{{ route('posts.store') }}" enctype = "multipart/form-data">
            <div class="form-group">
                @csrf            
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" placeholder="Title"/>
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea class="form-control" name="body" id = "article-ckeditor" cols="30" rows="10" placeholder="Body Text"></textarea>
            </div>
            <div class="form-group">          
                <input type="file" name = "cover_image">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @endif
</div>
@endsection