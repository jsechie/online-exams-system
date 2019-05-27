@extends('layouts.admin_layouts.admin_design')

@section('content')

	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Update
        <small>User Password</small>
      </h1><br>
      	@include('messages.flash_messages')
      	@include('messages.errors')
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a href="{{route('admin.settings')}}"">Settings</a></li><li class="active">Update</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">

      	<div class="col-md-8 col-md-offset-2">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user row">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
              <h3 class="widget-user-username">{{Auth::user()->name}}</h3>
              <h5 class="widget-user-desc">{{Auth::user()->role}}</h5>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="{{Storage::disk('local')->url(Auth::user()->picture)}}" alt="User Avatar">
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-3 border-right">
                  <div class="description-block">
                    <h6 class="description-text">ID</h6>
                    <span class="description-header">{{Auth::user()->lec_id}}</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-5 border-right">
                  <div class="description-block">
                    <h6 class="description-text">Email</h6>
                    <span class="description-header">{{Auth::user()->email}}</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h6 class="description-text">Username</h6>
                    <span class="description-header">{{'@'}}{{Auth::user()->username}}</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <a href="" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#edit-profile">Edit</a>
            </div>
          </div>
          <!-- /.widget-user -->
        {{-- </div> --}}
        <!-- /.col -->

        {{-- <div class="col-md-5"> --}}
          <!-- general form elements -->
          <div class="box box-primary row">
            <div class="box-header with-border">
              <h3 class="box-title">Update Password</h3>
              <br>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{ url('/admin/update-pwd')}}">
            {{csrf_field()}}
              <div class="box-body">
                <div class="form-group col-md-12">
                  <label for="current_pwd">Current Password</label>
                  <input type="password" class="form-control" id="current_pwd" placeholder="Old Password" name="current_pwd">
                </div>
                <div class="form-group col-md-6">
                  <label for="new_pwd">New Password</label>
                  <input type="password" class="form-control" id="new_pwd" placeholder="New Password" name="new_pwd">
                </div> 
                <div class="form-group col-md-6">
                  <label for="confirm_pwd">Confirm Password</label>
                  <input type="password" class="form-control" id="confirm_pwd" placeholder="New Password" name="confirm_pwd">
                </div>               
              <div class="box-footer col-md-12">
              	<a href="{{route('admin.dashboard')}}" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-primary pull-right">Confirm Change</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
      </div>
    </section>
  </div>

  {{-- modal --}}
  <form method="post" action="{{route('admin.profile',$user->id)}}" enctype="multipart/form-data">
  	{{csrf_field()}}
  <div class="modal fade" id="edit-profile">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Profile Settings</h4>
	      </div>
	      <div class="modal-body">
          <div class="form-group col-md-12">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{$user->name}}" {{old('name')}}>
          </div> 
          <div class="form-group col-md-12">
            <label for="email">Email</label>
            <input type="emal" class="form-control" id="email" placeholder="New Password" name="email" {{old('email')}} value="{{$user->email}}">
          </div>
          {{-- <div class="form-group col-md-4">
            <label for="lec_id">Lecturer ID</label>
            <input type="text" class="form-control" id="lec_id" placeholder="Lecturer ID" name="lec_id" value="{{$user->lec_id}}">
          </div> --}}
	        <div class="form-group col-md-6">
	          <label for="username">Username</label>
	          <input type="text" class="form-control" id="username" placeholder="Username" name="username" value="{{$user->username}}" {{old('username')}}>
	        </div>
          <div class="form-group col-md-6">
            <label for="picture">Change Profile Picture</label>
            <input type="file" class="form-control" id="picture" name="picture">
         </div>	        
	      </div>
	      <div class="modal-footer">
	        <a class="btn btn-default pull-left" data-dismiss="modal">Close</a>
	        <button type="submit" class="btn btn-primary">Save Changes</button>
	      </div>
	    </div>
	    <!-- /.modal-content -->
	  </div>
	  <!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
  </form>
@endsection