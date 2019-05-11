@extends('layouts.admin_layouts.admin_design')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Lecturers Questions
        <small>Upload Status</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Questions Upload Status</li>
      </ol>
      @include('messages.flash_messages')
    </section>
      <!-- /.content -->

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Upload Status of Lecturers</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover table-responsive">
                <thead>
                <tr>
                  <th><center>Course</center></th>
                  <th><center>Lecturer</center></th>
                  <th><center>Exams Title</center></th>
                  <th><center>Question Upload Status</center></th>
                </tr>
                </thead>
                <tbody>
                  @foreach($courses as $course)
                    <tr>
                      <td  class="text-center">{{$course->name}}</td>
                      <td  class="text-center">{{App\Admin::find($course->assigned_to)->name}}</td>
                      <?php $exams = $course->examsSettings ?>
                      <td >
                        @foreach($exams as $exam)
                          <table class="table table-hover table-responsive"><tr class="text-center"><td>{{$exam->title}}</td></tr></table>
                        @endforeach
                      </td>
                      <td>
                        @foreach($exams as $exam)
                        <?php $questions = $exam->questions->count() ?>
                          <table class="table table-hover table-responsive"><tr class="text-center"><td>
                            @if($questions > 0)
                              <span class="label label-success">Yes</span>
                            @else
                              <span class="label label-danger">No</span>
                            @endif
                          </td></tr></table>
                        @endforeach
                      </td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th><center>Course</center></th>
                  <th><center>Lecturer</center></th>
                  <th><center>Exams Title</center></th>
                  <th><center>Question Upload Status</center></th>
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
    
@endsection

