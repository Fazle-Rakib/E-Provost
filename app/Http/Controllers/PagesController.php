<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\CommentsNotification;
use App\User;

class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome to E-Provost';
        return view('pages.index',compact('title'));
    }
    public function about(){
        $title = 'About Us';
        return view('pages.about')->with('title',$title);
    }
    public function service(){
        $data = array(
            'title' => 'Services',
            'services' => ['Web design','PHP','Programming']    
        );
        return view('pages.service')->with($data);
    }
}
