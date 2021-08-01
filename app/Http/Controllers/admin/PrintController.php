<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Department;
use App\User;
use App\Course;
use App\Academic;
use App\StudentsResults;
use App\StudentCumulativeResult;
use Auth;
use App\ExamsSettings;
use App\IncidentReport;
use App\Admin;
use PDF;
use App\Questions;
use App\ExamsQuestions;
use Illuminate\Support\Facades\DB;

class PrintController extends Controller
{

    public function examsHistoryPrint(Request $request){
    	$start_date = date('d-m-Y',strtotime($request->start_date));
    	$academic = Academic::where('status',1)->first();
    	$exams = [];
    	if ($request->end_date!= null) {
    		$end_date = date('d-m-Y',strtotime($request->end_date));
    		$exams = ExamsSettings::whereBetween('exams_date',[$start_date,$end_date])->get()->sortby('exams_date');
    	}
    	else{
    		$end_date = Null;
    		$exams = ExamsSettings::where('exams_date',$start_date)->get()->sortby('exams_date');	
    	}
		$pdf = PDF::loadView('admin.reports.printables.exams_history',compact('start_date','exams','academic','end_date'))->setPaper('a4', 'landscape');
		return $pdf->download('Exams Schedule'.date('d-m-Y h:i'));
    }

    public function attendancePerfPrint(Request $request){
        $academic_year = $request->academic_year;
        $course = $request->course_name;
        $exams_type = $request->exams_type;
        // performance calculation
        // $student_present = StudentsResults::where([['exams_type',$request->exams_type],['academic_year',$request->academic_year],['course_name',$request->course_name]])->get()->sortbydesc('marks_scored');
        if ($request->exams_type == 'Cumulative') {
            $student_present = StudentCumulativeResult::where([['academic_year',$request->academic_year],['course_name',$request->course_name]])->get()->sortbydesc('marks_scored');;
            $results_type = 'cumulative';
        }
        else{
            $student_present = StudentsResults::where([['exams_type',$request->exams_type],['academic_year',$request->academic_year],['course_name',$request->course_name]])->get()->sortbydesc('marks_scored');
            $results_type = 'singles';
        }
        if ($exams_type == "End Of Semester Examination") {
            $pass_mark = 28;
            $total_exams_marks = 70;    
        }
        elseif ($exams_type == "Cumulative") {
            $pass_mark = 40;
            $total_exams_marks = 100;    
        }
        else{
            $pass_mark = 12;
            $total_exams_marks = 30;
        }
        $pass = 0;
        if ($exams_type == "Cumulative") {
            foreach ($student_present as $result) {
                if (($result->mid_sem_mark + $result->end_of_sem_mark) >= $pass_mark) {
                    $pass += 1;
                }
            }
        }
        else{
            foreach ($student_present as $result) {
                if ($result->marks_scored >= $pass_mark) {
                    $pass += 1;
                }
            }
        }
        
        $total_result = $student_present->count();
        // attendace calculation
        $_course = Course::where('name',$course)->first();
        // $total_student = User::where([['dep_id',$_course->dep_id],['year',$_course->year]])->count();
        $all_students = User::where([['dep_id',$_course->dep_id],['year',$_course->year]])->get();
        $total_student = $all_students->count();
        $pdf = PDF::loadView('admin.reports.printables.attendance_and_performance',compact('academic_year','exams_type','course','pass','total_result','total_student','student_present','all_students','pass_mark','total_exams_marks','results_type'));
		return $pdf->download('Attendance And Performance_'.date('d-m-Y h:i'));
    }

    public function incidentReportPrint(Request $request){
    	// return $request->all();
    	$end_date = Null;
    	$exams_id = Null;
    	$start_date = Null;
    	$lecturers_name = Null;
    	$tag_name = Null;
    	if ($request->exams_id != Null) {
    		$exams_id = $request->exams_id;
    		$reports = IncidentReport::where('exams_id',$exams_id)->get();
    		$exam = ExamsSettings::find($exams_id);
    		$course = Course::find($exam->course_id);
    		$heading = "Incident Report For $course->name $exam->title";
    	}
    	elseif ($request->start_date != null && $request->end_date != null) {
    		$start_date = date('d-m-Y',strtotime($request->start_date));
    		$end_date = date('d-m-Y',strtotime($request->end_date));
    		$reports = IncidentReport::whereBetween('reported_date',[$start_date,$end_date])->get();
    		$heading = "Incident Report Writtten from $start_date to $end_date";
    		
    	}
    	elseif ($request->start_date != null) {
    		$start_date = date('d-m-Y',strtotime($request->start_date));
    		$reports = IncidentReport::where('reported_date',$start_date)->get();
    		$heading = "Incident Report Writtten on $start_date";
    	}
    	elseif ($request->lecturers_name != null) {
    		$lecturers_name = $request->lecturers_name;
    		$reports = IncidentReport::where('reporter',$lecturers_name)->get();
    		$heading = "Incident Report Writtten by $lecturers_name";
    	}
    	elseif ($request->tag_name != null) {
    		$tag_name = $request->tag_name;
    		$reports = IncidentReport::where('tag',$tag_name)->get();
    		$heading = "Incident Report Tagged with $tag_name";
    	}
    	$pdf = PDF::loadView('admin.reports.printables.incident_report',compact('reports','heading','tag_name','lecturers_name','start_date','end_date','exams_id'));
		return $pdf->download('Incident Report_'.date('d-m-Y h:i:s'));
    }

