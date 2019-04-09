<?php

namespace App\Http\Controllers\admin;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Course;
use App\Admin;
use App\ExamsSettings;
use App\ExamsQuestions;
use App\Questions;
use App\Department;

// use App\Http\Controllers\admin\Questions; 

class ExamsSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**

     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses =  Admin::find(Auth::user()->id)->courses;
        return view('admin.ExamsSettings.exams_index',compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // $this->validate($request,[
      //     'title'=>'required',
      //     'marks'=>'required',
      //     'start_time'=>'required',
      //     'stop_time'=>"required|",
      //     'exams_date'=>'required|date|after_or_equal:today',
      // ]);
      
      // if ($request->start_time >= $request->stop_time) {
      //   session()->flash('flash_message_error',"Exams Start time must always be leass Than the Ending time");
      //   return redirect()->back();
      //   }

      //   else{
      //     $exams =new ExamsSettings;
      //     $exams->course_id = $request->course_id;
      //     $exams->title = $request->title;
      //     $exams->total_marks = $request->marks;
      //     $exams->exams_date =  date("d-m-Y",strtotime($request->exams_date));
      //     $exams->start_time = date('G:i',strtotime($request->start_time));
      //     $exams->stop_time = date('G:i',strtotime($request->stop_time));
      //     $exams->instructions = $request->instructions;
      //     $exams->save();
          
      //     $questions = Course::find($request->course_id)->questions->where('status',1);
      //     foreach ($questions as $question) {
      //           $test = new ExamsQuestions;
      //           $test->question_id = $question->id;
      //           $test->exams_id = $exams->id;
      //           $test->save();
      //       }  

      //       return redirect()->back()->with('flash_message_success',"New Exams Created Successfully");
      //   }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $duration = DB::select("select TIMEDIFF(stop_time,start_time) as diff from exams_settings order by exams_date");
        $course = Course::find($id);
        $exam=ExamsSettings::where('course_id',"$id")->get()->sortby('exams_date');
        return view('admin.ExamsSettings.show_exams',compact('exam','course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exam = ExamsSettings::find($id);
        return view('admin.ExamsSettings.edit_exams',compact('exam'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            // 'title'=>'required',
          // 'marks'=>'required',
          'start_time'=>'required',
          'stop_time'=>"required|",
          'exams_date'=>'required|date|after_or_equal:today',
        ]);
        
        if (strtotime($request->start_time) >= strtotime($request->stop_time)) {
        session()->flash('flash_message_error',"Exams Start time must always be leass Than the Ending time");
        return redirect()->back();
        }

        else{
          $exams =ExamsSettings::find($id);
          // $exams->title = $request->title;
          // $exams->total_marks = $request->marks;
          $exams->exams_date =  date("d-m-Y",strtotime($request->exams_date));
          $exams->start_time = date('G:i',strtotime($request->start_time));
          $exams->stop_time = date('G:i',strtotime($request->stop_time));
          $exams->instructions = $request->instructions;
          $exams->update(); 

          return redirect()->route('examsSettings.show',$exams->course_id)->with('flash_message_success',"Exams Updated Successfully");
        } 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (ExamsSettings::find($id)->status == '1') {
            return redirect()->back()->with('flash_message_error',"!!!Exams Active Deactivate Before Deletion");
        }
        else{
            $exams = ExamsSettings::find($id)->questions;
            foreach ($exams as $exam) {
                $exam->delete();
            }
            ExamsSettings::where('id',$id)->delete();
            return redirect()->back()->with('flash_message_success',"Exams Deleted Successfully");
        }
    }

    //viewing the exams questions by the admin
    public function view($id){
        $examQuestions = ExamsQuestions::select('question_id')->where('exams_id',$id)->get();
        $exam = ExamsSettings::find($id);
        $course = Course::find($exam->course_id);
        $department = Department::find($course->dep_id);
        $questions = Questions::whereIn('id',$examQuestions)->get();
        return view('admin.ExamsSettings.view_exams',compact('exam','questions','course','department'));
    }

    public function removeAll($id){
        $examQuestions = ExamsQuestions::select('question_id')->where('exams_id',$id)->get();
        $exam = ExamsSettings::find($id);
        $questions = ExamsQuestions::whereIn('question_id',$examQuestions)->get();
        foreach ($questions as $question) {
          $question->delete();
        }
        return redirect()->back()->with('flash_message_success',"All Question Removed Successfully");
    }


    public function status($id){
        $exam = ExamsSettings::find($id);
        $total = ExamsSettings::find($id)->questions->count();
        if($exam->status=='0'){
            if ($total > 0 && $exam->exams_date != NULL && $exam->start_time != NULL && $exam->stop_time != NULL) {
              $exam->status = 1;
              $exam->save();

              return redirect()->back()->with('flash_message_success',"$exam->title Activated Successfully");
            }

            else{
              return redirect()->back()->with('flash_message_error',"<h3>NB: In order to Activate An Exams</h3><ul><li><h4>The Exams must have some Total Question greater than 0</h4></li><li><h4>The exams date and Times must be set</h4></li></ul>");
            }
        }

        if($exam->status=='1'){
            $exam->status = 0;
            $exam->save();

            return redirect()->back()->with('flash_message_success',"$exam->title Deactivated Successfully");
        }
    }

    public function removeQuestion(Request $request,$id){
        ExamsQuestions::where([['question_id',$id],['exams_id',$request->exams_id]])->delete();

       return redirect()->back()->with('flash_message_success',"Question Removed Successfully");
    }


    public function updateQuestion(Request $request, $id)
    {
        $this->validate($request,[
            'question'=>'required',
            'option_A'=>'required',
            'option_B'=>'required',
            'answer'=>'required',
        ]);
        
        $question = Questions::find($id);        
        $question->question = $request->question;
        $question->option_A = $request->option_A;
        $question->option_B = $request->option_B;
        $question->option_C = $request->option_C;
        $question->option_D = $request->option_D;
        $question->option_E = $request->option_E;
        $question->answer = $request->answer;
        $question->update();
        return redirect()->back()->with('flash_message_success',"Question Updated Successfully");
        // return redirect($url);
    }

    public function moreQuestions($id){
        $exam=ExamsSettings::find($id);
        $questions = ExamsQuestions::select('question_id')->where('exams_id',$id)->get();
        $examQuestions= Questions::whereIn('id',$questions)->get();
        $courseQuestions = Course::find($exam->course_id)->questions;
        return view('admin.ExamsSettings.addquestion_exams',compact('exam','courseQuestions','examQuestions'));
        
    }

    public function addQuestions(Request $request, $id)
    {
        // return $request->exams_id;
        $ExamsQuestion = new ExamsQuestions;        
        $ExamsQuestion->question_id = $id;
        $ExamsQuestion->exams_id = $request->exams_id;
        $ExamsQuestion->save();
        return redirect()->back()->with('flash_message_success',"Question Added Successfully");
        // return redirect($url);
    }

    public function addAll($id){
      $exam=ExamsSettings::find($id);
      $questions = ExamsQuestions::select('question_id')->where('exams_id',$id)->get();
      $examQuestions= Questions::whereIn('id',$questions)->get();
      $courseQuestions = Course::find($exam->course_id)->questions;
      // return $examQuestions; 

      foreach($courseQuestions as $question){
        $status = 1;
        foreach($examQuestions as $examQuestion){
          if($question->id == $examQuestion->id){
            $status = 0;
            break;
          }
        }
        if ($status == 1) {
          $ExamsQuestion = new ExamsQuestions;        
          $ExamsQuestion->question_id = $question->id;
          $ExamsQuestion->exams_id = $id;
          $ExamsQuestion->save();
        }
      }
      return redirect()->back()->with('flash_message_success',"All Question Added Successfully"); 
    }

    // public function randomAdd(Request $request)
    // {
    //  $this->validate($request,[
    //           'random_number'=>"required",
    //       ]);
    //  $random = DB::select("select * from questions where status = 0 order by Rand() limit $request->random_number");

    //  foreach ($random as $value) {
    //    $question = Questions::find($value->id);
    //    $question->status = 1;
    //    $question->update();
    //  }
      

    //       return redirect()->back()->with('flash_message_success',"$request->random_number Questions Activated Successfully");
    // }

}
