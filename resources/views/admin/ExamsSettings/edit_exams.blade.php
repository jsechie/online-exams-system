@extends('layouts.admin_layouts.admin_design')

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Update 
        <small>Exams</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
      <!-- /.content -->

    <section class="content">
      <div class="row col-md-10 col-md-offset-1">
        <form role="form" method="post" action="{{route('examsSettings.update',$exam->id)}}" enctype="multipart/form-data">
        {{csrf_field()}}
        {{method_field('PUT')}}
        <div class="box-body">
          <div class="form-group">
            <label>Exams Title</label>
            <textarea class="form-control" rows="2" placeholder="Enter the Exams Title..." name="title" >{{$exam->title}}</textarea>
          </div>
          <div class="form-group">
            <label>Total Marks</label>
            <input type="number" class="form-control" name="marks" value="{{$exam->total_marks}}">
          </div>
          <div class="form-group">
            <label>Total Questions</label>
            <input type="number" class="form-control" value="{{App\ExamsSettings::find($exam->id)->questions->count()}}" disabled="">
          </div>
          <div class="form-group">
            <label>Exams Instructions</label>
            <textarea class="form-control" rows="2" placeholder="Enter the Exams Instructions..." name="instructions" >{{$exam->instructions}}</textarea>
          </div>
        <div class="box-footer">
          <a type="button" href="{{route('examsSettings.show',$exam->course_id)}}" class="btn btn-danger">
          Cancel</a>
          <button type="submit" class="btn btn-primary pull-right">Update</button>
        </div>
      </form> 
      </div>
    </section>
  </div

@endsection

@section('script')
<script src="{{asset('AdminLTE/bower_components/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })</script>
  @endsection