    public function studentResultPrint(Request $request){
    	// $results = StudentsResults::where([['exams_type',$request->exams_type],['academic_year',$request->academic_year],['course_name',$request->course_name]])->get();
        if ($request->exams_type == 'Cumulative') {
            $results = StudentCumulativeResult::where([['academic_year',$request->academic_year],['course_name',$request->course_name]])->get();
            $results_type = 'cumulative';
        }
        else{
            $results = StudentsResults::where([['exams_type',$request->exams_type],['academic_year',$request->academic_year],['course_name',$request->course_name]])->get();
            $results_type = 'singles';
        } 
        $academic_year = $request->academic_year;
        $course = $request->course_name;
        $exams_type = $request->exams_type;
        $pdf = PDF::loadView('admin.reports.printables.student_result',compact('academic_year','exams_type','course','results','results_type'));
		return $pdf->download("$academic_year $course $exams_type Result");
    }

    public function resultPrint(Request $request){
        if ($request->exams_type == 'Cumulative') {
            $results = StudentCumulativeResult::where([['student_id',Auth::user()->id],['academic_year',$request->academic_year],['academic_semester',$request->academic_semester]])->get();
            $results_type = 'cumulative';
        }
        else{
            $results = StudentsResults::where([['student_id',Auth::user()->id],['exams_type',$request->exams_type],['academic_year',$request->academic_year],['academic_semester',$request->academic_semester]])->get();
            $results_type = 'singles';
        }
        // $results = StudentsResults::where([['student_id',Auth::user()->id],['exams_type',$request->exams_type],['academic_year',$request->academic_year],['academic_semester',$request->academic_semester]])->get();
        $academic_year = $request->academic_year;
        $academic_sem = $request->academic_semester;
        $exams_type = $request->exams_type;
        $user = User::find(Auth::user()->id);
        $pdf = PDF::loadView('student.printables.studentResult',compact('academic_year','exams_type','academic_sem','results','user','results_type'));
		return $pdf->download("$academic_year Semester $academic_sem $exams_type Result");
        // if ($results->count() > 0) {
        //     return view('student.result.studentResult',compact('academic_year','exams_type','academic_sem','results'));
        // }
        // else{
        //     return redirect()->back()->with('flash_message_error','<h2>Result Not Found<br>Check Your Selected Options Again</h2>');
        // }
        
    }

    public function questionsPrint($id){
        $examQuestions = ExamsQuestions::select('question_id')->where('exams_id',$id)->get();
        $exam = ExamsSettings::find($id);
        $course = Course::find($exam->course_id);
        $department = Department::find($course->dep_id);
        $questions = Questions::whereIn('id',$examQuestions)->get();
        $pdf = PDF::loadView('admin.reports.printables.examsQuestionsPrint',compact('exam','questions','course','department'));
		return $pdf->download("$course->name $exam->title Questions");
        
    }

    public function timetablePrint(){
        $academic = Academic::where('status',1)->first();
    	$a=ExamsSettings::whereIn('course_id',Course::select('id')->where([['dep_id',Auth::user()->dep_id],['year',Auth::user()->year],['semester',$academic->semester]]))->get()->sortby('exams_date');

    	$timetable = $a->where('exams_date','>=',date('d-m-Y'));
        $dep = Department::find(Auth::user()->dep_id);
        $academic = Academic::where('status',1)->first();
        $pdf = PDF::loadView('student.printables.timeTablePrint',compact('timetable','dep','academic'))->setPaper('a4', 'landscape');
		// return $pdf->download("$dep->name ".Auth::user()->year." Exams TimeTable");
		return $pdf->download("$dep->name ".Auth::user()->year." Exams TimeTable");
    	// return view('student.printables.timeTablePrint',compact('timetable','dep','academic'));
    }
}
