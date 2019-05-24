<?php

namespace App\Http\Controllers\student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Course;
use App\ExamsSettings;
use App\ExamsQuestions;
use App\Department;
use App\Questions;
use App\StudentExamsAnswers;
use App\StudentsResults;
use App\Academic;
use App\StudentCumulativeResult;
class StudentExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $academic = Academic::where('status',1)->first();
    	$courses = Course::where([['dep_id',Auth::user()->dep_id],['year',Auth::user()->year],['status',1],['semester',$academic->semester]])->get();
    	return view('student.exams.index_exams_students',compact('courses'));
    }

    public function timetable(){
        $academic = Academic::where('status',1)->first();
    	$a=ExamsSettings::whereIn('course_id',Course::select('id')->where([['dep_id',Auth::user()->dep_id],['year',Auth::user()->year],['semester',$academic->semester]]))->get()->sortby('exams_date');

    	$timetable = $a->where('exams_date','>=',date('d-m-Y'));
        $dep = Department::find(Auth::user()->dep_id);
        $academic = Academic::where('status',1)->first();
        
    	return view('student.exams.exams_timetable',compact('timetable','dep','academic'));
    }

    public function nextExam(){

    	// $a=ExamsSettings::whereIn('course_id',Course::select('id')->where([['dep_id',Auth::user()->dep_id],['year',Auth::user()->year],['status',1]]))->get()->sortby('exams_date');
    	// $check_status = $a->where('status',1);
     //    $take_exams = $check_status->sortby('exams_date,start_time');

    	// $date = date('d-m-Y');
    	// $time = date('G:i');
     //    if ($check_status->where('exams_date',$date)->count()>0) {
     //       $check_date = $check_status->where('exams_date',$date)->sortby('exams_date,start_time');
     //       $take_exam = $check_status->where('stop_time','<=',$time)->sortby('exams_date,start_time')->first();
     //    }
    	$academic = Academic::where('status',1)->first();
    	$courses = Course::where([['dep_id',Auth::user()->dep_id],['year',Auth::user()->year],['status',1],['semester',$academic->semester]])->get();
    	return view('student.exams.take_exam',compact('courses'));
    }

    public function startExam($id){

    	$exam = ExamsSettings::find($id);
        $examQuestions = ExamsQuestions::select('question_id')->where('exams_id',$id)->get();
        $course = Course::find($exam->course_id);
        $department = Department::find($course->dep_id);
        $questions = Questions::whereIn('id',$examQuestions)->simplePaginate(1);
        $total = Questions::whereIn('id',$examQuestions)->count();
        $pages = $questions->perPage();
        $questions_answered = StudentExamsAnswers::where([['student_id',Auth::user()->id],['exams_id',$id]])->get();
        $questions_remaining = Questions::whereIn('id',$examQuestions)->get();
        if ($exam->exams_date < date('d-m-Y') ||($exam->exams_date == date('d-m-Y') && $exam->stop_time < date('G:i'))){
            return redirect()->back()->with('flash_message_error',"Exams is OVER");
        }
        elseif ($exam->exams_date == date('d-m-Y') && $exam->start_time <= date('G:i') && $exam->stop_time > date('G:i') && $exam->status == 1) {
            $check_status = StudentsResults::where([['exams_id',$id],['student_id',Auth::user()->id]])->count();
            if ($check_status == 0) {
                return view('student.exams.show_exams_students',compact('pages','exam','questions','course','department','total','questions_remaining','questions_answered'));
            }
            else{
                return redirect()->back()->with('flash_message_error',"Exams Already Taken");
            }
        }
    	else{
    		return redirect()->back()->with('flash_message_error',"Exams hasn't being Approved Yet");
    	}
    }

    public function courseExams($id){
        $course= Course::find($id);
        $take_exams = ExamsSettings::where([['course_id',$id],['status',1]])->get();
        return view('student.exams.course_exam',compact('take_exams','course'));
    }

    public function answerQuestion(Request $request, $id){

        $check_status = StudentExamsAnswers::where([['student_id',Auth::user()->id],['question_id',$id]])->get();
        $count = $check_status->count();
        if ($count==0) {
            $answer = new StudentExamsAnswers;
            $answer->student_id = Auth::user()->id;
            $answer->question_id = $id;
            $answer->answer = $request->answer;
            $answer->exams_id = $request->exam_id;
            $answer->save();
            return redirect()->back(); 
        }
        else{
            $check_status = $check_status->first();
            $check_status->answer = $request->answer;
            $check_status->update();
            return redirect()->back(); 
        }
    }

    public function nextQuestion(Request $request, $id){

        $check_status = StudentExamsAnswers::where([['student_id',Auth::user()->id],['question_id',$id],['exams_id',$request->exam_id]])->count();
        $total = ExamsQuestions::where('exams_id',$request->exam_id)->count();
        if ($request->page < $total) {
            if ($check_status==0){
                return redirect()->back()->with('flash_message_error',"<h3>Current Question Needs To be Answered Before Next One is Attempted</h3>");
             }
             else{
                $question_number = $request->page + 1;
                return redirect("students/Exams/startExam/$request->exam_id?page=$question_number"); 
             }
        }
        else{
            return redirect()->back()->with('flash_message_error',"<h3>This is The Last Page</h3>");
        }
    }

    public function submitExams(Request $request, $id){

        $exam = ExamsSettings::find($id);
        $course = Course::find($exam->course_id);
        $examQuestions = ExamsQuestions::select('question_id')->where('exams_id',$id)->get();
        $questions = Questions::whereIn('id',$examQuestions)->get();
        $questions_answered = StudentExamsAnswers::where([['student_id',Auth::user()->id],['exams_id',$id]])->get();
        $marks = 0;
        $total = $questions->count();
        foreach ($questions_answered as $student) {

             foreach ($questions as $question) {
                 if ($student->question_id == $question->id) {
                    if ($student->answer == $question->answer) {
                        $marks += 1;
                    }
                 }
             }
         }

         // for ttest reasons i am going to delete all the students answer
         foreach ($questions_answered as $student) {
             StudentExamsAnswers::where('id',$student->id)->delete();
         }
         $totalMark = round(($marks/$total)*$exam->total_marks,1); 
         // return "You got $marks/$total which is $totalMark/$exam->total_marks";
         $academic = Academic::where('status',1)->first();
         $result = new StudentsResults;
         $result->student_id = Auth::user()->id;
         $result->exams_id = $exam->id;
         $result->course_name = $course->name;
         $result->course_code = $course->code;
         $result->credit_hours = $course->credit_hours;
         $result->exams_type = $exam->title;
         $result->marks_scored = $totalMark;
         $result->academic_year = $academic->year;
         $result->academic_semester = $academic->semester;
         $result->save();

         //adding to the Cumulative record database
         $temp = StudentCumulativeResult::where([['student_id',Auth::user()->id],['course_code',$course->code]])->get();
         if ($temp->count() == 0) {
             $cumulative = new StudentCumulativeResult;
             $cumulative->student_id = Auth::user()->id;
             // $cumulative->exams_id = $exam->id;
             $cumulative->course_name = $course->name;
             $cumulative->course_code = $course->code;
             $cumulative->credit_hours = $course->credit_hours;
             // $cumulative->exams_type = $exam->title;
             if ($exam->title == 'End Of Semester Examination') {
                 $cumulative->end_of_sem_mark = $totalMark;
             }
             else{
                $cumulative->mid_sem_mark = $totalMark;
             }
             $cumulative->academic_year = $academic->year;
             $cumulative->academic_semester = $academic->semester;
             $cumulative->save();

         }
         else{
            $cumulative = $temp->first();
            if ($exam->title == 'End Of Semester Examination') {
                 $cumulative->end_of_sem_mark = $totalMark;
             }
             else{
                $cumulative->mid_sem_mark = $totalMark;
             }
             $cumulative->update();

         }
         return view('student.result.result_after_exams',compact('exam','course','total','totalMark','marks'));
    }

    public function resultSearch(){
        $academics = Academic::select('year')->distinct()->get();
        return view('student.result.result_search_page',compact('academics'));
    }

    public function viewResult(Request $request){
        $this->validate($request,[
            'exams_type'=>'required',
            'academic_year'=>'required',
            'academic_semester'=>'required',
        ]);
        if ($request->exams_type == 'Cumulative') {
            $results = StudentCumulativeResult::where([['student_id',Auth::user()->id],['academic_year',$request->academic_year],['academic_semester',$request->academic_semester],['mid_sem_mark','<>',Null],['end_of_sem_mark','<>',Null]])->get();
            $results_type = 'cumulative';
        }
        else{
            $results = StudentsResults::where([['student_id',Auth::user()->id],['exams_type',$request->exams_type],['academic_year',$request->academic_year],['academic_semester',$request->academic_semester]])->get();
            $results_type = 'singles';
        }
        
        $academic_year = $request->academic_year;
        $academic_sem = $request->academic_semester;
        $exams_type = $request->exams_type;
        if ($results->count() > 0) {
            return view('student.result.studentResult',compact('academic_year','exams_type','academic_sem','results','results_type'));
        }
        else{
            return redirect()->back()->with('flash_message_error','<h2>Result Not Found<br>Check Your Selected Options Again</h2>');
        }
        
    }

    public function viewResultReport(Request $request){
        $academic_year = $request->academic_year;
        $academic_semester = $request->academic_sem;
        $exams_type = $request->exams_type;
        // performance calculation
        
        if ($request->exams_type == 'Cumulative') {
            $results = StudentCumulativeResult::where([['student_id',Auth::user()->id],['academic_semester',$academic_semester],['academic_year',$academic_year],['mid_sem_mark','<>',Null],['end_of_sem_mark','<>',Null]])->get();
            $results_type = 'cumulative';
        }
        else{
            $results = StudentsResults::where([['student_id',Auth::user()->id],['exams_type',$exams_type],['academic_semester',$academic_semester],['academic_year',$academic_year]])->get();
            $results_type = 'singles';
        }
        if ($exams_type == "End Of Semester Examination") {
            $pass_mark = 28;    
        }
        elseif ($exams_type == "Cumulative") {
            $pass_mark = 40;    
        }
        else{
            $pass_mark = 12;
        }
        $pass = 0;
        if ($exams_type == "Cumulative") {
            foreach ($results as $result) {
                if (($result->mid_sem_mark + $result->end_of_sem_mark) >= $pass_mark) {
                    $pass += 1;
                }
            }   
        }
        else{
            foreach ($results as $result) {
                if ($result->marks_scored >= $pass_mark) {
                    $pass += 1;
                }
            }
        }
        
        $total_result = $results->count();
       return view('student.reports.result_report',compact('academic_year','exams_type','academic_semester','pass','total_result')); 
    }

}
