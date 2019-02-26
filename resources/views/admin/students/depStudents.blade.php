@extends('layouts.admin_layouts.admin_design')

@section('content')

   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        All
        <small>Students</small> In {{ucfirst($department->name)}}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('allStudents')}}"><i class="fa fa-user"> Students</i></a></li>
        <li class="active">{{$department->name}}</li>
      </ol>
      @include('messages.flash_messages')
    </section>
      <!-- /.content -->

    <section class="content">
      <center><u><h3 class="text-warning">Select A Year To View It's Students</h3></u></center>
      @if($students->count() > 0)
      
        <hr><div class="row">
          <div class="col-lg-1 col-md-1"></div>
          <div class="col-lg-10 col-md-10 row">
            @php $years=[1,2,3,4,5,6]; @endphp
            @foreach($years as $year) 
              <form method="post" action="{{route('year.students',$year)}}" id="year-form-{{$year}}" style="display: none;">
                {{csrf_field()}}
                <input type="hidden" name="dep_id" value="{{$department->id}}">
              </form>
              <a href="" 
                onclick="
                  event.preventDefault();
                  document.getElementById('year-form-{{$year}}').submit();
                " 
              ><div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 text-danger">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="fa fa-files-o"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Year</span>
                    <span class="info-box-number">{{$year}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div></a>

            {{-- <a href="{{route('year.students',{$department->id}/{$year})}}"></a> --}}
            <!-- /.col -->        
            @endforeach
          </div>
          <div class="col-lg-1 col-md-1"></div>
        </div><hr>
      @else
        <h1 class="text-center text-danger">No Student Has Registered With This Department</h1>
      @endif

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">List Of All Students In The {{$department->name}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>
                  <th><center>Picture</center></th>
                  <th><center>Name</center></th>
                  <th><center>Index Number</center></th>
                  <th><center>Student ID</center></th>
                  <th><center>Year</center></th>
                  <th><center>Student Type</center></th>
                  <th><center>Program Type</center></th>
                  <th><center>Action</center></th>
                </tr>
                </thead>
                <tbody>
                  @foreach($students as $student)
                    <tr class="gradeU">
                      <th><center><img class="img-circle" height="60px" src="{{Storage::disk('local')->url("$student->picture")}}"></center></th>
                      <td><center>{{$student->name}}</center></td>
                      <td><center>{{$student->index_number}}</center></td>
                      <td><center>{{$student->student_id}}</center></td>
                      <td><center>{{$student->year}}</center></td>
                      <td><center>{{$student->student_type}}</center></td>
                      <td><center>{{$student->program_type}}</center></td>
                      <td><center>
                        {{-- <form method="post" action="{{route('academics.destroy',$academic->id)}}" id="delete-form-{{$academic->id}}" style="display: none;">
                          {{csrf_field()}}
                          {{method_field('DELETE')}}
                        </form>
                        <a title="Delete" class="btn btn-danger tip "
                          onclick="
                          if(confirm('Are You Sure You want delete {{$academic->year}}.{{$academic->semester}}?')){
                            event.preventDefault();
                            document.getElementById('delete-form-{{$academic->id}}').submit();
                          }
                          else{
                            event.preventDefault();
                          }
                          " 
                        ><i class="glyphicon glyphicon-trash"></i></a> --}}
                      </center></td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th><center>Picture</center></th>
                  <th><center>Name</center></th>
                  <th><center>Index Number</center></th>
                  <th><center>Student ID</center></th>
                  <th><center>Year</center></th>
                  <th><center>Student Type</center></th>
                  <th><center>Program Type</center></th>
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