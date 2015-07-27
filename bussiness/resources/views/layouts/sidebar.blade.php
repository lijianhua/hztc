<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">产品与服务</li>
      <li><a href="{{{ url('/') }}}"><i class="fa fa-dashboard"></i><span>首页</span></a></li>
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
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>