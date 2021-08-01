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
        Update 
        <small>@php 
        $course = App\Course::find($exam->course_id); 
        @endphp {{$course->name}}</small> {{$exam->title}}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
      @include('messages.flash_messages')
      @include('messages.errors')
    </section>
      <!-- /.content -->

    <section class="content container-fluid">
      <div class="row col-md-10 col-md-offset-1">
        <form role="form" method="post" action="{{route('examsSettings.update',$exam->id)}}" enctype="multipart/form-data">
        {{csrf_field()}}
        {{method_field('PUT')}}
        <div class="box-body">
          <div class="form-group">
            <label>Exams Title</label>
            <input class="form-control" disabled name="title" value="{{"$course->name $exam->title"}}">
          </div>
          {{-- <div class="form-group">
            <label>Total Marks</label>
            <input type="number" class="form-control" name="marks" value="{{$exam->total_marks}}">
          </div> --}}
          <div class="form-group">
            <label>Total Questions</label>
            <input type="number" class="form-control" value="{{App\ExamsSettings::find($exam->id)->questions->count()}}" disabled="">
          </div>
          <div class="form-group">
            <label>Exams Instructions</label>
            <textarea class="form-control" rows="2" placeholder="Enter the Exams Instructions..." name="instructions" >{{$exam->instructions}}</textarea>
          </div>
          <div class="form-group">
            <label>Exams Start Date:</label>

            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control pull-right" id="datepicker" name="exams_date" value="{{date('m/d/Y',strtotime($exam->exams_date))}}">
            </div>
            <!-- /.input group -->
          </div>

          <!-- time Picker -->
          <div class="bootstrap-timepicker">
            <div class="form-group">
              <label>Exams Start Time:</label>

              <div class="input-group">
                <input type="text" class="form-control timepicker" name="start_time" value="{{date('h:i A',strtotime($exam->start_time))}}">

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
              <input type="text" class="form-control timepicker" name="stop_time" value="{{date('h:i A',strtotime($exam->stop_time))}}">

              <div class="input-group-addon">
                <i class="fa fa-clock-o"></i>
              </div>
            </div>
            <!-- /.input group -->
          </div>
          <!-- /.form group -->
        </div>
        <div class="box-footer">
          <a type="button" href="{{route('examsSettings.show',$exam->course_id)}}" class="btn btn-danger">
          Cancel</a>
          <button type="submit" class="btn btn-primary pull-right">Update</button>
        </div>
      </form> 
      </div>
    </section>
  </div

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