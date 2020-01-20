<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Profile;
use App\Notice;

class NoticesController extends Controller
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
        $notices = Notice::orderBy('created_at','desc')->paginate(3);
        return view('notices.index')->with('notices',$notices);
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
        $this->validate($request,[
            'title' => 'required',
            'notice_image' =>'image|max:1999'
        ]);
        //Handle File Upload
        if($request->hasfile('notice_image')){
            //Get File name with the Extension
            $fileNameWithExt = $request->file('notice_image')->getClientOriginalName();
            //Get Just fileName
            $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            //Get Just Ext
            $extension = $request->file('notice_image')->getClientOriginalExtension();
            //File Name to Store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            $path = $request->file('notice_image')->storeAs('public/notice_image',$fileNameToStore);
        }
        //Create notice
        $notice = new Notice();
        $notice->title = $request->input('title');
        $notice->user_id = auth()->user()->id;
        $notice->notice_image = $fileNameToStore;
        $notice->save();
        return redirect('/notices')->with('success', 'Notice Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $notice =  Notice::find($id);
        return view('notices.show')->with('notice',$notice);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notice =  Notice::find($id);
        if(auth()->user()->id !== $notice->user_id )
        {
            return redirect('/notices')->with('error','Unauthorized Page!');
        }
        return view('notices.edit')->with('notice',$notice);
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
        $notice = Notice::find($id);
        $this->validate($request,[
            'title' => 'required',
        ]);
        if(auth()->user()->id !== $notice->user_id )
        {
            return redirect('/notices')->with('error','Unauthorized Page!');
        }
        //Handle File Upload
        if($request->hasfile('notice_image')){
            //Get File name with the Extension
            $fileNameWithExt = $request->file('notice_image')->getClientOriginalName();
            //Get Just fileName
            $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            //Get Just Ext
            $extension = $request->file('notice_image')->getClientOriginalExtension();
            //File Name to Store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            $path = $request->file('notice_image')->storeAs('public/notice_image',$fileNameToStore);
        }
        //Update notice
        $notice->title = $request->input('title');
        if($request->hasfile('notice_image')){
            Storage::delete('public/notice_image/'.$notice->notice_image);
            $notice->notice_image = $fileNameToStore;
        }
        $notice->save();
        return redirect('/dashboard')->with('success', 'Notice Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notice = Notice::find($id);
        //Notification for Provost
        if(auth()->user()->id !== $notice->user_id && auth()->user()->user_type != 1)
        {
            return redirect('/notices')->with('error','Unauthorized Page!');
        }
        Storage::delete('public/notice_image/'.$notice->notice_iamge);
        $notice->delete();
        return redirect('/dashboard')->with('success', 'Notice Removed Successfully');
    }
}
