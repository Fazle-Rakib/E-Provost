@foreach($comments as $comment)
    <div class="card bg-light border-primary mb-3">
        <div class="card-header">
            <h5 class="card-title">{{ $comment->user->name }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{$comment->created_at->diffForHumans()}}</h6>
            @if(!Auth::guest())
                @if(Auth::user()->id == $comment->user_id)
                    <form method="POST" action="{{ route('comments.destroy',$comment->id)}}">
                        @method('DELETE')
                        @csrf
                        <!-- Edit Button -->
                        <a href = "/comments/{{$comment->id}}/edit" class ="btn btn-primary">Edit</a>
                        <!-- Delete Button -->            
                        <button type="submit" class="btn btn-danger float">Delete</button>
                    </form>
                @endif
            @endif
        </div>
        <div class="card-body">
            <p class="card-text">{{ $comment->commentsBody }}</p>
        </div>
    </div>
@endforeach