@extends('layouts.app')

@section('css')
<!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
<!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('AdminLTE/bower_components/font-awesome/css/font-awesome.min.css')}}">
<!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('AdminLTE/bower_components/Ionicons/css/ionicons.min.css')}}">
<!-- Theme style -->
  <link rel="stylesheet" href="{{asset('AdminLTE/dist/css/AdminLTE.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins/iCheck/square/blue.css')}}">

@section('content')

<div class="register-box col-md-8 col-md-offset-2">
  <div class="register-logo">
    <a href="../../index2.html"><b>Student </b>Register</a>
  </div>

  <div class="register-box-body row">
    <p class="login-box-msg">Register a new membership</p>
    
    <form class="form-horizontal" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
      <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }} has-feedback col-md-7">
        <label for="name">Full Name</label>
        <input type="text" class="form-control" placeholder="Full name" name="name" id="name" value="{{ old('name') }}">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }} has-feedback col-md-5">
        <label for="username">User Name</label>
        <input type="text" class="form-control" placeholder="User name" name="username" id="username" value="{{ old('username') }}">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        @if ($errors->has('username'))
            <span class="help-block">
                <strong>{{ $errors->first('username') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group {{ $errors->has('index_number') ? ' has-error' : '' }} has-feedback col-md-6">
        <label for="index_number">Index Number</label>
        <input type="number" class="form-control" name="index_number" id="index_number" value="{{ old('index_number') }}">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        @if ($errors->has('index_number'))
            <span class="help-block">
                <strong>{{ $errors->first('index_number') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group {{ $errors->has('student_id') ? ' has-error' : '' }} has-feedback col-md-6">
        <label for="student_id">Student ID</label>
        <input type="number" class="form-control" name="student_id" id="student_id" value="{{ old('student_id') }}">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        @if ($errors->has('student_id'))
            <span class="help-block">
                <strong>{{ $errors->first('student_id') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }} has-feedback col-md-7">
        <label for="email">Email</label>
        <input type="email" class="form-control" placeholder="Email" name="email" id="email" value="{{old('email')}}">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group {{ $errors->has('picture') ? ' has-error' : '' }} has-feedback col-md-5">
        <label for="picture">Profile Picture</label>
        <input type="file" class="form-control" name="picture" id="picture">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        @if ($errors->has('picture'))
            <span class="help-block">
                <strong>{{ $errors->first('picture') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group {{ $errors->has('department_name') ? ' has-error' : '' }} col-md-8 has-feedback">
        <label >Department Name</label>
        <select class="form-control" name="department_name">
          <?php $departments = App\Department::all(); ?>
          <option value="">---Select Department---</option>
          @foreach($departments as $department)
              <option value="{{$department->id}}" {{old('department_name')==$department->id? 'selected':'' }}>{{$department->name}}</option>
          @endforeach
        </select>
        @if ($errors->has('department_name'))
            <span class="help-block">
                <strong>{{ $errors->first('department_name') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group col-md-4 has-feedback {{ $errors->has('year') ? ' has-error' : '' }}">
        <label >Year</label>
        <select name="year" class="form-control">
            <option value="">---Select Year---</option>
            @php $years=[1,2,3,4,5,6] @endphp
            @foreach($years as $year)
            <option value="{{$year}}" {{old('year')==$year? 'selected':'' }}>{{$year}}</option>
            @endforeach
        </select>
        @if ($errors->has('year'))
            <span class="help-block">
                <strong>{{ $errors->first('year') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group col-md-6 ">
        <label >Student Type</label>
        <select class="form-control" name="student_type">
            <option value="Ghanaian" {{old('student_type')=='Ghanaian'? 'selected':'' }}>Ghanaian</option>
            <option value="International" {{old('student_type')=='International'? 'selected':'' }}>International</option>
        </select>
      </div>
      <div class="form-group col-md-6 ">
        <label >Program Type</label>
        <select class="form-control" name="program_type">
            <option value="Regular" {{old('program_type')=='Regular'? 'selected':'' }}>Regular</option>
            <option value="Parallel" {{old('program_type')=='Parallel'? 'selected':'' }}>Parallel</option>
        </select>
      </div>
      <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }} has-feedback col-md-6">
        <label for="password">Password</label>
        <input type="password" class="form-control" placeholder="Password" name="password" id="password">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group has-feedback col-md-6">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" id="password_confirmation">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      {{-- <div class="row col-md-12"> --}}
        <!-- /.col -->
        <div class="col-md-3 col-sm-12 col-xs-12 pull-right">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      {{-- </div> --}}
    </form>
  </div>
  <!-- /.form-box -->
</div>

@endsection
