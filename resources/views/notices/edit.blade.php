@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:20px;">
    <h1>Edit notice</h1>
    <form method="POST" action="{{ route('notices.update',$notice->id)}}" enctype = "multipart/form-data">
        <div class="form-group">
            @method('PUT')
            @csrf            
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" placeholder="Title" value = "{{$notice->title}}"/>
        </div>
        <div class="form-group">          
            <input type="file" name = "notice_image">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection