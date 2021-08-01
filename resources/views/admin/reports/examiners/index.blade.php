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
         
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Report</li>
      </ol>
    </section>
      @include('messages.errors')
      @include('messages.flash_messages')

    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#attendance" data-toggle="tab">Student Attendance And Performance</a></li>
              <li><a href="#exams_history" data-toggle="tab">Exams History</a></li>
              <li><a href="#incident_report" data-toggle="tab">Incident Report</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="attendance">
                @if($courses->count() > 0)
                  {{-- <div class="col-md-6 col-md-offset-3"> --}}
                    <!-- general form elements -->
                    <div class="box box-danger">
                      <div class="box-header with-border">
                        <h3 class="box-title">Select Your Options To Generate Report</h3>
                      </div>
                      <!-- /.box-header -->
                      <!-- form start -->
                      <form role="form" method="post" action="{{route('admin.attendanceReport')}}">
                         {{csrf_field()}}
                        <div class="box-body">
                          <div class="form-group col-md-3">
                            <label>Course Name</label>
                            <select class="form-control" name="course_name">
                              <option value=""> --Select Course--</option>
                              @foreach($courses as $course)
                                <option value="{{$course->name}}" {{old('course_name')=="$course->name"? 'selected':'' }}>{{$course->name}} </option>
                              @endforeach
                            </select>
                          </div>
                         <div class="form-group col-md-6">
                            <label>Examination Type</label>
                            <select class="form-control" name="exams_type">
                              <option value=""> --Select Exams Type--</option>
                              <option value="Mid Semester Examination" {{old('exams_type')=='Mid Semester Examination'? 'selected':'' }}>Mid Semester Examination</option>
                              <option value="End Of Semester Examination" {{old('exams_type')=='End Of Semester Examination'? 'selected':'' }}>End Of Semester Examinamtion</option>
                            </select>
                          </div>
                          <div class="form-group col-md-3">
                            <label>Academic Year</label>
                            <select class="form-control" name="academic_year">
                              <option value=""> --Select Academic Year--</option>
                              @foreach($academics as $academic)
                                <option value="{{$academic->year}}" {{old('academic_year')=="$academic->year"? 'selected':'' }}>{{$academic->year}} </option>
                              @endforeach
                            </select>
                          </div>
                          
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer ">
                          <div class="col-md-8 col-md-offset-2">
                            <a href="{{route('admin.dashboard')}}" type="button" class="btn btn-default">Cancel</a>
                            <button type="submit" class="btn btn-info pull-right">Generate Report</button>
                          </div>
                            
                          </div>
                      </form>
                    </div>
                    <!-- /.box -->
                  {{-- </div> --}}
                @else
                  <center><h1>No Course Available</h1></center>
                @endif 
              </div>
              <div class="tab-pane" id="incident_report">
                <div class="row">
                  <div class="col-md-12">
                    <center><h4>Genrate Incident Report By</h4></center><br>
                    <div class="nav-tabs-custom">
                      <ul class="nav nav-tabs">
                        <li class="active"><a href="#exam" data-toggle="tab">Exams</a></li>
                        <li><a href="#date" data-toggle="tab">Date Written</a></li>
                        <li><a href="#lecturer" data-toggle="tab">Report Written By</a></li>
                        <li><a href="#tag" data-toggle="tab">Report Tag</a></li>
                      </ul>
                      <div class="tab-content">
                        <div class="active tab-pane" id="exam">
                           <div class="box box-danger">
                            <div class="box-header with-border">
                              <h3 class="box-title">Select Your Exam To Generate Incident Report</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form role="form" method="post" action="{{route('incident.report')}}">
                               {{csrf_field()}}
                              <div class="box-body">
                                <div class="form-group col-md-8 col-md-offset-2">
                                  <label>Exams</label>
                                  <select class="form-control" name="exams_id">
                                    {{-- <option value=""> --Select Exam--</option> --}}
                                    @foreach($exams as $exam)
                                      <option value="{{$exam->id}}" {{old('exams_id')=="$exam->id"? 'selected':'' }}>{{App\Course::find($exam->course_id)->name." $exam->title"}} </option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                              <!-- /.box-body -->

                              <div class="box-footer ">
                                <div class="col-md-8 col-md-offset-2">
                                  <a href="{{route('admin.dashboard')}}" type="button" class="btn btn-default">Cancel</a>
                                  <button type="submit" class="btn btn-info pull-right">Generate Report</button>
                                </div>
                                  
                                </div>
                            </form>
                          </div>
                        </div>
                        <div class="tab-pane" id="date">
                          <div class="row">
                            <div class="col-md-6">
                              <center><h4 class="text-danger"><u>Search Incident Report By Custom Date</u></h4></center><br>
                              <form role="form" method="post" action="{{route('incident.report')}}">
                                 {{csrf_field()}}
                                <div class="box-body">
                                  <div class="form-group col-md-6">
                                    <label>Report Start Date:</label>

                                    <div class="input-group date">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" class="form-control pull-right" id="datepicker1" name="report_start_date" value="{{date('m/d/Y',strtotime('-1 week'))}}">
                                    </div>
                                    <!-- /.input group -->
                                  </div>
                                  <div class="form-group col-md-6">
                                    <label>Report End Date:</label>

                                    <div class="input-group date">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" class="form-control pull-right" id="datepicker1" name="report_end_date" value="{{date('m/d/Y',strtotime('today'))}}">
                                    </div>
                                    <!-- /.input group -->
                                  </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer col-md-12">
                                  <button type="submit" class="btn btn-primary pull-right">Search</button>
                                </div>
                                
                              </form>
                            </div>
                            <div class="col-md-6">
                              <center><h4 class="text-danger"><u>Search Incident Report By Exact Date</u></h4></center><br>
                              <form role="form" method="post" action="{{route('incident.report')}}">
                                 {{csrf_field()}}
                                <div class="box-body">
                                  <div class="form-group col-md-12">
                                    <label>Report Date:</label>

                                    <div class="input-group date">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" class="form-control pull-right" id="datepicker1" name="report_start_date" value="{{date('m/d/Y',strtotime('today'))}}">
                                    </div>
                                    <!-- /.input group -->
                                  </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer col-md-12">
                                  <button type="submit" class="btn btn-primary pull-right">Search</button>
                                </div>
                                
                              </form>
                            </div>
                          </div>
                          
                        </div>
                        <div class="tab-pane" id="lecturer">
                          {{-- <div class="active tab-pane" id="exam"> --}}
                           <div class="box box-danger">
                            <div class="box-header with-border">
                              <h3 class="box-title">Select Your Invigilator to view Incident Report</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form role="form" method="post" action="{{route('incident.report')}}">
                               {{csrf_field()}}
                              <div class="box-body">
                                <div class="form-group col-md-8 col-md-offset-2">
                                  <label>Exams</label>
                                  <select class="form-control" name="lecturers_name">
                                    {{-- <option value=""> --Select Invigilator--</option> --}}
                                    @foreach($lecturers as $lecturer)
                                      <option value="{{$lecturer->name}}" {{old('lecturers_name')=="$lecturer->name"? 'selected':'' }}>{{" $lecturer->name"}} </option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                              <!-- /.box-body -->

                              <div class="box-footer ">
                                <div class="col-md-8 col-md-offset-2">
                                  <a href="{{route('admin.dashboard')}}" type="button" class="btn btn-default">Cancel</a>
                                  <button type="submit" class="btn btn-info pull-right">Generate Report</button>
                                </div>
                                  
                                </div>
                            </form>
                          </div>
                        {{-- </div> --}}
                        </div>
                        <div class="tab-pane" id="tag">
                          <div class="box box-danger">
                            <div class="box-header with-border">
                              <h3 class="box-title">Select Your Report Tag to view Incident Report</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form role="form" method="post" action="{{route('incident.report')}}">
                               {{csrf_field()}}
                              <div class="box-body">
                                <div class="form-group col-md-8 col-md-offset-2">
                                  <label>Report Tag</label>
                                  <select class="form-control" name="tag_name">
                                    {{-- <option value=""> --Select Invigilator--</option> --}}
                                    <option value="Stolen Case" {{old('tag_name')=="Stolen Case"? 'selected':'' }}>Stolen Case</option>
                                    <option value="Cheating Case" {{old('tag_name')=="Cheating Case"? 'selected':'' }}>Cheating Case</option>
                                    <option value="Stolen & Cheating Cases" {{old('tag_name')=="Stolen & Cheating Cases"? 'selected':'' }}>Stolen & Cheating Cases</option>
                                  </select>
                                </div>
                              </div>
                              <!-- /.box-body -->

                              <div class="box-footer ">
                                <div class="col-md-8 col-md-offset-2">
                                  <a href="{{route('admin.dashboard')}}" type="button" class="btn btn-default">Cancel</a>
                                  <button type="submit" class="btn btn-info pull-right">Generate Report</button>
                                </div>
                                  
                                </div>
                            </form>
                          </div>
                        </div>
                        <!-- /.tab-pane -->
                      </div>
                      <!-- /.tab-content -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                  </div>
                  <!-- /.col -->
                </div>                
              </div>
              <div class="tab-pane" id="exams_history">
                <div class="row">
                  <div class="col-md-6">
                    <form role="form" method="post" action="{{ route('exams.history')}}">
                      {{csrf_field()}}
                      <div class="box-body">
                        <center><h4 class="text-danger"><u>Search Exams Schedule By Custom Date</u></h4></center><br>
                        <div class="form-group col-md-6">
                          <label>Start Date:</label>

                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="datepicker" name="start_date" value="{{date('m/d/Y',strtotime('-1 week'))}}">
                          </div>
                          <!-- /.input group -->
                        </div>
                        <div class="form-group col-md-6">
                          <label>End Date:</label>

                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="datepicker" name="end_date" value="{{date('m/d/Y',strtotime('today'))}}">
                          </div>
                          <!-- /.input group -->
                        </div>                
                      <div class="box-footer col-md-12">
                        <button type="submit" class="btn btn-primary pull-right">Search</button>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <form role="form" method="post" action="{{ route('exams.history')}}">
                      {{csrf_field()}}
                      <div class="box-body">
                        <center><h4 class="text-danger"><u>Search Exams Schedule By The Exact Date</u></h4></center><br>
                        <div class="form-group col-md-12">
                          <label>Date:</label>

                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="datepicker2" name="start_date" value="{{date('m/d/Y',strtotime('today'))}}">
                          </div>
                          <!-- /.input group -->
                        </div>          
                      <div class="box-footer col-md-12">
                        <button type="submit" class="btn btn-primary pull-right">Search</button>
                      </div>
                    </form>
                  </div>
                </div>
                  
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
  </div>
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
      $('#datepicker1').datepicker({
        autoclose: true
      })
      $('#datepicker2').datepicker({
        autoclose: true
      })
  //Timepicker
      $('.timepicker').timepicker({
        showInputs: false
      })
    })
  </script>
@endsection