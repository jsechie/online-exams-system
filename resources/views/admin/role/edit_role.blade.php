@extends('layouts.admin_layouts.admin_design')

@section('content')

	 <div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <section class="content-header">
	      <h1>
	       Update
	        <small>Role Info</small>
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
	        <li class=""><a href="{{route('role.index')}}"">Role</a></li><li class="active">Update</li>
	      </ol>
	    </section>
	      <!-- /.content -->
	     <div class="row">
	       <div class="col-md-4"></div>
	        <div class="col-md-4">
	          <hr>
	          <a class="btn btn-block btn-primary" href="{{route('role.index')}}"'" >View Role</a>
	        </div>
	      <div class="col-md-4"></div>
      </div>

    <section class="content">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Update Role Form</h3>
              <br>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{route('role.update',$role->id)}}">
            {{csrf_field()}}
		    {{method_field('PATCH')}}
              <div class="box-body">
                <div class="form-group">
                  <label for="role_name">Role Name</label>
                  <input type="text" class="form-control" id="role_name" placeholder="Name" name="role_name" value="{{$role->name}}">
                </div>
              <div class="box-footer">
              	<a href="{{route('role.index')}}" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-primary pull-right">Update New</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
      </div>
    </section>
  </div>

@endsection