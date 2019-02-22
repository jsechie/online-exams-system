@extends('layouts.admin_layouts.admin_design')

@section('content')

   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Available
        <small>Courses</small> Assigned To You
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Questions</li>
      </ol>
      @include('messages.flash_messages')
    </section>
      <!-- /.content -->

    <section class="content">
      @if($courses->count() > 0)
      <center><u><h3 class="text-warning">Select A Course To Add Your Questions</h3></u></center>
        <hr><div class="row">
          <div class="col-lg-2 col-md-2"></div>
          <div class="col-lg-8 col-md-8 row">
            @foreach($courses as $course)        
              <a href="{{route('questions.show',$course->id)}}"><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-danger">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="fa fa-files-o"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">{{$course->name}}</span>
                    <span class="info-box-number">{{$course->code}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div></a>
            <!-- /.col -->        
            @endforeach
          </div>
          <div class="col-lg-2 col-md-2"></div>
        </div><hr>
      @else
        @include('messages.course_error')
      @endif

{{--       <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">List Of All Questions Set By You Irrespective Of The Course</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>
                  <th><center>Question</center></th>
                  <th><center>Course</center></th>
                  <th><center>Status</center></th>
                  <th><center>Action</center></th>
                </tr>
                </thead>
                <tbody>
                  @foreach($questions as $question)
                    <tr class="gradeU">
                      <td>
                        <div class="panel box @if($loop->index/2 == 0) box-warning @else box-success @endif">
                          <div class="box-header with-border">
                            <h4 class="box-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapse-{{$question->id}}" @if($loop->index/2 == 0)class="text-danger" @endif>
                                <!-- question starts here -->
                                {!!$question->question!!}
                                <!-- /.question -->
                              </a>
                            </h4>
                          </div>
                          <div id="collapse-{{$question->id}}" class="panel-collapse collapse out">
                            <div class="box-body">
                              <!-- options starts here -->
                              <h4>A. {{$question->option_A}}</h4>
                              <h4>B. {{$question->option_B}}</h4>
                              @if($question->option_C != NULL)
                                <h4>C. {{$question->option_C}}</h4>
                              @endif
                              @if($question->option_D != NULL)
                                <h4>D. {{$question->option_D}}</h4>
                              @endif
                              @if($question->option_E != NULL)
                                <h4>E. {{$question->option_E}}</h4>
                              @endif
                              <!-- /.body -->
                            </div>
                          </div>
                        </div>
                      </td>
                      <td><center>{{ App\Questions::find($question->id)->courses->name.' ('.App\Questions::find($question->id)->courses->code.')'}}</center></td>
                      @if($question->status == 1)
                        <td class="btn btn-success"><center>Active</center></td>
                      @else
                        <td><center class="btn-danger">Inactive</center></td>
                      @endif
                      <td><center><a title="Edit" class="btn btn-info tip"href="{{route('questions.edit',$question->id)}}"><i class="glyphicon glyphicon-edit"></i></a>
                        <form method="post" action="{{route('questions.destroy',$question->id)}}" id="delete-form-{{$question->id}}" style="display: none;">
                          {{csrf_field()}}
                          {{method_field('DELETE')}}
                        </form>
                        <a title="Delete" class="btn btn-danger tip "
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
                      </center></td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th><center>Question</center></th>
                  <th><center>Course</center></th>
                  <th><center>Status</center></th>
                  <th><center>Action</center></th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div> --}}
    </section>
  </div>

  	{{-- course --}}
@endsection