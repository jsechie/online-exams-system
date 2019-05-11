<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Role;
use App\Admin;
use App\Department;
use App\Course;
use App\Questions;
use App\Academic;
use App\User;
use App\ExamsSettings;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=Admin::all();
        $departments=department::all();
        $courses=course::all();
        $questions=Questions::all();
        $students=User::all();
        $assigned=Course::whereNotNull('assigned_to')->get();
        $available= Admin::whereIn('id',Course::select('assigned_to')->distinct())->get();
        $available=$users->count() - $available->count();
        $userCourses= Admin::find(Auth::user()->id)->courses;
        $userQuestions=Questions::whereIn('course_id', Course::select('id')->where('assigned_to',Auth::user()->id)->get())->get()->count();
        $userExams = ExamsSettings::whereIn('course_id',Course::select('id')->where('assigned_to',Auth::user()->id))->get()->count();
        $userStudents = 0;
        foreach ($userCourses as $value) {
            $userStudents += User::where([['year',$value->year],['dep_id',$value->dep_id]])->get()->count();
        }
        $academic = Academic::where('status',1)->first();
        return view('admin.admin_dashboard',compact('users','departments','courses','questions','students','assigned','available','userCourses','userQuestions','userExams','userStudents','academic'));
    }

    public function settings(){
        $user = Admin::find(Auth::user()->id);
        return view('admin.admin_settings',compact('user'));
    }

    public function updatePassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
             
            $check_pwd = Admin::where(['email'=>Auth::user()->email])->first();
            $current_pwd = $data['current_pwd'];
            if(Hash::check($current_pwd,$check_pwd->password)){
                $new_pwd =['new_pwd'];
                if($data['confirm_pwd']==$data['new_pwd']){
                    $password = bcrypt($data['new_pwd']);
                    Admin::where('id',Auth::user()->id)->update(['password'=>$password]);
                    return redirect('/admin/settings')->with('flash_message_success','Password Updated Successfully');
                }
                else{
                     return redirect('/admin/settings')->with('flash_message_error','New Password and Confirm Password Does Not Match');
                }
                
            }
            else{
                return redirect('/admin/settings')->with('flash_message_error','Current Password is InCorrect');
            }
        }
    }

    public function profile(Request $request, $id){
        $this->validate($request,[
            'username'=>"required|string|unique:admins,username,$id",
            'name'=>"required|string",
            'email'=>"required|unique:admins,email,$id",
            'picture' => 'image',
            // 'lec_id' => 'required|string',
        ]);
        $user = Admin::find($id);
        if ($request->hasFile('picture')){
           $user->picture =$request->picture->store('public');
        }
        // $user->lec_id = $request->lec_id;
        $user->name=$request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with('flash_message_success','Details Updated Successfully');
    }

    public function questionsUploadStatus(){
        $courses = Course::where('assigned_to','<>',NULL)->get();

        return view('admin.users.upload_status',compact('courses'));
    }

    public function assigned()
    {
        $courses = Course::where('assigned_to','<>',NULL)->get();
         $users = Admin::all()->sortByDesc('created_at');
        return view('admin.course.index_course',compact('courses','users'));
    }

    public function unassigned()
    {
        $courses = Course::where('assigned_to',NULL)->get();
         $users = Admin::all()->sortByDesc('created_at');
        return view('admin.course.index_course',compact('courses','users'));
    }

}