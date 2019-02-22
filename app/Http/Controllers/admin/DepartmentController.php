<?php

namespace App\Http\Controllers\admin;
use App\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $departments = Department::all();
        return view('admin.department.index_dep',compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.department.create_dep');
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
            'department_name'=>'required|string|unique:departments,name',
            'department_code'=>'required|max:3|string|min:3|unique:departments,code',
        ]);

        $department =new Department;
        $department->name = $request->department_name;
        $department->code = $request->department_code;
        $department->save();

        return redirect(route('department.index'))->with('flash_message_success',"$department->name Added Successfully");
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
        $department = Department::where('id',$id)->first();
        return view('admin.department.edit_dep',compact('department'));
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
            'department_name'=>"required|string|unique:departments,name,$id",
            'department_code'=>"required|max:3|string|min:3|unique:departments,code,$id",
        ]);

        $department = Department::find($id);
        $department->name = $request->department_name;
        $department->code = $request->department_code;
        $department->update();

        return redirect(route('department.index'))->with('flash_message_success',"$department->name Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Department::where('id',$id)->delete();
        return redirect()->back()->with('flash_message_success',"Department Deleted Successfully");
    }
}
