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

    <section class="content container-fluid">
      <div class="row">
        <div class="col-md-3 "><a class="btn btn-block btn-warning " href="{{route('examsSettings.show',$exam->course_id)}}">Back</a></div>
        <div class="col-md-3 "><a class="btn btn-block btn-info " href="{{route('examsQuestions.print',$exam->id)}}">Print Exams Question</a></div>
        <div class="col-md-3 "><a class="btn btn-block btn-danger " href="{{route('examsSettings.removeAll',$exam->id)}}">Remove All</a></div>
        <div class="col-md-3 pull-right"><a class="btn btn-block btn-primary " href="{{route('examsSettings.moreQuestions',$exam->id)}}">Add More Questions</a></div>
      </div><hr>
      <div class="row bg-success" >
        <div class="col-md-offset-1">
          <div class="col-md-12">
            @php 
              $diff=strtotime($exam->stop_time)-strtotime($exam->start_time);
            @endphp
            <h3><center><br>KWAME NKRUMAH UNIVERSITY OF SCIENCE AND TECHNOLOGY<br>COLLEGE OF SCIENCE<br>DEPARTMENT OF {{strtoupper($department->name)}}<br><br>{{strtoupper("$exam->title, ".date('F Y',strtotime($exam->exams_date)))}}<br>BSC {{strtoupper("$department->name (YEAR $course->year)")}}<br><br>{{strtoupper("$course->code: $course->name")}}</center></h3><br>
            <h3><div class="row"><div class="col-md-8">TIME ALLOWED: @if(date('g',$diff) > 12 || date('g',$diff)< 12){{strtoupper(date('g',$diff).' hour(s)') }}@endif @if(date('i',$diff) != 00){{strtoupper(date('i',$diff).' minute(s)') }}@endif</div><div class="pull-right col-md-4 text-right">{{"($exam->total_marks Marks Total)"}}</div></div></h3><br>
            <h3>INSTRUCTIONS: <span><u>{{$exam->instructions}}</u></span></h3><hr>
          </div>
          <table id="example1" class="table table-bordered table-striped table-responsive container">
            <thead>
            <tr>
              <th class="col-md-1">Ques#</th>
              <th><center>Questions</center></th>
              <th></th>
            </tr>
            </thead>
            <tbody>
              @foreach($questions as $question)
                <tr>
                  <td>{{$loop->index+1}}</td>
                  <td ><h3>{!!$question->question!!}</h3>
                    <ol type="A">
                      <li><h4> {{$question->option_A}} 
                      @if($question->answer == 'A')<small><i class="fa fa-check-circle text-danger">correct answer</i></small>@endif</h4></li>
                      <li><h4> {{$question->option_B}}
                      @if($question->answer == 'B')<small><i class="fa fa-check-circle text-danger">correct answer</i></small>@endif</h4></li>
                      @if($question->option_C != NULL)
                        <li><h4> {{$question->option_C}}
                        @if($question->answer == 'C')<small><i class="fa fa-check-circle text-danger">correct answer</i></small>@endif</h4></li>
                      @endif
                      @if($question->option_D != NULL)
                        <li><h4> {{$question->option_D}}
                        @if($question->answer == 'D')<small><i class="fa fa-check-circle text-danger">correct answer</i></small>@endif</h4></li>
                      @endif
                      @if($question->option_E != NULL)
                        <li><h4>{{$question->option_E}}
                        @if($question->answer == 'E')<small><i class="fa fa-check-circle text-danger">correct answer</i></small>@endif</h4></li>
                      @endif
                    </ol>
                  
                  <footer class="pull-right">
                    {{-- <a title="Edit" class="btn btn-info tip" href="#" data-toggle="modal" data-target="#modal-default" ><i class="glyphicon glyphicon-edit"></i></a> --}}
                   
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
                  </footer></td>
                  <td></td>
                </tr>
                 {{-- Edit Modal --}}
                {{-- <div class="modal fade" id="modal-default">
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
                </div> --}}
              @endforeach
            </tbody>
          </table>
          
          <div class="col-lg-12"><hr>
            <footer ><br><br><h4><div class="pull-left col-md-2">{{Auth::user()->name}}</div><div class="pull-right col-md-2">--GoodLuck--<hr></div></h4></footer>
          </div>
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

              