
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{-- {{route('admin.dashboard')}} --}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
      @include('messages.errors')
      @include('messages.flash_messages')

    <section class="content">
      <div class="row">
        
      </div>
    </section>
  </div>
@endsection