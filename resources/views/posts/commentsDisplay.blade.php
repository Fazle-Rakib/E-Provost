@php($comments = \App\Comment::where('post_id', $post->id)->latest()->get())
@foreach($comments as $comment)
    <div class="card bg-light border-primary mb-3">
        <div class="card-header">
            @if(!Auth::guest())
                    @if(Auth::user()->id == $comment->user_id)
                        <form id="delete-form" method="POST" action="{{ route('comments.destroy',$comment->id)}}">
                            @method('DELETE')
                            @csrf
                            <div class="dropdown float-right">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown"  href="#" role="button float-right" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            <i class="fa fa-cog" style="color:black; margin-right:5px; margin-top:0px"></i><span class=""></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" >
                                            <!-- Edit Button -->
                                                <a class="dropdown-item" href="/comments/{{$comment->id}}/edit" onMouseOver="this.style.color='#808080'" onMouseOut="this.style.color='#000'">Edit</a>
                                            <!-- Delete Button -->  
                                                <a class="dropdown-item" href="{{ route('comments.destroy',$comment->id)}} "
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
            <h5 class="card-title">{{ $comment->user->name }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{$comment->created_at->diffForHumans()}}</h6>
            
        </div>
        <div class="card-body">
            <p class="card-text">{{ $comment->commentsBody }}</p>
        </div>
    </div>
@endforeach