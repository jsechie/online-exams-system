@extends('layouts.admin_layouts.admin_design')

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
        <div class="row"><hr>
          <div class="col-md-4"><a class="btn btn-block btn-primary" href="{{route('questions.show',$course->id)}}">Back To All Questions</a></div>
          <div class="col-md-4"></div>
          <div class="col-md-4"><a class="btn btn-block btn-warning" href="#" data-toggle="modal" data-target="#modal-default">Upload Question</a></div>
        </div>

      <section class="content">
        <div class="row">
          <div class="col-md-10 col-md-offset-1">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Add Question {{$total+1}}</h3>
                <br>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form role="form" method="post" action="{{route('questions.store')}}">
                {{csrf_field()}}
                <div class="box-body">
                  <div class="form-group">
                    <textarea id="editor1" name="question" rows="5" cols="80">
                      {{old('question')}}
                    </textarea>
                  </div>
                  <div class="form-group">
                    <label>Option A.</label>
                    <textarea class="form-control" rows="2" placeholder="Enter Option A Required..." name="option_A" >{{old('option_A')}}</textarea>
                  </div>
                  <div class="form-group">
                    <label>Option B.</label>
                    <textarea class="form-control" rows="2" placeholder="Enter Option B Required ..." name="option_B">{{old('option_B')}}</textarea>
                  </div>
                  <div class="form-group">
                    <label>Option C.</label>
                    <textarea class="form-control" rows="2" placeholder="Ignore if question has only 2 option" name="option_C" id="optionC">{{old('option_C')}}</textarea>
                  </div>
                  <div class="form-group">
                    <label>Option D.</label>
                    <textarea class="form-control" rows="2" placeholder="Ignore if question has only 3 option" name="option_D">{{old('option_D')}}</textarea>
                  </div>
                  <div class="form-group">
                    <label>Option E.</label>
                    <textarea class="form-control" rows="2" placeholder="Ignore if question has only 4 option" name="option_E">{{old('option_E')}}</textarea>
                  </div>
                  <div class="form-group">
                    <label>Select Answer</label>
                    <select class="form-control" name="answer">
                      <option value="">---Select An Answer---</option>
                      @php $answers=['A','B','C','D','E']; @endphp
                      @foreach($answers as $answer)
                        <option value="{{$answer}}" {{old('answer')==$answer? 'selected':'' }}>{{$answer}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <div class="checkbox icheck">
                      <label>
                        <input name="next" type="checkbox" {{ old('next') ? 'checked' : '' }}> Add Next Question
                      </label>
                    </div>
                    <div class="checkbox icheck">
                      <label>
                        <input name="status" type="checkbox" {{ old('status') ? 'checked' : '' }}> Make Question Active To Student
                      </label>
                    </div>
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

      {{-- modal for the upload page --}}
      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Questions Upload</h4>
            </div>
            <div class="modal-body">
              <form role="form" method="post" action="{{route('questions.upload')}}" enctype="multipart/form-data">
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
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

    </section>
  </div>

@endsection

@section('script')
<script src="{{asset('AdminLTE/bower_components/ckeditor/ckeditor.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('AdminLTE/plugins/iCheck/icheck.min.js')}}"></script>
<script type="text/javascript">
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  });
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
@endsection