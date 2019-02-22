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
        <div class="col-md-3"><a class="btn btn-block btn-warning" href="{{route('questions.index')}}">Back To All Courses</a></div>
        <div class="col-md-3 pull-right"><a class="btn btn-block btn-primary" {{-- data-toggle="modal" data-target="#modal-default" --}} href="{{route('questions.add',$course->id)}}">Add New Question</a></div>
      </div><hr>

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
                              @if($question->answer == 'A')<small><i class="fa fa-check-circle">correct answer</i></small>@endif</h4>
                              <h4>B. {{$question->option_B}}
                              @if($question->answer == 'B')<small><i class="fa fa-check-circle">correct answer</i></small>@endif</h4>
                              @if($question->option_C != NULL)
                                <h4>C. {{$question->option_C}}
                                @if($question->answer == 'C')<small><i class="fa fa-check-circle">correct answer</i></small>@endif</h4>
                              @endif
                              @if($question->option_D != NULL)
                                <h4>D. {{$question->option_D}}
                                @if($question->answer == 'D')<small><i class="fa fa-check-circle">correct answer</i></small>@endif</h4>
                              @endif
                              @if($question->option_E != NULL)
                                <h4>E. {{$question->option_E}}
                                @if($question->answer == 'E')<small><i class="fa fa-check-circle">correct answer</i></small>@endif</h4>
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