@extends('layouts.admin_layouts.admin_design')

@section('content')

   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Available
        <small>Lecturer(s)</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Lecturer(s)</li>
      </ol>
    </section>
    @include('messages.flash_messages')
    @include('messages.errors')
      <!-- /.content -->
      <div class="row">
        <div class="col-md-4">
          
        </div>
        <div class="col-md-4">
          <hr>
          <a class="btn btn-block btn-primary" {{-- href="{{route('users.create')}}"'" --}}data-toggle="modal" data-target="#newLecturer" >Add New Lecturer</a>
        </div>
        <div class="col-md-4">
          
        </div>
      </div>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">List Of Lecturer(s) Available</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>
                  <th><center>Picture</center></th>
                  <th><center>Staff ID</center></th>
                  <th><center>User Name</center></th>
                  <th><center>Email</center></th>
                  <th><center>Name</center></th>
                  <th><center>Role</center></th>
                  <th><center>Action</center></th>
                </tr>
                </thead>
                <tbody>
                  @foreach($users as $user)
                    <tr class="gradeU">
                      <th><center><img class="img-circle" height="60px" src="{{Storage::disk('local')->url("$user->picture")}}"></center></th>
                      <th><center>{{$user->lec_id}}</center></th>
                      <td><center>{{$user->username}}</center></td>
                      <td><center>{{$user->email}}</center></td>
                      <td><center>{{$user->name}}</center></td>
                      <th><center>{{$user->role}}</center></th>
                      <td><center><a title="Edit" class="btn btn-info tip"{{-- href="{{route('users.edit',$user->id)}}" --}} data-target="#edit-modal-{{$user->id}}" data-toggle="modal"><i class="glyphicon glyphicon-edit"></i></a>
                        <form method="post" action="{{route('users.destroy',$user->id)}}" id="delete-form-{{$user->id}}" style="display: none;">
                          {{csrf_field()}}
                          {{method_field('DELETE')}}
                        </form>
                        <a title="Delete" class="btn btn-danger tip " data-toggle="modal" data-target="#delete-modal-{{$user->id}}"
                          {{-- onclick="
                          if(confirm('Are You Sure You want delete {{$user->name}}?')){
                            event.preventDefault();
                            document.getElementById('delete-form-{{$user->id}}').submit();
                          }
                          else{
                            event.preventDefault();
                          }
                          "  --}}
                        ><i class="glyphicon glyphicon-trash"></i></a>
                      </center></td>
                    </tr>
                    {{-- delete modal --}}
                        <!-- Side Modal Top Right -->
                        <!-- To change the direction of the modal animation change .right class -->
                        <div class="modal fade {{-- modal-warning --}}" id="delete-modal-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myDeleteModal-{{$user->id}}"
                          aria-hidden="true">
                          <!-- Add class .modal-side and then add class .modal-top-right (or other classes from list above) to set a position to the modal -->
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title w-100 text-danger" id="myDeleteModal-{{$user->id}}">Are You Sure You Want To Delete {{$user->name}}'s Record?</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <h4>Deleting {{ $user->name }}'s record <b>will prevent him from accessing the Lecturers portal.</b><br><br> And also re-assign courses assigned to {{$user->name}}.</h4>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                                <a type="button" class="btn btn-danger" onclick="event.preventDefault();
                                  document.getElementById('delete-form-{{$user->id}}').submit();" 
                                >Yes, Delete</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Side Modal Top Right -->
                    {{-- edit modal --}}
                        <!-- Side Modal Top Right -->
                        <!-- To change the direction of the modal animation change .right class -->
                        <div class="modal fade {{-- modal-warning --}}" id="edit-modal-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myEditModal-{{$user->id}}"
                          aria-hidden="true">
                          <!-- Add class .modal-side and then add class .modal-top-right (or other classes from list above) to set a position to the modal -->
                          <div class="modal-dialog {{-- modal-lg --}}" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title w-100 text-danger" id="myEditModal-{{$user->id}}">Updating {{$user->name}}'s Details</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form role="form" method="post" action="{{route('users.update',$user->id)}}" enctype="multipart/form-data" id="edit-form-{{$user->id}}">
                                  {{csrf_field()}}
                                  {{method_field('PUT')}}
                                  <div class="box-body">
                                    <div class="form-group col-md-12">
                                      <label for="name">Name</label>
                                      <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{$user->name}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label for="username">Username</label>
                                      <input type="text" class="form-control" id="username" placeholder="Username" name="username" value="{{$user->username}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label for="lec_id">Lecturer ID</label>
                                      <input type="text" class="form-control" id="lec_id" placeholder="Lecturer ID" name="lec_id" value="{{$user->lec_id}}">
                                    </div>
                                    <div class="form-group col-md-12">
                                      <label for="email">Email</label>
                                      <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}">
                                    </div>               
                                    <div class="form-group col-md-6">
                                      <label >Role</label>
                                      <select name="role" class="form-control">
                                          <option value="Lecturer" @if($user->role == 'Lecturer') selected="selected" @endif >Lecturer</option>
                                          <option value="Examiner" @if($user->role == 'Examiner') selected="selected" @endif >Examiner</option>
                                      </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="picture">Upload Profile Picture</label>
                                        <input type="file" class="form-control" id="picture" name="picture">
                                     </div>
                                    <div class="form-group col-md-6">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" value"{{$user->password}}">
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value"{{$user->password}}">
                                      </div>
                                  {{-- <div class="box-footer">
                                    <a href="{{route('users.index')}}" class="btn btn-danger">Cancel</a>
                                    <button type="submit" class="btn btn-primary pull-right">Update</button>
                                  </div> --}}
                                </form>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                <a type="button" class="btn btn-success" onclick="event.preventDefault();
                                  document.getElementById('edit-form-{{$user->id}}').submit();" 
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
                  <th><center>Picture</center></th>
                  <th><center>Staff ID</center></th>
                  <th><center>User Name</center></th>
                  <th><center>Email</center></th>
                  <th><center>Name</center></th>
                  <th><center>Role</center></th>
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
  {{-- creating new lecturer modal  --}}
  <!-- Side Modal Top Right -->
    <!-- To change the direction of the modal animation change .right class -->
    <div class="modal fade {{-- modal-warning --}}" id="newLecturer" tabindex="-1" role="dialog" aria-labelledby="myNewLecturer" aria-hidden="true">
      <!-- Add class .modal-side and then add class .modal-top-right (or other classes from list above) to set a position to the modal -->
      <div class="modal-dialog {{-- modal-lg --}}" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title w-100 text-danger" id="myNewLecturer">Add A New Lecturer</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form role="form" method="post" action="{{route('users.store')}}" enctype="multipart/form-data" id="newLec">
              {{csrf_field()}}
                {{-- <div class="box-body"> --}}
                  <div class="form-group col-md-12">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{old('name')}}">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Username" name="username" value="{{old('username')}}">
                  </div> 
                  <div class="form-group col-md-6">
                    <label for="lec_id">Lecturer ID</label>
                    <input type="text" class="form-control" id="lec_id" placeholder="Lecturer ID" name="lec_id" value="{{old('lec_id')}}">
                  </div>
                  <div class="form-group col-md-12">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
                  </div>               
                  <div class="form-group col-md-6">
                    <label >Role</label>
                    <select name="role" class="form-control">
                        <option value="Lecturer">Lecturer</option>
                        <option value="Examiner">Examiner</option>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                      <label for="picture">Upload Profile Picture</label>
                      <input type="file" class="form-control" id="picture" name="picture">
                   </div>
                  <div class="form-group col-md-6">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="password_confirmation">Confirm Password</label>
                      <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                {{-- <div class="box-footer">
                  <a href="{{route('users.index')}}" class="btn btn-danger">Cancel</a>
                  <button type="submit" class="btn btn-primary pull-right">Add New</button>
                </div> --}}
              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <a type="button" class="btn btn-primary" onclick="event.preventDefault();
              document.getElementById('newLec').submit();" 
            >Add New</a>
          </div>
        </div>
      </div>
    </div>
@endsection

