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
        <b>Printed On:</b> {{date('d-m-y h:i:s')}}
      </td>
    </tr></table>
    <hr>
      <div class="container">
          <table class="table table-striped table-responsive table-bordered">
                <thead>
                  @if($results_type == 'singles')
                   <tr>
                    <th class="text-center">Course Code</th>
                    <th class="text-center">Course Name</th>
                    <th class="text-center">Credit Hours</th>
                    <th class="text-center">Marks</th>
                  </tr>
                  @else 
                     <tr>
                    <th class="text-center">Course Code</th>
                    <th class="text-center">Course Name</th>
                    <th class="text-center">Credit Hours</th>
                    <th class="text-center">Mid Sem</th>
                    <th class="text-center">End Of Sem</th>
                    <th class="text-center">Total Marks %</th>
                  </tr>
                  @endif
                </thead>
                <tbody>
                  @if($results_type == 'singles')
                    @foreach($results as $result)
                      <?php $student = App\User::find($result->student_id); ?>
                      <tr>
                      <td class="text-center">{{$result->course_code}}</td>
                      <td class="text-center">{{$result->course_name}}</td>
                      {{-- <th class="text-center">{{$result->credit_hours}}</th> --}}
                      <th class="text-center">{{$result->credit_hours}}</th>
                      <td class="text-center">{{$result->marks_scored}} </td>
                    </tr>
                    @endforeach
                  @else 
                     @foreach($results as $result)
                        <?php $student = App\User::find($result->student_id); ?>
                        <tr>
                        <td class="text-center">{{$result->course_code}}</td>
                        <td class="text-center">{{$result->course_name}}</td>
                        <th class="text-center">{{$result->credit_hours}}</th>
                        <td class="text-center">{{$result->mid_sem_mark}}</td>
                        <td class="text-center">{{$result->end_of_sem_mark}}</td>
                        <td class="text-center">{{$result->mid_sem_mark + $result->end_of_sem_mark}}</td>
                      </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>
      </div>
  </div>
@endsection
  