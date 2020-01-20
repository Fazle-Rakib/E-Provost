<!--Template-->
<link rel="stylesheet" href=" {{asset('css/LandingAdded/main.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--<link rel="stylesheet" href=" asset('css/buttonLook.css') }}" />-->
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
    <br>
    <h3 style="text-align: center;"> <b>E-Provost Supervised By </b></h3>
    <br>
    
  
    <div class="row">
            <div class="card float-left" style=" background-color: #F4F6F6; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);max-width: 300px; min-width:250px; 
            margin: auto;text-align: center;" >
            <img src="{{URL::asset('/images/about/sir1.jpg')}}"style="width:100%;margin-top:15px;" class="rounded-circle mr-3" height="250px" width="230px" alt="avatar">
                <br>
                <h3 style="none; font-size:125%; height: 35px;margin-top:15px;" ><b>Asif Mohammed Samir</b></h3>
            <p class="title" style="margin-top:15px; font-size:23px;"><b>Assistant Professor</b></p>
            <p><button><a href="https://www.sust.edu/institutes/iict">IICT,SUST</a></button></p>
                <!--<p><button style="border: none;outline: 0;display: inline-block;padding: 8px;color: white;
                    background-color: #000;text-align: center;cursor: pointer;width: 100%;font-size: 18px;"></p>-->
            </div>
            <div class="card float-left" style=" background-color: #F4F6F6;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);max-width: 300px; min-width:250px; 
            margin: auto;text-align: center;" >
            <img src="{{URL::asset('/images/about/sir2.jpg')}}"style="width:100%;margin-top:15px;" class="rounded-circle mr-3" height="250px" width="230px" alt="avatar">
                <br>
                <h3 style="none; font-size:125%; height: 35px;margin-top:15px;" ><b>Quazi Ishtiaque Mahmud</b></h3>
            <p class="title" style="margin-top:15px; font-size:23px;"><b>Lecturer</b></p>
            <p><button><a href="https://www.sust.edu/institutes/iict">IICT,SUST</a></button></p>
                <!--<p><button style="border: none;outline: 0;display: inline-block;padding: 8px;color: white;
                    background-color: #000;text-align: center;cursor: pointer;width: 100%;font-size: 18px;"></p>-->
            </div>
    </div>

    <br><br><br><br>
    <h3 style="text-align: center;"> <b>Developed By </b></h3>
    <br>

    <div class="row">
        <div class="card float-left" style=" background-color: #F4F6F6; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);max-width: 300px; min-width:250px; height:450px; 
        margin: auto;text-align: center;" >
        <img src="{{URL::asset('/images/about/habib.jpg')}}"style="width:100%;margin-top:15px;" alt="avatar">
            <br>
            <h3 style="none; font-size:125%; height: 35px;margin-top:15px;" ><b>Habib Wahid</b></h3>
        <p class="title" style="margin-top:15px; font-size:23px;"><b>Student</b></p>
        <p><button><a href="https://www.sust.edu/institutes/iict">SWE,IICT,SUST</a></button></p>
            <!--<p><button style="border: none;outline: 0;display: inline-block;padding: 8px;color: white;
                background-color: #000;text-align: center;cursor: pointer;width: 100%;font-size: 18px;"></p>-->
        </div>
        <div class="card float-left" style=" background-color: #F4F6F6;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);max-width: 300px; min-width:250px; 
        margin: auto;text-align: center;" >
        <img src="{{URL::asset('/images/about/Rakib.jpg')}}"style="width:100%;margin-top:15px; height:120%"  alt="avatar">
            <br>
            <h3 style="none; font-size:125%; height: 35px;margin-top:15px;" ><b>Fazle Rabbi Rakib</b></h3>
        <p class="title" style="margin-top:15px; font-size:23px;"><b>Student</b></p>
        <p><button><a href="https://www.sust.edu/institutes/iict">SWE,IICT,SUST</a></button></p>
            <!--<p><button style="border: none;outline: 0;display: inline-block;padding: 8px;color: white;
                background-color: #000;text-align: center;cursor: pointer;width: 100%;font-size: 18px;"></p>-->
        </div>
    </div>

    <br><br><br><br>
    <h3 style="text-align: center;"> <b>Special Thanks To</b></h3>
    <br>
    <div class="row">
        <div class="card float-left" style=" background-color: #F4F6F6; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);max-width: 300px; min-width:260px; 
            margin: auto;text-align: center;" >
            <img src="{{URL::asset('/images/about/sajib2.jpeg')}}"style="width:100%;margin-top:15px;" class="rounded-circle mr-3" height="250px" width="230px" alt="avatar">
                <br>
                <h3 style="none; font-size:125%; height: 35px;margin-top:15px;" ><b>Sajib Sikder</b></h3>
            <p class="title" style="margin-top:15px; font-size:23px;"><b>Software Engineer</b></p>
            <p><button><a href="https://www.shohoz.com">Shohoj Limited</a></button></p>
                <!--<p><button style="border: none;outline: 0;display: inline-block;padding: 8px;color: white;
                    background-color: #000;text-align: center;cursor: pointer;width: 100%;font-size: 18px;"></p>-->
        </div>
    </div>


@endsection