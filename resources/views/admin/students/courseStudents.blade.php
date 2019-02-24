@extends('layouts.admin_layouts.admin_design')

@section('content')

   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        All
        <small>Students</small> In {{ucfirst($course->name)}}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('allStudents')}}"><i class="fa fa-user"> Students</i></a></li>
        <li><a href="{{route('department.students',$course->dep_id)}}"><i class="fa fa-user"> Department</i></a></li>
        <li class="active">{{$course->name}}</li>
      </ol>
      @include('messages.flash_messages')
    </section>
      <!-- /.content -->

    <section class="content">
      {{-- <center><u><h3 class="text-warning">Select A Course To View It's Students</h3></u></center>
      @if($courses->count() > 0)
      
        <hr><div class="row">
          <div class="col-lg-2 col-md-2"></div>
          <div class="col-lg-8 col-md-8 row">
            @foreach($courses as $course)        
            <a href="{{route('course.students',$course->id)}}"><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-danger">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="fa fa-files-o"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">{{$course->name}}</span>
                    <span class="info-box-number">{{$course->code}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div></a>
            <!-- /.col -->        
            @endforeach
          </div>
          <div class="col-lg-2 col-md-2"></div>
        </div><hr>
      @else
        <h1 class="text-center text-danger">No Courses Available</h1>
      @endif --}}

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">List Of All Students In The {{$course->name}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>
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
                 {{--  @foreach($students as $student)
                    <tr class="gradeU">
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
                  @endforeach --}}
                </tbody>
                <tfoot>
                <tr>
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
      </div>
    </section>
  </div>

  	{{-- course --}}
@endsection