@extends('layouts.admin_layouts.admin_design')

@section('content')

   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Available
        <small>Courses</small> Assigned To You
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Questions</li>
      </ol>
      @include('messages.flash_messages')
       @include('messages.errors')
    </section>
      <!-- /.content -->

    <section class="content container-fluid">
      @if($courses->count() > 0)
      <center><h3 class="text-warning"><u>Select A Course To Change Your Exams Settings</u></h3></center>
        <hr><div class="row">
          <div class="col-lg-2 col-md-2"></div>
          <div class="col-lg-8 col-md-8 row">
            @foreach($courses as $course)        
              <a href="{{route('examsSettings.show',$course->id)}}"><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-danger">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="fa fa-files-o"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">{{$course->name}}</span>
                    <span class="info-box-number">{{$course->code}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div></a>
            <!-- /.col -->        
            @endforeach
          </div>
          <div class="col-lg-2 col-md-2"></div>
        </div><hr>
      @else
        @include('messages.course_error')
      @endif
    </section>
  </div>

    {{-- course --}}
@endsection