@extends('layouts.admin_layouts.admin_design')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Available
        <small>Academic Calenders</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Academics</li>
      </ol>
      @include('messages.flash_messages')
    </section>
      <!-- /.content -->
      <div class="row">
        <div class="col-md-4">
          
        </div>
        <div class="col-md-4">
          <hr>
          <a class="btn btn-block btn-primary" href="{{route('academics.create')}}"'" >Add New Academics</a>
        </div>
        <div class="col-md-4">
          
        </div>
      </div>

    <section class="content">
      <div class="row col-md-8 col-md-offset-2"><h1><marquee ><span class="label label-info">{!!"$academ->year Semester $academ->semester"!!} in Progress</marquee></span></h1></div>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">List Of Academics Available</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>
                  <th><center>No:</center></th>
                  <th><center>Academic Year</center></th>
                  <th><center>Academic Semester</center></th>
                  <th><center>Status</center></th>
                  <th><center>Action</center></th>
                </tr>
                </thead>
                <tbody>
                  @foreach($academics as $academic)
                    <tr class="gradeU">
                      <td><center>{{$loop->index + 1}}</center></td>
                      <td><center>{{$academic->year}}</center></td>
                      <td><center>{{$academic->semester}}</center></td>
                      @if($academic->status == 1)
                        <td ><center ><h4><span class="label label-success"> In Progress</span></h4></center></td>
                      @else
                        <td><center ><h4><span class="label label-danger"> Inactive</span></h4></center></td>
                      @endif
                      <td><center><a title="Edit" class="btn btn-info tip"href="{{route('academics.edit',$academic->id)}}"><i class="glyphicon glyphicon-edit"></i></a>
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
                         @if($academic->status == '0')
                        <a title="Activate" class="btn btn-success tip"href="{{route('academics.status',$academic->id)}}"><i class="fa fa-check-square"> Switch</i></a>@endif
                        {{-- @if($academic->status == '1')
                        <a title="Deactivate" class="btn btn-warning tip"href="{{route('academics.status',$academic->id)}}"><i class="fa fa-times-circle">Deactivate</i></a>@endif --}}
                      </center></td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th><center>No:</center></th>
                  <th><center>Academic Year</center></th>
                  <th><center>Academic Semester</center></th>
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
    
@endsection

