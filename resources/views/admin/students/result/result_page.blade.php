@extends('layouts.admin_layouts.admin_design')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Result
        <small>Slip</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Result</li>
      </ol>
    </section>
      @include('messages.errors')
      @include('messages.flash_messages')

    <section class="invoice container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="">{{"$academic_year $course $exams_type Result"}}.</i>
            <small class="pull-right"><?= date('d-m-Y  G:i') ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <div class="row invoice-info">

      <div class="col-xs-12 col-md-offset-1 col-md-10">
         <!-- Table row -->
        <div class="row">
          <div class="col-xs-12 table-responsive">
            <table id="example1" class="table table-bordered table-striped table-responsive">
              <thead>
              @if($results_type == 'singles')
               <tr>
                <th class="text-center">Index Number</th>
                <th class="text-center">Name</th>
                <th class="text-center">Marks</th>
              </tr>
              @else 
                 <tr>
                <th class="text-center">Index Number</th>
                <th class="text-center">Name</th>
                <th class="text-center">Mid Sem Mark /30</th>
                <th class="text-center">End Of Sem Mark /70</th>
                <th class="text-center">Total Marks %</th>
              </tr>
              @endif
              </thead>
              <tbody>
              @if($results_type == 'singles')
                @foreach($results as $result)
                  <?php $student = App\User::find($result->student_id); ?>
                  <tr>
                  <td class="text-center">{{$student->index_number}}</td>
                  <td class="text-center">{{$student->name}}</td>
                  <td class="text-center">{{$result->marks_scored}} </td>
                </tr>
                @endforeach
              @else 
                 @foreach($results as $result)
                    <?php $student = App\User::find($result->student_id); ?>
                    <tr>
                    <td class="text-center">{{$student->index_number}}</td>
                    <td class="text-center">{{$student->name}}</td>
                    <td class="text-center">{{$result->mid_sem_mark}}</td>
                    <td class="text-center">{{$result->end_of_sem_mark}}</td>
                    <td class="text-center">{{$result->mid_sem_mark + $result->end_of_sem_mark}}</td>
                  </tr>
                @endforeach
              @endif
              </tbody>
            </table>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        
      </div>
      <!-- /.col -->
    </div>
    <br><br><div class="row no-print">
        <div class="col-md-12">
          <div class="col-md-4"><a href="{{route('admin.dashboard')}}" type="button" class="btn btn-danger {{-- pull-right --}}"><i class="fa fa-times"></i> Close</a></div>
          <div class="col-md-4"><form role="form" method="post" action="{{route('studentResult.excel')}}">
            {{csrf_field()}}
            <input type="hidden" name="course_name" value="{{$course}}">
            <input type="hidden" name="exams_type" value="{{$exams_type}}">
            <input type="hidden" name="academic_year" value="{{$academic_year}}">
            <div >
                <button type="submit" class="btn btn-warning pull-right"><i class="fa fa-report"></i> Export To Excel</button>
              </div>

          </form></div>
          <div class="col-md-4"><form role="form" method="post" action="{{route('studentResult.print')}}">
            {{csrf_field()}}
            <input type="hidden" name="course_name" value="{{$course}}">
            <input type="hidden" name="exams_type" value="{{$exams_type}}">
            <input type="hidden" name="academic_year" value="{{$academic_year}}">
            <div >
                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-report"></i> Export To PDF</button>
              </div>

          </form></div><br><hr>
          
          <form role="form" method="post" action="{{route('admin.viewResultReport')}}">
            {{csrf_field()}}
            <input type="hidden" name="course_name" value="{{$course}}">
            <input type="hidden" name="exams_type" value="{{$exams_type}}">
            <input type="hidden" name="academic_year" value="{{$academic_year}}">
            <div class="box-footer">
                <button type="submit" class="btn btn-success btn-block"><i class="fa fa-report"></i> Generate Report</button>
              </div>
          </form>
          
          
          
          {{-- <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button> --}}
        </div>
      </div>
    </section>
  </div>
@endsection