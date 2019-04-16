@extends('layouts.students_layouts.student_design')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('student.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
      @include('messages.errors')
      @include('messages.flash_messages')

    <section class="content">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Select Your Options To View Result</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{route('student.viewResult')}}">
               {{csrf_field()}}
              <div class="box-body">
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
                <div class="form-group">
                  <label>Academic Semester</label>
                  <select class="form-control" name="academic_semester">
                    <option value=""> --Select Academic Semester--</option>
                    <option value="1" {{old('academic_semester')=='1'? 'selected':'' }}> 1</option>
                    <option value="2" {{old('academic_semester')=='2'? 'selected':'' }}> 2</option>
                  </select>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                  <a href="{{route('student.dashboard')}}" type="button" class="btn btn-default">Cancel</a>
                  <button type="submit" class="btn btn-info pull-right">Search</button>
                </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
  </div>
@endsection
