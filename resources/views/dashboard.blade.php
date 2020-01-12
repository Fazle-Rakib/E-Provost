@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3>Your Blog Posts</h3>
                    @if(count($posts) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th></th>
                            </tr>
                            @foreach($posts as $post)
                                <tr>
                                    <td><a href = "/posts/{{$post->id}}">{{$post->title}}</a></td>
                                    <td>
                                        <form method="POST" action="{{ route('posts.destroy',$post->id)}}">
                                            @method('DELETE')
                                            @csrf
                                            <!-- Edit Button -->
                                            <a href = "/posts/{{$post->id}}/edit" class ="btn btn-primary" style = "margin-left:330px;">Edit</a>
                                            <!-- Delete Button -->            
                                            <button type="submit" class="btn btn-danger float-right">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>You have no post</p>
                    @endif  
                    <!--You are logged in!-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
