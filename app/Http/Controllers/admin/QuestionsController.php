<?php

namespace App\Http\Controllers\admin;

use Auth;
use App\Questions;
use App\Admin;
use App\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

	public function activateAll($id){
		$questions = Questions::where('course_id',$id)->get();
		foreach ($questions as $question) {
			$question->status = '1';
			$question->save();
		}
		return redirect()->back()->with('flash_message_success',"All Questions Activated Successfully");
	}

	public function deactivateAll($id){
		$questions = Questions::where('course_id',$id)->get();
		foreach ($questions as $question) {
			$question->status = '0';
			$question->save();
		}
		return redirect()->back()->with('flash_message_success',"All Questions Deactivated Successfully");
	}

	public function upload(Request $request)
	{
		// @require_once '\PhpOffice\PhpWord\bootstrap.php';
		// $course = Course::find($id);
		// return view('admin.questions.upload_ques',compact('course'));
		// return 'true';
		// $phpWord = new \PhpOffice\PhpWord\PhpWord();
	      // $objReader = \PhpOffice\PhpWord\IOFactory::createWriter($phpword,'Word2007');
	      // $phpword = \PhpOffice\PhpWord\IOFactory::load('public/IOT.doc','Word2007');

	      // foreach($phpWord->getSections() as $section) {
	      //   foreach($section->getElements() as $element) {
	      //       if(method_exists($element,'getText')) {
	      //           echo($element->getText() . "<br>");
	      //       }
	      //   }
	      // }
	      // $newSection = $phpWord->addSection();
	      // $newSection->addText('Fuck ooooo');

	      // $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord,'Word2007');

	      // try{
	      // 	$objWriter->save('C:/Users/NANA BAAH/Documents/IOT.docx');
	      // }
	      // catch(Exception $e){

	      // }
	      // return response()->download('C:/Users/NANA BAAH/Documents/IOT.docx');

			// $objReader = \PhpOffice\PhpWord\IOFactory::createReader("Word2007");
			// $phpWord = $objReader->load("C:/Users/NANA BAAH/Documents/IOT.docx");

			// foreach($phpWord->getSections() as $section) {
			//     foreach($section->getElements() as $element) {
			//         if(method_exists($element,'getText')) {
			//             return($element->getText() . "<br>");
			//         }
			//     }
			// }
						
		// $sections = $phpWord->getSections(0);
		// $sections = $sections[0];
		// $arrays = $sections->getElements(0);
		// foreach ($arrays as $value) {
		// 	foreach ($value->getElements(0) as $element) {
		// 		echo ($element->getText()."<br>");
		// 	}
		// 	// print_r($value->getElements(0)->getText());
		// }

		// print_r($sections);

		$filename = 'C:/Users/NANA BAAH/Documents/IOT.docx';
		$striped_content = '';
	    $content = '';

	    if(!$filename || !file_exists($filename)) return false;

	    $zip = zip_open($filename);
	    if (!$zip || is_numeric($zip)) return false;

	    while ($zip_entry = zip_read($zip)) {

	        if (zip_entry_open($zip, $zip_entry) == FALSE) continue;

	        if (zip_entry_name($zip_entry) != "word/document.xml") continue;

	        $content .=zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

	        zip_entry_close($zip_entry);


	    }
	    zip_close($zip);      
	    $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
	    $content = str_replace('</w:r></w:p>', "\r\n", $content);
	    $striped_content = strip_tags($content);
	    echo "<pre>";
	    return $striped_content;
	}
}
