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
use App\ExamsSettings;
use App\IncidentReport;
use App\Admin;
use PDF;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //report index page
    public function index(){
    	$academics = Academic::select('year')->distinct()->get();
        $courses = Course::all();
        $exams = ExamsSettings::all();
        $lecturers = Admin::all();
    	return view('admin.reports.examiners.index',compact('academics','courses','exams','lecturers'));
    }

    public function attendanceReport(Request $request){
    	$this->validate($request,[
            'academic_year'=>'required',
            'course_name'=>'required',
            'exams_type'=>'required',
        ]);
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

        if ($results->count() > 0) {
            return view('admin.reports.examiners.attendance_and_Performance',compact('academic_year','exams_type','course','pass','total_result','total_student')); 
        }
        else{
            return redirect()->back()->with('flash_message_error','<h3>Exams Not Yet Taken By Student<br>Check Your Selected Options Again</h3>');
        }
       // return view('admin.reports.examiners.attendance_and_Performance',compact('academic_year','exams_type','course','pass','total_result','total_student')); 
    }

    public function examsHistoryReport(Request $request){
    	$start_date = date('d-m-Y',strtotime($request->start_date));
    	$academic = Academic::where('status',1)->first();
    	// $exams = [];
    	if ($request->end_date != Null) {
    		$end_date = date('d-m-Y',strtotime($request->end_date));
    		$exams = ExamsSettings::whereBetween('exams_date',[$start_date,$end_date])->get()->sortby('exams_date');
            $error = "No Exams Available from $start_date to $end_date";
    	}
    	else{
    		$end_date = Null;
    		$exams = ExamsSettings::where('exams_date',$start_date)->get()->sortby('exams_date');
            $error = "No Exams Available On $start_date";	
    	}
		if ($exams->count()>0) {
			return view('admin.reports.examiners.exams_history',compact('exams','start_date','end_date','academic'));
		}
		else{
        	return redirect()->back()->with('flash_message_error',"<h3>$error</h3>");
    	}
    }

    public function incidentReport(Request $request){
    	$reports = [];
    	$end_date = Null;
    	$exams_id = Null;
    	$start_date = Null;
    	$lecturers_name = Null;
    	$tag_name = Null;
    	if ($request->has('exams_id')) {
    		$exams_id = $request->exams_id;
    		$reports = IncidentReport::where('exams_id',$exams_id)->get();
    		$exam = ExamsSettings::find($exams_id);
    		$course = Course::find($exam->course_id);
    		$heading = "Incident Report For $course->name $exam->title";
    		$error = "No Report On This Exams";
    	}
    	elseif ($request->has('report_start_date') && $request->has('report_end_date')) {
    		$start_date = date('d-m-Y',strtotime($request->report_start_date));
    		$end_date = date('d-m-Y',strtotime($request->report_end_date));
    		$reports = IncidentReport::whereBetween('reported_date',[$start_date,$end_date])->get();
    		$heading = "Incident Report Writtten from $start_date to $end_date";
    		$error = "No Report Written from $start_date to $end_date";
    		
    	}
    	elseif ($request->has('report_start_date')) {
    		$start_date = date('d-m-Y',strtotime($request->report_start_date));
    		$reports = IncidentReport::where('reported_date',$start_date)->get();
    		$heading = "Incident Report Writtten on $start_date";
    		$error = "No Report Written on $start_date";
    	}
    	elseif ($request->has('lecturers_name')) {
    		$lecturers_name = $request->lecturers_name;
    		$reports = IncidentReport::where('reporter',$lecturers_name)->get();
    		$heading = "Incident Report Writtten by $lecturers_name";
    		$error = "No Report Written by $lecturers_name";
    	}
    	elseif ($request->has('tag_name')) {
    		$tag_name = $request->tag_name;
    		$reports = IncidentReport::where('tag',$tag_name)->get();
    		$heading = "Incident Report Tagged with $tag_name";
    		$error = "No Report Tagged with $tag_name";
    	}
    	if ($reports->count()>0) {
			return view('admin.reports.examiners.incident_report',compact('reports','heading','tag_name','lecturers_name','start_date','end_date','exams_id'));
		}
		else{
        return redirect()->back()->with('flash_message_error',"<h3>$error</h3>");
    	}
    }


}
