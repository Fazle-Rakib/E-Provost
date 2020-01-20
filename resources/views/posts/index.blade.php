@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <h1>All Posts:</h1>
            @if(count($posts) > 0)  
            <div class="container">
                <div class="row">
                    @foreach($posts as $post)
                        <div class="card float-left" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); min-width:18rem; max-width: 18rem; margin-left:60px; margin-top:10px; min-height:26rem; max-height:26rem;" >
                            <div class="card-body d-flex flex-row">
                                <a href="/profile/{{$post->user->id}}"><img src="/storage/profile_image/{{$post->user->profile->profile_image}}" class="rounded-circle mr-3" height="50px" width="50px" alt="avatar"></a>
                                <div>
                                    <!-- Title -->
                                    <h5 class="card-title font-weight-bold mb-2">{{$post->user->name}}</h5>
                                    <!-- Subtitle -->
                                    <p class="card-text"><i class="fa fa-clock-o"></i>{{$post->created_at->diffForHumans()}}</p>
                                </div>
                            </div>
                            <div class="view overlay">
                                <img class="card-img-top rounded-0" src="/storage/cover_image/{{$post->cover_image}}" alt="Card image cap">
                                <a href="#!">
                                <div class="mask rgba-white-slight"></div>
                                </a>
                            </div>
                            <div class="card-body ">
                                <div class="collapse-content">
                                    <h5 style="text-align:center"><b>{{$post->title}}</b></h5>
                                    <!-- Text -->
                                    <p class="card-text collapse" >{!!str_limit($post->body,71,'...')!!}</p>
                                </div>
                            </div>
                            
                            <form method="GET" action="{{route('posts.show',$post->id)}}">
                                    @csrf            
                                    <input type="submit" class="button" onMouseOver="this.style.color='#0F0'" onMouseOut="this.style.color='#FFF'" style="border: none;outline: 0;display: inline-block;padding: 6px;color: white;
                                    background-color: grey;text-align:center;cursor: pointer;width: 100%;font-size: 18px;" value="Details" />   
                            </form> 
                        </div>
                    @endforeach
                </div>
            </div> <!--container div  -->
            <br>
            {{$posts->links()}}
            @else
                <p>No posts found</p>
            @endif
    </div>
    <br>
@endsection
<!--<p class="card-text">This text will be written on a grey background inside a Card.</p>
<a href="#" class="btn btn-primary">This is a Button</a>-->