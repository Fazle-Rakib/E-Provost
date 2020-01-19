<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\CommentsNotification;
use App\User;
use App\Post;
use App\Profile;

class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome to E-Provost';
        $posts = Post::orderBy('created_at','desc')->paginate(4);
        
        $user_id = User::where('user_type',1)->get();
        $ui= $user_id->map->only(['id']);
        if(count($user_id) > 0)
        {
           

            $users = Profile::where('user_id',$ui)->get();
            return view('pages.index',compact('title'))->with('posts',$posts)->with('users',$users);
        }
        return view('pages.index',compact('title'))->with('posts',$posts);
    }
    public function about(){
        $title = 'About Us';
        return view('pages.about')->with('title',$title);
    }
    public function service(){
        $data = array(
            'title' => 'Notices',
            'services' => ['Web design','PHP','Programming']    
        );
        return view('pages.service')->with($data);
    }
}
