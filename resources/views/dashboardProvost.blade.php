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

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content text-center">
                                    <div class="modal-header" style="background-color: #D8E1E9">
                                    <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body" style="background-color: #E16F7C">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <p>Do you really want to delete these records? This process cannot be undone.</p>
                                    </div>
                                    <div class="modal-footer" style="background-color: #D8E1E9">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">DELETE</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <!--endof_Model-->

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
                                                                document.getElementById('exampleModal').submit();"  onMouseOver="this.style.color='#808080'" onMouseOut="this.style.color='#000'" data-toggle="modal" data-target="#exampleModal">
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