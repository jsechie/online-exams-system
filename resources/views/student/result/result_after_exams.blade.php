@extends('layouts.students_layouts.student_design')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Result
        <small>Slip</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('student.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Result</li>
      </ol>
    </section>
      @include('messages.errors')
      @include('messages.flash_messages')

    <section class="invoice">
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class=""></i> {{"$course->name $exam->title Result"}}.
            <small class="pull-right"><?= date('d-m-Y  G:i') ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <div class="row invoice-info">

      <div class="col-sm-6 invoice-col">
        <b>Name:</b> {{Auth::user()->name}}<br>
        <b>Ref #:</b> {{Auth::user()->student_id}}<br>
        <b>Index #:</b> {{Auth::user()->index_number}}
      </div>
      <!-- /.col -->
      <div class="col-sm-6 invoice-col">
        <b>Department:</b> {{App\Department::find($course->dep_id)->name}}<br>
        <b>Year:</b> {{Auth::user()->year}}<br>
        <b>Type:</b> {{Auth::user()->student_type}}
      </div>
      <div class="col-xs-12 col-md-offset-2 col-md-8">
        <br><p class="lead">Result</p>

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Total Questions:</th>
              <td>{{$total}}</td>
            </tr>
            <tr>
              <th>Score:</th>
              <td>{{"$marks/$total"}}</td>
            </tr>
            <tr>
              <th>Marks:</th>
              <td>{{"$totalMark/$exam->total_marks"}}</td>
            </tr>
            <tr>
              <th>Marks %:</th>
              <td><?= round(($totalMark/$exam->total_marks)*100,1)."%"?></td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <div class="row no-print">
        <div class="col-xs-12">
          <a href="#" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
          <a href="{{route('student.dashboard')}}" type="button" class="btn btn-danger pull-right"><i class="fa fa-times"></i> Close
          </a>
          {{-- <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button> --}}
        </div>
      </div>
    </section>
  </div>
@endsection