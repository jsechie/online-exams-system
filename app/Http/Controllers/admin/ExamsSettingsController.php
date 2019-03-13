<?php

namespace App\Http\Controllers\admin;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Course;
use App\Admin;
use App\ExamsSettings;
use App\ExamsQuestions;
use App\Questions;

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
        // return $request->all();
        $this->validate($request,[
            'title'=>'required',
            'marks'=>'required',
        ]);
        
        $exams =new ExamsSettings;
        $exams->course_id = $request->course_id;
        $exams->title = $request->title;
        $exams->total_marks = $request->marks;
        $exams->instructions = $request->instructions;
        $exams->save();
        
        $questions = Course::find($request->course_id)->questions->where('status',1);
        foreach ($questions as $question) {
              $test = new ExamsQuestions;
              $test->question_id = $question->id;
              $test->exams_id = $exams->id;
              $test->save();
          }  

        return redirect()->back()->with('flash_message_success',"New Exams Created Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::find($id);
        $exam=ExamsSettings::where('course_id',"$id")->get();
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
            'title'=>'required',
            'marks'=>'required',
        ]);
        
        $exams =ExamsSettings::find($id);
        $exams->title = $request->title;
        $exams->total_marks = $request->marks;
        $exams->instructions = $request->instructions;
        $exams->save();  

        return redirect()->route('examsSettings.show',$exams->course_id)->with('flash_message_success',"Exams Updated Successfully");
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
        $questions = Questions::whereIn('id',$examQuestions)->get();
        return view('admin.ExamsSettings.view_exams',compact('exam','questions'));
    }

    public function status($id){
        $exam = ExamsSettings::find($id);
        if($exam->status=='0'){
            $exam->status = 1;
            $exam->save();

            return redirect()->back()->with('flash_message_success',"$exam->title Activated Successfully");
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

}
