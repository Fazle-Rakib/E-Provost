<!--Template-->
<link rel="stylesheet" href=" {{asset('css/LandingAdded/main.css') }}" />
@extends('layouts.app')
@section('content')

   <!-- Header -->
   <header id="header" class="alt">
    <div class="inner">
        <h1>E-Provost</h1>
        <p>A online platform to communicate with <a href="/">E-Provost</a></p>
    </div>
    </header>

<!-- Wrapper -->
<div id="wrapper">

    <!-- Banner -->
        <section id="intro" class="main">
            <span class="icon fa-diamond major"></span>
            <h2>A Online Platform</h2>
            <p>Goal of ​ E-Provost ​ is to inform the hall related problem to
                hall provost more easily and precisely .<br> ​ E-Provost ​ is an online based
                system, based on relational database <br>and the data shared by it’s
                users.</p>
            <ul class="actions">
                <li><a href="/about" class="button big">Learn More</a></li>
            </ul>
        </section>
    <hr>
    <!-- Posts -->
        <h2 style = "margin-left:360px; float-right;">Newsfeed</h2><br>
        <section class="main items">
            @if(count($posts) > 0)
                @foreach($posts as $post)
                    <article class="item">
                        <header>
                            <a href="/posts/{{$post->id}}"><img src="/storage/cover_image/{{$post->cover_image}}" alt="" /></a>
                        </header>
                        <h4><i class="fa fa-user-circle"></i>{{$post->user->name}}</h4>
                        <p>{{$post->title}}</p>
                        <ul class="actions">
                            <li><a href="/posts/{{$post->id}}" class="button">More</a></li>
                        </ul>
                    </article>
                @endforeach
            @else
                <p>No posts found</p>
            @endif
            <div class="mx-auto mt-3 ml-auto"> 
            <ul class="actions">
                <li><a href="/posts/" class="button btn-info" style="float:center;">More Posts</a></li>
            </ul>
             </div>
        </section>

    <hr>
    <!--Profile Card-->
    <!-- Add icon library -->
    @if(count($users) > 0)
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <br><h2 style = "margin-left:290px; float-right;">Administration</h2><br>
    <div class="row">
        @foreach($users as $user_id)
            <div class="card float-left" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);max-width: 300px; min-width:250px; 
            margin: auto;text-align: center;" >
            <img src="/storage/profile_image/{{$user_id->profile_image}}" alt="John" style="max-height: 250px;">
                <br>
                <h1 style="none; font-size:100%; height: 35px;" >{{$user_id->user->name}}</h1>
                <p class="title" style="color: grey;font-size: 18px;">{{$user_id->hall_post}}</p>
                <p>{{$user_id->hall_name}} Hall</p>
                <!--<p><button style="border: none;outline: 0;display: inline-block;padding: 8px;color: white;
                    background-color: #000;text-align: center;cursor: pointer;width: 100%;font-size: 18px;"></p>-->
                
                <form method="GET" action="{{route('profile.show',$user_id->user_id)}}">
                    <div class="form-group">
                        @csrf            
                        <input type="submit" class="button" style="border: none;outline: 0;display: inline-block;padding: 6px;color: white;
                        background-color: #000;text-align:center;cursor: pointer;width: 100%;font-size: 18px;" value="More" />
                    </div>
                </form>    
            </div>
        @endforeach
    </div>
    @endif
    <!-- CTA -->
        <section id="cta" class="main special">
            <h2>Etiam veroeros lorem</h2>
            <p>Phasellus ac augue ac magna auctor tempus proin<br />
            accumsan lacus a nibh commodo in pellentesque dui<br />
            in hac habitasse platea dictumst.</p>
            <ul class="actions">
                <li><a href="#" class="button big">Get Started</a></li>
            </ul>
        </section>

    <!-- Main -->
    <!--
        <section id="main" class="main">
            <header>
                <h2>Lorem ipsum dolor</h2>
            </header>
            <p>Fusce malesuada efficitur venenatis. Pellentesque tempor leo sed massa hendrerit hendrerit. In sed feugiat est, eu congue elit. Ut porta magna vel felis sodales vulputate. Donec faucibus dapibus lacus non ornare. Etiam eget neque id metus gravida tristique ac quis erat. Aenean quis aliquet sem. Ut ut elementum sem. Suspendisse eleifend ut est non dapibus. Nulla porta, neque quis pretium sagittis, tortor lacus elementum metus, in imperdiet ante lorem vitae ipsum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Etiam eget neque id metus gravida tristique ac quis erat. Aenean quis aliquet sem. Ut ut elementum sem. Suspendisse eleifend ut est non dapibus. Nulla porta, neque quis pretium sagittis, tortor lacus elementum metus, in imperdiet ante lorem vitae ipsum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
        </section>
    -->

    <!-- Footer -->
        <footer id="footer">
            <ul class="icons">
                <li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
                <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
                <li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
                <li><a href="#" class="icon fa-linkedin"><span class="label">LinkedIn</span></a></li>
                <li><a href="#" class="icon fa-envelope"><span class="label">Email</span></a></li>
            </ul>
            <p class="copyright">&copy; Untitled. Design: <a href="https://templated.co">TEMPLATED</a>. Images: <a href="https://unsplash.com">Unsplash</a>.</p>
        </footer>

</div>

<!-- Scripts -->
<script src="{{ asset('js/LandingAdded/jquery.min.js')}}"></script>
<script src="{{ asset('js/LandingAdded/skel.min.js')}}"></script>
<script src="{{ asset('js/LandingAdded/util.js')}}"></script>
<script src="{{ asset('js/LandingAdded/main.js')}}"></script>

@endsection
