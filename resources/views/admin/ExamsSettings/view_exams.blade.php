@extends('layouts.admin_layouts.admin_design')
@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Question 
        <small>Paper</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Exams</li>
      </ol>
      @include('messages.flash_messages')
    </section>
      <!-- /.content -->

    <section class="content">
      <div class="row">
        <div class="col-md-3 "><a class="btn btn-block btn-warning " href="{{route('examsSettings.show',$exam->course_id)}}">Back</a></div>
        <div class="col-md-3 pull-right"><a class="btn btn-block btn-primary " href="{{route('examsSettings.moreQuestions',$exam->id)}}">Add More Questions</a></div>
      </div><hr>
      <div class="row bg-success" >
        <div class="col-md-offset-1">
          <div class="col-md-12">
            <h2><u><center>{{$exam->title}}</center></u></h2><br>
            <h3>INSTRUCTIONS: <span><u>{{$exam->instructions}}</u></span></h3><hr>
          </div>
          @foreach($questions as $question)
            <div class="col-lg-5">
              <h3>{{$loop->index+1}}.{!!$question->question!!}</h3>
                <ol>
                  <li><h4>A. {{$question->option_A}} 
                  @if($question->answer == 'A')<small><i class="fa fa-check-circle text-danger">correct answer</i></small>@endif</h4></li>
                  <li><h4>B. {{$question->option_B}}
                  @if($question->answer == 'B')<small><i class="fa fa-check-circle text-danger">correct answer</i></small>@endif</h4></li>
                  @if($question->option_C != NULL)
                    <li><h4>C. {{$question->option_C}}
                    @if($question->answer == 'C')<small><i class="fa fa-check-circle text-danger">correct answer</i></small>@endif</h4></li>
                  @endif
                  @if($question->option_D != NULL)
                    <li><h4>D. {{$question->option_D}}
                    @if($question->answer == 'D')<small><i class="fa fa-check-circle text-danger">correct answer</i></small>@endif</h4></li>
                  @endif
                  @if($question->option_E != NULL)
                    <li><h4>E. {{$question->option_E}}
                    @if($question->answer == 'E')<small><i class="fa fa-check-circle text-danger">correct answer</i></small>@endif</h4></li>
                  @endif
                </ol>
              
              <footer class="pull-right">
                <a title="Edit" class="btn btn-info tip" href="#" data-toggle="modal" data-target="#modal-default" ><i class="glyphicon glyphicon-edit"></i></a>
                        <form method="post" action="{{route('examsSettings.remove',$question->id)}}" id="delete-form-{{$question->id}}" style="display: none;">
                          {{csrf_field()}}
                          {{method_field('DELETE')}}
                          <input type="hidden" name="exams_id" value="{{$exam->id}}">
                        </form>
                        <a title="Remove" class="btn btn-danger tip "
                          onclick="
                          if(confirm('Are You Sure You want delete?')){
                            event.preventDefault();
                            document.getElementById('delete-form-{{$question->id}}').submit();
                          }
                          else{
                            event.preventDefault();
                          }
                          " 
                        ><i class="glyphicon glyphicon-trash"></i></a>
              </footer>
            </div>
            <div class="col-md-1"></div>
          @endforeach
          <div class="col-lg-12"><hr>
            <footer ><br><br><h4><div class="pull-left col-md-2">{{Auth::user()->name}}</div><div class="pull-right col-md-2">--GoodLuck--<hr></div></h4></footer>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Creating New Exams</h4>
            </div>
            <div class="modal-body">
              <form role="form" method="post" action="{{route('examsSettings.updateQuestion',$question->id)}}">
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
                <div class="box-footer">
                  <a type="button" data-dismiss="modal" aria-label="Close" class="btn btn-danger">Cancel</a>
                  <button type="submit" class="btn btn-primary pull-right">Update</button>
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
<script type="text/javascript">
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })</script>
  @endsection

              