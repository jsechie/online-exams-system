@extends('layouts.admin_layouts.admin_design')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Available
        <small>Departments</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Department</li>
      </ol>
      @include('messages.flash_messages')
      @include('messages.errors')
    </section>
      <!-- /.content -->
      <div class="row">
        <div class="col-md-4">
          
        </div>
        <div class="col-md-4">
          <hr>
          <a class="btn btn-block btn-primary" {{-- href="{{route('department.create')}}" --}} data-toggle="modal" data-target="#newDepartment">Add New Department</a>
        </div>
        <div class="col-md-4">
          
        </div>
      </div>

    <section class="content container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">List Of Department Available</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>
                  <th><center>No:</center></th>
                  <th><center>Name</center></th>
                  <th><center>Code</center></th>
                  <th><center>Action</center></th>
                </tr>
                </thead>
                <tbody>
                  @foreach($departments as $department)
                    <tr class="gradeU">
                      <td><center>{{$loop->index + 1}}</center></td>
                      <td><center>{{$department->name}}</center></td>
                      <td><center>{{$department->code}}</center></td>
                      <td><center>{{-- <a title="Edit" class="btn btn-info tip"href="{{route('department.edit',$department->id)}}"><i class="glyphicon glyphicon-edit"></i></a> --}}
                        {{-- edit modal --}}
                        <a title="Edit" class="btn btn-info tip"  data-toggle="modal" data-target="#edit-modal-{{$department->id}}"><i class="glyphicon glyphicon-edit"></i></a>
                        <a title="Delete" class="btn btn-danger tip " data-toggle="modal" data-target="#delete-modal-{{$department->id}}"><i class="glyphicon glyphicon-trash"></i></a>
                        
                        <form method="post" action="{{route('department.destroy',$department->id)}}" id="delete-form-{{$department->id}}" style="display: none;">
                          {{csrf_field()}}
                          {{method_field('DELETE')}}
                        </form>
                        {{-- <a title="Delete" class="btn btn-danger tip "
                          onclick="
                          if(confirm('Are You Sure You want delete {{$department->name}}?')){
                            event.preventDefault();
                            document.getElementById('delete-form-{{$department->id}}').submit();
                          }
                          else{
                            event.preventDefault();
                          }
                          " 
                        ><i class="glyphicon glyphicon-trash"></i></a> --}}         

                        {{-- delete modal --}}
                        <!-- Side Modal Top Right -->
                        <!-- To change the direction of the modal animation change .right class -->
                        <div class="modal fade {{-- modal-warning --}}" id="delete-modal-{{$department->id}}" tabindex="-1" role="dialog" aria-labelledby="myDeleteModal-{{$department->id}}"
                          aria-hidden="true">
                          <!-- Add class .modal-side and then add class .modal-top-right (or other classes from list above) to set a position to the modal -->
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title w-100 text-danger" id="myDeleteModal-{{$department->id}}">Are You Sure You Want To Delete {{$department->name}} Department?</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <h4>Deleting {{ $department->name }} Department will delete all <b>Course(s) and Questions associated with this Department</b></h4>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                                <a type="button" class="btn btn-danger" onclick="event.preventDefault();
                                  document.getElementById('delete-form-{{$department->id}}').submit();" 
                                >Yes, Delete</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Side Modal Top Right -->
                      </center></td>
                    </tr>
                    {{-- edit modal --}}
                        <!-- Side Modal Top Right -->
                        <!-- To change the direction of the modal animation change .right class -->
                        <div class="modal fade {{-- modal-warning --}}" id="edit-modal-{{$department->id}}" tabindex="-1" role="dialog" aria-labelledby="myEditModal-{{$department->id}}"
                          aria-hidden="true">
                          <!-- Add class .modal-side and then add class .modal-top-right (or other classes from list above) to set a position to the modal -->
                          <div class="modal-dialog {{-- modal-lg --}}" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title w-100 text-danger" id="myEditModal-{{$department->id}}">Updating {{$department->name}} Department Info</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form role="form" method="post" action="{{route('department.update',$department->id)}}" id="edit-form-{{$department->id}}">
                                {{csrf_field()}}
                                {{method_field('PATCH')}}
                                
                                  <div class="form-group {{-- col-md-6 col-md-offset-3 --}}">
                                    <label for="department_name">Department Name </label>
                                    <input type="text" class="form-control" id="department_name" placeholder="Name" name="department_name" value="{{$department->name}}" {{old('department_name')}}>
                                  </div>
                                  <div class="form-group ">
                                    <label for="department_code">Deparment Code </label>
                                    <input type="text" class="form-control" id="department_code" placeholder="Code" name="department_code" value="{{$department->code}}">
                                  </div>                
                                {{-- <div class="box-footer">
                                  <a href="{{route('department.index')}}" class="btn btn-danger">Cancel</a>
                                  <button type="submit" class="btn btn-primary pull-right">Update New</button>
                                </div> --}}
                              </form>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                <a type="button" class="btn btn-success" onclick="event.preventDefault();
                                  document.getElementById('edit-form-{{$department->id}}').submit();" 
                                >Update</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Side Modal Top Right -->
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th><center>No:</center></th>
                  <th><center>Name</center></th>
                  <th><center>Code</center></th>
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
   
  {{-- creating new department modal  --}}
  <!-- Side Modal Top Right -->
    <!-- To change the direction of the modal animation change .right class -->
    <div class="modal fade {{-- modal-warning --}}" id="newDepartment" tabindex="-1" role="dialog" aria-labelledby="myNewDepartment" aria-hidden="true">
      <!-- Add class .modal-side and then add class .modal-top-right (or other classes from list above) to set a position to the modal -->
      <div class="modal-dialog {{-- modal-lg --}}" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title w-100 text-danger" id="myNewDepartment">Create A New Department</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form role="form" method="post" action="{{route('department.store')}}" id="newDep">
              {{csrf_field()}}
                <div class="form-group">
                  <label for="department_name">Deparment Name</label>
                  <input type="text" class="form-control" id="department_name" placeholder="Name" name="department_name" value="{{old('department_name')}}">
                </div>
                <div class="form-group">
                  <label for="department_code">Deparment Code</label>
                  <input type="text" class="form-control" id="department_code" placeholder="Code" name="department_code" value="{{old('department_code')}}">
                </div>                
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <a type="button" class="btn btn-primary" onclick="event.preventDefault();
              document.getElementById('newDep').submit();" 
            >Create New</a>
          </div>
        </div>
      </div>
    </div>
@endsection

