@extends('layouts.admin_layouts.admin_design')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Report
        <small>Page</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Incident Report</li>
      </ol>
    </section>
      @include('messages.errors')
      @include('messages.flash_messages')

    <section class="invoice">
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="">{{$heading}}</i>
            <small class="pull-right"><?= date('d-m-Y  G:i') ?></small>
          </h2>
        </div>
      </div>
      <!-- /.row -->
            <!-- Table row -->
      <div class="row">
        @foreach($reports as $report)
          <div class="col-md-12">
          
            <div class="box box-widget">
              <div class="box-header with-border">
                <div class="user-block">
                  <span class="description">Written By:</span>
                  <span class="username"><a href="#">{{$report->reporter}}.</a></span>
                  <span class="description">On - {{$report->reported_date}}</span>
                </div>
                <!-- /.user-block -->
                <!-- /.box-tools -->
              </div>
              <!-- /.box-header -->
              <div class="box-body col-md-10 col-md-offset-1">
                <!-- post text -->
                
                  <p >{!! $report->report !!}</p>
                

                
                </div>
                <!-- /.box-comment -->
              </div><br>
              <!-- /.box-footer -->
            </div>
          @endforeach
          <!-- Box Comment -->
          
          <!-- /.box -->
        </div>
        <br>
        <form role="form" method="post" action="{{route('incidentReport.print')}}">
          {{csrf_field()}}
          <input type="hidden" name="exams_id" value="{{$exams_id}}">
          <input type="hidden" name="end_date" value="{{$end_date}}">
          <input type="hidden" name="start_date" value="{{$start_date}}">
          <input type="hidden" name="lecturers_name" value="{{$lecturers_name}}">
          <input type="hidden" name="tag_name" value="{{$tag_name}}">
          <div class="box-footer ">
            <div class="col-md-10 col-md-offset-1">
              <a href="{{route('examiner.report')}}" type="button" class="btn btn-danger">Cancel</a>
              <button type="submit" class="btn btn-primary pull-right">Export PDF</button>
            </div>
              
          </div>
        </form>
      </div>
      <!-- /.row -->
    </section>
  </div>
@endsection