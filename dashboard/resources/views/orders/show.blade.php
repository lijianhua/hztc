@extends ('app')

@section ('title')
订单详情
@stop

@section ('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{{ url('/') }}}"><i class="fa fa-dashboard"></i>首页</a></li>
    <li><a href="{{{ url('orders') }}}"><i class="fa fa-file-text-o"></i>客户订单</a></li>
    <li><a href="{{{ url('orders/'. $order->id) }}}"><i class="fa fa-circle-o"></i>订单{{ $order->order_seq }}</a></li>
  </ol>
@stop

@section ('content')
  <div class="row">
    <div class="col-xs-12">
      @include ('shared.status')
      <div class="box">
        <div class="box-body">
          @include ('orders.show.panel')
        </div>
      </div>
    </div>
  </div>
@stop




