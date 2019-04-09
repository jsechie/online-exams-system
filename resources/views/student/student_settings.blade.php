@extends('layouts.students_layouts.student_design')

@section('content')
	
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Student Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('student.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Profile</li>
      </ol>

      @include('messages.flash_messages')
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-offset-2 col-md-4">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{Storage::disk('local')->url(Auth::user()->picture)}}" alt="User profile picture">

              <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>

              <p class="text-muted text-center">Year {{Auth::user()->year}}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Email:</b> <a class="pull-right">{{Auth::user()->email}}</a>
                </li>
                <li class="list-group-item">
                  <b>Username:</b> <a class="pull-right">{{Auth::user()->username}}</a>
                </li>
                <li class="list-group-item">
                  <b>Registered Courses:</b> <a class="pull-right"></a>
                </li>
              </ul>

              <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#edit-profile"><b>Edit</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->


        </div>
        <!-- /.col -->
        <div class="col-md-4">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">About Me</a></li>
              <li><a href="#settings" data-toggle="tab">Change Password</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                 <!-- About Me Box -->
		          <div class="box box-primary">
		            <div class="box-header with-border">
		              <h3 class="box-title">My Details</h3>
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body">
		            	<strong><i class="fa fa-user margin-r-5"></i> Program Of Study</strong>

		              <p class="text-muted text-primary">
		                {{$department->name}}
		              </p>

		              <hr>
		              <strong><i class="fa fa-book margin-r-5"></i> Index Number</strong>

		              <p class="text-muted text-primary">
		                {{Auth::user()->index_number}}
		              </p>

		              <hr>

		              <strong><i class="fa fa-book margin-r-5"></i> Student ID</strong>

		              <p class="text-muted text-primary">{{Auth::user()->student_id}}</p>

		              <hr>

		              <strong><i class="fa fa-pencil margin-r-5"></i> Nationality</strong>

		              <p class="text-muted text-primary">{{Auth::user()->student_type}}</p>

		              <hr>

		              <strong><i class="fa fa-pencil margin-r-5"></i> Program Type</strong>

		              <p class="text-muted text-primary">{{Auth::user()->program_type}}</p>
		            </div>
		            <!-- /.box-body -->
		          </div>
		          <!-- /.box -->
              </div>
              <div class="tab-pane" id="settings">
                <form role="form" method="post" action="{{ url('/student/update-pwd')}}">
	            {{csrf_field()}}
	              <div class="box-body">
	                <div class="form-group col-md-12">
	                  <label for="current_pwd">Current Password</label>
	                  <input type="password" class="form-control" id="current_pwd" placeholder="Old Password" name="current_pwd">
	                </div>
	                <div class="form-group col-md-12">
	                  <label for="new_pwd">New Password</label>
	                  <input type="password" class="form-control" id="new_pwd" placeholder="New Password" name="new_pwd">
	                </div> 
	                <div class="form-group col-md-12">
	                  <label for="confirm_pwd">Confirm Password</label>
	                  <input type="password" class="form-control" id="confirm_pwd" placeholder="New Password" name="confirm_pwd">
	                </div>               
	              <div class="box-footer col-md-12">
	              	<a href="{{route('user.settings')}}" class="btn btn-danger">Cancel</a>
	                <button type="submit" class="btn btn-primary pull-right">Confirm Change</button>
	              </div>
	            </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

	<form method="post" action="{{route('student.profile',Auth::user()->id)}}" enctype="multipart/form-data">
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
            <label for="email">Email</label>
            <input type="emal" class="form-control" id="email" placeholder="New Password" name="email" {{old('email')}} value="{{Auth::user()->email}}">
          </div>
	        <div class="form-group col-md-6">
	          <label for="username">Username</label>
	          <input type="text" class="form-control" id="username" placeholder="Username" name="username" value="{{Auth::user()->username}}" {{old('username')}}>
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