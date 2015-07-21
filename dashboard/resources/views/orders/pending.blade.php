@extends ('app')

@section ('title')
待投放订单
@stop

@section ('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{{ url('/') }}}"><i class="fa fa-dashboard"></i>首页</a></li>
    <li><a href="{{{ url('orders') }}}"><i class="fa fa-file-text-o"></i>客户订单</a></li>
    <li><a href="{{{ url('orders/pending-proccess') }}}"><i class="fa fa-circle-o"></i>待投放订单</a></li>
  </ol>
@stop

@section ('content')
  <div class="row">
    <div class="col-xs-12">
      @include ('shared.status')
      <div class="box">
        <div class="box-body">
          @include ('orders.pending.table')
        </div>
      </div>
    </div>
  </div>
@stop



