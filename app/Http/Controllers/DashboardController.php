<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
Use App\Post;
use App\Notice;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        if(auth()->user()->user_type == 1)
        {
            $notices = Notice::where('user_id',$user_id)->latest()->paginate(3);
            return view('dashboardProvost')->with('notices',$notices);
        }
        else
        {
            $posts = Post::where('user_id',$user_id)->latest()->paginate(3);
            return view('dashboard')->with('posts',$posts);
        }   
    }
}
