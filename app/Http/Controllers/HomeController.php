<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\User;
use App\Department;
use App\Academic;
use App\Course;
use App\StudentsResults;
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
        $academic = Academic::where('status',1)->first();
        $total_courses = Course::where([['dep_id',Auth::user()->dep_id],['year',Auth::user()->year],['status',1]])->count();
        // $total_courses = $courses->count();
        $total_exams = StudentsResults::where('student_id',Auth::user()->id)->count();
        $results = StudentsResults::where('student_id',Auth::user()->id)->get();
        $pass = 0;
        foreach ($results as $result) {
            if ($result->exams_type == "End Of Semester Examination") {
                if ($result->marks_scored >= 28) {
                    $pass += 1;
                }
            }
            else{
               if ($result->marks_scored >= 12) {
                    $pass += 1;
                }
            }
        }
        // return StudentsResults::all()->groupby('exams_id');
        return view('student.student_dashboard',compact('academic','total_courses','total_exams','pass'));
    }

    // user settings 
    public function settings(){
        $department = Department::find(Auth::user()->dep_id);
        return view('student.student_settings',compact('department'));
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

    public function profile(Request $request, $id){
        $this->validate($request,[
            'username'=>"required|string|unique:admins,username,$id",
            'email'=>"required|unique:users,email,$id",
            'picture' => 'image',
            // 'lec_id' => 'required|string',
        ]);
        $user = user::find($id);
        if ($request->hasFile('picture')){
           $user->picture =$request->picture->store('public');
        }
        // $user->lec_id = $request->lec_id;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with('flash_message_success','Details Updated Successfully');
    }

}
