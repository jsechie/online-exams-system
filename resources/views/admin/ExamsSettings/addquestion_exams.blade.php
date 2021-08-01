@extends('layouts.admin_layouts.admin_design')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Add More
        <small>Questions</small> To {{$exam->title}}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">More Questions</li>
      </ol>
      @include('messages.flash_messages')
       @include('messages.errors')
    </section>
      <!-- /.content -->

    <section class="content container-fluid">
    	<div class="row">
        <div class="col-md-3 "><a class="btn btn-block btn-warning " href="{{route('examsSettings.view',$exam->id)}}">Back</a></div>
        {{-- <div class="col-md-3 "><a class="btn btn-block btn-info " href="#">Add Randomly</a></div> --}}
        <div class="col-md-3 pull-right"><a class="btn btn-block btn-primary " href="{{route('examsSettings.addAll',$exam->id)}}">Add All Questions</a></div>
      </div><hr>
      <div class="row col-md-offset-1">
        @foreach($courseQuestions as $question)
          @php $status=0; 
            $hasQuestion = false;
          @endphp
          @foreach($examQuestions as $examQuestion)          	 
          	@php 
          	if($question->id == $examQuestion->id){
          		$status=1;
          	}
          	@endphp 
          @endforeach
          @php
          if($status==0):
          @endphp
          	<div class="col-lg-5">
              <h3>{!!$question->question!!}</h3>
                <ul type="none">
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
                </ul>
              
              <footer class="pull-right">
                        <form method="post" action="{{route('examsSettings.addQuestions',$question->id)}}" id="delete-form-{{$question->id}}" style="display: none;">
                          {{csrf_field()}}
                          <input type="hidden" name="exams_id" value="{{$exam->id}}">
                        </form>
                        <a title="Add" class="btn btn-primary tip "
                          onclick="
                          if(confirm('Are You Sure You want Add?')){
                            event.preventDefault();
                            document.getElementById('delete-form-{{$question->id}}').submit();
                          }
                          else{
                           event.preventDefault();
                          }
                          " 
                        ><i class="glyphicon glyphicon-check"> Add</i></a>
              </footer>
            </div>
            <div class="col-md-1"></div>
          @php endif @endphp
        @endforeach
        @if($examQuestions->count() == $courseQuestions->count())
        	@include('messages.addQuestion_error')
        @endif
      </div>
    </section>
  </div>

  {{-- <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Randomly Add Questions To Exams</h4>
            </div>
            <div class="modal-body">
              <form role="form" method="post" action="">
                {{csrf_field()}}
                <div class="box-body">
                  <div class="form-group">
                    <label>Total Questions To Be Added <br>Min: <span class="label label-success">1</span> </label>
                    <input type="number" class="form-control" name="random_number" value="{{old('random_number')}}" max="{{$courseQuestions->count()-$examQuestions->count()}}" min="1">
                    <label>Max: <span class="label label-danger"> {{$courseQuestions->count()-$examQuestions->count()}}</span></label>
                  </div>
                  <input type="hidden" name="course_id" value="{{$exam->id}}">
                <div class="box-footer">
                  <button type="submit" class="btn btn-primary pull-right">Generate</button>
                  <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-danger">
                  Cancel</button>
                </div>
              </div>
              </form>
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div> --}}
@endsection