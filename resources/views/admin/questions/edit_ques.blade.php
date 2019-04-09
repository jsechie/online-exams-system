@extends('layouts.admin_layouts.admin_design')

@section('content')

  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Update
          <small>Question</small>
        </h1><br>
        <ol class="breadcrumb">
          <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class=""><a href="{{route('questions.show',$question->course_id)}}}}"">Question</a></li><li class="active">Update</li>
        </ol>
        @include('messages.errors')
      </section>
        <!-- /.content -->
        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <hr>
            <a class="btn btn-block btn-primary" href="{{route('questions.show',$question->course_id)}}}}">Back To Questions</a>
          </div>
          <div class="col-md-4"></div>
        </div>

      <section class="content">
        <div class="row">
          <div class="col-md-10 col-md-offset-1">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Update Question Form</h3>
                <br>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form role="form" method="post" action="{{route('questions.update',$question->id)}}">
                {{csrf_field()}}
                {{method_field('PUT')}}
                <div class="box-body">
                  <div class="form-group">
                    <textarea id="editor1" name="question" rows="5" cols="80">
                      {{$question->question}}
                    </textarea>
                  </div>
                  <div class="form-group">
                    <label>Option A.</label>
                    <textarea class="form-control" rows="2" placeholder="Enter Option A Required..." name="option_A" >{{$question->option_A}}</textarea>
                  </div>
                  <div class="form-group">
                    <label>Option B.</label>
                    <textarea class="form-control" rows="2" placeholder="Enter Option B Required ..." name="option_B">{{$question->option_B}}</textarea>
                  </div>
                  <div class="form-group">
                    <label>Option C.</label>
                    <textarea class="form-control" rows="2" placeholder="Ignore if question has only 2 option" name="option_C" id="optionC">{{$question->option_C}}</textarea>
                  </div>
                  <div class="form-group">
                    <label>Option D.</label>
                    <textarea class="form-control" rows="2" placeholder="Ignore if question has only 3 option" name="option_D">{{$question->option_D}}</textarea>
                  </div>
                  <div class="form-group">
                    <label>Option E.</label>
                    <textarea class="form-control" rows="2" placeholder="Ignore if question has only 4 option" name="option_E">{{$question->option_E}}</textarea>
                  </div>
                  <div class="form-group">
                    <label>Select Answer</label>
                    <select class="form-control" name="answer">
                      <option value="">---Select An Answer---</option>
                      @php $answers=['A','B','C','D','E']; @endphp
                      @foreach($answers as $answer)
                        <option value="{{$answer}}" {{old('answer')==$answer? 'selected':'' }} @if($question->answer == $answer) selected="selected" @endif>{{$answer}}</option>
                      @endforeach
                    </select>
                  </div>
                  {{-- <div class="form-group">
                  <label>
                    <input type="checkbox" class="flat-red" name="status" value="next" @if($question->status==1) checked=""@endif>
                    Make Question Active To Student
                  </label>
                </div> --}}
                <div class="box-footer">
                  <a href="{{route('questions.show',$question->course_id)}}" class="btn btn-danger">Cancel</a>
                  <button type="submit" class="btn btn-primary pull-right">Update</button>
                </div>
              </form>
            </div>
            <!-- /.box -->
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