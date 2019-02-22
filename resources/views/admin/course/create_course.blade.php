@extends('layouts.admin_layouts.admin_design')

@section('content')

	<div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <section class="content-header">
	      <h1>
	        Create
	        <small>New Course</small>
	      </h1><br>
	      	@if(count($errors)>0)
				@foreach($errors->all() as $error)
					<div class="alert alert-error alert-block">
			    		<button type="button" class="close" data-dismiss="alert">x</button>
			    		<strong>{{$error}}</strong>
			    	</div>
				@endforeach
			@endif
	      <ol class="breadcrumb">
	        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
	        <li class=""><a href="{{route('course.index')}}"">Course</a></li><li class="active">Add</li>
	      </ol>
	    </section>
	      <!-- /.content -->
	      <div class="row">
	        <div class="col-md-4"></div>
	        <div class="col-md-4">
	          <hr>
	          <a class="btn btn-block btn-primary" href="{{route('course.index')}}"'" >View Course</a>
	        </div>
	        <div class="col-md-4"></div>
	      </div>

	    <section class="content">
	      <div class="row">
	        <div class="col-md-8 col-md-offset-2">
	          <!-- general form elements -->
	          <div class="box box-primary">
	            <div class="box-header with-border">
	              <h3 class="box-title">Add Course Form</h3>
	              <br>
	            </div>
	            <!-- /.box-header -->
	            <!-- form start -->
	            <form role="form" method="post" action="{{route('course.store')}}">
	            {{csrf_field()}}
	              <div class="box-body">
	                <div class="form-group col-md-7">
	                  <label for="course_name">Course Name</label>
	                  <input type="text" class="form-control" id="course_name" placeholder="Name" name="course_name" value="{{old('course_name')}}">
	                </div>
	                <div class="form-group col-md-3">
	                  <label for="course_code">Course Code</label>
	                  <input type="text" class="form-control" id="course_code" placeholder="Code" name="course_code"  value="{{old('course_code')}}">
	                </div> 
	                <div class="form-group col-md-2">
	                  <label for="course_code">Credit Hours</label>
	                  <input type="number" class="form-control" id="credit_hours" name="credit_hours"  value="{{old('credit_hours')}}">
	                </div>               
		             <div class="form-group col-md-12">
		              	<label >Department Name</label>
		              	<select class="form-control" name="department_name">
		              		<option value="">---Select Department---</option>
			                @foreach($departments as $department)
		                  		<option value="{{$department->id}}" {{old('department_name')==$department->id? 'selected':'' }}>{{$department->name}}</option>
		                  	@endforeach
		              	</select>
		              </div>
		              <div class="form-group col-md-6">
		              	<label >Semester</label>
		              	<select name="semester" class="form-control">
		                  	<option value="">---Select Semester---</option>
		                  	<option value="1" {{old('semester')=='1'? 'selected':'' }}>1</option>		                
		                  	<option value="2" {{old('semester')=='2'? 'selected':'' }}>2</option>
		                </select>
		              </div>
		              <div class="form-group col-md-6">
		              	<label >Year</label>
		              	<select name="year" class="form-control">
		              		@php $years =['1','2','3','4','5','6']; @endphp
		              		<option value="">---Select Year---</option>
		              		@foreach($years as $year)
		                  	<option value="{{$year}}" {{old('year')==$year? 'selected':'' }}>{{$year}}</option>
		                  	@endforeach
		                </select>
		              </div>
		              <div class="form-group col-md-12">
		              	<label >Assign Course To</label>
		              	<select name="assigned_to" class="form-control">
		              		<option value="">---None---</option>
		                   @foreach($users as $user)
		                  		<option value="{{$user->id}}" {{old('assigned_to')==$user->id? 'selected':'' }}>{{$user->name}}</option>
		                  	@endforeach
		                </select>
		              </div>
	              <div class="box-footer col-md-12">
	              	<a href="{{route('course.index')}}" class="btn btn-danger">Cancel</a>
	                <button type="submit" class="btn btn-primary pull-right">Add New</button>
	              </div>
	            </form>
	          </div>
	          <!-- /.box -->
	      </div>
    </section>
  </div>

@endsection