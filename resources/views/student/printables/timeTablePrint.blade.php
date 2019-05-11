@extends('layouts.print_layouts.print_design')
@section('content')
  <div class="container">
    <div class="box">
      <div class="box-header">
        <center><h2 class="box-title text-danger"><u>Kwame Nkrumah University Of Science And Technology<br>{{$academic->year}} Semester {{$academic->semester}} {{ucfirst($dep->name)}} {{Auth::user()->year}} Exams Timetable</u></h2></center>
      </div><br>
      <table class="table table-bordered table-striped table-responsive">
        <thead>
          <tr>
            <th><center>Day</center></th>
            <th><center>Date</center></th>
            <th><center>Course</center></th>
            <th><center>Exams Title</center></th>
            <th><center>Starting</center></th>
            <th><center>Ending</center></th>
          </tr>
        </thead>
        <tbody>
          @foreach($timetable as $exams)
            <tr>
              <td><center><span class="text-primary">{{  date('F d, (l)',strtotime($exams->exams_date))}}</span></center></td>
              <td><center><span class="text-default">{{  date('d-m-Y',strtotime($exams->exams_date))}}</span></center></td>
              <th><center>{{ucfirst(App\Course::find($exams->course_id)->name)}}</center></th>
              <th><center><h4><span class="text-success">{{ucfirst($exams->title)}}</span></h4></center></th>
              <td><center><span class="text-info">{{  date('h:i A',strtotime($exams->start_time))}}</span></center></td>
              <td><center><span class="text-info">{{  date('h:i A',strtotime($exams->stop_time))}}</span></center></td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <th><center>Day</center></th>
            <th><center>Date</center></th>
            <th><center>Course</center></th>
            <th><center>Exams Title</center></th>
            <th><center>Starting</center></th>
            <th><center>Ending</center></th>
          </tr>
        </tfoot>
      </table>
    </div>  
  </div>
@endsection    
  