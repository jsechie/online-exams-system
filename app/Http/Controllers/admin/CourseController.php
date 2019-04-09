<?php

namespace App\Http\Controllers\admin;
use App\Course;
use App\Academic;
use App\Department;
use App\Admin;
use App\ExamsSettings;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $courses = Course::all();
         $users = Admin::all()->sortByDesc('created_at');
        return view('admin.course.index_course',compact('courses','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        $users = Admin::all();
        return view('admin.course.create_course',compact('departments','users'));
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
            'course_name'=>'required|string|unique:courses,name,',
            'course_code'=>'required|string|unique:courses,code,',
            'credit_hours'=>'required|integer',
            'semester'=>'required',
            'year'=>'required',
            'department_name'=>'required',
        ]);

        $course =new Course;
        $course->name = $request->course_name;
        $course->code = $request->course_code;
        $course->dep_id = $request->department_name;
        $course->semester = $request->semester;
        $course->year = $request->year;
        $course->credit_hours = $request->credit_hours;
        $course->assigned_to = $request->assigned_to;
        $course->save();

        $midsem = new ExamsSettings;
        $midsem->title = 'Mid Semester Examination';
        $midsem->course_id = $course->id;
        $midsem->total_marks = 30;
        $midsem->save();

        $finalExam = new ExamsSettings;
        $finalExam->title = 'End Of Semester Examination';
        $finalExam->course_id = $course->id;
        $finalExam->total_marks = 70;
        $finalExam->save();

        return redirect(route('course.index'))->with('flash_message_success',"$course->name Added Successfully");
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
        $course = Course::where('id',$id)->first();
        $departments = Department::all();
        $academics = Academic::all();
        $users = Admin::all();
        return view('admin.course.edit_course',compact('course','departments','academics','users'));
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
        // assign a course to lecturer
        if ($request->has('user_id')){
            $course = Course::find($id);
            $course->assigned_to = $request->user_id;
            $course->save();
            return redirect(route('course.index'))->with('flash_message_success',"$course->name Assigned Successfully");
        }
        else{
             $this->validate($request,[
                'course_name'=>"required|string|unique:courses,name,$id",
                'course_code'=>"required|string|unique:courses,code,$id",
                'credit_hours'=>'required|integer',
            ]);

            $course = Course::find($id);
            $course->name = $request->course_name;
            $course->code = $request->course_code;
            $course->dep_id = $request->dep_id;
            $course->semester = $request->semester;
            $course->year = $request->year;
            $course->credit_hours = $request->credit_hours;
            $course->assigned_to = $request->assigned_to;
            $course->save();

            return redirect(route('course.index'))->with('flash_message_success',"$course->name Updated Successfully");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Course::find($id)->status == '1') {
            return redirect()->back()->with('flash_message_error',"!!!Course Active Deactivate Before Deletion");
        }
        else{
            Course::where('id',$id)->delete();
            return redirect()->back()->with('flash_message_success',"Course Deleted Successfully");
        }
    }

    public function status($id){
        $course = course::find($id);
        if($course->status=='0'){
            $course->status = 1;
            $course->save();

            return redirect()->back()->with('flash_message_success',"$course->name Course Activated Successfully");
        }

        if($course->status=='1'){
            $course->status = 0;
            $course->save();

            return redirect()->back()->with('flash_message_success',"$course->name Course Deactivated Successfully");
        }
    }


    // assigning the course
    public function assign($id)
    {
        $course = Course::where('id',$id)->first();
        $users = Admin::all();
        return view('admin.course.assign_course',compact('course','users'));
    }


    public function updateAssign(Request $request, $id)
    {
        // assign a course to lecturer
            $course = Course::find($id);
            $course->assigned_to = $request->user_id;
            $course->save();
            if ($course->assigned_to != NULL) {
               return redirect(route('course.index'))->with('flash_message_success',"$course->name Assigned Successfully");
            }
            else{
                return redirect(route('course.index'))->with('flash_message_error',"$course->name Not Assigned To Any Lecturer");
            }
    }

     public function adminCourse()
    {
        // return 'Hi';
        $courses = Admin::find(Auth::user()->id)->courses;
        
        return view('admin.course.my_course',compact('courses'));
    }

}
