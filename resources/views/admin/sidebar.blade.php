<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      {{-- <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('AdminLte/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div> --}}

      <!-- search form (Optional) -->
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

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
          <li class="header">Navigation</li>
          <!-- Optionally, you can add icons to the links -->
          {{-- <li class="active"><a href="#"><i class="fa fa-link"></i> <span>Link</span></a></li>
          <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li> --}}
          <li class="treeview">
            <a href="#"><i class="fa fa-folder-o"></i> <span>Documents Approval</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
              {{-- <li class="item {{active_route('users.index')}}"><a href="{{ route('users.index')}}">Users</a></li>
              <li class="item {{active_route('roles.index')}}"><a href="{{route('roles.index')}}">Roles</a></li> --}}
              <li class="item "{{active_route('documents.create')}}><a href="{{route('documents.create')}}"><i class="fa fa-file-text"></i> Create New</a></li>
              <li class="item "{{active_route('documents.needMyAction')}}><a href="{{route('documents.needMyAction')}}"> Need My Action</a></li>
              <li class="item "{{active_route('documents.myDocument')}}><a href="{{route('documents.myDocument')}}"> My Documents</a></li>
              <li class="item "{{active_route('documents.index')}}><a href="{{route('documents.index')}}"> All Documents</a></li>
            </ul>
            
          </li>
       
        <li class="treeview">
          <a href="#"><i class="fa fa-cogs"></i> <span>Approval Setting</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li class="item {{active_route('department.index')}}"><a href="{{ route('department.index')}}"> Department</a></li>
            <li class="item "{{active_route('section.index')}}><a href="{{route('section.index')}}"> Section</a></li>
            <li class="item "{{active_route('workflow.index')}}><a href="{{route('workflow.index')}}"> Work Flow</a></li>
          
          </ul>
          
        </li>
        <li class="header">User Management</li>
        <!-- Optionally, you can add icons to the links -->
        {{-- <li class="active"><a href="#"><i class="fa fa-link"></i> <span>Link</span></a></li>
        <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li> --}}
        <li class="treeview">
          <a href="#"><i class="fa fa-users"></i> <span>Access Control List</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
          <li class="item {{active_route('users.index')}}"><a href="{{ route('users.index')}}">Users</a></li>
            <li class="item {{active_route('roles.index')}}"><a href="{{route('roles.index')}}">Roles</a></li>
          
          </ul>
          
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>