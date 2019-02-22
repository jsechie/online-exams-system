@extends('layouts.admin_layouts.admin_design')

@section('content')

   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Available
        <small>Users</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Users</li>
      </ol>
    </section>
    @include('messages.flash_messages')
      <!-- /.content -->
      <div class="row">
        <div class="col-md-4">
          
        </div>
        <div class="col-md-4">
          <hr>
          <a class="btn btn-block btn-primary" href="{{route('users.create')}}"'" >Add New User</a>
        </div>
        <div class="col-md-4">
          
        </div>
      </div>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">List Of Users Available</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>
                  <th><center>Lecturer ID</center></th>
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
                      <th><center>{{$user->lec_id}}</center></th>
                      <td><center>{{$user->username}}</center></td>
                      <td><center>{{$user->email}}</center></td>
                      <td><center>{{$user->name}}</center></td>
                      <th><center>{{$user->role}}</center></th>
                      <td><center><a title="Edit" class="btn btn-info tip"href="{{route('users.edit',$user->id)}}"><i class="glyphicon glyphicon-edit"></i></a>
                        <form method="post" action="{{route('users.destroy',$user->id)}}" id="delete-form-{{$user->id}}" style="display: none;">
                          {{csrf_field()}}
                          {{method_field('DELETE')}}
                        </form>
                        <a title="Delete" class="btn btn-danger tip "
                          onclick="
                          if(confirm('Are You Sure You want delete {{$user->name}}?')){
                            event.preventDefault();
                            document.getElementById('delete-form-{{$user->id}}').submit();
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
                  <th><center>User Name</center></th>
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

  	{{-- course --}}
@endsection

