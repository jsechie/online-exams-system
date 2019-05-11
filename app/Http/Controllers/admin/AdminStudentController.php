<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Department;
use App\User;
use App\Course;
use App\Academic;
use App\StudentsResults;
use Auth;

class AdminStudentController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function allStudents(){
    	$departments = Department::all();
    	$students = User::all();

    	return view('admin.students.allStudents',compact('departments','students'));
    }

    public function depStudents($id){
    	$students = Department::find($id)->students;
    	
    	$department= Department::find($id);
    	return view('admin.students.depStudents',compact('students','department'));
    }

     public function yearStudents(Request $request, $id){
        $year=$id;
    	$department = Department::find($request->dep_id);
        $students = Department::find($request->dep_id)->students->where('year',$id);
        return view('admin.students.yearStudents',compact('students','department','year'));
    }

    public function myStudents(){
        $courses = Course::where('assigned_to',Auth::user()->id)->get();
        return view('admin.students.myStudents',compact('courses'));
    }

    public function myStudentsCourse($id){
        // return $request->all();
        $course = Course::find($id);
        $students = User::where([['dep_id',$course->dep_id],['year',$course->year]])->get();
        
        return view('admin.students.courseStudents',compact('students','course'));
    }

     public function resultSearch(){
        $academics = Academic::select('year')->distinct()->get();
        $courses = Course::where('assigned_to',Auth::user()->id)->get();
        return view('admin.students.result.result_search_page',compact('academics','courses'));
    }

    public function viewResult(Request $request){
        $this->validate($request,[
            'exams_type'=>'required',
            'academic_year'=>'required',
            'course_name'=>'required',
        ]);
        $results = StudentsResults::where([['exams_type',$request->exams_type],['academic_year',$request->academic_year],['course_name',$request->course_name]])->get();
        $academic_year = $request->academic_year;
        $course = $request->course_name;
        $exams_type = $request->exams_type;
        if ($results->count() > 0) {
            return view('admin.students.result.result_page',compact('academic_year','exams_type','course','results'));
        }
        else{
            return redirect()->back()->with('flash_message_error','<h2>Result Not Found<br>Check Your Selected Options Again</h2>');
        }
        
    }

    public function viewResultReport(Request $request){
        $academic_year = $request->academic_year;
        $course = $request->course_name;
        $exams_type = $request->exams_type;
        // performance calculation
        $results = StudentsResults::where([['exams_type',$request->exams_type],['academic_year',$request->academic_year],['course_name',$request->course_name]])->get();
        if ($exams_type == "End Of Semester Examination") {
            $pass_mark = 28;    
        }
        else{
            $pass_mark = 12;
        }
        $pass = 0;
        foreach ($results as $result) {
            if ($result->marks_scored >= $pass_mark) {
                $pass += 1;
            }
        }
        $total_result = $results->count();
        // attendace calculation
        $_course = Course::where('name',$course)->first();
        $total_student = User::where([['dep_id',$_course->dep_id],['year',$_course->year]])->count();

       return view('admin.reports.result_report',compact('academic_year','exams_type','course','pass','total_result','total_student')); 
    }

    public function reportSearch(){
        $academics = Academic::select('year')->distinct()->get();
        $courses = Course::where('assigned_to',Auth::user()->id)->get();
        return view('admin.reports.report_search',compact('academics','courses'));
    }
}
