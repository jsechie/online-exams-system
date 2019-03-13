<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Academic;
class AcademicsController extends Controller
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
        $academics = Academic::all();
        return view('admin.academics.index_academics',compact('academics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.academics.create_academics');
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
            'academic_year'=>'required|string|unique:academics,year',
        ]);
        $academics =new Academic;
        $academics->year = $request->academic_year;
        $academics->semester = "1";
        $academics->save();

        $academics =new Academic;
        $academics->year = $request->academic_year;
        $academics->semester = "2";
        $academics->save();

        return redirect(route('academics.index'))->with('flash_message_success'," $academics->year Academic Year Added Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $allAcademics = Academic::all();
        $academic = Academic::where('id',$id)->first();
        return view('admin.academics.edit_academics',compact('academic','allAcademics'));
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
            'academics_year'=>'required|string',
            'academics_sem'=>'required|string',
        ]);

        $academics =Academic::find($id);
        $academics->year = $request->academics_year;
        $academics->semester = $request->academics_sem;
        $academics->save();

        return redirect(route('academics.index'))->with('flash_message_success',"Academic Year Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Academic::where('id',$id)->delete();
        return redirect()->back()->with('flash_message_success','Academic Year Deleted Successfully');
    }

    public function status($id){
        $academic = Academic::find($id);
        if($academic->status=='0'){
            $academics = Academic::all();
            foreach ($academics as $value) {
                $value->status = 0;
                $value->save();
            }
            $academic->status = 1;
            $academic->save();
            return redirect()->back()->with('flash_message_success',"Academic Activated Successfully");
        }

        if($academic->status=='1'){
            return redirect()->back()->with('flash_message_error',"Can't Deactivate Academic Year \n Just switch to current Academic Year of choice");
        }
    }

}
