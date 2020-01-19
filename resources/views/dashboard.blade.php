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
                                        <form id="delete-form" method="POST" action="{{ route('posts.destroy',$post->id)}}">
                                            @method('DELETE')
                                            @csrf
                                            <div class="dropdown float-right">
                                                <ul class="navbar-nav ml-auto">
                                                    <li class="nav-item dropdown">
                                                        <a id="navbarDropdown"  href="#" role="button float-right" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                            <i class="fa fa-cog"></i><span class=""></span>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" >
                                                            <a class="dropdown-item" href="/posts/{{$post->id}}/edit" onMouseOver="this.style.color='#808080'" onMouseOut="this.style.color='#000'">Edit</a>
                                                            <a class="dropdown-item" href="{{ route('posts.destroy',$post->id)}} "
                                                                onclick="event.preventDefault();
                                                                                document.getElementById('delete-form').submit();"  onMouseOver="this.style.color='#808080'" onMouseOut="this.style.color='#000'" >
                                                                {{ __('Delete') }}
                                                            </a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
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
