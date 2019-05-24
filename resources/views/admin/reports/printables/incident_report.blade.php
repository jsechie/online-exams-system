@extends('layouts.print_layouts.print_design')
@section('content')
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header text-danger text-center">
        <i class="">{{$heading}}</i>
        <!--small class="pull-right"><?= date('d-m-Y  G:i') ?></small-->
      </h2>
    </div>
  </div>
  <!-- /.row -->
        <!-- Table row -->
  <div class="row">
    @foreach($reports as $report)
      <div class="col-md-12">
      
        <div class="box box-widget">
          <p >{!! $report->report !!}</p>
          <!-- /.box-header -->
          <div class="box-body col-md-10 col-md-offset-1">
            <!-- post text -->
            <div class="box-header with-border">
              <div class="user-block">
                <span class="description">Written By:</span>
                <span class="username"><a href="#">{{$report->reporter}}.</a></span>
                <span class="description">On - {{$report->updated_at->toFormattedDateString()}}</span>
              </div>
              <!-- /.user-block -->
              <!-- /.box-tools -->
            </div>
          </div>
            <!-- /.box-comment -->
        </div><br>
          <!-- /.box-footer -->
      </div>
    @endforeach
      <!-- Box Comment -->
      
      <!-- /.box -->
  </div>
</div>
  <!-- /.row -->
@endsection
  