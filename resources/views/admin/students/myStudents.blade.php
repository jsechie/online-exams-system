@extends('layouts.admin_layouts.admin_design')

@section('content')

   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        All
        <small>Students</small> Taking My Course
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">My Students</li>
      </ol>
      @include('messages.flash_messages')
    </section>
      <!-- /.content -->

    <section class="content">
      <center><u><h3 class="text-warning">Select A Course To View It's Students</h3></u></center>
      @if($courses->count() > 0)
      
        <hr><div class="row">
          <div class="col-lg-1 col-md-1"></div>
          <div class="col-lg-10 col-md-10 row">
            @foreach($courses as $course) 
              <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 text-danger">
                <form method="post" action="{{route('myStudentsCourse')}}">
                  {{csrf_field()}}
                  <input type="hidden" name="dep_id" value="{{$course->dep_id}}">
                  <input type="hidden" name="course_id" value="{{$course->id}}">
                  <input type="hidden" name="year" value="{{$course->year}}">
                  <button class="btn-block" type="submit">
                    <span class="info-box-icon bg-red"><i class="fa fa-file-archive-o"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">{{$course->name}}</span>
                      <span class="info-box-number">{{$course->code}}</span>
                    </div>
                        <!-- /.info-box-content -->
                      <!-- /.info-box -->
                  </button>
                </form>

              </div>

            {{-- <a href="{{route('year.students',{$department->id}/{$year})}}"></a> --}}
            <!-- /.col -->        
            @endforeach
          </div>
          <div class="col-lg-1 col-md-1"></div>
        </div><hr>
      @else
        @include('messages.course_error')
      @endif

      {{-- <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">List Of All Students Taking My Courses</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>
                  <th><center>Picture</center></th>
                  <th><center>Name</center></th>
                  <th><center>Index Number</center></th>
                  <th><center>Student ID</center></th>
                  <th><center>Year</center></th>
                  <th><center>Student Type</center></th>
                  <th><center>Program Type</center></th>
                  <th><center>Action</center></th>
                </tr>
                </thead>
                <tbody>
                  @foreach($students as $student)
                    <tr class="gradeU">
                      <th><center><img class="img-circle" height="60px" src="{{Storage::disk('local')->url("$student->picture")}}"></center></th>
                      <td><center>{{$student->name}}</center></td>
                      <td><center>{{$student->index_number}}</center></td>
                      <td><center>{{$student->student_id}}</center></td>
                      <td><center>{{$student->year}}</center></td>
                      <td><center>{{$student->student_type}}</center></td>
                      <td><center>{{$student->program_type}}</center></td>
                      <td><center>
                        <form method="post" action="{{route('academics.destroy',$academic->id)}}" id="delete-form-{{$academic->id}}" style="display: none;">
                          {{csrf_field()}}
                          {{method_field('DELETE')}}
                        </form>
                        <a title="Delete" class="btn btn-danger tip "
                          onclick="
                          if(confirm('Are You Sure You want delete {{$academic->year}}.{{$academic->semester}}?')){
                            event.preventDefault();
                            document.getElementById('delete-form-{{$academic->id}}').submit();
                          }
                          else{
                            event.preventDefault();
                          }
                          " 
                        ><i class="glyphicon glyphicon-trash"></i></a> 
                      </center></td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th><center>Picture</center></th>
                  <th><center>Name</center></th>
                  <th><center>Index Number</center></th>
                  <th><center>Student ID</center></th>
                  <th><center>Year</center></th>
                  <th><center>Student Type</center></th>
                  <th><center>Program Type</center></th>
                  <th><center>Action</center></th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div> --}}
    </section>
  </div>

  	{{-- course --}}
@endsection