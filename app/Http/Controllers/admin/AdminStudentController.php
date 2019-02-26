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
    	
    	$department= Department::find($id);
    	return view('admin.students.depStudents',compact('students','department'));
    }

     public function yearStudents(Request $request, $id){
        $year=$id;
    	$department = Department::find($request->dep_id);
        $students = Department::find($request->dep_id)->students->where('year',$id);
        return view('admin.students.yearStudents',compact('students','department','year'));
    }
}
