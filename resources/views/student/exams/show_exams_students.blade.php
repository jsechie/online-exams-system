@extends('layouts.students_layouts.student_design')
@section('css')
  @php
    $date = date('F d, Y',strtotime($exam->exams_date));
    $time = date('G:i:s',strtotime($exam->stop_time));
    $countDownTime = $date." ".$time;
  @endphp
  <script>
    // Set the date we're counting down to
    var time = "<?= $countDownTime ?>";
    var countDownDate = new Date(time).getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

      // Get todays date and time
      var now = new Date().getTime();
        
      // Find the distance between now and the count down date
      var distance = countDownDate - now;
        
      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
      // Output the result in an element with id="demo"
      document.getElementById("demo").innerHTML = hours + "hrs "
      + minutes + "min " + seconds + "sec ";
       
      if (distance < 120001) {
        // clearInterval(x);
        document.getElementById("warnings").innerHTML = "You Have Less Than 2 minutes to submit Your Work" ;
      }

      if (distance < 30001) {
        // clearInterval(x);
        document.getElementById("warnings").innerHTML = "You Have Less Than 30 seconds to submit Your Work" ;
      } 
      // If the count down is over, submit 
      if (distance < 2) {
        clearInterval(x);
        document.getElementById("submit_exams").submit();
      }
    }, 1000);
  </script>
