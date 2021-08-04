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
          <a class="btn btn-block btn-primary" {{-- href="{{route('course.create')}}" --}} data-toggle="modal" data-target="#newCourse" >Add New Course</a>
        </div>
        <div class="col-md-4">
          
        </div>
      </div>

    <section class="content container-fluid">
      <div class="row">
        <div class="col-xs-12 col-md-12 col-sm-12">
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
                      <td><center><a {{-- href="{{route('course.assign',$course->id)}}" --}}data-toggle="modal" data-target="#assign-modal-{{$course->id}}" >@if($course->assigned_to != NULL )<span class="btn btn-primary">{{ App\Course::find("$course->id")->users->name}}</span>@else
                        <span class="btn btn-danger">Not Assigned</span>               
                      @endif</a></center>
                      
                    </td>

                        @if($course->status == 1)
                          <td ><center class=" btn-success">Active</center></td>
                        @else
                          <td><center class="btn-danger">Inactive</center></td>
                        @endif
                      <td><center><a title="Edit" class="btn btn-info tip"{{-- href="{{route('course.edit',$course->id)}}" --}} data-toggle="modal" data-target="#edit-modal-{{$course->id}}"><i class="glyphicon glyphicon-edit"></i></a>
                        
                        <form method="post" action="{{route('course.destroy',$course->id)}}" id="delete-form-{{$course->id}}" style="display: none;">
                          {{csrf_field()}}
                          {{method_field('DELETE')}}
                        </form>
                        <a data-toggle="modal" data-target="#delete-modal-{{$course->id}}" title="Delete" class="btn btn-danger tip "
                          {{-- onclick="
                          if(confirm('Are You Sure You want delete {{$course->name}}?')){
                            event.preventDefault();
                            document.getElementById('delete-form-{{$course->id}}').submit();
                          }
                          else{
                            event.preventDefault();
                          }
                          "  --}}
                        ><i class="glyphicon glyphicon-trash"></i></a>
                        {{-- delete modal --}}
                        <!-- Side Modal Top Right -->
                        <!-- To change the direction of the modal animation change .right class -->
                        <div class="modal fade {{-- modal-warning --}}" id="delete-modal-{{$course->id}}" tabindex="-1" role="dialog" aria-labelledby="myDeleteModal-{{$course->id}}"
                          aria-hidden="true">
                          <!-- Add class .modal-side and then add class .modal-top-right (or other classes from list above) to set a position to the modal -->
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title w-100 text-danger" id="myDeleteModal-{{$course->id}}">Are You Sure You Want To Delete {{$course->name}} Course?</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <h4>Deleting {{ $course->name }} course will delete all <b>Questions and Examinations associated with this Course</b></h4>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                                <a type="button" class="btn btn-danger" onclick="event.preventDefault();
                                  document.getElementById('delete-form-{{$course->id}}').submit();" 
                                >Yes, Delete</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Side Modal Top Right -->
                        @if($course->status == '0')
                        <a title="Activate" class="btn btn-success tip"href="{{route('course.status',$course->id)}}"><i class="fa fa-check-square">Activate</i></a>@endif
                        @if($course->status == '1')
                        <a title="Deactivate" class="btn btn-warning tip"href="{{route('course.status',$course->id)}}"><i class="fa fa-times-circle">Deactivate</i></a>@endif
                      </center></td>
                    </tr>
                    {{-- edit modal --}}
                        <!-- Side Modal Top Right -->
                        <!-- To change the direction of the modal animation change .right class -->
                        <div class="modal fade {{-- modal-warning --}}" id="edit-modal-{{$course->id}}" tabindex="-1" role="dialog" aria-labelledby="myEditModal-{{$course->id}}"
                          aria-hidden="true">
                          <!-- Add class .modal-side and then add class .modal-top-right (or other classes from list above) to set a position to the modal -->
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title w-100 text-danger" id="myEditModal-{{$course->id}}">Updating {{$course->name}} Info</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                 <!-- form start -->
                                <form role="form" method="post" action="{{route('course.update',$course->id)}}" id="edit-form-{{$course->id}}">
                                {{csrf_field()}}
                                {{method_field('PATCH')}}                                  
                                    <div class="form-group col-md-7">
                                      <label for="course_name">Course Name</label>
                                      <input type="text" class="form-control" id="course_name" placeholder="Name" name="course_name" value="{{$course->name}}">
                                    </div>
                                    <div class="form-group col-md-3">
                                      <label for="course_code">Course Code</label>
                                      <input type="text" class="form-control" id="course_code" placeholder="Code" name="course_code" value="{{$course->code}}">
                                    </div> 
                                    <div class="form-group col-md-2">
                                      <label for="course_code">Credit Hours</label>
                                      <input type="number" class="form-control" id="credit_hours" name="credit_hours" value="{{$course->credit_hours}}">
                                    </div>               
                                   <div class="form-group col-md-12">
                                      <label >Department Name</label>
                                      <select class="form-control" name="dep_id">
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}" 
                                              @if($course->dep_id == $department->id) selected="selected" @endif 
                                              >{{$department->name}}</option>
                                          @endforeach
                                      </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label >Semester</label>
                                      <select name="semester" class="form-control">
                                          <option value="1" @if($course->semester == '1') selected="selected" @endif>1</option>
                                          <option value="2" @if($course->semester == '2') selected="selected" @endif>2</option>
                                      </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label >Year</label>
                                      <select name="year" class="form-control">
                                        @php $years=[1,2,3,4,5,6] @endphp
                                        @foreach($years as $year)
                                          <option value="{{$year}}" @if($course->year == "$year") selected="selected" @endif>{{$year}}</option>
                                          @endforeach
                                      </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                      <label >Assign Course To</label>
                                      <select name="assigned_to" class="form-control">
                                        <option value="">---None---</option>
                                         @foreach($users as $user)
                                            <option value="{{$user->id}}"
                                              @if($course->assigned_to == $user->id) selected="selected" @endif>{{$user->name}}</option>
                                          @endforeach
                                      </select>
                                    </div>
                                 {{--  <div class="box-footer col-md-12">
                                    <a href="{{route('course.index')}}" class="btn btn-danger">Cancel</a>
                                    <button type="submit" class="btn btn-primary pull-right">Update</button>
                                  </div> --}}
                                </form>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                <a type="button" class="btn btn-success" onclick="event.preventDefault();
                                  document.getElementById('edit-form-{{$course->id}}').submit();" 
                                >Update</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Side Modal Top Right -->
                        {{-- assign course modal --}}
                        <!-- Side Modal Top Right -->
                        <!-- To change the direction of the modal animation change .right class -->
                        <div class="modal fade {{-- modal-warning --}}" id="assign-modal-{{$course->id}}" tabindex="-1" role="dialog" aria-labelledby="myAssignCourseModal-{{$course->id}}"
                          aria-hidden="true">
                          <!-- Add class .modal-side and then add class .modal-top-right (or other classes from list above) to set a position to the modal -->
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title w-100 text-danger" id="myAssignCourseModal-{{$course->id}}">Assign {{$course->name}} to A Lecturer</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form method="post" action="{{route('assign.update',$course->id)}}" id="assign-form-{{$course->id}}">
                                  {{csrf_field()}}
                                  {{method_field('PATCH')}}
                                  <div class="form-group">
                                      <label for="user_id">Lecturer Name</label>
                                      <select class="form-control input-lg" name="user_id">
                                        <option value="">---None---</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                  {{-- <div class="form-group col-md-12">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary pull-right">Save changes</button>
                                  </div> --}}
                                </form>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                <a type="button" class="btn btn-primary" onclick="event.preventDefault();
                                  document.getElementById('assign-form-{{$course->id}}').submit();" 
                                >Assign</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Side Modal Top Right -->
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
  	{{-- creating new Course modal  --}}
  <!-- Side Modal Top Right -->
    <!-- To change the direction of the modal animation change .right class -->
    <div class="modal fade {{-- modal-warning --}}" id="newCourse" tabindex="-1" role="dialog" aria-labelledby="myNewCourse" aria-hidden="true">
      <!-- Add class .modal-side and then add class .modal-top-right (or other classes from list above) to set a position to the modal -->
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title w-100 text-danger" id="myNewCourse">Create A New Course</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- form start -->
              <form role="form" method="post" action="{{route('course.store')}}" id="newCourse-form">
              {{csrf_field()}}
                {{-- <div class="box-body"> --}}
                  <div class="form-group col-md-7">
                    <label for="course_name">Course Name</label>
                    <input type="text" class="form-control" id="course_name" placeholder="Name" name="course_name" value="{{old('course_name')}}">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="course_code">Course Code</label>
                    <input type="text" class="form-control" id="course_code" placeholder="Code" name="course_code"  value="{{old('course_code')}}">
                  </div> 
                  <div class="form-group col-md-2">
                    <label for="course_code">Credit Hours</label>
                    <input type="number" class="form-control" id="credit_hours" name="credit_hours"  value="{{old('credit_hours')}}">
                  </div>               
                 <div class="form-group col-md-12">
                    <label >Department Name</label>
                    <select class="form-control" name="department_name">
                      <option value="">---Select Department---</option>
                      @foreach($departments as $department)
                          <option value="{{$department->id}}" {{old('department_name')==$department->id? 'selected':'' }}>{{$department->name}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label >Semester</label>
                    <select name="semester" class="form-control">
                        <option value="">---Select Semester---</option>
                        <option value="1" {{old('semester')=='1'? 'selected':'' }}>1</option>                   
                        <option value="2" {{old('semester')=='2'? 'selected':'' }}>2</option>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label >Year</label>
                    <select name="year" class="form-control">
                      @php $years =['1','2','3','4','5','6']; @endphp
                      <option value="">---Select Year---</option>
                      @foreach($years as $year)
                        <option value="{{$year}}" {{old('year')==$year? 'selected':'' }}>{{$year}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-12">
                    <label >Assign Course To</label>
                    <select name="assigned_to" class="form-control">
                      <option value="">---None---</option>
                       @foreach($users as $user)
                          <option value="{{$user->id}}" {{old('assigned_to')==$user->id? 'selected':'' }}>{{$user->name}}</option>
                        @endforeach
                    </select>
                  </div>
                {{-- <div class="box-footer col-md-12">
                  <a href="{{route('course.index')}}" class="btn btn-danger">Cancel</a>
                  <button type="submit" class="btn btn-primary pull-right">Add New</button>
                </div> --}}
              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <a type="button" class="btn btn-primary" onclick="event.preventDefault();
              document.getElementById('newCourse-form').submit();" 
            >Create New</a>
          </div>
        </div>
      </div>
    </div>
@endsection

