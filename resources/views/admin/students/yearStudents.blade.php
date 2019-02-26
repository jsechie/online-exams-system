@extends('layouts.admin_layouts.admin_design')

@section('content')

   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        All
        <small>Students</small> In {{ucfirst($department->name)}} Year {{$year}}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('allStudents')}}"><i class="fa fa-user"> Students</i></a></li>
        <li><a href="{{route('department.students',$department->id)}}"><i class="fa fa-user"> {{$department->name}}</i></a></li>
        <li class="active">Year {{$year}}</li>
      </ol>
      @include('messages.flash_messages')
    </section>
      <!-- /.content -->

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          @if($students->count() == 0)
            <h1 class="text-center text-danger">No Student Has Registered From This Class</h1><br>
          @endif
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">List Of All Year {{$year}} Students </h3>
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
                      {{-- <td><center>
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
                      </center></td> --}}
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
      </div>
    </section>
  </div>

  	{{-- course --}}
@endsection