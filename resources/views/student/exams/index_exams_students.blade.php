@extends('layouts.students_layouts.student_design')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Examinations 
        <small>Available</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('student.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Available Exams</li>
      </ol>
    </section>
      <!-- /.content -->
    <div class="row col-md-offset-1 col-md-10">

    <section class="content">

      @if($courses->count()>0)     
          @foreach($courses as $course)
            <div class="col-md-6">
              <!-- DIRECT CHAT -->
              <div class="box box-warning ">
                <div class="box-header with-border">
                  <h2 class="box-title">{!! "$course->code <small>$course->name" !!}</h2>
                  @php 
                    $exams = App\Course::find($course->id)->examsSettings->sortby('exams_date');
                  @endphp
                  <div class="box-tools pull-right">
                    <span data-toggle="tooltip" title="3 New Messages" class="badge bg-yellow">{{$exams->count()}}</span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  
                  @if($exams->count()>0)
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead>
                      <tr>
                        <th><center><h3>Name</h3></center></th>
                        {{-- <th><center><h3>Marks</h3></center></th> --}}
                        <th><center><h3>Status</h3></center></th>
                      </tr>
                      </thead>
                      <tbody>
                        @foreach($exams as $exam)
                          <tr>
                            <td><center><h4><a href="#">{{ucfirst($exam->title)}}</a></h4></center></td>
                            {{-- <td><center><h4><b>{{$exam->total_marks}}</b></h4></center></td> --}}
                            <td><center><h4>
                              {{-- @if($exam->exams_date == date('d-m-Y') && date('G:i',strtotime($exam->start_time)) > date('G:i'))
                              <span class="label label-success"> Pending</span>
                              @elseif($exam->exams_date == date('d-m-Y') && date('G:i',strtotime($exam->start_time)) <= date('G:i') && date('G:i',strtotime($exam->stop_time)) >= date('G:i'))
                                <span class="label label-warning"> Started</span> --}}
                              @if ($exam->exams_date >= date('d-m-Y')) 
                              <span class="label label-success"> Pending</span>
                              
                              @else
                              <span class="label label-danger"> Not Available</span>
                              @endif
                            </h4></center></td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  @else
                    <h2 class="text-center text-danger">No Exams Available For Now</h2>
                  @endif
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  
                </div>
                <!-- /.box-footer-->
              </div>
              <!--/.direct-chat -->
            </div>
            <!-- /.col -->
          @endforeach
      @else
        <div class="col-md-8 col-md-offset-2 text-danger text-center"><h1>No Course Has Been Made Available To Your Department For Now</h1></div>
      @endif
      </div>
    </section>
  </div>

@endsection