<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Notifications\CommentsNotification;
use App\User;
use App\Post;
use App\Comment;
use App\Profile;

class PostsController extends Controller
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
        //$posts =  Post::all();
        //$posts = Post::where('title','Post Two')->get();
        //$posts = Post::select('SELECT * FROM posts');
        //$posts = Post::orderBy('title','desc')->take(1)->get();
        //$posts = Post::orderBy('title','desc')->get();
        
        //$posts = Post::orderBy('created_at','desc')->paginate(6);
        $posts = Post::with("user.profile")->latest()->paginate(3);
        //return $posts;
        //return User::find(10)->profile->profile_image;
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
            'cover_image' =>'image|nullable|max:1999'
        ]);
        //Handle File Upload
        if($request->hasfile('cover_image')){
            //Get File name with the Extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get Just fileName
            $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            //Get Just Ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //File Name to Store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            $path = $request->file('cover_image')->storeAs('public/cover_image',$fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }
        //Create Post
        $post = new POST();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        //Notification for Provost
        if(!Auth::guest())
        {
            $users = User::where('user_type',1)->get();
            foreach($users as $user)
            {
                if($user != Auth::user())
                {
                    $user->notify(new CommentsNotification($post));  
                }
                
            }
        }
        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post =  Post::find($id);
        if(!Auth::guest())
        {
            $user =  Auth::user();
            $notification = auth()->user()->notifications()->where('data->post_id',$post->id)->get();
            if($notification) {
                $notification->markAsRead();
            }
            //$user->unreadNotifications()->where('type', 'App\Notifications\CommentsNotification')->where('data->post_id', $post->id)->markAsRead();
        }
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post =  Post::find($id);
        if(auth()->user()->id !== $post->user_id )
        {
            return redirect('/posts')->with('error','Unauthorized Page!');
        }
        return view('posts.edit')->with('post',$post);
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
        $post =  Post::find($id);
        //return 'hello';
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required'
        ]);
        if(auth()->user()->id !== $post->user_id )
        {
            return redirect('/posts')->with('error','Unauthorized Page!');
        }
        //Handle File Upload
        if($request->hasfile('cover_image')){
            //Get File name with the Extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get Just fileName
            $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            //Get Just Ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //File Name to Store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            $path = $request->file('cover_image')->storeAs('public/cover_image',$fileNameToStore);
        }
        /*if ($request->hasFile('cover_image')) {
            
            $post->cover_image = $fileNameToStore;
        }*/
        //Update Post
        //$post = POST::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasfile('cover_image')){
            if($post->cover_image != 'noimage.jpg')
            {
                Storage::delete('public/cover_image/'.$post->cover_image);
            }
            $post->cover_image = $fileNameToStore;
        }
        $post->save();
        
        return redirect('/posts')->with('success', 'Post Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = POST::find($id);
        //Notification for Provost
        if(!Auth::guest())
        {
            $users = User::where('user_type',1)->get();
            foreach($users as $user)
            {
                if($user != Auth::user())
                {
                    $user->notifications()->where('type', 'App\Notifications\CommentsNotification')->where('data->post_id', $post->id)->delete();
                }
            }            
            if($post->user_id != Auth::user()->id)
            {
                $post_user = User::where('id',$post->user_id)->get();
                $post_user->notifications()->where('type', 'App\Notifications\CommentsNotification')->where('data->post_id', $post->id)->delete();
            }
            
        }
        if(auth()->user()->id !== $post->user_id && auth()->user()->user_type != 1)
        {
            return redirect('/posts')->with('error','Unauthorized Page!');
        }
        if($post->cover_image != 'noimage.jpg')
        {
            Storage::delete('public/cover_image/'.$post->cover_iamge);
        }
        $post->delete();

        
        return redirect('/posts')->with('success', 'Post Removed Successfully');
    }
}
