@extends('layouts.print_layouts.print_design')
@section('content')
  <div class="row">
    <div class="col-xs-12">
      <center><h2 class="page-header">
        <i class="text-danger">{{"$academic_year Semester $academic_sem $exams_type Result"}}.</i> 
      </h2></center>
    </div>
    <!-- /.col -->
  </div>
  <div class="container">
    <table class="table-responsive"><tr>
      <td style="padding-left: 10px;">
        <b>Name:</b> {{$user->name}}<br>
        <b>Ref #:</b> {{$user->student_id}}<br>
        <b>Index #:</b> {{$user->index_number}}<br>
      </td>
      <td style="padding-left: 10px;" >
        <b>Academic Year:</b> {{$academic_year}}<br>
        <b>Semester:</b> {{$academic_sem}}<br>
        <b>Result Type:</b> {{$exams_type}}
      </td>
      <td style="padding-left: 10px;" >
        <b>Department:</b> {{App\Department::find($user->dep_id)->name}}<br>
        <b>Year:</b> {{$user->year}}<br>
        <b>Type:</b> {{$user->student_type}}
      </td>
    </tr></table>
    <hr>
      <div class="container">
          <table class="table table-striped table-responsive table-bordered">
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
              <td class="text-center">{{$result->marks_scored}}</td>
            </tr>
            @endforeach
            </tbody>
          </table>
      </div>
  </div>
@endsection
  