<?php

namespace App\Http\Controllers\admin;

use Auth;
use App\Questions;
use App\Admin;
use App\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
// use PhpOffice\PhpWord\Exception\Exception;

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
		// $questions = Questions::all();
		$courses =  Admin::find(Auth::user()->id)->courses;
        return view('admin.questions.index_ques',compact('courses'));
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
        // if ($request->has('status')) {
        // 	$question->status = 1;
        // }
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
		$active= Questions::where([['course_id',$id],['status','1']])->count();
		$course = Course::find($id);
		$questions=Questions::where('course_id',"$id")->get();
		return view('admin.questions.show_ques',compact('questions','course','active'));
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
        // if ($request->has('status')) {
        // 	$question->status = 1;
        // }
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
        	$exams = Questions::find($id)->exams;
        	foreach ($exams as $exam) {
        		$exam->delete();
        	}
			Questions::where('id',$id)->delete();
	        return redirect()->back()->with('flash_message_success',"Question Deleted Successfully");
	    }
	}

	public function createQuestion($id){
		$course = Course::find($id);
		$total = Course::find($id)->questions->count();
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

	// public function activateAll($id){
	// 	$questions = Questions::where('course_id',$id)->get();
	// 	foreach ($questions as $question) {
	// 		$question->status = '1';
	// 		$question->save();
	// 	}
	// 	return redirect()->back()->with('flash_message_success',"All Questions Activated Successfully");
	// }

	// public function deactivateAll($id){
	// 	$questions = Questions::where('course_id',$id)->get();
	// 	foreach ($questions as $question) {
	// 		$question->status = '0';
	// 		$question->save();
	// 	}
	// 	return redirect()->back()->with('flash_message_success',"All Questions Deactivated Successfully");
	// }

	public function upload(Request $request){
		$this->validate($request,[
            'questions'=>'required|file|filled|mimes:txt',
        ]);

        if ($request->has('active')) {
        	$status = 1;
        }
		$path = $request->questions->getRealPath();//get the files path on upload
		// 	when the usser upload the question in txt form;
		// Now it we open the test file for upload
     	$file = file($path);//get store the file
		$file = str_replace('Answer = A', '||A??', $file);
		$file = str_replace('Answer = B', '||B??', $file);
		$file = str_replace('Answer = C', '||C??', $file);
		$file = str_replace('Answer = D', '||D??', $file);
		$file = str_replace('Answer = E', '||E??', $file);
		$file = str_replace('A.', '||', $file);
		$file = str_replace('B.', '||', $file);
		$file = str_replace('C.', '||', $file);
		$file = str_replace('D.', '||', $file);
		$file = str_replace('E.', '||', $file);
		$file = str_replace("\r\n", '', $file);
		$file = str_replace('</w:r></w:p></w:tc><w:tc>', " ",$file);
		$combine = "";	
		foreach ($file as $values) {
			$combine .= $values;	
		}
		$questions = explode("??", $combine);
		if (count($questions)>1) {
			$counter=1;
			foreach ($questions as $value) {
				if ($counter == count($questions)) {
					break;
				}
				$new_question = new Questions;
				$new_question->course_id = $request->course_id;
				if ($request->has('active')) {
		        	$new_question->status = 1;
		        }
				$question= explode("||", $value);
				$total = count($question);
				if ($total >3) {
					$i=1;
					foreach ($question as $upload){
						if ($total==4) {
							switch ($i) {
								case 1:
									$new_question->question = $upload;
									break;
								case 2:
									$new_question->option_A = $upload;
									break;
								case 3:
									$new_question->option_B = $upload;
									break;

								case 4:
									$new_question->answer = $upload;
									break;
								default:
									# code...
									break;
							}
							++$i;
						}

						elseif ($total==5) {
							switch ($i) {
								case 1:
									$new_question->question = $upload;
									break;
								case 2:
									$new_question->option_A = $upload;
									break;
								case 3:
									$new_question->option_B = $upload;
									break;

								case 4:
									$new_question->option_C = $upload;
									break;
								case 5:
									$new_question->answer = $upload;
									break;
								default:
									# code...
									break;
							}
							++$i;
						}
						
						elseif ($total==6) {
							switch ($i) {
								case 1:
									$new_question->question = $upload;
									break;
								case 2:
									$new_question->option_A = $upload;
									break;
								case 3:
									$new_question->option_B = $upload;
									break;

								case 4:
									$new_question->option_C = $upload;
									break;
								case 5:
									$new_question->option_D = $upload;
									break;
								case 6:
									$new_question->answer = $upload;
									break;
								default:
									# code...
									break;
							}
							++$i;
						}

						elseif ($total==7) {
							switch ($i) {
								case 1:
									$new_question->question = $upload;
									break;
								case 2:
									$new_question->option_A = $upload;
									break;
								case 3:
									$new_question->option_B = $upload;
									break;

								case 4:
									$new_question->option_C = $upload;
									break;
								case 5:
									$new_question->option_D = $upload;
									break;
								case 6:
									$new_question->option_E = $upload;
									break;
								case 7:
									$new_question->answer = $upload;
									break;
								default:
									# code...
									break;
							}
							++$i;
						}
						
						// echo "<li>$question[$i]</li>";
					}

					$new_question->save();
					++$counter;
				}

				else{//let the user know its needs at least two choices
					return redirect()->back()->with('flash_message_error',"All Questions must atleast HAVE TWO choices Please check well!!!");
				}
			}
			$total = count($questions)-1;
			return redirect()->route('questions.show',$request->course_id)->with('flash_message_success',"$total Questions Uploaded Successfully");
		}
		else{
			return redirect()->back()->with('flash_message_error',"The File being uploaded is not in the FROMAT requsted Please check well!!!");
		}
	}
	
	// public function randomActivate(Request $request)
	// {
	// 	$this->validate($request,[
 //            'random_number'=>"required",
 //        ]);
	// 	$random = DB::select("select * from questions where status = 0 order by Rand() limit $request->random_number");

	// 	foreach ($random as $value) {
	// 		$question = Questions::find($value->id);
	// 		$question->status = 1;
	// 		$question->update();
	// 	}
		

 //        return redirect()->back()->with('flash_message_success',"$request->random_number Questions Activated Successfully");
	// }

	// public function randomDeactivate(Request $request)
	// {
	// 	$this->validate($request,[
 //            'random_number'=>"required",
 //        ]);
	// 	$random = DB::select("select * from questions where status = 1 order by Rand() limit $request->random_number");

	// 	foreach ($random as $value) {
	// 		$question = Questions::find($value->id);
	// 		$question->status = 0;
	// 		$question->update();
	// 	}
		

 //        return redirect()->back()->with('flash_message_success',"$request->random_number Questions Deactivated Successfully");
	// }
}