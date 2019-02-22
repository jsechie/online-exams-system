<?php

namespace App\Http\Controllers\admin;

use Auth;
use App\Questions;
use App\Admin;
use App\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionsController extends Controller
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
		$questions = Questions::all();
		$courses =  Admin::find(Auth::user()->id)->courses;
        return view('admin.questions.index_ques',compact('questions','courses'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		// $question = Questions::where('id',$id)->first();
  //       return view('admin.questions.edit_ques',compact('question'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$this->validate($request,[
            'question'=>'required',
            'option_A'=>'required',
            'option_B'=>'required',
            'answer'=>'required',
        ]);

        $question =new Questions;
        $question->course_id = $request->course_id;
        $question->question = $request->question;
        $question->option_A = $request->option_A;
        $question->option_B = $request->option_B;
        $question->option_C = $request->option_C;
        $question->option_D = $request->option_D;
        $question->option_E = $request->option_E;
        $question->answer = $request->answer;
        if ($request->has('status')) {
        	$question->status = 1;
        }
        $question->save();
		// return $request->all();
		if ($request->has('next')) {
			return redirect()->route('questions.add',$request->course_id)->with('flash_message_success',"Question Added Successfully");
		}
		else{
        	return redirect()->route('questions.show',$request->course_id)->with('flash_message_success',"Question Added Successfully");
		}
		
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
		$questions=Questions::where('course_id',"$id")->get();
		return view('admin.questions.show_ques',compact('questions','course'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$question = Questions::where('id',$id)->first();
        return view('admin.questions.edit_ques',compact('question'));
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
        if ($request->has('status')) {
        	$question->status = 1;
        }
        $question->update();
        $course_id=$question->course_id;
       	return redirect()->route('questions.show',$course_id)->with('flash_message_success',"Question Updated Successfully");
       	// return redirect($url);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if (Questions::find($id)->status == '1') {
            return redirect()->back()->with('flash_message_error',"!!!Question Active Deactivate Before Deletion");
        }
        else{
			Questions::where('id',$id)->delete();
	        return redirect()->back()->with('flash_message_success',"Question Deleted Successfully");
	    }
	}

	public function createQuestion($id){
		$course = Course::find($id);
		$total = Questions::all()->count();
		return view('admin.questions.create_ques',compact('course','total'));
	}

	public function status($id){
		$question = Questions::find($id);
		if($question->status=='0'){
			$question->status = 1;
			$question->save();

			return redirect()->back()->with('flash_message_success',"Question Activated Successfully");
		}

		if($question->status=='1'){
			$question->status = 0;
			$question->save();

			return redirect()->back()->with('flash_message_success',"Question Deactivated Successfully");
		}
	}
}
