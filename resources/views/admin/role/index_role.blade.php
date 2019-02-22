@extends('layouts.admin_layouts.admin_design')

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Available
        <small>Roles</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Role</li>
      </ol>
    </section>
      <!-- /.content -->
      <div class="row">
        <div class="col-md-4">
          
        </div>
        <div class="col-md-4">
          <hr>
          <a class="btn btn-block btn-primary" href="{{route('role.create')}}"'" >Add New Role</a>
        </div>
        <div class="col-md-4">
          
        </div>
      </div>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">List Of Role Available</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>
                  <th><center>No:</center></th>
                  <th><center>Name</center></th>
                  <th><center>Action</center></th>
                </tr>
                </thead>
                <tbody>
                  @foreach($roles as $role)
                    <tr class="gradeU">
                      <td><center>{{$loop->index + 1}}</center></td>
                      <td><center>{{$role->name}}</center></td>
                      <td><center><a title="Edit" class="btn btn-info tip"href="{{route('role.edit',$role->id)}}"><i class="glyphicon glyphicon-edit"></i></a>
                        <form method="post" action="{{route('role.destroy',$role->id)}}" id="delete-form-{{$role->id}}" style="display: none;">
                          {{csrf_field()}}
                          {{method_field('DELETE')}}
                        </form>
                        <a title="Delete" class="btn btn-danger tip "
                          onclick="
                          if(confirm('Are You Sure You want delete {{$role->name}}?')){
                            event.preventDefault();
                            document.getElementById('delete-form-{{$role->id}}').submit();
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
                  <th><center>No:</center></th>
                  <th><center>Name</center></th>
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

  	{{-- <div id="content">
    <div id="content-header">
      <div id="breadcrumb"> <a href="{{url('admin')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">ADMIN Role</a> </div>
      <h1>Administrator Roles</h1>
    </div>
    <div class="container-fluid">
      <hr>
      <a class="btn btn-block btn-primary" href="{{route('role.create')}}"'" >Add New Role</a>
      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
              <h5>Available Roles</h5>
            </div>
            <div class="widget-content nopadding">
              <table class="table table-bordered data-table">
                <thead>
                  <tr>
                    <th>No:</th>
                    <th>Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($roles as $role)
                  <tr class="gradeU">
                    <td><center>{{$loop->index + 1}}</center></td>
                    <td><center>{{$role->name}}</center></td>
                    <td><center><a title="Edit" class="btn btn-info tip"href="{{route('role.edit',$role->id)}}"><i class="icon-pencil"></i></a>
                      <form method="post" action="{{route('role.destroy',$role->id)}}" id="delete-form-{{$role->id}}" style="display: none;">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                      </form>
                      <a title="Delete" class="btn btn-danger tip "
                        onclick="
                        if(confirm('Are You Sure You want delete {{$role->name}}?')){
                          event.preventDefault();
                          document.getElementById('delete-form-{{$role->id}}').submit();
                        }
                        else{
                          event.preventDefault();
                        }
                        " 
                      ><i class="icon-remove"></i></a>
                    </center></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> --}}
@endsection

