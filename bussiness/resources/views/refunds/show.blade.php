@extends ('app')

@inject('service', 'App\Reponsitories\RefundReponsitory');

@section ('title')
退单详情
@stop

@section ('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{{ url('/') }}}"><i class="fa fa-dashboard"></i>首页</a></li>
    <li><a href="{{{ url('refunds') }}}"><i class="fa fa-table"></i>所有退单</a></li>
    <li><a href="{{{ url('refunds/'. $refund->id) }}}"><i class="fa fa-circle-o"></i>退单{{ $refund->order_seq }}</a></li>
  </ol>
@stop

@section ('content')
  <div class="row">
    <div class="col-xs-12">
      @include ('shared.status')
      <div class="box">
        <div class="box-body">
          @include ('refunds.show.panel')
        </div>
      </div>
    </div>
  </div>
@stop





