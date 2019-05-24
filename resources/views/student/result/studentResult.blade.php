@extends('layouts.students_layouts.student_design')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Result
        <small>Slip</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('student.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Result</li>
      </ol>
    </section>
      @include('messages.errors')
      @include('messages.flash_messages')

    <section class="invoice">
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class=""></i> {{"$academic_year Semester $academic_sem $exams_type Result"}}.
            <small class="pull-right"><?= date('d-m-Y  G:i') ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <div class="row invoice-info">

        <div class="col-sm-4 invoice-col">
          <b>Name:</b> {{Auth::user()->name}}<br>
          <b>Ref #:</b> {{Auth::user()->student_id}}<br>
          <b>Index #:</b> {{Auth::user()->index_number}}
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Department:</b> {{App\Department::find(Auth::user()->dep_id)->name}}<br>
          <b>Year:</b> {{Auth::user()->year}}<br>
          <b>Type:</b> {{Auth::user()->student_type}}
        </div>
        <div class="col-sm-4 invoice-col">
          <b>Academic Year:</b> {{$academic_year}}<br>
          <b>Semester:</b> {{$academic_sem}}<br>
          <b>Result Type:</b> {{$exams_type}}
        </div>
        <div class="col-xs-12 col-md-offset-1 col-md-10">
           <!-- Table row -->
          <br><hr><div class="row">
            <div class="col-xs-12 table-responsive">
              <table class="table table-striped">
                <thead>
                <tr>
                  <th class="text-center">Course Code</th>
                  <th class="text-center">Course Name</th>
                  <th class="text-center">Credit Hours</th>
                  <th class="text-center">Marks</th>
                </tr>
                </thead>
                <tbody>
                @foreach($results as $result)
                  <tr>
                  <td class="text-center">{{$result->course_code}}</td>
                  <td class="text-center">{{$result->course_name}}</td>
                  <td class="text-center">{{$result->credit_hours}}</td>
                  <td class="text-center">@if($results_type == 'singles'){{$result->marks_scored}} @else {{$result->mid_sem_mark + $result->end_of_sem_mark}}@endif</td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          
        </div>
        <!-- /.col -->
      </div>
    <div class="row no-print">
        <div class="col-xs-12">
          <form role="form" method="post" action="{{route('Result.print')}}">
            {{csrf_field()}}
            <input type="hidden" name="academic_semester" value="{{$academic_sem}}">
            <input type="hidden" name="exams_type" value="{{$exams_type}}">
            <input type="hidden" name="academic_year" value="{{$academic_year}}">
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-report"></i> Export To PDF</button>
                <a href="{{route('student.dashboard')}}" type="button" class="btn btn-danger {{-- pull-right --}}"><i class="fa fa-times"></i> Close</a><br><hr>
              </div>

          </form>
          <form role="form" method="post" action="{{route('student.viewResultReport')}}">
            {{csrf_field()}}
            <input type="hidden" name="academic_sem" value="{{$academic_sem}}">
            <input type="hidden" name="exams_type" value="{{$exams_type}}">
            <input type="hidden" name="academic_year" value="{{$academic_year}}">
            <div class="box-footer">
                <button type="submit" class="btn btn-success btn-block"><i class="fa fa-report"></i> Generate Report</button>
              </div>
          </form>
        </div>

      </div>
    </section>
  </div>
@endsection