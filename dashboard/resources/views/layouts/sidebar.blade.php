<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="搜索..."/>
        <span class="input-group-btn">
          <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
        </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">产品与服务</li>
      <li><a href="{{{ url('/') }}}"><i class="fa fa-dashboard"></i><span>首页</span></a></li>
      <li>
        <a href="{{ url('ad-categories') }}">
          <i class="fa fa-cubes"></i>
          <span>广告分类</span>
        </a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-shirtsinbulk"></i>
          <span>产品套系</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="../charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
          <li><a href="../charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
          <li><a href="../charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
          <li><a href="../charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-file-text-o"></i>
          <span>客户订单</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="#">
              <i class="fa fa-circle-o"></i>
              <span>未完成订单</span>
              <small class="label pull-right bg-red">3</small>
            </a>
          </li>
        </ul>
      </li>
      <li class="header">站点与资源</li>
      <li><a href="{{{ url('navigators') }}}"><i class="fa fa-navicon"></i> <span>全局导航</span></a></li>
      <li><a href="{{{ url('slides') }}}"><i class="fa fa-file-image-o"></i> <span>轮播图</span></a></li>
      <li class="header">用户中心</li>
      <li> <a href="{{ url('admins') }}"> <i class="fa fa-user-secret"></i> 管理员 </a> </li>
      <li>
        <a href="#">
          <i class="fa fa-users"></i>
          <span>注册用户</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>

