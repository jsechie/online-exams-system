<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\User;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('student.student_dashboard');
    }

    // user settings 
    public function settings(){
        return view('student.student_settings');
    }

    // check password for updating
    // public function ChkPassword(Request $request){
    //     $data = $request->all();
    //     $current_pwd = $data['current_pwd'];
    //     $check_pwd = User::where(['email'=>Auth::user()->email])->first();
    //     if(Hash::check($current_pwd,$check->password)){
    //         echo 'true';die;
    //     }else{
    //         echo 'false';die;
    //     }
    // }

    // updating student password
    public function updatePassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
             
            $check_pwd = User::where(['email'=>Auth::user()->email])->first();
            $current_pwd = $data['current_pwd'];
            if(Hash::check($current_pwd,$check_pwd->password)){
                $password = bcrypt($data['new_pwd']);
                User::where('id',Auth::user()->id)->update(['password'=>$password]);
                return redirect('/student/settings')->with('flash_message_success','Password Updated Successfully');
            }
            else{
                return redirect('/student/settings')->with('flash_message_error','Current Password is InCorrect');
            }
        }
    }
}
