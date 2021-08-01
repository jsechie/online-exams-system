@extends('layouts.admin_layouts.admin_design')
@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Write Report
        <small>for</small> {{App\Course::find($exam->course_id)->name}}<small>{{$exam->title}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Report</li>
      </ol>
      @include('messages.flash_messages')
      @include('messages.errors')
    </section>
      <!-- /.content -->

    <section class="content container-fluid">
      <hr>
      <div class="row" >
        <div class="col-md-10 col-md-offset-1">
          <form role="form" method="post" action="{{route('examsSettings.submitReport',$exam->id)}}">
            {{csrf_field()}}
            <div class="box-body ">
              <div class="form-group col-md-12">
                <label>Report Body</label>
                <textarea id="editor1" name="report" rows="5" cols="80">
                  {{old('report')}}
                </textarea>
              </div>
              <div class="form-group ">
                <div class="checkbox icheck col-md-12">
                  <center><label>
                    <b>Tag Report</b><br>
                    <input name="stolen" type="checkbox" {{ old('stolen') ? 'checked' : '' }}> Stolen Case<br>
                    <input name="cheating" type="checkbox" {{ old('cheating') ? 'checked' : '' }}> Student Cheating
                  </label></center>
                </div>
            <div class="box-footer ">
              <a href="{{route('examsSettings.show',$exam->course_id)}}" class="btn btn-danger">Cancel</a>
              <button type="submit" class="btn btn-primary pull-right">Send Report</button>
            </div>
          </form>
        </div>
      </div>

    </section>
  </div>

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

              