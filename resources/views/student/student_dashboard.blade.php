@extends('layouts.students_layouts.student_design')

@section('css')
  <!-- Morris charts -->
  <link rel="stylesheet" href="{{asset('AdminLTE/bower_components/morris.js/morris.css')}}">
@endsection
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
      <div class="row col-md-8 col-sm-8 col-md-offset-2"><h1 class="text-center"><span class="label label-warning">Academic Calender: {!!"$academic->year Semester $academic->semester"!!} in Progress</span></h1><hr></div>
            <!-- Info boxes -->
      <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-6">
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
        <div class="col-md-6 col-sm-6 col-xs-6">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-wikipedia-w"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Exams Written</span>
              <span class="info-box-number">{{$total_exams}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-12 row hidden">
          <!-- DONUT CHART -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Exams Performance Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                {{-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> --}}
              </div>
            </div>
            {{-- <div class="box-body chart-responsive">
              <div class="chart" id="performance-chart" style="height: 300px; position: relative;"></div>
              <h3>{{$total_exams}} Result(s) available, out of the {{$total_exams}} Result(s):<br>Passes: <span class="badge label-success">{{$pass}}</span>, which is {{($pass/$total_exams)*100}}% <br>Fails: <span class="badge label-danger">{{$total_exams-$pass}}</span>, which is {{(($total_exams - $pass)/$total_exams)*100}}%</h3>
            </div> --}}
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <!-- AREA CHART -->
          <div class="box box-primary hidden">
            <div class="box-header with-border">
              <h3 class="box-title">Area Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="revenue-chart" style="height: 300px;"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          

        </div>
        <!-- /.col (LEFT) -->
        <div class="col-md-6">
          <!-- LINE CHART -->
          <div class="box box-info hidden">
            <div class="box-header with-border">
              <h3 class="box-title">Line Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="line-chart" style="height: 300px;"></div>
            </div>
            <!-- /.box-body -->
          </div>

          <!-- BAR CHART -->
          <div class="box box-success hidden">
            <div class="box-header with-border">
              <h3 class="box-title">Bar Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="bar-chart" style="height: 300px;"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (RIGHT) -->
        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>
      </div>

      <br><div class="row">
        <div class="col-md-3 col-sm-6 col-xs-6">
          <center><img src="{{asset('AdminLTE/dist/img/ico/cabinet.png')}}" class="img-circle img-responsive" width="100"><br><a href="{{route('student.course')}}" class="btn btn-success btn-lg">My Courses</a><br></center>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6">
          <center><img src="{{asset('AdminLTE/dist/img/ico/survey.png')}}" class="img-circle img-responsive" width="100"><br><a href="{{route('student.nextExam')}}" class="btn btn-success btn-lg">Take Exams</a><br></center>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6">
          <center><img src="{{asset('AdminLTE/dist/img/ico/calendar.png')}}" class="img-circle img-responsive" width="100"><br><a href="{{route('student.timetable')}}" class="btn btn-success btn-lg">Exams TimeTable</a><br></center>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6">
          <center><img src="{{asset('AdminLTE/dist/img/ico/book.png')}}" class="img-circle img-responsive" width="100"><br><a href="{{route('student.result')}}" class="btn btn-success btn-lg">Check Result</a><br></center>
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection

@section('script')
  <!-- Morris.js charts -->
  <script src="{{asset('AdminLTE/bower_components/raphael/raphael.min.js')}}"></script>
  <script src="{{asset('AdminLTE/bower_components/morris.js/morris.min.js')}}"></script>
  <script>
    $(function () {
      "use strict";

      // // AREA CHART
      // var area = new Morris.Area({
      //   element: 'revenue-chart',
      //   resize: true,
      //   data: [
      //     {y: '2011 Q1', item1: 2666, item2: 2666},
      //     {y: '2011 Q2', item1: 2778, item2: 2294},
      //     {y: '2011 Q3', item1: 4912, item2: 1969},
      //     {y: '2011 Q4', item1: 3767, item2: 3597},
      //     {y: '2012 Q1', item1: 6810, item2: 1914},
      //     {y: '2012 Q2', item1: 5670, item2: 4293},
      //     {y: '2012 Q3', item1: 4820, item2: 3795},
      //     {y: '2012 Q4', item1: 15073, item2: 5967},
      //     {y: '2013 Q1', item1: 10687, item2: 4460},
      //     {y: '2013 Q2', item1: 8432, item2: 5713}
      //   ],
      //   xkey: 'y',
      //   ykeys: ['item1', 'item2'],
      //   labels: ['Item 1', 'Item 2'],
      //   lineColors: ['#a0d0e0', '#3c8dbc'],
      //   hideHover: 'auto'
      // });

      // // LINE CHART
      // var line = new Morris.Line({
      //   element: 'line-chart',
      //   resize: true,
      //   data: [
      //     {y: '2011 Q1', item1: 2666},
      //     {y: '2011 Q2', item1: 2778},
      //     {y: '2011 Q3', item1: 4912},
      //     {y: '2011 Q4', item1: 3767},
      //     {y: '2012 Q1', item1: 6810},
      //     {y: '2012 Q2', item1: 5670},
      //     {y: '2012 Q3', item1: 4820},
      //     {y: '2012 Q4', item1: 15073},
      //     {y: '2013 Q1', item1: 10687},
      //     {y: '2013 Q2', item1: 8432}
      //   ],
      //   xkey: 'y',
      //   ykeys: ['item1'],
      //   labels: ['Item 1'],
      //   lineColors: ['#3c8dbc'],
      //   hideHover: 'auto'
      // });

      //DONUT CHART
      var donut = new Morris.Donut({
        element: 'performance-chart',
        resize: true,
        colors: ["#00a65a", "#f56954"],
        data: [
          {label: "Passes", value: <?= $pass; ?>},
          {label: "Fail(s)", value: <?= $total_exams - $pass; ?>},
        ],
        hideHover: 'auto'
      });
      //BAR CHART
      var bar = new Morris.Bar({
        element: 'bar-chart',
        resize: true,
        data: [
          {y: '2006', a: 100, b: 90},
          {y: '2007', a: 75, b: 65},
          {y: '2008', a: 50, b: 40},
          {y: '2009', a: 75, b: 65},
          {y: '2010', a: 50, b: 40},
          {y: '2011', a: 75, b: 65},
          {y: '2012', a: 100, b: 90}
        ],
        barColors: ['#00a65a', '#f56954'],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['CPU', 'DISK'],
        hideHover: 'auto'
      });
    });
  </script>
@endsection