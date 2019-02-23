@extends('layouts.admin_layouts.admin_design')

@section('content')

   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Available
        <small>Courses</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Courses</li>
      </ol>
      @include('messages.flash_messages')
    </section>
      <!-- /.content -->
      <div class="row">
        <div class="col-md-4">
          
        </div>
        <div class="col-md-4">
          <hr>
          <a class="btn btn-block btn-primary" href="{{route('course.create')}}"'" >Add New Course</a>
        </div>
        <div class="col-md-4">
          
        </div>
      </div>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">List Of Courses Available</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>
                  <th><center>Name</center></th>
                  <th><center>Code</center></th>
                  <th><center>Cedit Hours</center></th>
                  <th><center>Department</center></th>
                  <th><center>Semester</center></th>
                  <th><center>Year</center></th>
                  <th><center>Lecturer</center></th>
                  <th><center>Status</center></th>
                  <th><center>Action</center></th>
                </tr>
                </thead>
                <tbody>
                  @foreach($courses as $course)
                    <tr>
                      <td><center>{{$course->name}}</center></td>
                      <td><center>{{$course->code}}</center></td>
                      <td><center>{{$course->credit_hours}}</center></td>
                      <td><center>{{App\Course::find("$course->id")->departments->name}}</center></td>
                      <td><center>{{$course->semester}}</center></td>
                      <td><center>{{$course->year}}</center></td>
                      <td><center>@if($course->assigned_to != NULL ){{ App\Course::find("$course->id")->users->name}}@else
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#assigned">
                          Not Assigned
                        </button>
                      @endif</center></td>
                      </td>

                      {{-- modal for course assignment --}}
                      <div class="modal fade" id="assigned">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title">Assign <i><u><b class="text-success">{{$course->name}}</b></u></i> To:</h4>
                            </div>
                            <div class="modal-body">
                              <p>
                                <form method="post" action="{{route('course.update',$course->id)}}">
                                  {{csrf_field()}}
                                  {{method_field('PATCH')}}
                                  <div class="form-group">
                                        <label >Lecturer Name</label>
                                        <select class="form-control" name="user_id">
                                          <option value="">None</option>
                                          @foreach($users as $user)
                                              <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                      </div>
                                    </p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                  </div>
                                </form>
                          </div>
                          <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                      </div>
                      <!-- /.modal -->

                        @if($course->status == 1)
                          <td ><center class=" btn-success">Active</center></td>
                        @else
                          <td><center class="btn-danger">Inactive</center></td>
                        @endif
                      <td><center><a title="Edit" class="btn btn-info tip"href="{{route('course.edit',$course->id)}}"><i class="glyphicon glyphicon-edit"></i></a>
                        <form method="post" action="{{route('course.destroy',$course->id)}}" id="delete-form-{{$course->id}}" style="display: none;">
                          {{csrf_field()}}
                          {{method_field('DELETE')}}
                        </form>
                        <a title="Delete" class="btn btn-danger tip "
                          onclick="
                          if(confirm('Are You Sure You want delete {{$course->name}}?')){
                            event.preventDefault();
                            document.getElementById('delete-form-{{$course->id}}').submit();
                          }
                          else{
                            event.preventDefault();
                          }
                          " 
                        ><i class="glyphicon glyphicon-trash"></i></a>
                        @if($course->status == '0')
                        <a title="Activate" class="btn btn-success tip"href="{{route('course.status',$course->id)}}"><i class="fa fa-check-square">Activate</i></a>@endif
                        @if($course->status == '1')
                        <a title="Deactivate" class="btn btn-warning tip"href="{{route('course.status',$course->id)}}"><i class="fa fa-times-circle">Deactivate</i></a>@endif
                      </center></td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th><center>Name</center></th>
                  <th><center>Code</center></th>
                  <th><center>Cedit Hours</center></th>
                  <th><center>Department</center></th>
                  <th><center>Semester</center></th>
                  <th><center>Year</center></th>
                  <th><center>Lecturer</center></th>
                  <th><center>Status</center></th>
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

