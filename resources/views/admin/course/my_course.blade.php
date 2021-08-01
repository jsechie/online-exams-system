@extends('layouts.admin_layouts.admin_design')

@section('content')

   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        All
        <small>Your Assigned </small> Courses 
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Courses</li>
      </ol>
      @include('messages.flash_messages')
    </section>
      <!-- /.content -->

    <section class="content container-fluid">
      @if($courses->count() > 0)
        <div class="row">
          <div class="col-xs-12 col-md-8 col-md-offset-2">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">List Of All Courses Assigned To You</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped table-responsive">
                  <thead>
                  <tr>
                    <th><center>Name</center></th>
                    <th><center>Code</center></th>
                    <th><center>Credit Hours</center></th>
                    <th><center>Status</center></th>
                  </tr>
                  </thead>
                  <tbody>
                   @foreach($courses as $course)
                   <tr>
                     <td><center><h4>{{$course->name}}</h4></center></td>
                     <td><center><h4><span class="label label-warning">{{$course->code}}</span></h4></center></td>
                     <td><center><h4><span class="label label-info">{{$course->credit_hours}}</span></h4></center></td>
                     @if($course->status == 1)
                          <td ><center class=" btn-success"><h4>Active</h4></center></td>
                        @else
                          <td><center class="btn-danger"><h4>Inactive</h4></center></td>
                        @endif
                   </tr>
                   @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th><center>Name</center></th>
                    <th><center>Code</center></th>
                    <th><center>Credit Hours</center></th>
                    <th><center>Status</center></th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.box-body -->
            </div>
          </div>
        </div>
      @else
        @include('messages.course_error')
      @endif
    </section>
  </div>

    {{-- course --}}
@endsection