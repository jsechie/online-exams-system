@extends('layouts.print_layouts.print_design')
@section('content')
  <div class="row">
    <div class="col-xs-12">
      <center><h2 class="page-header text-danger">
        <i class="">{{"$academic_year $course $exams_type Result"}}.</i>
      </h2></center>
    </div>
    <!-- /.col -->
  </div><br>
  <div class="row invoice-info">

    <div class="col-xs-12 col-md-offset-1 col-md-10">
       <!-- Table row -->
      <div class="row">
        <div class="col-xs-12">
          <table class="table table-bordered table-striped table-responsive">
            <thead>
            <tr>
              <th class="text-center">Index Number</th>
              <th class="text-center">Name</th>
              <th class="text-center">Marks</th>
            </tr>
            </thead>
            <tbody>
            @foreach($results as $result)
              <?php $student = App\User::find($result->student_id); ?>
              <tr>
                <td class="text-center">{{$student->index_number}}</td>
                <td class="text-center">{{$student->name}}</td>
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
@endsection

  