<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
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
          <span>广告产品</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="{{ url('ad-spaces/create') }}">
              <i class="fa fa-circle-o"></i>
              <span>添加广告位</span>
            </a>
          </li>
          <li>
            <a href="{{ url('ads/waiting-audited') }}">
              <i class="fa fa-circle-o"></i>
              <span>审核广告位</span>
              <small class="label pull-right bg-red">{{ $__counts['waitingForAuditedAd'] }}</small>
            </a>
          </li>
          <li>
            <a href="{{ url('ads') }}">
              <i class="fa fa-circle-o"></i>
              <span>所有广告位</span>
            </a>
          </li>
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
            <a href="{{ url('orders/newest') }}">
              <i class="fa fa-circle-o"></i>
              <span>最新订单</span>
              <small class="label pull-right bg-green">{{ $__counts['newestOrders'] }}</small>
            </a>
          <li>
            <a href="{{ url('orders/pending-proccess') }}">
              <i class="fa fa-circle-o"></i>
              <span>待投放订单</span>
              <small class="label pull-right bg-red">{{ $__counts['pendingProccessOrders'] }}</small>
            </a>
          </li>
          <li>
            <a href="{{ url('orders') }}">
              <i class="fa fa-circle-o"></i>
              <span>所有订单</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-table"></i>
          <span>客户退单</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="{{ url('refunds/pending-proccess') }}">
              <i class="fa fa-circle-o"></i>
              <span>待处理退单</span>
              <small class="label pull-right bg-red">{{ $__counts['pendingProcessRefunds'] }}</small>
            </a>
            <a href="{{ url('refunds/underway') }}">
              <i class="fa fa-circle-o"></i>
              <span>退款中退单</span>
              <small class="label pull-right label-warning">{{ $__counts['underwayRefunds'] }}</small>
            </a>
          <li>
            <a href="{{ url('refunds') }}">
              <i class="fa fa-circle-o"></i>
              <span>所有退单</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="header">站点与资源</li>
      <li><a href="{{{ url('navigators') }}}"><i class="fa fa-navicon"></i> <span>全局导航</span></a></li>
      <li><a href="{{{ url('slides') }}}"><i class="fa fa-file-image-o"></i> <span>轮播图</span></a></li>
      <li class="header">用户中心</li>
      <li>
        <a href="{{ url('admins') }}">
          <i class="fa fa-user-secret"></i>
          <span>管理员</span>
        </a>
      </li>
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
