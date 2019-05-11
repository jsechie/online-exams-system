@extends('layouts.print_layouts.print_design')
@section('css')
  <style>
    .page-break {
        page-break-after: always;
    }
  </style>
@endsection
@section('content')
  <div class="row">
  <div class="col-xs-12">
    <h2 class="page-header text-danger text-center">
      <i class="">{{"$academic_year $course $exams_type Student Report"}}.</i>
    </h2>
  </div>
  <!-- /.col -->
</div>
<div class="container">
    <table class="table-responsive">
      <tr>
        <th style="padding-left: 10px;" class="text-center"><u>Attendance Details</u></th>
        <th style="padding-left: 10px;" class="text-center"><u>Performance Details</u></th>
      </tr>
      <tr>
        <td style="padding-left: 20px;">
          <b>Total Student:</b> {{$total_student}}<br>
          <b>Student Present:</b> <span class="badge label-success">{{$total_result}}</span>, which is {{round(($total_result/$total_student)*100,1)}}%<br>
          <b>Student Absent:</b> <span class="badge label-danger">{{$total_student - $total_result}}</span>, which is {{round((($total_student - $total_result)/$total_student)*100,1)}}%
        </td>
        <td style="padding-left: 20px;">
          <b>Total Results:</b> {{$total_result}}<br>
          <b>Student Passing:</b> <span class="badge label-success">{{$pass}}</span>, which is {{round(($pass/$total_result)*100,1)}}%<br>
          <b>Student Failing:</b> <span class="badge label-danger">{{$total_result-$pass}}</span>, which is {{round((($total_result - $pass)/$total_result)*100,1)}}%
        </td>
      </tr>
    </table>
    <hr>
      <div class="container">
        <center><h3><u>Results Of Students Who Took The Exam</u></h3></center>
        <table class="table-responsive table-bordered table-striped">
          <thead>
            <tr>
              <th class="text-center">Index Number</th>
              <th class="text-center">Name</th>
              <th class="text-center">Marks/{{$total_exams_marks}}</th>
              {{-- <th class="text-center">Status</th> --}}
            </tr>    
          </thead>
          <tbody>
            @foreach($student_present as $record)
              <?php $student = App\User::find($record->student_id); ?>
              <tr>
                <td class="text-center">{{$student->index_number}}</td>
                <td class="text-center">{{ucfirst($student->name)}}</td>
                <td class="text-center">{{$record->marks_scored}}</td>
                {{-- <td class="text-center"></td> --}}
              </tr>
            @endforeach
          </tbody>
        </table>
        <div class="page-break"></div>
        <center><h3><u>Students That Were Absent</u></h3></center>
        @if($all_students == $student_present)
          <center><h2 class="text-success">No Student Absent</h2></center>
        @else
          <table class="table-responsive table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center">Index Number</th>
                <th class="text-center">Name</th>
              </tr>    
            </thead>
            <tbody>
              @foreach($all_students as $absentees)
                <?php $checker = 0; ?>
                @foreach($student_present as $record)
                  @if($record->student_id == $absentees->id)
                    <?php $checker = 1; break;?>
                  @endif
                @endforeach
                @if($checker == 0)
                  <tr>
                    <td class="text-center">{{$absentees->index_number}}</td>
                    <td class="text-center">{{ucfirst($absentees->name)}}</td>
                  </tr>
                @endif
              @endforeach
            </tbody>
          </table> 
        @endif 
      </div>
  </div>
@endsection