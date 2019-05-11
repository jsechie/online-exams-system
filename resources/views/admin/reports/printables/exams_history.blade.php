@extends('layouts.print_layouts.print_design')
@section('content')
  <div class="row">
    <div class="col-xs-12">
      <center><h2 class="page-header">
        <i class="">{{"$academic->year Sem $academic->semester Exams Schedule Report."}}</i>
      </h2></center>
    </div>
  </div>
  <!-- /.row -->
        <!-- Table row -->
  <div class="row">
    <center><h3 class="text-danger"><u>There will be {{$exams->count()}} Examination(s) written @if($end_date==Null){{"on $start_date"}}@else{{"from $start_date to $end_date"}}@endif as follows:</u></h3></center><br>
    <div class="col-xs-12 ">
      <table class="table table-striped table-bordered table-responsive">
        <thead>
        <tr>
          <th>Exams Date</th>
          <th>Course</th>
          <th>Department</th>
          <th>Exams Type</th>
          <th>Starting On</th>
          <th>Ending At</th>
        </tr>
        </thead>
        <tbody>
          @foreach($exams as $exam)
            <tr>
              <td>{{date('l (F d,Y)',strtotime($exam->exams_date))}}</td>
              <?php $course = App\Course::find($exam->course_id); ?>
              <td>{{$course->name}}</td>
              <?php $department = App\Department::find($course->dep_id); ?>
              <td>{{$department->name}}</td>
              <td>{{$exam->title}}</td>
              <td>{{$exam->start_time}}</td>
              <td>{{$exam->stop_time}}</td>
            </tr>
          @endforeach
        
        </tbody>
      </table>
    </div>
    <!-- /.col -->
  </div>
@endsection

  