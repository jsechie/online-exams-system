<?php

namespace App\Http\Controllers\student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Course;
use App\ExamsSettings;
use App\Academic;
class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	//get the courses with their years equalling that of the student 
        $academic = Academic::where('status',1)->first();
    	$courses = Course::where([['dep_id',Auth::user()->dep_id],['year',Auth::user()->year],['status',1],['semester',$academic->semester]])->get();
    	// $allexams = ExamsSettings::whereIn('course_id',Course::select('id')->where([['dep_id',1],['year',3],['status',1]]))->get();
    	// $timetable = $allexams->where('status',1);
    	return view('student.course.regCourse',compact('courses'));

    }
}
