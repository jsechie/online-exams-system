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
        <li><a href="{{route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
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

              <a href="#" class="btn btn-primary btn-block"><b>Edit</b></a>
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
		              <h3 class="box-title">About Me</h3>
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body">
		              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

		              <p class="text-muted">
		                B.S. in Computer Science from the University of Tennessee at Knoxville
		              </p>

		              <hr>

		              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

		              <p class="text-muted">Malibu, California</p>

		              <hr>

		              <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

		              <p>
		                <span class="label label-danger">UI Design</span>
		                <span class="label label-success">Coding</span>
		                <span class="label label-info">Javascript</span>
		                <span class="label label-warning">PHP</span>
		                <span class="label label-primary">Node.js</span>
		              </p>

		              <hr>

		              <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

		              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
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
	              	<a href="{{route('admin.dashboard')}}" class="btn btn-danger">Cancel</a>
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

	<!--div id="content">
	  <div id="content-header">
		    <div id="breadcrumb"> <a href="{{url('/home')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></a> <a href="#" class="current">Settings</a> </div>
		    <h1>Student Settings</h1>

		    {{-- message to display for password changes --}}
		     @if(Session::has('flash_message_error'))
		    	<div class="alert alert-error alert-block">
		    		<button type="button" class="close" data-dismiss="alert">x</button>
		    		<strong>{!! session('flash_message_error') !!} </strong>
		    	</div>
		    @endif

		    @if(Session::has('flash_message_success'))
		    	<div class="alert alert-success alert-block">
		    		<button type="button" class="close" data-dismiss="alert">x</button>
		    		<strong>{!! session('flash_message_success') !!} </strong>
		    	</div>
		    @endif
		   
	  </div>
	  <div class="container-fluid"><hr>
	      <div class="row-fluid">
	        <div class="span12">
	          <div class="widget-box">
	            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
	              <h5>Password Update</h5>
	            </div>
	            <div class="widget-content nopadding">
	              <form class="form-horizontal" method="post" action="{{ url('/student/update-pwd')}}" name="password_validate" id="password_validate" novalidate="novalidate">{{ csrf_field() }}
	                <div class="control-group">
	                  <label class="control-label">Current Password</label>
	                  <div class="controls">
	                    <input type="password" name="current_pwd" id="current_pwd" />
	                  </div>
	                </div>
	                <div class="control-group">
	                  <label class="control-label">New Password</label>
	                  <div class="controls">
	                    <input type="password" name="new_pwd" id="new_pwd" />
	                  </div>
	                </div>
	                <div class="control-group">
	                  <label class="control-label">Confirm New Password</label>
	                  <div class="controls">
	                    <input type="password" name="confirm_pwd" id="confirm_pwd" />
	                  </div>
	                </div>
	                <div class="form-actions">
	                  <input type="submit" value="Update" class="btn btn-success">
	                </div>
	              </form>
	            </div>
	          </div>
	        </div>
	      </div>
	    </div>
	  </div>
	</div -->
@endsection