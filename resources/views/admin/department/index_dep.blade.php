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
    </section>
      <!-- /.content -->
      <div class="row">
        <div class="col-md-4">
          
        </div>
        <div class="col-md-4">
          <hr>
          <a class="btn btn-block btn-primary" href="{{route('department.create')}}"'" >Add New Department</a>
        </div>
        <div class="col-md-4">
          
        </div>
      </div>

    <section class="content">
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
                      <td><center><a title="Edit" class="btn btn-info tip"href="{{route('department.edit',$department->id)}}"><i class="glyphicon glyphicon-edit"></i></a>
                        <form method="post" action="{{route('department.destroy',$department->id)}}" id="delete-form-{{$department->id}}" style="display: none;">
                          {{csrf_field()}}
                          {{method_field('DELETE')}}
                        </form>
                        <a title="Delete" class="btn btn-danger tip "
                          onclick="
                          if(confirm('Are You Sure You want delete {{$department->name}}?')){
                            event.preventDefault();
                            document.getElementById('delete-form-{{$department->id}}').submit();
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
    
@endsection

