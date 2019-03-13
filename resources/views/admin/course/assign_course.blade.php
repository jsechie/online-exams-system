 @extends('layouts.admin_layouts.admin_design')

@section('content')

  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Assign
          <small>Course To New Lecturer</small>
        </h1><br>
        <ol class="breadcrumb">
          <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class=""><a href="{{route('course.index')}}"">Course</a></li><li class="active">Assign</li>
        </ol>
      </section>
        <!-- /.content -->
        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <hr>
            <a class="btn btn-block btn-primary" href="{{route('course.index')}}"'" >View Course</a>
          </div>
          <div class="col-md-4"></div>
        </div>

      <section class="content">
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <!-- general form elements -->
            <div class="box box-primary row">
              <div class="box-header with-border">
                <h3 class="box-title">Assign <i><u><b class="text-success">{{$course->name}}</b></u></i> To:</h3>
                <br><br><br>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form method="post" action="{{route('assign.update',$course->id)}}" class="col-md-8 col-md-offset-2">
              {{csrf_field()}}
              {{method_field('PATCH')}}
              <div class="form-group col-md-12">
                  <label for="user_id">Lecturer Name</label>
                  <select class="form-control" name="user_id">
                    <option value="">---None---</option>
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                  </select>
                </div>
              <div class="form-group col-md-12">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary pull-right">Save changes</button>
              </div>
            </form>
            </div>
            <!-- /.box -->
        </div>
    </section>
  </div>


@endsection
