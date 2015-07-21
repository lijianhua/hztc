<section class="order">
  <div class="row">
    <div class="col-xs-12">
      <div class="clearfix header-tools">
        @if ($order->isPending())
          <a href="{{ url("orders/proccessing/{$order->id}") }}" class="pull-right text-muted" title="标记为已投放" data-toggle="tooltip" data-method="PUT">
            <span class="fa-stack fa-lg">
              <i class="fa fa-square-o fa-stack-2x"></i>
              <i class="fa fa-paw fa-stack-1x"></i>
            </span>
          </a>
        @endif
        @if ($order->isNewest())
          <a href="{{ url("orders/confirm/{$order->id}") }}" class="pull-right text-muted" title="标记为已接单" data-toggle="tooltip" data-method="PUT">
            <span class="fa-stack fa-lg">
              <i class="fa fa-square-o fa-stack-2x"></i>
              <i class="fa fa-paw fa-stack-1x"></i>
            </span>
          </a>
        @endif
      </div>
      <h5 class="page-header">
        <i class="fa fa-bookmark-o"></i>
        {{ $order->order_seq }}
        <small class="pull-right">
          @include ('orders.show.state')
        </small>
      </h5>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      @include ('orders.show.base_info')
    </div>
    <div class="col-xs-12">
      @include ('orders.show.ads')
    </div>
  </div>
</section>
