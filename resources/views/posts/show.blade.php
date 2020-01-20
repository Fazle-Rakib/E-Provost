@extends('layouts.app')


@section('content')
<div class="container">
    <br>
    <!-- <a href="/posts" class="btn btn-primary">Go Back</a>-->
    <a href="javascript:history.back()" class="btn btn-primary">Go Back</a>    
    <br><br>
    <div class="card card-inverse" style="background-color: #ECF0F1; width:90%; margin-left:40px;">
        <div class="card-body d-flex flex-row" style="height:0%">
            
            <a href="/profile/{{$post->user->id}}"><img src="/storage/profile_image/{{$post->user->profile->profile_image}}" class="rounded-circle mr-3" height="70px" width="70px" alt="avatar"></a>
                <div style="margin-top:10px;">
                    <!-- Title -->
                    
                    <h5 class="card-title font-weight-bold mb-2">{{$post->user->name}}</h5>
                    <!-- Subtitle -->
                    <p class="card-text"><i class="fa fa-clock-o"></i>{{$post->created_at->diffForHumans()}}</p>

                </div>

            
            <!--Buttons-->
            <div class="float-right" style="margin-left:750px;">
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
            </div>
            
        </div>
        <div class="card-body ">
            @if($post->cover_image != "noimage.jpg")
            <img class="card-img rounded-0" src="/storage/cover_image/{{$post->cover_image}}" alt="Card image cap">
            @endif
            <br><br>
            <h3 class="card-text" style="color: grey;font-size: 30px; text-align:center;" ><u><b>{{$post->title}}</b></u></h3>
            <p class="card-text">{!!$post->body!!}</p>
        </div>
    </div>
    

        <br>
        @if(!Auth::guest())
        <div class="container" style=" background-color: #ECF0F1; width:90%; margin-left:40px; height:11rem;" >
        <br>
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
        </div>
        @endif
    <!--Display Comments-->   
    @if(count($post->comments) > 0)
    <div class="container" style=" background-color: #ECF0F1; width:90%; margin-left:40px;" >
        <h4>Display Comments</h4>
        @include('posts.commentsDisplay', ['comments' => $post->comments, 'post_id' => $post->id])
        <hr>
        @endif
    </div>

</div>
    <br><br>
@endsection