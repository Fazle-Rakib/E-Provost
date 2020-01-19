<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo asset('css/profileShow.css')?>" type="text/css"> 
<!------ Include the above in your HEAD tag ---------->

@extends('layouts.app')

@section('content')
    <a href="/dashboard" class="btn btn-primary">Go Back</a>

<div class="container emp-profile">
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="/storage/profile_image/{{$user_id->profile_image}}" alt=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5>
                                        {{$user->name}}
                                    </h5>
                                    <h6>
                                        {{$user->email}}
                                    </h6>
                                    <br><br>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <p style="font-family:courier; font-size:140%;">About</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @if(auth()->user()->id == $user->id)
                        <div class="col-md-2">
                            <a href = "/profile/{{$user->id}}/edit" class ="btn btn-primary">Edit</a>
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Department Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$user_id->dept_name}}</p>
                                    </div>
                                </div>
                                @if(Auth::user()->user_type == 1)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Post In Department</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{$user_id->dept_post}}</p>
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Hall Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$user_id->hall_name}}</p>
                                    </div>
                                </div>
                                @if(Auth::user()->user_type != 1)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Hall Id</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{$user_id->hall_id}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Registration Number</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{$user_id->reg_number}}</p>
                                        </div>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Post in Hall</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{$user_id->hall_post}}</p>
                                        </div>
                                    </div>
                                @endif
                                
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Blood Group</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$user_id->blood_group}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Phone</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$user_id->phn_number}}</p>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </form>           
        </div>

@endsection