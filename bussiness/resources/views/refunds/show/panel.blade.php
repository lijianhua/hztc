<section class="refund">
  <div class="row">
    <div class="col-xs-12">
      <div class="clearfix header-tools">
        @if ($refund->isPending())
          <a href="{{ url("refunds/{$refund->id}/aggree") }}" class="pull-right text-muted" title="同意申请" data-toggle="tooltip" data-method="PUT">
            <span class="fa-stack fa-lg">
              <i class="fa fa-square-o fa-stack-2x"></i>
              <i class="fa fa-check fa-stack-1x"></i>
            </span>
          </a>
          <a href="{{ url("refunds/{$refund->id}/refuse") }}" class="pull-right text-muted" title="拒绝申请" data-toggle="tooltip" data-method="PUT">
            <span class="fa-stack fa-lg">
              <i class="fa fa-square-o fa-stack-2x"></i>
              <i class="fa fa-close fa-stack-1x"></i>
            </span>
          </a>
        @endif
        @if ($refund->isUnderway())
          <a href="{{ url("orders/{$refund->id}/finish") }}" class="pull-right text-muted" title="标记退款完成" data-toggle="tooltip" data-method="PUT">
            <span class="fa-stack fa-lg">
              <i class="fa fa-square-o fa-stack-2x"></i>
              <i class="fa fa-paw fa-stack-1x"></i>
            </span>
          </a>
        @endif
      </div>
      <h5 class="page-header">
        <i class="fa fa-bookmark-o"></i>
        {{ $refund->order_seq }}
        <small class="pull-right">
          {!! $service->refundStateLabel($refund->confirmed) !!}
        </small>
      </h5>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-6">
      @include ('refunds.show.base_info')
    </div>
    <div class="col-xs-6">
      @include ('refunds.show.user_info', ['user' => $refund->user])
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      @include ('orders.show.ads', ['order' => $refund->order])
    </div>
  </div>
</section>
