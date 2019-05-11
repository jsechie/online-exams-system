<div class="panel box box-success">
  <div class="box-header with-border">
    <h4 class="box-title">
      <a data-toggle="collapse" data-parent="#accordion2" href="#collapseUser">
        User Summary
      </a>
    </h4>
  </div>
  <div id="collapseUser" class="panel-collapse collapse in">
    <div class="box-body">
           <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <a href="{{route('course.adminCourse')}}"><div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$userCourses->count()}}</h3>
              <p>{{'Course'}}@if($userCourses->count() > 1 ||$userCourses->count() == 0 ){{'s'}} @endif{{'Assigned To You'}}</p>
             

            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            {{-- <a href="{{route('course.adminCourse')}}" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a> --}}
          </div></a>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <a href="{{route('questions.index')}}"><div class="small-box bg-green">
            <div class="inner">
              <h3>{{$userQuestions}}</h3>

              <p>{{'Question'}}@if($userQuestions > 1 ||$userQuestions == 0 ){{'s'}} @endif{{' Uploaded By You'}}</p>
            </div>
            <div class="icon">
              <i class="fa fa-th-list"></i>
            </div>
            {{-- <a href="{{route('questions.index')}}" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a> --}}
          </div></a>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <a href="{{route('examsSettings.index')}}"><div class="small-box bg-red">
            <div class="inner">
              <h3>{{$userExams}}</h3>

              <p>{{'Exam'}}@if($userExams > 1 ||$userExams == 0 ){{'s'}}@endif {{'Added By You'}} </p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            {{-- <a href="{{route('examsSettings.index')}}" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a> --}}
          </div></a>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <a href="{{route('myStudents')}}"><div class="small-box bg-navy">
            <div class="inner">
              <h3>{{$userStudents}}</h3>

              <p>{{'Student'}}@if($userStudents > 1 ||$userStudents == 0 ){{'s'}}@endif{{' Taking Your Courses'}} </p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            {{-- <a href="{{route('myStudents')}}" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a> --}}
          </div></a>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </div>
  </div>
</div>