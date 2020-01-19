<!--Template-->
<link rel="stylesheet" href=" {{asset('css/LandingAdded/main.css') }}" />
@extends('layouts.app')
@section('content')
<section id="intro" class="main">
    <h1 style="margin:auto;position: relative;z-index: 0;">{{$title}}</h1>
</section>
    <div class= "container">
    <p>Goal of ​ E-Provost ​ is to inform the hall related problem to
        hall provost more easily and precisely . ​ E-Provost ​ is an online based
        system, based on relational database and the data shared by it’s
        users.</p>
    <p>Almost 60% students of every university stays in varsity hall.When
        they face any problem,they have to write down their problem in a diary kept
        in the provost room. When provost visits the varsity hall, he checks the
        written problem in the diary and takes necessary steps which takes a very
        long time.
        To solve this problem we are building a website which will provide hall
        students to post their problems online so that hall provost can take steps
        as soon as possible.</p>
    </div>

@endsection