@extends('layouts.app')


@section('content')
<div class="container">
    <!-- <a href="/posts" class="btn btn-primary">Go Back</a>-->
    <br>
    <a href="javascript:history.back()" class="btn btn-primary">Go Back</a>   
    
    <div class="card-columns-fluid">
        <div class="card" style="width: 36rem; margin:auto; margin-top:0px; max-height:58rem; min-height:34rem">
            <div class="card-body d-flex flex-row" style="height:0%">
                <!--Buttons-->
                
                <a href="/profile/{{$notice->user->id}}"><img src="/storage/profile_image/{{$notice->user->profile->profile_image}}" class="rounded-circle mr-3" height="70px" width="70px" alt="avatar"></a>
                <div style="margin-top:10px;">
                    <!-- Title -->
                    
                    <h5 class="card-title font-weight-bold mb-2">{{$notice->user->name}}</h5>
                    <!-- Subtitle -->
                    <p class="card-text"><i class="fa fa-clock-o"></i>{{$notice->created_at->diffForHumans()}}</p>
                    <div class="float-right" style="margin-left:430px; margin-top:-80px;">
                    @if(!Auth::guest())
                        @if(Auth::user()->id == $notice->user_id)
                            <form id="delete-form" method="POST" action="{{ route('notices.destroy',$notice->id)}}">
                                @method('DELETE')
                                @csrf
                                <div class="dropdown float-right">
                                    <ul class="navbar-nav ml-auto">
                                        <li class="nav-item dropdown">
                                            <a id="navbarDropdown"  href="#" role="button float-right" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                <i class="fa fa-cog"></i><span class=""></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" >
                                                <a class="dropdown-item" href="/notices/{{$notice->id}}/edit" onMouseOver="this.style.color='#808080'" onMouseOut="this.style.color='#000'">Edit</a>
                                                <a class="dropdown-item" href="{{ route('notices.destroy',$notice->id)}} "
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
            </div>
            <div class="card-body ">
                <h3 class="card-text" style="color: grey;font-size: 30px; text-align:center;" ><u><b>{{$notice->title}}</b></u></h3>
                <img class="card-img rounded-0" src="/storage/notice_image/{{$notice->notice_image}}" alt="Card image cap">
            </div>
        </div>
    </div>
</div>
@endsection