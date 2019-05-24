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
use Excel;
use Illuminate\Support\Facades\DB;

class ExportExcelController extends Controller
{
    public function studentResultExcel(Request $request){
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
        // $students_array[] = array('Index Number','Name','Marks');
        if ($results_type == 'cumulative') {
            $students_array[] = array('Index Number','Name','Mid Semester Score','End Of Semester Score','Total Score');
            foreach ($results as $result) {
                $student = User::find($result->student_id);
                $mark = $result->mid_sem_mark + $result->end_of_sem_mark;
                $students_array[] = array(
                    'Index Number' => $student->index_number,
                    'Name' => $student->name,
                    'Mid Semester Score' =>$result->mid_sem_mark,
                    'End Of Semester Score' =>$result->end_of_sem_mark,
                    'Total Score' => "$mark"
                );
            }
        }
        else{
            $students_array[] = array('Index Number','Name','Marks');
            foreach ($results as $result) {
                $student = User::find($result->student_id);
                $students_array[] = array(
                    'Index Number' => $student->index_number,
                    'Name' => $student->name,
                    'Mark' => "$result->marks_scored"
                );
            }
        }
        Excel::create("$academic_year $course $exams_type Result",function($excel) use($students_array){
        	$excel->setTitle("Student Result");
        	$excel->sheet("Student Result",function($sheet) use($students_array){
        		$sheet->fromArray($students_array,NULL,'A1',false,false);
        	});
        })->download('xlsx');
		// return $students_array;
    }
}
