@extends('layouts.admin_layouts.admin_design')

@section('content')

	<div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <section class="content-header">
	      <h1>
	        Register
	        <small>New User</small>
	      </h1><br>
	      	@include('messages.errors')
	      <ol class="breadcrumb">
	        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
	        <li class=""><a href="{{route('users.index')}}"">User</a></li><li class="active">Add</li>
	      </ol>
	    </section>
	      <!-- /.content -->
	      <div class="row">
	        <div class="col-md-4"></div>
	        <div class="col-md-4">
	          <hr>
	          <a class="btn btn-block btn-primary" href="{{route('users.index')}}"'" >Back To Users</a>
	        </div>
	        <div class="col-md-4"></div>
	      </div>

	    <section class="content">
	      <div class="row">
	        <div class="col-md-6 col-md-offset-3">
	          <!-- general form elements -->
	          <div class="box box-primary">
	            <div class="box-header with-border">
	              <h3 class="box-title">Register User Form</h3>
	              <br>
	            </div>
	            <!-- /.box-header -->
	            <!-- form start -->
	            <form role="form" method="post" action="{{route('users.store')}}" enctype="multipart/form-data">
	            {{csrf_field()}}
	              <div class="box-body">
	                <div class="form-group col-md-12">
	                  <label for="name">Name</label>
	                  <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{old('name')}}">
	                </div>
	                <div class="form-group col-md-6">
	                  <label for="username">Username</label>
	                  <input type="text" class="form-control" id="username" placeholder="Username" name="username" value="{{old('username')}}">
	                </div> 
	                <div class="form-group col-md-6">
	                  <label for="lec_id">Lecturer ID</label>
	                  <input type="text" class="form-control" id="lec_id" placeholder="Lecturer ID" name="lec_id" value="{{old('lec_id')}}">
	                </div>
	                <div class="form-group col-md-12">
	                  <label for="email">Email</label>
	                  <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
	                </div>               
		              <div class="form-group col-md-6">
		              	<label >Role</label>
		              	<select name="role" class="form-control">
		                  	<option value="Lecturer">Lecturer</option>
		                  	<option value="Examiner">Examiner</option>
		                </select>
		              </div>
		              <div class="form-group col-md-6">
		                  <label for="picture">Upload Profile Picture</label>
		                  <input type="file" class="form-control" id="picture" name="picture">
		               </div>
		              <div class="form-group col-md-6">
		                  <label for="password">Password</label>
		                  <input type="password" class="form-control" id="password" name="password">
		                </div>
		                <div class="form-group col-md-6">
		                  <label for="password_confirmation">Confirm Password</label>
		                  <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
		                </div>
	              <div class="box-footer">
	              	<a href="{{route('users.index')}}" class="btn btn-danger">Cancel</a>
	                <button type="submit" class="btn btn-primary pull-right">Add New</button>
	              </div>
	            </form>
	          </div>
	          <!-- /.box -->
	      </div>
    </section>
  </div>

@endsection