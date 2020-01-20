@extends('layouts.app')


@section('content')

    <!-- <a href="/posts" class="btn btn-primary">Go Back</a>-->
    <a href="javascript:history.back()" class="btn btn-primary">Go Back</a>    
    <br><br>
    <div class="card card-inverse" style="background-color: #89ABE3FF; border-color: #89ABE5FF;">
        <div class="card-block">
            <h4 class="card-title">{{$post->title}}
            <!--Buttons-->
            @if(!Auth::guest())
                @if(Auth::user()->id == $post->user_id || Auth::user()->user_type == 1)
                    <form id="delete-form" method="POST" action="{{ route('posts.destroy',$post->id)}}" style="float:right;">
                        @method('DELETE')
                        @csrf
                        <div class="dropdown float-right">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown"  href="#" role="button float-right" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <i class="fa fa-cog" style="color:black; margin-right:10px; margin-top:5px"></i><span class=""></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" >
                                        @if(Auth::user()->id == $post->user_id)
                                        <!-- Edit Button -->
                                            <a class="dropdown-item" href="/posts/{{$post->id}}/edit" onMouseOver="this.style.color='#808080'" onMouseOut="this.style.color='#000'">Edit</a>
                                        @endif
                                        <!-- Delete Button -->  
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
                @endif
            @endif
            </h4>
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
    <!--Display Comments-->   
    @if(count($post->comments) > 0)
    <h4>Display Comments</h4>
    @include('posts.commentsDisplay', ['comments' => $post->comments, 'post_id' => $post->id])
    <hr>
    @endif
    <br><br>
@endsection