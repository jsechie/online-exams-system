@extends('layouts.students_layouts.student_design')

@section('content')

   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        All
        <small>Registered </small> Courses 
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Courses</li>
      </ol>
      @include('messages.flash_messages')
    </section>
      <!-- /.content -->

    <section class="content">
      @if($courses->count() > 0)
        <div class="row">
          <div class="col-xs-12 col-md-8 col-md-offset-2">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">List Of All Registered Courses</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped table-responsive">
                  <thead>
                  <tr>
                    <th><center>Name</center></th>
                    <th><center>Code</center></th>
                    <th><center>Credit Hours</center></th>
                  </tr>
                  </thead>
                  <tbody>
                   @foreach($courses as $course)
                   <tr>
                     <td><center>{{$course->name}}</center></td>
                     <td><center>{{$course->code}}</center></td>
                     <td><center><span class="label label-success">{{$course->credit_hours}}</span></center></td>
                   </tr>
                   @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th><center>Name</center></th>
                    <th><center>Code</center></th>
                    <th><center>Credit Hours</center></th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.box-body -->
            </div>
          </div>
        </div>
      @else
        <div class="col-md-8 col-md-offset-2 text-danger text-center"><h1>No Course Has Been Made Available To Your Department For Now</h1></div>
      @endif
    </section>
  </div>

    {{-- course --}}
@endsection