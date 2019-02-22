@extends('layouts.admin_layouts.admin_design')

@section('content')

	<div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <section class="content-header">
	      <h1>
	        Update
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
	        <li class=""><a href="{{route('course.index')}}"">Course</a></li><li class="active">Update</li>
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
	              <h3 class="box-title">Update Course Form</h3>
	              <br>
	            </div>
	            <!-- /.box-header -->
	            <!-- form start -->
	            <form role="form" method="post" action="{{route('course.update',$course->id)}}">
	            {{csrf_field()}}
	            {{method_field('PATCH')}}
	              <div class="box-body">
	                <div class="form-group col-md-7">
	                  <label for="course_name">Course Name</label>
	                  <input type="text" class="form-control" id="course_name" placeholder="Name" name="course_name" value="{{$course->name}}">
	                </div>
	                <div class="form-group col-md-3">
	                  <label for="course_code">Course Code</label>
	                  <input type="text" class="form-control" id="course_code" placeholder="Code" name="course_code" value="{{$course->code}}">
	                </div> 
	                <div class="form-group col-md-2">
	                  <label for="course_code">Credit Hours</label>
	                  <input type="number" class="form-control" id="credit_hours" name="credit_hours" value="{{$course->credit_hours}}">
	                </div>               
		             <div class="form-group col-md-12">
		              	<label >Department Name</label>
		              	<select class="form-control" name="dep_id">
			                @foreach($departments as $department)
		                  		<option value="{{$department->id}}" 
		                  			@if($course->dep_id == $department->id) selected="selected" @endif 
		                  			>{{$department->name}}</option>
		                  	@endforeach
		              	</select>
		              </div>
		              <div class="form-group col-md-6">
		              	<label >Semester</label>
		              	<select name="semester" class="form-control">
		                  	<option value="1" @if($course->semester == '1') selected="selected" @endif>1</option>
		                  	<option value="2" @if($course->semester == '2') selected="selected" @endif>2</option>
		                </select>
		              </div>
		              <div class="form-group col-md-6">
		              	<label >Year</label>
		              	<select name="year" class="form-control">
		              		@php $years=[1,2,3,4,5,6] @endphp
		              		@foreach($years as $year)
		                  	<option value="{{$year}}" @if($course->year == "$year") selected="selected" @endif>{{$year}}</option>
		                  	@endforeach
		                </select>
		              </div>
		              <div class="form-group col-md-12">
		              	<label >Assign Course To</label>
		              	<select name="assigned_to" class="form-control">
		              		<option value="">---None---</option>
		                   @foreach($users as $user)
		                  		<option value="{{$user->id}}"
		                  			@if($course->assigned_to == $user->id) selected="selected" @endif>{{$user->name}}</option>
		                  	@endforeach
		                </select>
		              </div>
	              <div class="box-footer col-md-12">
	              	<a href="{{route('course.index')}}" class="btn btn-danger">Cancel</a>
	                <button type="submit" class="btn btn-primary pull-right">Update</button>
	              </div>
	            </form>
	          </div>
	          <!-- /.box -->
	      </div>
    </section>
  </div>


	{{-- <div id="content">
		<div id="content-header">
		  <div id="breadcrumb"> <a href="{{url('/admin')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{route('course.index')}}" class="tip-bottom">Course</a> <a href="#" class="current">Edit</a> </div>
		  <h1>Update Course</h1>
		</div>
			@if(count($errors)>0)
        		@foreach($errors->all() as $error)
        			<div class="alert alert-error alert-block">
			    		<button type="button" class="close" data-dismiss="alert">x</button>
			    		<strong>{{$error}}</strong>
			    	</div>
        		@endforeach
        	@endif
		<div class="container-fluid">
		  <hr>
		  <a class="btn btn-block btn-primary" href="{{route('course.index')}}">View Course</a>
		  <div class="row-fluid">
		  	<div class="span3"></div>
		  	<div class="span6">
		      <div class="widget-box">
		        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
		          <h5>Update Course</h5>
		        </div>
		        <div class="widget-content nopadding"> 	
		          <form action="{{route('course.store')}}" method="post" class="form-horizontal">
		          	{{csrf_field()}}
		            <div class="control-group">
		              <label class="control-label">{{$course->name}}</label>
		              <div class="controls">
		                <input type="text" class="span11" placeholder="Course Name" id="course_name" name="course_name" />
		              </div>
		            </div>
		            <div class="control-group">
		              <label class="control-label">{{$course->code}}</label>
		              <div class="controls">
		                <input type="text" class="span11" placeholder="Course Code" id="course_code" name="course_code" />
		              </div>
		            </div>
		            <div class="control-group">
		              <label class="control-label">{{$course->credit_hours}}</label>
		              <div class="controls">
		                <input type="number" class="span11" id="number" name="credit_hours" placeholder="Enter a number" />
		              </div>
		            </div>
		            <div class="control-group">
		              <label class="control-label">Department</label>
		              <div class="controls">
		                <select name="dep_id">
		                  <option value="1">Computer Science</option>
		                  <option value="2">Mathematis</option>
		                </select>
		              </div>
		            </div>
		            <div class="control-group">
		              <label class="control-label">Academic Year & Semester</label>
		              <div class="controls">
		                <select name="academics_id">
		                  <option value="1">2018/2019 semester 1</option>
		                  <option value="2">2018/2019 semester 2</option>
		                </select>
		              </div>
		            </div>
		            <div class="form-actions">
		              <button type="submit" class="btn btn-success">Update</button>
		            </div>
		          </form>
		        </div>
		      </div>

		  </div>
		</div>
	</div>
</div> --}}

@endsection