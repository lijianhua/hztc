<header class="main-header">
  <!-- Logo -->
  <a class="logo" href="/">
    <span class="logo-mini">AD</span>
    <span class="logo-lg"><b>布谷广告</b>LTE</span>
  </a>

  <nav class="navbar navbar-static-top" role="navigation">
    <a class="sidebar-toggle" href="#" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Notifications: style can be found in dropdown.less -->
        <li class="dropdown notifications-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell-o"></i>
            <span class="label label-warning">10</span>
          </a>
          <ul class="dropdown-menu">
            <li class="header">You have 10 notifications</li>
            <li>
              <!-- inner menu: contains the actual data -->
              <ul class="menu">
                <li>
                  <a href="#">
                    <i class="fa fa-users text-aqua"></i> 5 new members joined today
                  </a>
                </li>
              </ul>
            </li>
            <li class="footer"><a href="#">View all</a></li>
          </ul>
        </li>
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="{{ $userRepons->userImageUrl(Auth::user()) }}" class="user-image" alt="{{ Auth::user()->name }}"/>
            <span class="hidden-xs">{{ Auth::user()->name }}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="{{ $userRepons->userImageUrl(Auth::user()) }}" class="img-circle" alt="{{ Auth::user()->name }}"/>
              <p>
                {{ Auth::user()->name }}
                <small>自{{ date('Y年, m月', strtotime(Auth::user()->created_at)) }}加入</small>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">我的</a>
              </div>
              <div class="pull-right">
                <a href="/auth/logout" class="btn btn-default btn-flat">注销</a>
              </div>
            </li>
          </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->
        <li>
          <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
        </li>
      </ul>
    </div>
  </nav>
</header>

