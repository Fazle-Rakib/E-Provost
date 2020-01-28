@extends('layouts.app')
@section('content')
<div class="container">
    <br>
    <h1>Notices</h1>
    @if(count($notices) > 0)
        <div class="container">
            <div class="row">
                @foreach($notices as $notice)
                    <div class="card float-left" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);max-width: 300px; min-width:270px; 
                    margin: auto;text-align: center;" >
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