@extends('layouts.admin_layouts.admin_design')

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Update
        <small>Academics</small>
      </h1><br>
      	@if(count($errors)>0)
			@foreach($errors->all() as $error)
				<div class="alert alert-error alert-block">
		    		<button type="button" class="close" data-dismiss="alert">x</button>
		    		<strong>{{$error}}</strong>
		    	</div>
			@endforeach
		@endif
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a href="{{route('academics.index')}}"">Academics</a></li><li class="active">Update</li>
      </ol>
    </section>
      <!-- /.content -->
      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
          <hr>
          <a class="btn btn-block btn-primary" href="{{route('academics.index')}}"'" >View Academics</a>
        </div>
        <div class="col-md-4"></div>
      </div>

    <section class="content">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Update Academics Form</h3>
              <br>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{route('academics.update',$academic->id)}}">
            {{csrf_field()}}
            {{method_field('PATCH')}}
              <div class="box-body">
                <div class="form-group">
                  <label for="academics_year">Academics Year</label>
                  <input type="text" class="form-control" id="academics_year" placeholder="Name" name="academics_year" value="{{$academic->year}}">
                </div>
                <div class="form-group">
                  <label for="academics_sem">Academic Semester</label>
                  <select class="form-control" name="academics_sem">
                    <option value="1" @if($academic->semester==1) selected="selected" @endif>Semester 1</option>
                    <option value="2" @if($academic->semester==2) selected="selected" @endif>Semester 2</option>
                  </select>
                </div>                
              <div class="box-footer">
              	<a href="{{route('academics.index')}}" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-primary pull-right">Update</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
      </div>
    </section>
  </div>

@endsection