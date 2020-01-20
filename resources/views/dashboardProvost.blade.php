@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>
    
    <h1>Notices You Posted :</h1>
    <br>
    @if(count($notices) > 0)
        <div class="container">
            <div class="row">
                @foreach($notices as $notice)
                    <div class="card float-left" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);max-width: 300px; min-width:270px; 
                        margin: auto;text-align: center;" >
                        
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
                      
                        <img src="/storage/notice_image/{{$notice->notice_image}}" alt="John" style="max-height: 250px;">
                        <p class="title" style="color: grey;font-size: 24px;"><b>{{$notice->title}}</b></p>
                        <p class="card-text"><i class="fa fa-clock-o"></i>{{$notice->created_at->diffForHumans()}}</p>
                        <form method="GET" action="{{route('notices.show',$notice->id)}}">
                            
                                @csrf            
                                <input type="submit" class="button" onMouseOver="this.style.color='#0F0'" onMouseOut="this.style.color='#FFF'" style="border: none;outline: 0;display: inline-block;padding: 6px;color: white;
                                background-color: grey;text-align:center;cursor: pointer;width: 100%;font-size: 18px;" value="Details" />
                        </form> 
                    </div>
                @endforeach
            </div>
        </div> <!--container div  -->
        <br><br>
        {{$notices->links()}}
    @else
        <p><b>No Notice Found</b></p>
    @endif  
</div>
<br>
@endsection