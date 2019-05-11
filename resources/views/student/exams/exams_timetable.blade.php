@extends('layouts.students_layouts.student_design')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Examinations 
        <small>Timetable</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('student.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">TimeTable</li>
      </ol>
    </section>
      
    <section class="content"> 
      @if($timetable->count() == 0)
        <div class="col-md-8 col-md-offset-2 text-danger text-center"><h1>No Exams Available!!!</h1></div>
      @else
        <div class="row">
          <div class="col-md-4 "></div>
          <div class="col-md-4 "><a class="btn btn-block btn-info " href="{{route('examsTimetable.print')}}">Print Time Table</a></div>
          <div class="col-md-4 "></div>
      </div><hr>
      @endif     
        <div class="row">
          <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <center><h3 class="box-title">{{$academic->year}} Semester {{$academic->semester}}<br> {{ucfirst($dep->name)}} {{Auth::user()->year}} Exams Timetable</h3></center>
            </div>
              <table id="example1" class="table table-bordered table-striped table-responsive">
              <thead>
              <tr>
                <th><center>Date(yy-mm-dd)</center></th>
                <th><center>Day</center></th>
                <th><center>Starting</center></th>
                <th><center>Exams Title</center></th>
                <th><center>Course</center></th>
                
                <th><center>Ending</center></th>
              </tr>
              </thead>
              <tbody>
                @foreach($timetable as $exams)
                  <tr>
                    <td><center><span class="label label-default">{{  date('Y-m-d',strtotime($exams->exams_date))}}</span></center></td>
                    <td><center><span class="label label-primary">{{  date('F d, (l)',strtotime($exams->exams_date))}}</span></center></td>
                    <td><center><span class="label label-info">{{  date('h:i A',strtotime($exams->start_time))}}</span></center></td>
                    <th><center><h4><span class="label label-success">{{ucfirst($exams->title)}}</span></h4></center></th>
                    <th><center>{{ucfirst(App\Course::find($exams->course_id)->name)}}</center></th>
                    
                    <td><center><span class="label label-info">{{  date('h:i A',strtotime($exams->stop_time))}}</span></center></td>
                  </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                <th><center>Date(yy-mm-dd)</center></th>
                <th><center>Date</center></th>
                <th><center>Exams Title</center></th>
                <th><center>Course</center></th>
                <th><center>Starting</center></th>
                <th><center>Ending</center></th>
              </tr>
              </tfoot>
            </table>
          </div>
          </div>
            
          </div>
        </div>
    </section>
  </div>

  {{-- modal for the viewing the exams timetable --}}
      <div class="modal fade modal-open" id="modal-info">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Exams TimeTable</h4>
            </div>
            <div class="modal-body">
              
            </div>
            <div class="box-footer">
                  <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-danger">
                  Cancel</button>
                </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

@endsection