@extends('layouts.admin_layouts.admin_design')

@section('content')

   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{$course->code}}
        <small>{{"($course->name) "}} </small> Available Exams
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Exams</li>
      </ol>
      @include('messages.flash_messages')
      @include('messages.errors')
    </section>
      <!-- /.content -->

    <section class="content">
      <hr><div class="row">
        <div class="col-md-3"><a class="btn btn-block btn-danger" href="{{route('examsSettings.index')}}">Back To My Courses</a></div>
        <div class="col-md-3 pull-right"><a class="btn btn-block btn-primary" href="#" data-toggle="modal" data-target="#modal-default" >Add New Exam</a></div>
      </div><hr>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">List of {{$course->name}} Exams </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>
                  <th><center>Exams Title</center></th>
                  <th><center>Total Questions</center></th>
                  <th><center>Total Marks</center></th>
                  <th><center>Status</center></th>
                  <th><center>Last Updated</center></th>
                  <th><center>Action</center></th>
                </tr>
                </thead>
                <tbody>
                  @foreach($exam as $exams)
                    <tr class="gradeU">
                      <td><center><a title="View Question" href="{{route('examsSettings.view',$exams->id)}}">{{$exams->title}}</a></center></td>
                      <td><center>{{App\ExamsSettings::find($exams->id)->questions->count()}}</center></td>
                      <td><center>{{$exams->total_marks}}</center></td>
                      @if($exams->status == 1)
                        <td ><center class=" btn-success">Active</center></td>
                      @else
                        <td><center class="btn-danger">Inactive</center></td>
                      @endif
                      <td><center>{{$exams->updated_at->toFormattedDateString()}}</center></td>
                      <td><center><a title="Edit" class="btn btn-info tip"href="{{route('examsSettings.edit',$exams->id)}}"><i class="glyphicon glyphicon-edit"></i></a>
                        <form method="post" action="{{route('examsSettings.destroy',$exams->id)}}" id="delete-form-{{$exams->id}}" style="display: none;">
                          {{csrf_field()}}
                          {{method_field('DELETE')}}
                        </form>
                        <a title="Delete" class="btn btn-danger tip "
                          onclick="
                          if(confirm('Are You Sure You want delete?')){
                            event.preventDefault();
                            document.getElementById('delete-form-{{$exams->id}}').submit();
                          }
                          else{
                            event.preventDefault();
                          }
                          " 
                        ><i class="glyphicon glyphicon-trash"></i></a>
                        @if($exams->status == '0')
                        <a title="Activate" class="btn btn-success tip"href="{{route('examsSettings.status',$exams->id)}}"><i class="fa fa-check-square">Activate</i></a>@endif
                        @if($exams->status == '1')
                        <a title="Deactivate" class="btn btn-warning tip"href="{{route('examsSettings.status',$exams->id)}}"><i class="fa fa-times-circle">Deactivate</i></a>@endif
                      </center></td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                   <th><center>Exams Title</center></th>
                  <th><center>Total Questions</center></th>
                  <th><center>Total Marks</center></th>
                  <th><center>Status</center></th>
                  <th><center>Last Updated</center></th>
                  <th><center>Action</center></th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>

      <div class="modal fade" id="modal-default">
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
                    <label>Exams Title</label>
                    <textarea class="form-control" rows="2" placeholder="Enter the Exams Title..." name="title" >{{old('title')}}</textarea>
                  </div>
                  <div class="form-group">
                    <label>Total Marks</label>
                    <input type="number" class="form-control" name="marks" {{old('marks')}}>
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