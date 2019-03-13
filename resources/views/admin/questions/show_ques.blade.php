@extends('layouts.admin_layouts.admin_design')

@section('content')

   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{$course->code}}
        <small>{{"($course->name) "}} </small> Questions
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Questions</li>
      </ol>
      @include('messages.flash_messages')
    </section>
      <!-- /.content -->

    <section class="content">
      <hr><div class="row">
        <div class="col-md-3"><a class="btn btn-block btn-warning" href="{{route('questions.index')}}">Back To My Courses</a></div>
        <div class="col-md-3"><a class="btn btn-block btn-success" href="{{route('questions.activate',$course->id)}}" >Activate All Questions</a></div>
        <div class="col-md-3"><a class="btn btn-block btn-danger" href="{{route('questions.deactivate',$course->id)}}" >Deactivate All Questions</a></div>
        <div class="col-md-3 pull-right"><a class="btn btn-block btn-primary" {{-- data-toggle="modal" data-target="#modal-default" --}} href="{{route('questions.add',$course->id)}}">Add New Question</a></div>
      </div><hr>
        <div class="row">
          <div class="col-md-4 col-sm-4 col-xs-12">
            <a href="#" data-toggle="modal" data-target="#modal-info"><div class="info-box">
              <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">{{$active}} @if($active==1) Question @else Questions @endif</span>
                <span class="info-box-text">Active</span>
                @if($active>=1)<span class="info-box-number"> Create New Exams</span> @endif
              </div>
              <!-- /.info-box-content -->
            </div></a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class=" col-md-4 col-sm-4 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Randomly</span>
                <span class="info-box-number">Activate</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-4 col-sm-4 col-xs-12">
            <a href="#"><div class="info-box">
              <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">{{$active}} @if($active==1) Question @else Questions @endif</span>
                <span class="info-box-text">Active</span>
                @if($active>=1)<span class="info-box-number"> Update Existing Exams</span> @endif
              </div>
              <!-- /.info-box-content -->
            </div></a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">List of {{$course->name}} Questions </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>
                  <th><center>Question</center></th>
                  <th><center>Last Updated</center></th>
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
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapse-{{$question->id}}" class="@if($loop->index/2 == 0 )text-danger @endif">
                                <!-- question starts here -->
                                {!!$question->question!!}
                                <!-- /.question -->
                              </a>
                            </h4>
                          </div>
                          <div id="collapse-{{$question->id}}" class="panel-collapse collapse out">
                            <div class="box-body">
                              <!-- options starts here -->
                              <h4>A. {{$question->option_A}} 
                              @if($question->answer == 'A')<small><i class="fa fa-check-circle text-danger">correct answer</i></small>@endif</h4>
                              <h4>B. {{$question->option_B}}
                              @if($question->answer == 'B')<small><i class="fa fa-check-circle text-danger">correct answer</i></small>@endif</h4>
                              @if($question->option_C != NULL)
                                <h4>C. {{$question->option_C}}
                                @if($question->answer == 'C')<small><i class="fa fa-check-circle text-danger">correct answer</i></small>@endif</h4>
                              @endif
                              @if($question->option_D != NULL)
                                <h4>D. {{$question->option_D}}
                                @if($question->answer == 'D')<small><i class="fa fa-check-circle text-danger">correct answer</i></small>@endif</h4>
                              @endif
                              @if($question->option_E != NULL)
                                <h4>E. {{$question->option_E}}
                                @if($question->answer == 'E')<small><i class="fa fa-check-circle text-danger">correct answer</i></small>@endif</h4>
                              @endif
                              <!-- /.body -->
                            </div>
                          </div>
                        </div>
                      </td>
                      <td><center>{{$question->updated_at->toFormattedDateString()}}</center></td>
                      @if($question->status == 1)
                        <td ><center class=" btn-success">Active</center></td>
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
                        @if($question->status == '0')
                        <a title="Activate" class="btn btn-success tip"href="{{route('questions.status',$question->id)}}"><i class="fa fa-check-square">Activate</i></a>@endif
                        @if($question->status == '1')
                        <a title="Deactivate" class="btn btn-warning tip"href="{{route('questions.status',$question->id)}}"><i class="fa fa-times-circle">Deactivate</i></a>@endif
                      </center></td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th><center>Question</center></th>
                  <th><center>Last Updated</center></th>
                  <th><center>Status</center></th>
                  <th><center>Action</center></th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>

      {{-- modal for the creating the exams --}}
      <div class="modal fade" id="modal-info">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Creating New Exams</h4>
            </div>
            <div class="modal-body">
              <form role="form" method="post" action="{{route('examsSettings.store')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="box-body">
                  <div class="form-group">
                    <h3 class="text-success"><center><u>Total Questions To Be Added <span class="text-danger">{{'('.$active.')'}}</span></u></center></h3>
                    <input type="hidden" class="form-control" name="total_questions" value="{{$active}}">
                  </div>
                  <div class="form-group">
                    <label>Exams Title</label>
                    <textarea class="form-control" rows="2" placeholder="Enter the Exams Title..." name="title" >{{old('title')}}</textarea>
                  </div>
                  <div class="form-group">
                    <label>Total Marks</label>
                    <input type="number" class="form-control" name="marks">
                  </div>
                  <div class="form-group">
                    <label>Exams Instructions</label>
                    <textarea class="form-control" rows="2" placeholder="Enter the Exams Instructions..." name="instructions" >{{old('instructions')}}</textarea>
                  </div>
                  <input type="hidden" name="course_id" value="{{$course->id}}">
                <div class="box-footer">
                  <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-danger">
                  Cancel</button>
                  <button type="submit" class="btn btn-primary pull-right">Add New</button>
                </div>
              </form>
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    </section>
  </div>
  	{{-- course --}}


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