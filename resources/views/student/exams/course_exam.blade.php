@extends('layouts.students_layouts.student_design')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Take 
        <small>Exam</small> On <small>{{$course->code}}</small> {{$course->name}}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('student.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Take Exam</li>
      </ol>

    </section>

    <section class="content-fluid">
      <div class="row">
               @include('messages.errors')
      @include('messages.flash_messages')
      {{-- @if($check_status->count()>0) --}}
      @if($take_exams->count()>0)
        @foreach($take_exams as $take_exam)

          <div class="col-md-offset-1 col-md-5">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user-2">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-primary">
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username">{{ucfirst($take_exam->title)}}</h3>
              </div>
              <div class="box-footer no-padding">
                <ul class="nav nav-stacked">
                  <li><a >Starts Date: <span class="pull-right bg-red">{{ date('l (F d, Y)',strtotime($take_exam->exams_date))}}</span></a></li>
                  <li><a >Start Time: <span class="pull-right badge bg-aqua">{{$take_exam->start_time}}</span></a></li>
                  <li><a >Stop Time: <span class="pull-right badge bg-green">{{$take_exam->stop_time}}</span></a></li>
                  <br><br>
                </ul>
                <a href="{{route('student.startExam',$take_exam->id)}}" class="btn btn-block btn-primary">Start Exams</a>
              </div>
              
            </div>
            <!-- /.widget-user -->
          </div>
        @endforeach
      @else
        <div>
          <center><h1 class="text-danger">No Exams Available For Now</h1></center>
        </div>
      @endif

         {{-- rules and regulations guidingthe examination --}}
      <div class="col-md-12">
        <div class="box box-default">
          <div class="box-header with-border">
            <i class="fa fa-bullhorn"></i>

            <h3 class="box-title">Terms And Condtions</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="callout callout-danger">
              <h4>Exams Access</h4>

              <p>Exams can only be acceesed between the start time and the stop time.<br>
                i.e If an Exams is to begin at 13:00 and end on 15:00, you can only access the exam between that particulaer period.
              </p>
            </div>
            <div class="callout callout-warning">
              <h4>Exams Timing</h4>

              <p>Once Exams starts A countdown begins and ends on the intended stop time<br>i.e If an Exams begins at 13:00 and end on 15:00, a countdown duration of 2 hours Automatically begins.</p>
            </div>
            <div class="callout callout-danger">
              <h4>No Additional Time Added</h4>

              <p>Students are adviced to be active on Time<br>No ADDITIONAL TIME will be given before and after the stated START and STOP times.</p>
            </div>
            <div class="callout callout-warning">
              <h4>Next Question Accessibility</h4>

              <p>A student can only view the NEXT Question IF AND ONLY IF the CURRENT Question being viewed is Answered </p>
            </div>
            <div class="callout callout-danger">
              <h4>Exams Submittion</h4>

              <p>Exmas will Automatically be submitted when it is Time to stop working<br>Students cam manually also Submit Exams when they finish before Time</p>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
        {{-- @else
        <div class="col-md-8 col-md-offset-2 text-danger text-center"><h1>No Exams Avalable!!!</h1></div>
      @endif --}}
      </div>
    </section>
  </div>
@endsection      



      