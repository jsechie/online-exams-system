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
      {{-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> --}}
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->

      @php
        $courses = App\Course::all();
        $checker = 0;
        foreach ($courses as $course) {
          if ($course->assigned_to == Auth::user()->id) {
            $checker = 1;
            break;
          }
        }
      @endphp


      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">SYSTEM FUNCTIONS</li>
          <li class="active"><a href="{{url('/admin')}}"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
        @if(Auth::user()->role =='Examiner')
          <li class="header">MAIN EXAMINER FUNCTIONS</li>
          <li class=""><a href="{{route('department.index')}}"><i class="fa fa-hospital-o"></i><span>Department</span></a></li>
          <li class=""><a href="{{route('academics.index')}}"><i class="fa fa-calendar-plus-o"></i><span>Academics Calender</span></a></li>
          <li class=""><a href="{{route('course.index')}}"><i class="fa fa-balance-scale"></i><span>Course</span></a></li>
          <li class=""><a href="{{route('allStudents')}}"><i class="fa fa-users"></i><span>All Students</span></a></li>
        @endif
        @if(Auth::user()->role =='Lecturer' || $checker == 1)
          <li class="header">MAIN USER FUNCTIONS</li>
          <li class=""><a href="{{route('course.adminCourse')}}"><i class="fa fa-balance-scale"></i><span>My Courses</span></a></li>  
          <li class=""><a href="{{route('examsSettings.index')}}"><i class="fa fa-gear"></i><span>Exams Settings</span></a></li>      
          <li class=""><a href="{{route('questions.index')}}"><i class="fa fa-dropbox"></i><span>Questions</span></a></li>
          <li><a href="{{route('adminStudent.result')}}"><i class="fa fa-file-text-o"></i><span>Students Exams Results</span></a></li>
          <li><a href="{{route('myStudents')}}"><i class="fa fa-users"></i><span>My Students</span></a></li>
          <li><a href="{{route('adminStudent.report')}}"><i class="fa fa-bar-chart"></i><span>My Student Report</span></a></li>
        @endif
        @if(Auth::user()->role =='Examiner')
          <li class="header">EXAMINERS ONLY</li>
          <li><a href="{{route('users.index')}}"><i class="fa fa-users"></i><span>Lecturer Management</span></a></li>
          <li><a href="{{route('examiner.report')}}"><i class="fa fa-bar-chart"></i><span>Examiners Report</span></a></li>
        @endif
        <li class="header">Settings</li>
        <li><a href="{{url('admin/settings')}}"><i class="fa fa-user"></i><span>Profile Settings</span></a></li>
        <li><a href="{{route('admin.logout')}}"><i class="fa fa-user-times"></i> Sign out</a></li> 
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>