@extends('layouts.admin_layouts.admin_design')

@section('content')

	 <div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <section class="content-header">
	      <h1>
	       Update
	        <small>Department Info</small>
	      </h1><br>
	      	@include('messages.errors')
	      <ol class="breadcrumb">
	        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
	        <li class=""><a href="{{route('department.index')}}"">Department</a></li><li class="active">Update</li>
	      </ol>
	    </section>
	      <!-- /.content -->
	     <div class="row">
	       <div class="col-md-4"></div>
	        <div class="col-md-4">
	          <hr>
	          <a class="btn btn-block btn-primary" href="{{route('department.index')}}"'" >View Department</a>
	        </div>
	      <div class="col-md-4"></div>
      </div>

    <section class="content">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Update Department Form</h3>
              <br>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{route('department.update',$department->id)}}">
              {{csrf_field()}}
		          {{method_field('PATCH')}}
              <div class="box-body">
                <div class="form-group">
                  <label for="department_name">Department Name</label>
                  <input type="text" class="form-control" id="department_name" placeholder="Name" name="department_name" value="{{$department->name}}" {{old('department_name')}}>
                </div>
                <div class="form-group">
                  <label for="department_code">Deparment Code</label>
                  <input type="text" class="form-control" id="department_code" placeholder="Code" name="department_code" value="{{$department->code}}">
                </div>                
              <div class="box-footer">
              	<a href="{{route('department.index')}}" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-primary pull-right">Update New</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
      </div>
    </section>
  </div>
@endsection