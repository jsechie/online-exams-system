{{-- @extends('layouts.admin_layouts.admin_design')

@section('css')
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins/iCheck/square/blue.css')}}">
@endsection

@section('content')

  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Add
          <small>New </small> {{$course->name}}<small>Question</small> 
        </h1><br>
        <ol class="breadcrumb">
          <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class=""><a href="{{route('questions.show',$course->id)}}"">Question</a></li><li class="active">Add</li>
        </ol>
        @include('messages.errors')
        @include('messages.flash_messages')
      </section>
        <!-- /.content -->
        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <hr>
            <a class="btn btn-block btn-primary" href="{{route('questions.show',$course->id)}}">Back To All Questions</a>
          </div>
          <div class="col-md-4"></div>
        </div>

      <section class="content">
        <div class="row">
          <div class="col-md-10 col-md-offset-1">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Add Question</h3>
                <br>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form role="form" method="post" action="#" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="box-body">
                  <div class="form-group">
                    <label>Exams Title</label>
                    <textarea class="form-control" rows="2" placeholder="Enter the Exams Title..." name="title" >{{old('title')}}</textarea>
                  </div>
                  <div class="form-group">
                    <label>Upload Your Questions</label>
                    <input type="file" name="" class="form-control" name="question">
                  </div>
                  <input type="hidden" name="course_id" value="{{$course->id}}">
                <div class="box-footer">
                  <a href="{{route('questions.show',$course->id)}}" class="btn btn-danger">Cancel</a>
                  <button type="submit" class="btn btn-primary pull-right">Add New</button>
                </div>
              </form>
            </div>
            <!-- /.box -->
        </div>
    </section>
  </div>

@endsection
 --}}