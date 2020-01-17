<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $this->validate($request,[
            'dept_name' => 'required',
            'reg_number' => 'required',
            'phn_number' => 'required',
            'blood_group' => 'required',
            'profile_image' =>'image|nullable|max:1999'
        ]);

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

        //Create Profile
        $profile = new Profile();
        $profile->user_id = auth()->user()->id;
        $profile->reg_number = $request->input('reg_number');
        $profile->dept_name = $request->input('dept_name');
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
        return 'Show';
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
        $user =  Profile::find($id);

        $this->validate($request,[
            'dept_name' => 'required',
            'reg_number' => 'required',
            'phn_number' => 'required',
            'blood_group' => 'required',
            'profile_image' =>'image|nullable|max:1999'
        ]);

        if(auth()->user()->id !== $user->user_id )
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
        $user->reg_number = $request->input('reg_number');
        $user->dept_name = $request->input('dept_name');
        $user->phn_number = $request->input('phn_number');
        $user->blood_group = $request->input('blood_group');
        if($request->hasfile('profile_image')){
            if($user->profile_image != 'noProfileImage.jpg')
            {
                Storage::delete('public/profile_image/'.$user->profile_image);
            }
            $user->profile_image = $fileNameToStore;
        }
        $user->save();
        
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
