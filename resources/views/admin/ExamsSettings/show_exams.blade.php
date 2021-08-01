@extends('layouts.admin_layouts.admin_design')

@section('css')
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{asset('AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins/timepicker/bootstrap-timepicker.min.css')}}">
@endsection

@section('content')

   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{$course->code}}
        <small>{{"($course->name) "}} </small> Available Exams
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Exams</li>
      </ol>
      @include('messages.flash_messages')
      @include('messages.errors')
    </section>
      <!-- /.content -->

    <section class="content container-fluid">
      <hr><div class="row">
        <div class="col-md-3"><a class="btn btn-block btn-danger" href="{{route('examsSettings.index')}}">Back To My Courses</a></div>
        <div class="col-md-3 pull-right"><a class="btn btn-block btn-info" href="{{route('questions.show',$course->id)}}">Go To My Questions</a></div>
        {{-- <div class="col-md-3 pull-right"><a class="btn btn-block btn-primary" href="#" data-toggle="modal" data-target="#modal-default" >Add New Exam</a></div> --}}
      </div><hr>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">List of {{$course->name}} Exams </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>
                  <th><center>Exams Title</center></th>
                  <th><center>Total Questions</center></th>
                  <th><center>Total Marks</center></th>
                  <th><center>Start Date</center></th>
                  <th><center>Start Time</center></th>
                  <th><center>Duration</center></th>
                  <th><center>Status</center></th>
                  <th><center>Incident Report</center></th>
                  <th><center>Action</center></th>
                </tr>
                </thead>
                <tbody>
                  @foreach($exam as $exams)
                    @php $i = $loop->index; @endphp
                    <tr class="gradeU">
                      <td><center><a title="View Question" href="{{route('examsSettings.view',$exams->id)}}">{{$exams->title}}</a></center></td>
                      <td><center>{{App\ExamsSettings::find($exams->id)->questions->count()}}</center></td>
                      <td><center>{{$exams->total_marks}}</center></td>
                      <td><center>@if($exams->exams_date != NULL)
                        {{ date('l (F d,Y)',strtotime($exams->exams_date))}}
                      @else
                        {{'Not Schedulled'}}
                      @endif</center></td>
                      <td><center>@if($exams->start_time != NULL)
                        {{date('g:i A',strtotime($exams->start_time))}}
                      @else
                        {{'Not Schedulled'}}
                      @endif</center></td>
                      <td><center>@if($exams->stop_time != NULL)
                        @php 
                        $diff=strtotime($exams->stop_time)-strtotime($exams->start_time);
                        @endphp
                        @if(date('g',$diff) > 12 || date('g',$diff)< 12){{strtoupper(date('g',$diff).' hr(s)') }}@endif @if(date('i',$diff) != 00){{strtoupper(date('i',$diff).' min(s)') }}@endif
                      @else
                        {{'Invalid'}}
                    @endif</center></td>
                      @if($exams->status == 1)
                        <td ><center class=" btn-success">Active</center></td>
                      @else
                        <td><center class="btn-danger">Inactive</center></td>
                      @endif
                      <td><center><a title="Write Report For Exams" class="btn btn-primary tip"{{-- href="{{route('examsSettings.report',$exams->id)}}" --}} data-toggle="modal" data-target="#incident-modal-{{$exams->id}}"><i class="glyphicon glyphicon-pencil"></i></a>{{-- {{$exams->updated_at->toFormattedDateString()}} --}}</center></td>
                      <td><center><a title="Edit" class="btn btn-info tip"{{-- href="{{route('examsSettings.edit',$exams->id)}}" --}} data-toggle="modal" data-target="#edit-modal-{{$exams->id}}"><i class="glyphicon glyphicon-edit"></i></a>
                        {{-- <form method="post" action="{{route('examsSettings.destroy',$exams->id)}}" id="delete-form-{{$exams->id}}" style="display: none;">
                          {{csrf_field()}}
                          {{method_field('DELETE')}}
                        </form>
                        <a title="Delete" class="btn btn-danger tip "
                          onclick="
                          if(confirm('Are You Sure You want delete?')){
                            event.preventDefault();
                            document.getElementById('delete-form-{{$exams->id}}').submit();
                          }
                          else{
                            event.preventDefault();
                          }
                          " 
                        ><i class="glyphicon glyphicon-trash"></i></a> --}}
                        @if($exams->status == '0')
                        <a title="Activate" class="btn btn-success tip"href="{{route('examsSettings.status',$exams->id)}}"><i class="fa fa-check-square">Activate</i></a>@endif
                        @if($exams->status == '1')
                        <a title="Deactivate" class="btn btn-warning tip" href="{{route('examsSettings.status',$exams->id)}}"><i class="fa fa-times-circle">Deactivate</i></a>@endif
                      </center></td>
                    </tr>
                    {{-- edit modal --}}
                    <!-- Side Modal Top Right -->
                    <!-- To change the direction of the modal animation change .right class -->
                    <div class="modal fade {{-- modal-warning --}}" id="edit-modal-{{$exams->id}}" tabindex="-1" role="dialog" aria-labelledby="myEditModal-{{$exams->id}}"
                      aria-hidden="true">
                      <!-- Add class .modal-side and then add class .modal-top-right (or other classes from list above) to set a position to the modal -->
                      <div class="modal-dialog {{-- modal-lg --}}" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="modal-title w-100 text-danger" id="myEditModal-{{$exams->id}}">Updating {{"$course->name $exams->title"}} Info</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form role="form" method="post" action="{{route('examsSettings.update',$exams->id)}}" enctype="multipart/form-data" id="edit-form-{{$exams->id}}">
                                {{csrf_field()}}
                                {{method_field('PUT')}}
                                {{-- <div class="box-body"> --}}
                                <div class="form-group col-md-9">
                                  <label>Exams Title</label>
                                  <input class="form-control" disabled name="title" value="{{"$course->name $exams->title"}}">
                                </div>
                                {{-- <div class="form-group">
                                  <label>Total Marks</label>
                                  <input type="number" class="form-control" name="marks" value="{{$exams->total_marks}}">
                                </div> --}}
                                <div class="form-group col-md-3">
                                  <label>Total Questions</label>
                                  <input type="number" class="form-control" value="{{App\ExamsSettings::find($exams->id)->questions->count()}}" disabled="">
                                </div>
                                <div class="form-group col-md-12">
                                  <label>Exams Instructions</label>
                                  <textarea class="form-control" rows="2" placeholder="Enter the Exams Instructions..." name="instructions" >{{$exams->instructions}}</textarea>
                                </div>
                                <div class="form-group col-md-4">
                                  <label>Exams Start Date:</label>

                                  <div class="input-group date">
                                    <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker" name="exams_date" value="{{date('m/d/Y',strtotime($exams->exams_date))}}">
                                  </div>
                                  <!-- /.input group -->
                                </div>

                                <!-- time Picker -->
                                <div class="bootstrap-timepicker">
                                  <div class="form-group col-md-4">
                                    <label>Exams Start Time:</label>

                                    <div class="input-group">
                                      <input type="text" class="form-control timepicker" name="start_time" value="{{date('h:i A',strtotime($exams->start_time))}}">

                                      <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                      </div>
                                    </div>
                                    <!-- /.input group -->
                                  </div>
                                  <!-- /.form group -->
                                </div>
                                <div class="bootstrap-timepicker">
                                  <div class="form-group col-md-4">
                                    <label>Exams End Time:</label>

                                  <div class="input-group">
                                    <input type="text" class="form-control timepicker" name="stop_time" value="{{date('h:i A',strtotime($exams->stop_time))}}">

                                    <div class="input-group-addon">
                                      <i class="fa fa-clock-o"></i>
                                    </div>
                                  </div>
                                  <!-- /.input group -->
                                </div>
                                <!-- /.form group -->
                              </div><hr>
                              {{-- <div class="box-footer">
                                <a type="button" href="{{route('examsSettings.show',$exams->course_id)}}" class="btn btn-danger">
                                Cancel</a>
                                <button type="submit" class="btn btn-primary pull-right">Update</button>
                              </div> --}}
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <a type="button" class="btn btn-success" onclick="event.preventDefault();
                              document.getElementById('edit-form-{{$exams->id}}').submit();" 
                            >Update</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Side Modal Top Right -->
                     {{-- Incident Report modal --}}
                    <!-- Side Modal Top Right -->
                    <!-- To change the direction of the modal animation change .right class -->
                    <div class="modal fade {{-- modal-warning --}}" id="incident-modal-{{$exams->id}}" tabindex="-1" role="dialog" aria-labelledby="myIcidentModal-{{$exams->id}}"
                      aria-hidden="true">
                      <!-- Add class .modal-side and then add class .modal-top-right (or other classes from list above) to set a position to the modal -->
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="modal-title w-100 text-danger" id="myIcidentModal-{{$exams->id}}">Incident Report For {{"$course->name $exams->title"}}</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form role="form" method="post" action="{{route('examsSettings.submitReport',$exams->id)}}" id="incident-form-{{$exams->id}}">
                              {{csrf_field()}}
                              {{-- <div class="box-body "> --}}
                                <div class="form-group">
                                  <label for="report">Report Body</label>
                                  <textarea class="form-control" rows="10" placeholder="Enter the Exams Instructions..." name="report" >{{-- {{$exams->instructions}} --}}</textarea>
                                  {{-- <textarea id="editor1" name="report" rows="5" cols="80">
                                    {{old('report')}}
                                  </textarea> --}}
                                </div>
                                <div class="form-group ">
                                  <div class="checkbox icheck">
                                    <center><label>
                                      <b>Tag Report</b><br>
                                      <input name="stolen" type="checkbox" {{ old('stolen') ? 'checked' : '' }}> Stolen Case<br>
                                      <input name="cheating" type="checkbox" {{ old('cheating') ? 'checked' : '' }}> Student Cheating
                                    </label></center>
                                  </div>
                              {{-- <div class="box-footer ">
                                <a href="{{route('examsSettings.show',$exams->course_id)}}" class="btn btn-danger">Cancel</a>
                                <button type="submit" class="btn btn-primary pull-right">Send Report</button>
                              </div> --}}
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <a type="button" class="btn btn-success" onclick="event.preventDefault();
                              document.getElementById('incident-form-{{$exams->id}}').submit();" 
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
                  <th><center>Exams Title</center></th>
                  <th><center>Total Questions</center></th>
                  <th><center>Total Marks</center></th>                  
                  <th><center>Start Date</center></th>
                  <th><center>Start Time</center></th>
                  <th><center>Duration</center></th>
                  <th><center>Status</center></th>
                  <th><center>Incident Report</center></th>
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

@section('script')
  <script src="{{asset('AdminLTE/bower_components/ckeditor/ckeditor.js')}}"></script>
  <!-- bootstrap datepicker -->
  <script src="{{asset('AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
  <!-- bootstrap time picker -->
  <script src="{{asset('AdminLTE/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
  <script type="text/javascript">
    $(function () {
      // Replace the <textarea id="editor1"> with a CKEditor
      // instance, using default configuration.
      CKEDITOR.replace('editor1')
      //bootstrap WYSIHTML5 - text editor
      $('.textarea').wysihtml5()
    });
    $(function () {
     //Date picker
      $('#datepicker').datepicker({
        autoclose: true
      })
  //Timepicker
      $('.timepicker').timepicker({
        showInputs: false
      })
    });
    
  </script>
@endsection