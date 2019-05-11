@extends('layouts.admin_layouts.admin_design')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
      @include('messages.errors')
      @include('messages.flash_messages')

    <section class="content">
      <div class="row">
        @if($courses->count() > 0)
          <div class="col-md-6 col-md-offset-3">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Select Your Options To View Result</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form role="form" method="post" action="{{route('admin.attendanceReport')}}">
                 {{csrf_field()}}
                <div class="box-body">
                  <div class="form-group">
                    <label>Course Name</label>
                    <select class="form-control" name="course_name">
                      <option value=""> --Select Course--</option>
                      @foreach($courses as $course)
                        <option value="{{$course->name}}" {{old('course_name')=="$course->name"? 'selected':'' }}>{{$course->name}} </option>
                      @endforeach
                    </select>
                  </div>
                 <div class="form-group">
                    <label>Examination Type</label>
                    <select class="form-control" name="exams_type">
                      <option value=""> --Select Exams Type--</option>
                      <option value="Mid Semester Examination" {{old('exams_type')=='Mid Semester Examination'? 'selected':'' }}>Mid Semester Examination</option>
                      <option value="End Of Semester Examination" {{old('exams_type')=='End Of Semester Examination'? 'selected':'' }}>End Of Semester Examinamtion</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Academic Year</label>
                    <select class="form-control" name="academic_year">
                      <option value=""> --Select Academic Year--</option>
                      @foreach($academics as $academic)
                        <option value="{{$academic->year}}" {{old('academic_year')=="$academic->year"? 'selected':'' }}>{{$academic->year}} </option>
                      @endforeach
                    </select>
                  </div>
                  
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <a href="{{route('admin.dashboard')}}" type="button" class="btn btn-default">Cancel</a>
                    <button type="submit" class="btn btn-info pull-right">Search</button>
                  </div>
              </form>
            </div>
            <!-- /.box -->
          </div>
        @else
          @include('messages.course_error')
        @endif
         
      </div>
    </section>
  </div>
@endsection
