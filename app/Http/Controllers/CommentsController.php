<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\CommentsNotification;
use App\User;
use App\Comment;
use App\Post;

class CommentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except' =>['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'Comment Added';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return 'Comment Added!';
        $this->validate($request,[
            'commentsBody' => 'required'
        ]);
        //$input = $request->all();
        $comment = new Comment();
        $comment->commentsBody = request()->input('commentsBody');
        $comment->user_id = Auth()->user()->id;
        $comment->post_id = request()->input('post_id');
        $comment->save();
        if(!Auth::guest())
        {
            $user = User::find(Post::find($comment->post_id)->user_id);
            if($user->id != Auth::user()->id)
            {
                $user->notify(new CommentsNotification($comment));   
            }
        }
        return back()->with('success', 'Comment Created');
        //return redirect('/posts')
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        if(auth()->user()->id !== $comment->user_id)
        {
            return back()->with('error','Unauthorized Page!');
        }
        return view('comments.edit')->with('comment',$comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comment =  Comment::find($id);
        $this->validate($request,[
            'commentsBody' => 'required'
        ]);
        if(auth()->user()->id !== $comment->user_id )
        {
            return redirect('/posts')->with('error','Unauthorized Page!');
        }
        //Update Comment
        $comment->commentsBody = request()->input('commentsBody');
        $comment->save();
        return redirect()->route('posts.show',$comment->post_id)->with('success', 'Comment Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment =  Comment::find($id);
        if(auth()->user()->id !== $comment->user_id )
        {
            return redirect('/posts')->with('error','Unauthorized Page!');
        }
        $comment->delete();
        return redirect()->route('posts.show',$comment->post_id)->with('success', 'Comment Deleted');
    }
}
