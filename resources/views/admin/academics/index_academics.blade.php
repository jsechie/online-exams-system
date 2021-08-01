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
          <a class="btn btn-block btn-primary" {{-- href="{{route('academics.create')}}" --}} data-toggle="modal" data-target="#newAcademic" >Add New Academics</a>
        </div>
        <div class="col-md-4">
          
        </div>
      </div>

    <section class="content container-fluid">
      <div class="row col-md-8 col-md-offset-2"><h1><span class="label label-info">{!!"Academic Calender $academ->year Semester $academ->semester"!!} in Progress</span></h1><hr></div>
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
                  {{-- <th><center>No:</center></th> --}}
                  <th><center>Academic Year</center></th>
                  <th><center>Academic Semester</center></th>
                  <th><center>Status</center></th>
                  <th><center>Action</center></th>
                </tr>
                </thead>
                <tbody>
                  @foreach($academics as $academic)
                    <tr class="gradeU">
                      {{-- <td><center>{{$loop->index + 1}}</center></td> --}}
                      <td><center>{{$academic->year}}</center></td>
                      <td><center>{{$academic->semester}}</center></td>
                      @if($academic->status == 1)
                        <td ><center ><h4><span class="label label-success"> In Progress</span></h4></center></td>
                      @else
                        <td><center ><h4><span class="label label-danger"> Inactive</span></h4></center></td>
                      @endif
                      <td><center><a title="Edit" class="btn btn-info tip" {{-- href="{{route('academics.edit',$academic->id)}}" --}} data-toggle="modal" data-target="#edit-modal-{{$academic->id}}"><i class="glyphicon glyphicon-edit"></i></a>
                        
                        <form method="post" action="{{route('academics.destroy',$academic->id)}}" id="delete-form-{{$academic->id}}" style="display: none;">
                          {{csrf_field()}}
                          {{method_field('DELETE')}}
                        </form>
                        {{-- <a title="Delete" class="btn btn-danger tip "
                          onclick="
                          if(confirm('Are You Sure You want delete {{$academic->year}}.{{$academic->semester}}?')){
                            event.preventDefault();
                            document.getElementById('delete-form-{{$academic->id}}').submit();
                          }
                          else{
                            event.preventDefault();
                          }
                          " 
                        ><i class="glyphicon glyphicon-trash"></i></a> --}}
                        <a title="Delete" class="btn btn-danger tip " data-toggle="modal" data-target="#delete-modal-{{$academic->id}}"><i class="glyphicon glyphicon-trash"></i></a>
                        {{-- delete modal --}}
                        <!-- Side Modal Top Right -->
                        <!-- To change the direction of the modal animation change .right class -->
                        <div class="modal fade {{-- modal-warning --}}" id="delete-modal-{{$academic->id}}" tabindex="-1" role="dialog" aria-labelledby="myDeleteModal-{{$academic->id}}"
                          aria-hidden="true">
                          <!-- Add class .modal-side and then add class .modal-top-right (or other classes from list above) to set a position to the modal -->
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title w-100 text-danger" id="myDeleteModal-{{$academic->id}}">Are You Sure You Want To Delete {{"$academic->year Semester $academic->semester"}} ?</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <h4>You will no longer be able to switch to this Academic year!!</b></h4>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                                <a type="button" class="btn btn-danger" onclick="event.preventDefault();
                                  document.getElementById('delete-form-{{$academic->id}}').submit();" 
                                >Yes, Delete</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Side Modal Top Right -->

                         @if($academic->status == '0')
                        <a title="Activate" class="btn btn-success tip"href="{{route('academics.status',$academic->id)}}"><i class="fa fa-check-square"> Switch</i></a>@endif
                        {{-- @if($academic->status == '1')
                        <a title="Deactivate" class="btn btn-warning tip"href="{{route('academics.status',$academic->id)}}"><i class="fa fa-times-circle">Deactivate</i></a>@endif --}}
                      </center></td>
                    </tr>
                    {{-- edit modal --}}
                        <!-- Side Modal Top Right -->
                        <!-- To change the direction of the modal animation change .right class -->
                        <div class="modal fade {{-- modal-warning --}}" id="edit-modal-{{$academic->id}}" tabindex="-1" role="dialog" aria-labelledby="myEditModal-{{$academic->id}}"
                          aria-hidden="true">
                          <!-- Add class .modal-side and then add class .modal-top-right (or other classes from list above) to set a position to the modal -->
                          <div class="modal-dialog {{-- modal-lg --}}" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title w-100 text-danger" id="myEditModal-{{$academic->id}}">Updating {{"$academic->year Semester $academic->semester"}} Academic Calender Info</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form role="form" method="post" action="{{route('academics.update',$academic->id)}}" id="edit-form-{{$academic->id}}">
                                  {{csrf_field()}}
                                  {{method_field('PATCH')}}
                                    <div class="form-group">
                                      <label for="academics_year">Academics Year (Eg: 2018/2019)</label>
                                      <input type="text" class="form-control" id="academics_year" placeholder="Name" name="academics_year" value="{{$academic->year}}">
                                    </div>
                                    <div class="form-group">
                                      <label for="academics_sem">Academic Semester</label>
                                      <select class="form-control" name="academics_sem">
                                        <option value="1" @if($academic->semester==1) selected="selected" @endif>Semester 1</option>
                                        <option value="2" @if($academic->semester==2) selected="selected" @endif>Semester 2</option>
                                      </select>
                                    </div>                
                                 {{--  <div class="box-footer">
                                    <a href="{{route('academics.index')}}" class="btn btn-danger">Cancel</a>
                                    <button type="submit" class="btn btn-primary pull-right">Update</button>
                                  </div> --}}
                                </form>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                <a type="button" class="btn btn-success" onclick="event.preventDefault();
                                  document.getElementById('edit-form-{{$academic->id}}').submit();" 
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
                  {{-- <th><center>No:</center></th> --}}
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
    
  {{-- creating new Academic Calender modal  --}}
  <!-- Side Modal Top Right -->
    <!-- To change the direction of the modal animation change .right class -->
    <div class="modal fade {{-- modal-warning --}}" id="newAcademic" tabindex="-1" role="dialog" aria-labelledby="myNewAcademic" aria-hidden="true">
      <!-- Add class .modal-side and then add class .modal-top-right (or other classes from list above) to set a position to the modal -->
      <div class="modal-dialog {{-- modal-lg --}}" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title w-100 text-danger" id="myNewAcademic">Create A New Academic Calender</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form role="form" method="post" action="{{route('academics.store')}}" id="newAcademic-form">
              {{csrf_field()}}
              <div class="form-group">
                <label for="academic_year">Academic Year (Eg: 2018/2019)</label>
                <input type="text" class="form-control" id="academic_year" placeholder="Name" name="academic_year" value="{{old('academic_year')}}">
              </div>                
             {{--  <div class="box-footer">
                <a href="{{route('academics.index')}}" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-primary pull-right">Add New</button>
              </div> --}}
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <a type="button" class="btn btn-primary" onclick="event.preventDefault();
              document.getElementById('newAcademic-form').submit();" 
            >Create New</a>
          </div>
        </div>
      </div>
    </div>

@endsection

