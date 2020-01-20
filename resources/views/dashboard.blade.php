@extends('layouts.app')

@section('content')
<div class="container" style="margin-left: 100px;">
    
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="container" style="width: 100%;height:3rem;
                padding: 10px;
                margin: 0; color:gray;text-align:center;" > <h2><u><b>Dashboard</b></u></h2></div>
               
                <div class="container" style="width: 100%;
                padding: 5px;
                margin: 0; color:gray;text-align:left;" ><h3><b>Your Blog Posts:</b></h3>
                </div>
                    
                    @if(count($posts) > 0)
                    
                    <div class="row justify-content-center">
                        @foreach($posts as $post)
                            <div class="col-md-4">
                                <div class="card-columns-fluid">
                                    <div class="card" style="width: 18rem; margin:auto; margin-top:20px; height:26rem;">
                                        <div class="card-body d-flex flex-row">
                                            <a href="/profile/{{$post->user->id}}"><img src="/storage/profile_image/{{$post->user->profile->profile_image}}" class="rounded-circle mr-3" height="50px" width="50px" alt="avatar"></a>
                                            <div>
                                                <!-- Title -->
                                                <h5 class="card-title font-weight-bold mb-2">{{$post->user->name}}</h5>
                                                <!-- Subtitle -->
                                                <p class="card-text"><i class="fa fa-clock-o"></i>{{$post->created_at->diffForHumans()}}</p>
                                            </div>
                                            <div class="container float-right" style="width:10%;margin-left:70px;">
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
                                            </div>
                                        </div>
                                        <!-- Card image -->
                                        <div class="view overlay">
                                            <img class="card-img-top rounded-0" src="/storage/cover_image/{{$post->cover_image}}" alt="Card image cap">
                                            <a href="#!">
                                            <div class="mask rgba-white-slight"></div>
                                            </a>
                                        </div>
                                        <div class="card-body ">
            
                                            <div class="collapse-content">
                                        
                                            <!-- Text -->
                                            <p class="card-text collapse" >{!!str_limit($post->body,71,'...')!!}</p>
                                            
                                            
                                            <a href="/posts/{{$post->id}}" class="btn btn-primary">Detailes</a>
                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <br>
                    {{$posts->links()}}
                    @else
                        <p>You have no post</p>
                    @endif  
                    <!--You are logged in!-->
</div>
            

@endsection
