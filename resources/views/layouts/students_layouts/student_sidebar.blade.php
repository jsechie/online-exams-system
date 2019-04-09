  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{Storage::disk('local')->url(Auth::user()->picture)}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->username}}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
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

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">HEADER</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="{{route('student.dashboard')}}"><i class="fa fa-link"></i> <span>My Dashboard</span></a></li>
        <li><a href="{{route('student.course')}}"><i class="fa fa-link"></i> <span>My Courses</span></a></li>
        <li><a href="{{route('student.nextExam')}}"><i class="fa fa-link"></i> <span>Take Exam</span></a></li>
        <li><a href="{{route('student.timetable')}}"><i class="fa fa-link"></i> <span>Exams TimeTable</span></a></li>
        <li><a href="{{route('student.exams.index')}}"><i class="fa fa-link"></i> <span>All Exams Per Courses</span></a></li>
        <li><a href="#"><i class="fa fa-link"></i> <span>Check My Results</span></a></li><br><br>
        <li class="header">SETTINGS</li>
        <li><a href="{{route('user.settings')}}"><i class="fa fa-link"></i> <span>Profile Settings</span></a></li>
        <li><a href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
            <i class="fa fa-link"></i> <span>Logout</span></a></li>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}</form>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>