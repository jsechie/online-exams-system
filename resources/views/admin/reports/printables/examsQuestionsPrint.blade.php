@extends('layouts.print_layouts.print_design')
@section('css')
  <style>
    .page-break {
        page-break-after: always;
    }
  </style>
@endsection
@section('content')
  <div class="row">
    <div class="">
      <div class="col-md-12">
        @php 
          $diff=strtotime($exam->stop_time)-strtotime($exam->start_time);
        @endphp
        <h3><center><br>KWAME NKRUMAH UNIVERSITY OF SCIENCE AND TECHNOLOGY<br>COLLEGE OF SCIENCE<br>DEPARTMENT OF {{strtoupper($department->name)}}<br><br>{{strtoupper("$exam->title, ".date('F Y',strtotime($exam->exams_date)))}}<br>BSC {{strtoupper("$department->name (YEAR $course->year)")}}<br><br>{{strtoupper("$course->code: $course->name")}}</center></h3><br>
        <h4><div class="row"><div class="col-md-8">TIME ALLOWED: @if(date('g',$diff) > 12 || date('g',$diff)< 12){{strtoupper(date('g',$diff).' hour(s)') }}@endif @if(date('i',$diff) != 00){{strtoupper(date('i',$diff).' minute(s)') }}@endif</div><div class="pull-right col-md-4 text-right">{{"($exam->total_marks Marks Total)"}}</div></div></h4><br>
        <br>
        <center><h3>INDEX NUMBER: ............................................</h3></center><br>
        <h3><u>READ INSTRUCTIONS CAREFULLY:</u><br><br> <span>{{$exam->instructions}}</span></h3><hr>
      </div>
      <div class="page-break"></div>
      <table class="table">
        <tbody>
          @foreach($questions as $question)
            <tr>
              {{-- <td></td> --}}
              <td ><h3>{{$loop->index+1}}. {!!$question->question!!}</h3>
                  <ul type="none"><li><h4>(A) {{$question->option_A}} 
                  {{-- @if($question->answer == 'A')<small><i class="fa fa-check-circle text-danger">correct answer</i></small>@endif --}}</h4>
                  <h4>(B) {{$question->option_B}}
                  {{-- @if($question->answer == 'B')<small><i class="fa fa-check-circle text-danger">correct answer</i></small>@endif --}}</h4>
                  @if($question->option_C != NULL)
                    <h4>(C) {{$question->option_C}}
                    {{-- @if($question->answer == 'C')<small><i class="fa fa-check-circle text-danger">correct answer</i></small>@endif --}}</h4>
                  @endif
                  @if($question->option_D != NULL)
                    <h4>(D) {{$question->option_D}}
                    {{-- @if($question->answer == 'D')<small><i class="fa fa-check-circle text-danger">correct answer</i></small>@endif --}}</h4>
                  @endif
                  @if($question->option_E != NULL)
                    <h4>(E) {{$question->option_E}}
                    {{-- @if($question->answer == 'E')<small><i class="fa fa-check-circle text-danger">correct answer</i></small>@endif --}}</h4>
                  @endif
              </li></ul></td>
              <td></td>
            </tr>
          @endforeach
        </tbody>
      </table>
      
      <div class="col-lg-12"><hr>
        <footer ><br><br><h4><div class="pull-left col-md-2">{{-- {{Auth::user()->name}} --}}</div><div class="pull-right col-md-2">--GoodLuck--<hr></div></h4></footer>
      </div>
    </div>
    <div class="page-break"></div>
    <center><h3><u>Answer(s) To {{"$course->name $exam->title"}}</u></h3></center>
    <ul type="none">@foreach($questions as $question)
      <li><h3>{{$loop->index+1}}.   
            @if($question->answer == 'A')<i > A</i>@endif
            @if($question->answer == 'B')<i > B</i>@endif
              @if($question->answer == 'C')<i > C</i>@endif
            
            @if($question->answer == 'D')<i > D</i>@endif
            
              @if($question->answer == 'E')<i > E</i>@endif
        </h3></li>
    @endforeach</ul>
  </div>
@endsection
  