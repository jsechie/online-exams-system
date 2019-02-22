@extends('layouts.students_layouts.student_design')

@section('content')
	<div id="content">
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
	</div>
@endsection