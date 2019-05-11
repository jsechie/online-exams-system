<?php

namespace App\Http\Controllers\admin;

use Auth;
use Session;
use App\Role;
use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminCRUDcontroller extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $users = Admin::all();
        return view('admin.users.index_admin',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create_admin');
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
            'name'=>'required|string',
            'username'=>'required|string|unique:admins,username,',
            'email' => 'required|string|email|max:255|unique:admins,email',
            'password' => 'required|string|min:6|confirmed',
            'picture' => 'image',
            'lec_id' => 'required|string|unique:admins,lec_id',
        ]);

        $users =new Admin;
        if ($request->hasFile('picture')){
           $users->picture =$request->picture->store('public');
        }
        $users->lec_id = $request->lec_id;
        $users->name = $request->name;
        $users->username = $request->username;
        $users->email = $request->email;
        $users->role = $request->role;
        $users->password = bcrypt("$request->password");
        $users->save();

        return redirect(route('users.index'))->with('flash_message_success',"$users->username's Record Added Successfully");
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
        $user = Admin::where('id',$id)->first();
        return view('admin.users.edit_admin',compact('user'));
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
       $this->validate($request,[
            'name'=>'required|string',
            'username'=>'required|string',
            'email' => 'required|string|email|max:255',
            'password' => 'confirmed',
            'picture' => 'image|',
            'lec_id' => 'required|string',
        ]);
        $user = Admin::find($id);
        if ($request->hasFile('picture')){
            
           $user->picture =$request->picture->store('public');
        }
        $user->lec_id = $request->lec_id;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role = $request->role;
        if($request['password']!=''){
           $user->password = $request->password; 
        }        
        $user->update();
        // $user = Admin::where('id',$id)->update($request->except('_token','_method'));
       return redirect(route('users.index'))->with('flash_message_success',"$user->username's Details Upated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         Admin::where('id',$id)->delete();
        return redirect()->back()->with('flash_message_error','User Deleted Successfully');
    }
}
