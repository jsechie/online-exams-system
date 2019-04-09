@extends('layouts.admin_layouts.admin_design')

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Create
        <small>New Academics</small>
      </h1><br>
      	@include('messages.errors')
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a href="{{route('academics.index')}}"">Academics</a></li><li class="active">Add</li>
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
              <h3 class="box-title">Add Academics Form</h3>
              <br>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{route('academics.store')}}">
            {{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                  <label for="academic_year">Academics Year (Eg: 2018/2019)</label>
                  <input type="text" class="form-control" id="academic_year" placeholder="Name" name="academic_year" value="{{old('academic_year')}}">
                </div>                
              <div class="box-footer">
              	<a href="{{route('academics.index')}}" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-primary pull-right">Add New</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
      </div>
    </section>
  </div>

@endsection