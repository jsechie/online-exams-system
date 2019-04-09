<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Department;
use App\User;
use App\Course;
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
}
