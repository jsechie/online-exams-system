<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{Storage::disk('local')->url(Auth::user()->picture)}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ucfirst(Auth::user()->username)}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">SYSTEM FUNCTIONS</li>
          <li class="active"><a href="{{url('/admin')}}"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li><br>
          @if(Auth::user()->role =='Examiner')
            <li class="header">MAIN ADMIN FUNCTIONS</li>
           <li class=""><a href="{{route('department.index')}}"><i class="fa fa-dashboard"></i><span>Department</span></a></li>
          <li class=""><a href="{{route('academics.index')}}"><i class="fa fa-dashboard"></i><span>Academics Calender</span></a></li>
          <li class=""><a href="{{route('course.index')}}"><i class="fa fa-dashboard"></i><span>Course</span></a></li><br>
        @endif
        <li class="header">MAIN USER FUNCTIONS</li>        
        <li class=""><a href="{{route('questions.index')}}"><i class="fa fa-dashboard"></i><span>Questions</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o"></i><span>Exams Results</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o"></i><span>Student Records</span></a></li>
        <li><a href="{{url('admin/settings')}}"><i class="fa fa-user"></i><span>Profile Settings</span></a></li><br>
        @if(Auth::user()->role =='Examiner')
        <li class="header">ADMINS ONLY</li>
        <li><a href="{{route('users.index')}}"><i class="fa fa-circle-o"></i><span>User Management</span></a></li>
        @endif 
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>