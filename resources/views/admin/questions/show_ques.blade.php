@extends('layouts.admin_layouts.admin_design')

@section('css')
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{asset('AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins/timepicker/bootstrap-timepicker.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins/iCheck/square/blue.css')}}">
@endsection

@section('content')

   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{$course->code}}
        <small>{{"($course->name) "}} </small> Questions
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Questions</li>
      </ol>
      @include('messages.flash_messages')
      @include('messages.errors')
    </section>
      <!-- /.content -->

    <section class="content">
      <hr><div class="row">
        <div class="col-md-3"><a class="btn btn-block btn-warning" href="{{route('questions.index')}}">Back To My Courses</a></div>
        <div class="col-md-3"><a class="btn btn-block btn-danger" href="{{route('examsSettings.show',$course->id)}}"" >Go To Exams</a></div>
         {{-- <div class="col-md-3"><a class="btn btn-block btn-success" href="{{route('questions.activate',$course->id)}}" >Activate All Questions</a></div> --}}
        {{-- <div class="col-md-3"><a class="btn btn-block btn-danger" href="{{route('questions.deactivate',$course->id)}}" >Deactivate All Questions</a></div> --}}
        <div class="col-md-3"><a class="btn btn-block btn-success" href="#" data-toggle="modal" data-target="#modal-primary">Upload Questions</a></div>
        <div class="col-md-3 pull-right"><a class="btn btn-block btn-primary" {{-- data-toggle="modal" data-target="#modal-default" --}} href="{{route('questions.add',$course->id)}}">Add New Question</a></div>
      </div><hr>
        {{-- <div class="row">
          <div class="col-md-3 col-sm-4 col-xs-12">
            <a href="#" data-toggle="modal" data-target="#modal-info"><div class="info-box">
              <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">{{$active}} @if($active==1) Question @else Questions @endif</span>
                <span class="info-box-text label label-success">Active</span>
                @if($active>=1)<span class="info-box-number"> Create New Exams</span> @endif
              </div>
              <!-- /.info-box-content -->
            </div></a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          @if($questions->count()>0)
          <div class=" col-md-3 col-sm-4 col-xs-12">
            <a href="#" data-toggle="modal" data-target="#modal-default"><div class="info-box">
              <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Randomly</span>
                <span class="info-box-number">Activate</span>
              </div>
              <!-- /.info-box-content -->
            </div></a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class=" col-md-3 col-sm-4 col-xs-12">
            <a href="#" data-toggle="modal" data-target="#modal-success"><div class="info-box">
              <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Randomly</span>
                <span class="info-box-number">Deactivate</span>
              </div>
              <!-- /.info-box-content -->
            </div></a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          @endif
          <div class="col-md-3 col-sm-4 col-xs-12">
            <a href="#" data-toggle="modal" data-target="#modal-primary"><div class="info-box">
              <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">Upload</span>
                <span class="info-box-text">Questions</span>
                <span class="info-box-number">To My Course</span>
              </div>
              <!-- /.info-box-content -->
            </div></a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-4 col-xs-12">
            <a href="{{route('examsSettings.show',$course->id)}}"><div class="info-box">
              <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">View</span>
                <span class="info-box-text">Test</span>
                <span class="info-box-number">On My Course</span>
              </div>
              <!-- /.info-box-content -->
            </div></a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div> --}}
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">List of {{$course->name}} Questions = <span class="label label-danger">{{$questions->count()}}</span> </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>
                  <th><center>Number</center></th>
                  <th><center>Question</center></th>
                  <th><center>Last Updated</center></th>
                  {{-- <th><center>Status</center></th> --}}
                  <th><center>Action</center></th>
                </tr>
                </thead>
                <tbody>
                  @foreach($questions as $question)
                    <tr class="gradeU">
                      <th><center>{{$loop->index+1}}</center></th>
                      <td>
                        <div class="panel box @if($loop->index/2 == 0) box-warning @else box-success @endif">
                          <div class="box-header with-border">
                            <h4 class="box-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapse-{{$question->id}}" class="@if($loop->index%2 == 0 )text-danger @endif">
                                <!-- question starts here -->
                                {!!$question->question!!}
                                <!-- /.question -->
                              </a>
                            </h4>
                          </div>
                          <div id="collapse-{{$question->id}}" class="panel-collapse collapse out">
                            <div class="box-body">
                              <!-- options starts here -->
                              <h4>A. {{$question->option_A}} 
                              @if($question->answer == 'A')<small><i class="fa fa-check-circle text-danger">correct answer</i></small>@endif</h4>
                              <h4>B. {{$question->option_B}}
                              @if($question->answer == 'B')<small><i class="fa fa-check-circle text-danger">correct answer</i></small>@endif</h4>
                              @if($question->option_C != NULL)
                                <h4>C. {{$question->option_C}}
                                @if($question->answer == 'C')<small><i class="fa fa-check-circle text-danger">correct answer</i></small>@endif</h4>
                              @endif
                              @if($question->option_D != NULL)
                                <h4>D. {{$question->option_D}}
                                @if($question->answer == 'D')<small><i class="fa fa-check-circle text-danger">correct answer</i></small>@endif</h4>
                              @endif
                              @if($question->option_E != NULL)
                                <h4>E. {{$question->option_E}}
                                @if($question->answer == 'E')<small><i class="fa fa-check-circle text-danger">correct answer</i></small>@endif</h4>
                              @endif
                              <!-- /.body -->
                            </div>
                          </div>
                        </div>
                      </td>
                      <td><center>{{$question->updated_at->toFormattedDateString()}}</center></td>
                     {{--  @if($question->status == 1)
                        <td ><center class=" btn-success">Active</center></td>
                      @else
                        <td><center class="btn-danger">Inactive</center></td>
                      @endif --}}
                      <td><center><a title="Edit" class="btn btn-info tip"href="{{route('questions.edit',$question->id)}}"><i class="glyphicon glyphicon-edit"></i></a>
                        <form method="post" action="{{route('questions.destroy',$question->id)}}" id="delete-form-{{$question->id}}" style="display: none;">
                          {{csrf_field()}}
                          {{method_field('DELETE')}}
                        </form>
                        <a title="Delete" class="btn btn-danger tip "
                          onclick="
                          if(confirm('Are You Sure You want delete?')){
                            event.preventDefault();
                            document.getElementById('delete-form-{{$question->id}}').submit();
                          }
                          else{
                            event.preventDefault();
                          }
                          " 
                        ><i class="glyphicon glyphicon-trash"></i></a>
                        {{-- @if($question->status == '0')
                        <a title="Activate" class="btn btn-success tip"href="{{route('questions.status',$question->id)}}"><i class="fa fa-check-square">Activate</i></a>@endif
                        @if($question->status == '1')
                        <a title="Deactivate" class="btn btn-warning tip"href="{{route('questions.status',$question->id)}}"><i class="fa fa-times-circle">Deactivate</i></a>@endif --}}
                      </center></td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th><center>Number</center></th>
                  <th><center>Question</center></th>
                  <th><center>Last Updated</center></th>
                  {{-- <th><center>Status</center></th> --}}
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


      {{-- upload questions modal --}}
      <div class="modal fade" id="modal-primary">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Questions Upload To <span class="text-danger">{{$course->name}}</span> Course</h4>
            </div>
            <div class="modal-body">
              <form role="form" method="post" action="{{route('questions.upload')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="box-body">
                  <div class="form-group">
                    <label>Upload Your Questions</label>
                    <input type="file" class="form-control" name="questions">
                  </div>
                  <input type="hidden" name="course_id" value="{{$course->id}}">
                  {{-- <div class="form-group">
                    <div class="checkbox icheck">
                      <label>
                        <input name="active" type="checkbox" {{ old('active') ? 'checked' : '' }}> Make All Questions Active
                      </label>
                    </div>
                </div> --}}
                <div class="box-footer">
                  <a type="button" data-dismiss="modal" aria-label="Close" class="btn btn-danger">Cancel</a>
                  <button type="submit" class="btn btn-primary pull-right">Upload</button>
                </div>
              </div>
              </form>
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      {{-- modal for the creating the exams --}}
      {{-- <div class="modal fade" id="modal-info">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Creating New Exams</h4>
            </div>
            <div class="modal-body">@if($active>0)
              <form role="form" method="post" action="{{route('examsSettings.store')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="box-body">
                  <div class="form-group">
                    <h3 class="text-success"><center><u>Total Questions To Be Added <span class="text-danger">{{'('.$active.')'}}</span></u></center></h3>
                    <input type="hidden" class="form-control" name="total_questions" value="{{$active}}">
                  </div>
                  <div class="form-group">
                    <label>Exams Title</label>
                    <input type="text" class="form-control" placeholder="Enter the Exams Title..." name="title" value="{{old('title')}}">
                  </div>
                  <div class="form-group">
                    <label>Total Marks</label>
                    <input type="number" class="form-control" name="marks">
                  </div>
                  <div class="form-group">
                    <label>Exams Instructions</label>
                    <textarea class="form-control" rows="2" placeholder="Enter the Exams Instructions..." name="instructions" >{{old('instructions')}}</textarea>
                  </div>
                  <!-- Date -->
                  <div class="form-group">
                    <label>Exams Start Date:</label>

                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="datepicker" name="exams_date" value="{{old('exams_date')}}">
                    </div>
                    <!-- /.input group -->
                  </div>

                  <!-- time Picker -->
                  <div class="bootstrap-timepicker">
                    <div class="form-group">
                      <label>Exams Start Time:</label>

                      <div class="input-group">
                        <input type="text" class="form-control timepicker" name="start_time" value="{{old('start_time')}}">

                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                      </div>
                      <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                  </div>
                  <div class="bootstrap-timepicker">
                    <div class="form-group">
                      <label>Exams End Time:</label>

                      <div class="input-group">
                        <input type="time" class="form-control timepicker" name="stop_time" value="{{old('stop_time')}}">

                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                      </div>
                      <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                  </div>

                  <input type="hidden" name="course_id" value="{{$course->id}}">
                <div class="box-footer">
                  <button type="submit" class="btn btn-primary pull-right">Add New</button>
                  @else
                    <div class="alert alert-danger ">
                      <h4><i class="icon fa fa-ban"></i> Notice!</h4>
                      <h4>You need to select some questions before creating the new EXAMS</h4>
                    </div>
                    <div class="alert alert-info ">
                      <h4><i class="icon fa fa-check"></i> Or!</h4>
                      <h4>If you want to CREATE an Empty EXAMS <a type="button" class="btn btn-success" href="{{route('examsSettings.show',$course->id)}}">Click Here</a> and click on Add Exams from there</h4>
                    </div>
                  @endif 
                  <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-danger">
                  Cancel</button>
                </div>
              </div>
              </form>
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div> --}}

      {{-- modal for random questions --}}
      {{-- <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Randomly Activate Questions</h4>
            </div>
            <div class="modal-body">
              <form role="form" method="post" action="{{route('questions.randomActivate')}}">
                {{csrf_field()}}
                <div class="box-body">
                  <div class="form-group">
                    <label>Total Questions To Be Activated <br>Min: <span class="label label-success">1</span> </label>
                    <input type="number" class="form-control" name="random_number" value="{{old('random_number')}}" max="{{$questions->count()}}" min="1">
                    <label>Max: <span class="label label-danger"> {{$questions->count()-$active}}</span></label>
                  </div>
                  <input type="hidden" name="course_id" value="{{$course->id}}">
                <div class="box-footer">
                  <button type="submit" class="btn btn-primary pull-right">Generate</button>
                  <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-danger">
                  Cancel</button>
                </div>
              </div>
              </form>
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div> --}}

      {{-- Deactivate --}}
      {{-- <div class="modal fade" id="modal-success">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Randomly Deactivate Questions</h4>
            </div>
            <div class="modal-body">
              <form role="form" method="post" action="{{route('questions.randomDeactivate')}}">
                {{csrf_field()}}
                <div class="box-body">
                  <div class="form-group">
                    <label>Total Questions To Be Deactivated <br>Min: <span class="label label-success">1</span> </label>
                    <input type="number" class="form-control" name="random_number" value="{{old('random_number')}}" max="{{$questions->count()}}" min="1">
                    <label>Max: <span class="label label-danger"> {{$active}}</span></label>
                  </div>
                  <input type="hidden" name="course_id" value="{{$course->id}}">
                <div class="box-footer">
                  <button type="submit" class="btn btn-primary pull-right">Generate</button>
                  <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-danger">
                  Cancel</button>
                </div>
              </div>
              </form>
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div> --}}

@endsection

@section('script')
  <script type="text/javascript">
    $(function () {
      $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
     //Date picker
      $('#datepicker').datepicker({
        autoclose: true
      });
      //Timepicker
      $('.timepicker').timepicker({
        showInputs: false
      });
    });
  </script>
<script src="{{asset('AdminLTE/bower_components/ckeditor/ckeditor.js')}}"></script>
  <!-- bootstrap datepicker -->
  <script src="{{asset('AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
  <!-- bootstrap time picker -->
  <script src="{{asset('AdminLTE/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
  
  @endsection


