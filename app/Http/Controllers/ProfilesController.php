<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Profile;
use App\User;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user1 = Profile::find(auth()->user()->id);
        $user2 = User::find(auth()->user()->id);
        //return $user;
        if($user1 != NULL)
        {
            return view('profiles.show',['user_id' => $user1,'user' => $user2]);
        }
        else
        {
            return view('profiles.create')->with('user_id',auth()->user()->id);
        }
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
        if(Auth::user()->user_type != 1)
        {
            $this->validate($request,[
                'dept_name' => 'required',
                'reg_number' => 'required',
                'hall_name' => 'required',
                'hall_id' => 'required',
                'phn_number' => 'required',
                'blood_group' => 'required',
                'profile_image' =>'image|nullable|max:1999'
            ]);
        }
        else
        {
            $this->validate($request,[
                'dept_name' => 'required',
                'dept_post' => 'required',
                'hall_name' => 'required',
                'hall_post' => 'required',
                'phn_number' => 'required',
                'blood_group' => 'required',
                'profile_image' =>'image|nullable|max:1999'
            ]);
        }

        //Handle File Upload
        if($request->hasfile('profile_image')){
            //Get File name with the Extension
            $fileNameWithExt = $request->file('profile_image')->getClientOriginalName();
            //Get Just fileName
            $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            //Get Just Ext
            $extension = $request->file('profile_image')->getClientOriginalExtension();
            //File Name to Store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            $path = $request->file('profile_image')->storeAs('public/profile_image',$fileNameToStore);
        }else{
            $fileNameToStore = 'noProfileImage.jpg';
        }

        $profile = new Profile();
        //Create Profile For Student
        if(Auth::user()->user_type != 1)
        {
            $profile->reg_number = $request->input('reg_number');
            $profile->hall_id = $request->input('hall_id');
            $profile->dept_post = "";
            $profile->hall_post = "";
        }
        else
        {
            $profile->reg_number = 0;
            $profile->hall_id = 0;
            $profile->dept_post = $request->input('dept_post');
            $profile->hall_post = $request->input('hall_post');
        }
        
        $profile->user_id = auth()->user()->id;
        $profile->dept_name = $request->input('dept_name');
        $profile->hall_name = $request->input('hall_name');
        $profile->phn_number = $request->input('phn_number');
        $profile->blood_group = $request->input('blood_group');
        $profile->profile_image = $fileNameToStore;
        $profile->save();

        return redirect('/dashboard');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user1 = Profile::find($id);
        $user2 = User::find($id);
        return view('profiles.show',['user_id' => $user1,'user' => $user2]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Profile::find($id);
        if(auth()->user()->id != $user->user_id)
        {
            return redirect('/')->with('error','Unauthorized Page!');
        }
        else
        {
            return view('profiles.edit')->with('user',$user);
        }
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
        $profile =  Profile::find($id);

        if(Auth::user()->user_type != 1)
        {
            $this->validate($request,[
                'dept_name' => 'required',
                'reg_number' => 'required',
                'hall_name' => 'required',
                'hall_id' => 'required',
                'phn_number' => 'required',
                'blood_group' => 'required',
                'profile_image' =>'image|nullable|max:1999'
            ]);
        }
        else
        {
            $this->validate($request,[
                'dept_name' => 'required',
                'dept_post' => 'required',
                'hall_name' => 'required',
                'hall_post' => 'required',
                'phn_number' => 'required',
                'blood_group' => 'required',
                'profile_image' =>'image|nullable|max:1999'
            ]);
        }

        if(auth()->user()->id !== $profile->user_id )
        {
            return redirect('/')->with('error','Unauthorized Page!');
        }
        //Handle File Upload
        if($request->hasfile('profile_image')){
            //Get File name with the Extension
            $fileNameWithExt = $request->file('profile_image')->getClientOriginalName();
            //Get Just fileName
            $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            //Get Just Ext
            $extension = $request->file('profile_image')->getClientOriginalExtension();
            //File Name to Store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            $path = $request->file('profile_image')->storeAs('public/profile_image',$fileNameToStore);
        }
        /*if ($request->hasFile('profile_image')) {
            
            $user->profile_image = $fileNameToStore;
        }*/
        //Update user
        //$user = user::find($id);
        if(Auth::user()->user_type != 1)
        {
            $profile->reg_number = $request->input('reg_number');
            $profile->hall_id = $request->input('hall_id');
        }
        else
        {
            $profile->dept_post = $request->input('dept_post');
            $profile->hall_post = $request->input('hall_post');
        }
        $profile->dept_name = $request->input('dept_name');
        $profile->hall_name = $request->input('hall_name');
        $profile->phn_number = $request->input('phn_number');
        $profile->blood_group = $request->input('blood_group');
        if($request->hasfile('profile_image')){
            if($profile->profile_image != 'noProfileImage.jpg')
            {
                Storage::delete('public/profile_image/'.$profile->profile_image);
            }
            $profile->profile_image = $fileNameToStore;
        }
        $profile->save();
        
        return redirect('/dashboard')->with('success', 'Profile Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
