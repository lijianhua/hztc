<header class="main-header">
  <!-- Logo -->
  <a class="logo" href="/">
    <span class="logo-lg"><b>创业服务器</b>LTE</span>
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
                <a href="{{ url('accounts/' . Auth::user()->id) }}" class="btn btn-default btn-flat">账户</a>
              </div>
              <div class="pull-right">
                <a href="/auth/logout" class="btn btn-default btn-flat">注销</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>

