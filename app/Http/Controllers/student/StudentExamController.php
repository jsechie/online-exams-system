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
class StudentExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$courses = Course::where([['dep_id',Auth::user()->dep_id],['year',Auth::user()->year],['status',1]])->get();
    	return view('student.exams.index_exams_students',compact('courses'));
    }

    public function timetable(){
    	$a=ExamsSettings::whereIn('course_id',Course::select('id')->where([['dep_id',Auth::user()->dep_id],['year',Auth::user()->year]]))->get()->sortby('exams_date');

    	$timetable = $a;
        
    	return view('student.exams.exams_timetable',compact('timetable'));
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
    	
    	$courses = Course::where([['dep_id',Auth::user()->dep_id],['year',Auth::user()->year],['status',1]])->get();
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
    	if ($exam->exams_date == date('d-m-Y') && $exam->start_time <= date('G:i') && $exam->stop_time >= date('G:i') && $exam->status == 1) {
    		return view('student.exams.show_exams_students',compact('pages','exam','questions','course','department','total','questions_remaining','questions_answered'));
    	}
    	else{
    		return redirect()->back()->with('flash_message_error',"Exams hasn't being Approved Yet");
    	}
    }

    public function courseExams($id){
        $course= Course::find($id);
        $take_exams = ExamsSettings::where('course_id',$id)->get();
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
        if ($check_status==0) {
            return redirect()->back()->with('flash_message_error',"<h2>Current Question Needs To be Answered Before Next One is Attempted</h2>"); 
        }
        else{
            $question_number = $request->page + 1;
            return redirect("students/Exams/startExam/$request->exam_id?page=$question_number"); 
        }
    }

    public function submitExams($id){

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
         return view('student.result.result_after_exams',compact('exam','course','total','totalMark','marks'));
    }


}
