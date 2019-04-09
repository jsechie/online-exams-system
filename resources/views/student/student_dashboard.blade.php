@extends('layouts.students_layouts.student_design')

@section('content')
	  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Student Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('student.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row col-md-8 col-md-offset-2"><h1 class="text-center"><marquee behaviour='alternate'><span class="label label-warning">Academic Calender: {!!"$academic->year Semester $academic->semester"!!} in Progress</marquee></span></h1></div>
            <!-- Info boxes -->
      <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-graduation-cap"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Courses</span>
              <span class="info-box-number">{{$total_courses}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6 col-sm-12 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-wikipedia-w"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Exams Written</span>
              <span class="info-box-number">0</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection