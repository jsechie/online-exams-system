<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Department;
use App\User;
use App\Course;

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
    	$courses = Department::find($id)->courses;
    	$department= Department::find($id);
    	return view('admin.students.depStudents',compact('courses','students','department'));
    }

     public function courseStudents($id){
    	// $students = Department::find($id)->students;
    	// $courses = Department::find($id)->courses;
    	$course= Course::find($id);
    	return view('admin.students.courseStudents',compact('course'));
    }
}
