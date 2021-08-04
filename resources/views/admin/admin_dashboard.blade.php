@extends('layouts.admin_layouts.admin_design')

@section('content')
      @php
        $courses = App\Course::all();
        $checker = 0;
        foreach ($courses as $course) {
          if ($course->assigned_to == Auth::user()->id) {
            $checker = 1;
            break;
          }
        }
      @endphp
	<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row col-md-8 col-sm-12 col-md-offset-2"><center><h1><span class="label label-info"> {!!"$academic->year Semester $academic->semester"!!} in Progress</span></h1><hr></center></div>
      <div class="row">
        <div class="col-md-12">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
              @if(Auth::user()->role =='Examiner')
                @include('admin.dashboard.system_summary')
              @endif
              @if(Auth::user()->role =='Lecturer' || $checker == 1)
                @include('admin.dashboard.user_summary')
              @endif
                {{-- <div class="panel box box-success">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion3" href="#collapseThree">
                        Graphs And Charts
                      </a>
                    </h4>
                  </div>
                  <div id="collapseThree" class="panel-collapse collapse">
                    <div class="box-body">
                      
                    </div>
                  </div>
                </div> --}}
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
  </div>

    </section>
    <!-- /.content -->
  </div>

@endsection