@endsection
@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    {{-- <section class="content-header">
      <h1>
        Question 
        <small>Paper</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('student.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Exams</li>
      </ol>
      @include('messages.flash_messages')
    </section> --}}
      <!-- /.content -->
    <section class="content">
      {{-- <div class="row">
        <div class="col-md-3 "><a class="btn btn-block btn-warning " href="{{route('examsSettings.show',$exam->course_id)}}">Back</a></div>
        <div class="col-md-3 "><a class="btn btn-block btn-info " href="#">Remove Randomly</a></div>
        <div class="col-md-3 "><a class="btn btn-block btn-danger " href="{{route('examsSettings.removeAll',$exam->id)}}">Remove All</a></div>
        <div class="col-md-3 pull-right"><a class="btn btn-block btn-primary " href="{{route('examsSettings.moreQuestions',$exam->id)}}">Add More Questions</a></div>
      </div><hr> --}}
      <div class="row " {{-- style="background-color: black;" --}}>
        <div class="col-md-9 row " style="background-color: yellow;">
          <div class="col-md-12">
            @php 
              $diff=strtotime($exam->stop_time)-strtotime($exam->start_time);
            @endphp
            @include('messages.flash_messages')
            <h4><center><br>KWAME NKRUMAH UNIVERSITY OF SCIENCE AND TECHNOLOGY<br>COLLEGE OF SCIENCE<br>DEPARTMENT OF {{strtoupper($department->name)}}<br><br>{{strtoupper("$exam->title, ".date('F Y',strtotime($exam->exams_date)))}}<br>BSC {{strtoupper("$department->name (YEAR $course->year)")}}<br><br>{{strtoupper("$course->code: $course->name")}}</center></h4>
            <h4><div class="row"><div class="col-md-8">TIME ALLOWED: @if(date('g',$diff) > 12 || date('g',$diff)< 12){{strtoupper(date('g',$diff).' hour(s)') }}@endif @if(date('i',$diff) != 00){{strtoupper(date('i',$diff).' minute(s)') }}@endif</div><div class="pull-right col-md-4 text-right">{{"($exam->total_marks Marks Total)"}}</div></div></h4>
            <h4>INSTRUCTIONS: <span><u>{{$exam->instructions}}</u></span></h4><hr>
          </div>
          {{-- <table id="example1" class="table table-bordered table-striped table-responsive container">
            <thead>
            <tr>
              <th class="col-md-1">Ques#</th>
              <th><center>Questions</center></th>
              <th></th>
            </tr>
            </thead>
            <tbody> --}}
              <div class="col-md-offset-1">
                @php $counter=1; @endphp
                @foreach($questions as $question)
                {{-- <tr> --}}
                  @php 
                    $check_status = App\StudentExamsAnswers::where([['student_id',Auth::user()->id],['question_id',$question->id],['exams_id',$exam->id]])->get();
                    if ($check_status->count() > 0) {
                      $check = $check_status->first();
                    }
                    
                  @endphp
                  <?php $number = (($questions->currentPage()-1)*$questions->perPage())+($loop->index + 1); ?>
                  {{-- <th> --}}<center><h2>Question {!!$number."/".$total !!}</h2></center>{{-- </th> --}}
                  {{-- <td > --}}<h3>{!!$question->question!!}</h3>
                    <ul class="list-unstyled">
                      <li>
                        <form method="post" action="{{route('answer.submit',$question->id)}}" id='A' style="display: none;">
                          {{csrf_field()}}
                          <input type="hidden" name="answer" value='A'>
                          <input type="hidden" name="exam_id" value='{{$exam->id}}'>
                        </form>
                        <a style="color: black"
                          onclick="
                            document.getElementById('A').submit();
                          " 
                        ><h4><input type="radio"  name="{{$question->id}}" value="A" @if ($check_status->count() > 0) @if($check->answer=='A') checked="checked" @endif @endif> (A) {{$question->option_A}} 
                      </h4></a>
                    </li>
                      <li>
                        <form method="post" action="{{route('answer.submit',$question->id)}}" id='B' style="display: none;">
                          {{csrf_field()}}
                          <input type="hidden" name="answer" value='B'>
                          <input type="hidden" name="exam_id" value='{{$exam->id}}'>
                        </form>
                        <a style="color: black"
                          onclick="
                            document.getElementById('B').submit();
                          " 
                        ><h4><input type="radio" @if ($check_status->count() > 0) @if($check->answer=='B') checked="checked" @endif @endif name="{{$question->id}}" value="B"> (B) {{$question->option_B}}
                      </h4></a>
                        </li>
                      @if($question->option_C != NULL)
                        <li>
                          <form method="post" action="{{route('answer.submit',$question->id)}}" id='C' style="display: none;">
                          {{csrf_field()}}
                          <input type="hidden" name="answer" value='C'>
                          <input type="hidden" name="exam_id" value='{{$exam->id}}'>
                        </form>
                        <a style="color: black"
                          onclick="
                            document.getElementById('C').submit();
                          " 
                        ><h4><input type="radio" @if ($check_status->count() > 0) @if($check->answer=='C') checked="checked" @endif @endif name="{{$question->id}}" value="C"> (C) {{$question->option_C}}
                        </h4></a>
                      </li>
                      @endif
                      @if($question->option_D != NULL)
                        <li>
                          <form method="post" action="{{route('answer.submit',$question->id)}}" id='D' style="display: none;">
                          {{csrf_field()}}
                          <input type="hidden" name="answer" value='D'>
                          <input type="hidden" name="exam_id" value='{{$exam->id}}'>
                        </form>
                        <a style="color: black"
                          onclick="
                            document.getElementById('D').submit();
                          " 
                        ><h4><input type="radio" @if ($check_status->count() > 0) @if($check->answer=='D') checked="checked" @endif @endif name="{{$question->id}}" value="D"> (D) {{$question->option_D}}
                        </h4></a>
                      </li>
                      @endif
                      @if($question->option_E != NULL)
                        <li>
                          <form method="post" action="{{route('answer.submit',$question->id)}}" id='E' style="display: none;">
                          {{csrf_field()}}
                          <input type="hidden" name="answer" value='E'>
                          <input type="hidden" name="exam_id" value='{{$exam->id}}'>
                        </form>
                        <a style="color: black"
                          onclick="
                            document.getElementById('E').submit();
                          " 
                        ><h4><input type="radio" @if ($check_status->count() > 0) @if($check->answer=='E') checked="checked" @endif @endif name="{{$question->id}}" value="E"> (E) {{$question->option_E}}
                       </h4></a>
                     </li>
                      @endif
                    </ul><br><br>
                @php $counter+=1; @endphp
                {{-- the next form --}}
                <form method="post" action="{{route('next.check',$question->id)}}" id='next' style="display: none;">
                  {{csrf_field()}}
                  <input type="hidden" name="page" value='{{$questions->currentPage()}}'>
                  <input type="hidden" name="exam_id" value='{{$exam->id}}'>
                </form>
                <center>@if($number < $total)
                  <a class="btn btn-default btn-lg"
                  onclick="
                    document.getElementById('next').submit();
                  " 
                >Next Question >></a>@endif
              </center>
                <br><br>
              @endforeach
              </div>
              {{-- <center>{!! $questions->render() !!}</center><br> --}}
              <form method="post" action="{{route('submit.exams',$exam->id)}}" id="submit_exams" style="display: none;">
                  {{csrf_field()}}
                </form>
              <a {{-- href="{{route('submit.exams',$exam->id)}}" --}} type="button" class="btn btn-block btn-danger btn-lg" id="submit_exams"
               onclick="
                if (<?= $number ?> < <?= $total ?> ) {
                  if(confirm('You Have  not finished answering your questions\nDo you still want to submit?')){
                    event.preventDefault();
                    if(confirm('Once you submit, You can not return back to your questions')){
                        event.preventDefault();
                      document.getElementById('submit_exams').submit();
                    }
                    else{
                      event.preventDefault();
                    }
                    // document.getElementById('submit_exams').submit();
                  }
                  else{
                    event.preventDefault();
                  }
                }
                else{
                  if(confirm('Once you submit, You can not return back to your questions')){
                      event.preventDefault();
                    document.getElementById('submit_exams').submit();
                  }
                  else{
                    event.preventDefault();
                  }
                }
                " 
              >I'm Done, I Want To Submit</a>

           {{--  </tbody>
          </table> --}}
          
          <div class="col-lg-12"><hr>
            <footer ><br><br><h4><div class="pull-left col-md-6">{{Auth::user()->name}}</div><div class="pull-right col-md-2">--GoodLuck--<hr></div></h4></footer>
          </div>
        </div>
        {{-- @php $page=13 % $pages; @endphp --}}
        <div class=" col-md-3 srow" >
          <div class=" col-sm-11 col-md-10">
            {{-- <center><h5><u><span class="badge bg-yellow"> UnAnswered Question</span></u></h5></center>
            @if($questions_remaining->count()>0)
            @if($questions_answered->count()>0)                
              @foreach($questions_remaining as $unanswered)
                @php 
                $question_number = $loop->index+1;
                $checker = false; 
                @endphp
                
                  @foreach($questions_answered as $answered)
                    @if($unanswered->id == $answered->question_id)
                    @php 
                    $checker = true;
                    break; @endphp          
                    @endif
                  @endforeach
                  @if(!$checker)
                    <a href="{{url("students/Exams/startExam/$exam->id?page=$question_number")}}" ><span class="badge bg-red">{{$question_number}}</span></a>
                  @endif
                @endforeach
                @else
                  No Question Attempted Yet
                @endif
              
            @else
              All Questions Answered Successfully<br>Submit Your Work If Sure
            @endif --}}
            {{--<br><br><center><h5><u><span class="badge bg-blue"> Select A Question To Answer</span></u></h5></center>     
             @for($page=1; $page<=$total; $page++) 
            
              <a href="{{url("students/Exams/startExam/$exam->id?page=$page")}}" ><span class="badge bg-blue">{{"  $page  "}}</span></b></a>
             
            @endfor --}}

            {{-- time left for exams  --}}
            <br><center><span class="badge bg-blue"> <h1 id="demo">Calculating...</h1>Left To Submit Work</span></center>
            <p ></p>
          </div>
          <div class="col-md-12">
            <div class="box box-default">
              <div class="box-header with-border">
                <i class="fa fa-bullhorn"></i>

                <h3 class="box-title">Warnings And Alerts</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="callout callout-danger">
                  <h4 id="warnings"></h4>

                  {{-- <p id="warnings">All warnings will be seen here
                  </p> --}}
                </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
        </div>
      </div>

    </section>
  </div>

@endsection

@section('script')
  
@endsection