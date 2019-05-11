@extends('layouts.admin_layouts.admin_design')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Report
        <small>Page</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Exams Schedule Report</li>
      </ol>
    </section>
      @include('messages.errors')
      @include('messages.flash_messages')

    <section class="invoice">
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="">{{"$academic->year Sem $academic->semester Exams Schedule ("}}@if($end_date==Null){{"on $start_date)"}}@else{{"from $start_date to $end_date)"}}@endif  Report.</i>
            <small class="pull-right"><?= date('d-m-Y  G:i') ?></small>
          </h2>
        </div>
      </div>
      <!-- /.row -->
            <!-- Table row -->
      <div class="row">
        <center><h3>There will be {{$exams->count()}} Examination(s) written @if($end_date==Null){{"on $start_date"}}@else{{"from $start_date to $end_date"}}@endif as follows:</h3></center><br>
        <div class="col-xs-12 ">
          <table class="table table-striped table-responsive">
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
      <form role="form" method="post" action="{{route('examsHistory.print')}}">
        {{csrf_field()}}
        <input type="hidden" name="start_date" value="{{$start_date}}">
        <input type="hidden" name="end_date" value="{{$end_date}}">
        <div class="box-footer ">
        <div class="col-md-10 col-md-offset-1">
          <a href="{{route('examiner.report')}}" type="button" class="btn btn-danger">Cancel</a>
          <button type="submit" class="btn btn-primary pull-right">Export PDF</button>
        </div>
          
      </div>
      </form>
      
      <!-- /.row -->
    </section>
  </div>
@endsection