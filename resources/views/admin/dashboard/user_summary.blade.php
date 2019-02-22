<div class="panel box box-success">
  <div class="box-header with-border">
    <h4 class="box-title">
      <a data-toggle="collapse" data-parent="#accordion" href="#collapseUser">
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
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$userCourses->count()}}</h3>
              <p>{{'Course'}}@if($userCourses->count() > 1 ||$userCourses->count() == 0 ){{'s'}} @endif{{'Assigned To You'}}</p>
             

            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="{{route('questions.index')}}" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <p>You belong to<br><b>{{$count=$userCourses->groupBy('dep_id')->count()}}</b><br>{{'Department'}}@if($count > 1 ||$count == 0 ){{'s'}} @endif</p>
            </div>
            <div class="icon">
              <i class="fa fa-th-list"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{$userQuestions}}</h3>

              <p>{{'Question'}}@if($userQuestions > 1 ||$userQuestions == 0 ){{'s Uploaded By You'}} @endif</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-navy">
            <div class="inner">
              <h3>0</h3>

              <p>{{'Students Taking Your Courses'}}{{-- @if($students->count() > 1 ||$students->count() == 0 ){{'s'}} @endif --}}</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </div>
  </div>
</div>