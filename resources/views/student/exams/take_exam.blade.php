@extends('layouts.students_layouts.student_design')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Take 
        <small>Exam</small> On
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('student.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Take Exam</li>
      </ol>
    </section>
      @include('messages.errors')
      @include('messages.flash_messages')

    <section class="content">
      @if($courses->count() > 0)
      <center><u><h3 class="text-warning">Select A Course To Take Its Exams</h3></u></center>
        <hr><div class="row">
          <div class="col-lg-2 col-md-2"></div>
          <div class="col-lg-8 col-md-8 row">
            @foreach($courses as $course)        
              <a href="{{route('student.courseExam',$course->id)}}"><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-danger">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="fa fa-files-o"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">{{$course->name}}</span>
                    <span class="info-box-number">{{$course->code}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div></a>
            <!-- /.col -->        
            @endforeach
          </div>
          <div class="col-lg-2 col-md-2"></div>
        </div><hr>
         @else
        <div class="col-md-8 col-md-offset-2 text-danger text-center"><h1>No Exams Avalable!!!</h1></div>
      @endif
      {{-- @if($check_status->count()>0)
        @foreach($take_exams as $take_exam)
          <div class="row col-md-offset-1 col-md-5">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user-2">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-primary">
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username">{{ucfirst($take_exam->title)}}</h3>
                <h5 class="widget-user-desc">Course: @php
                  ($course=App\Course::find($take_exam->course_id)) 
                @endphp{{$course->name}}</h5>
              </div>
              <div class="box-footer no-padding">
                <ul class="nav nav-stacked">
                  <li><a >Starts On: <span class="pull-right bg-red">{{ date('l (F d,Y)',strtotime($take_exam->exams_date))}}</span></a></li>
                  <li><a >From: <span class="pull-right badge bg-aqua">{{$take_exam->start_time}}</span></a></li>
                  <li><a >To: <span class="pull-right badge bg-green">{{$take_exam->stop_time}}</span></a></li>
                  <br><br>
                </ul>
                <a href="{{route('student.startExam',$take_exam->id)}}" class="btn btn-block btn-primary">Start Exams</a>
              </div>
              
            </div>
            <!-- /.widget-user -->
          </div>
        @endforeach
        @else
        <div class="col-md-8 col-md-offset-2 text-danger text-center"><h1>No Exams Avalable!!!</h1></div>
      @endif --}}
    </section>
  </div>
@endsection      



      