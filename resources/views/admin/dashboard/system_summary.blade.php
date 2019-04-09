<div class="panel box box-primary">
  <div class="box-header with-border">
    <h4 class="box-title">
      <a data-toggle="collapse" data-parent="#accordion1" href="#collapseOne">
        System Summary
      </a>
    </h4>
  </div>
  <div id="collapseOne" class="panel-collapse collapse in">
    <div class="box-body">
           <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$users->count()}}</h3>
              <p>{{'Administrator'}}@if($users->count() > 1 ||$users->count() == 0 ){{'s'}} @endif</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="{{route('users.index')}}" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$departments->count()}}</h3>

              <p>{{'Department'}}@if($departments->count() > 1 ||$departments->count() == 0 ){{'s'}} @endif in Total</p>
            </div>
            <div class="icon">
              <i class="fa fa-th-list"></i>
            </div>
            <a href="{{route('department.index')}}" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$courses->count()}}</h3>

              <p>{{'Course'}}@if($courses->count() > 1 ||$courses->count() == 0 ){{'s'}} @endif in Total</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{route('course.index')}}" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{$questions->count()}}</h3>

              <p>{{'Question'}}@if($questions->count() > 1 ||$questions->count() == 0 ){{'s'}} @endif in Total</p>
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
          <div class="small-box bg-maroon">
            <div class="inner">
              <h3>{{$assigned->count()}}</h3>

              <p>{{'Course'}}@if($assigned->count() > 1 ||$assigned->count() == 0 ){{'s'}} @endif {{'Assigned To Lecturers'}}</p>
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
          <div class="small-box bg-teal">
            <div class="inner">
              <h3>{{$courses->count() - $assigned->count()}}</h3>

              <p>{{'Course'}}@if($courses->count()- $assigned->count() > 1 ||$courses->count() - $assigned->count() == 0 ){{'s'}} @endif {{'Not Assigned Lecturers'}}</p>
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
          <div class="small-box bg-purple">
            <div class="inner">
              @if($available==0)
              <h3>All</h3>

              <p>Lecturers Assigned A Course</p>
              @else
              <h3>{{$available}}</h3>

              <p>{{'Lecturer'}}@if($available > 1 ){{'s'}} @endif {{'Not Assigned Course'}}</p>
              @endif
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-navy">
            <div class="inner">
              <h3>{{$students->count()}}</h3>

              <p>{{'Student'}}@if($students->count() > 1 ||$students->count() == 0 ){{'s'}} @endif in Total</p>
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