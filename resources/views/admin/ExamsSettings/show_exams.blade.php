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

    <section class="content">
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
                      <td><center><a title="Write Report For Exams" class="btn btn-primary tip"href="{{route('examsSettings.report',$exams->id)}}"><i class="glyphicon glyphicon-pencil"></i></a>{{-- {{$exams->updated_at->toFormattedDateString()}} --}}</center></td>
                      <td><center><a title="Edit" class="btn btn-info tip"href="{{route('examsSettings.edit',$exams->id)}}"><i class="glyphicon glyphicon-edit"></i></a>
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

      {{-- <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Creating New Exams</h4>
            </div>
            <div class="modal-body">
              <form role="form" method="post" action="{{route('examsSettings.store')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="box-body">
                  <div class="form-group">
                    <label>Exams Title</label>
                    <input type="text" class="form-control" placeholder="Enter the Exams Title..." name="title" value="{{old('title')}}">
                  </div>
                  <div class="form-group">
                    <label>Total Marks</label>
                    <input type="number" class="form-control" name="marks" {{old('marks')}}>
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
                        <input type="text" class="form-control timepicker" name="stop_time" value="{{old('stop_time')}}">

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
                    <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-danger">
                    Cancel</button>
                    <button type="submit" class="btn btn-primary pull-right">Add New</button>
                  </div>
                </div>
              </form>
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div> --}}

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
     //Date picker
      $('#datepicker').datepicker({
        autoclose: true
      })
  //Timepicker
      $('.timepicker').timepicker({
        showInputs: false
      })
    })
  </script>
@endsection