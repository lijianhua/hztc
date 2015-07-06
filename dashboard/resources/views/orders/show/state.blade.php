@if ($order->state == 0)
  <span class="label bg-navy">未付款</span>
@elseif ($order->state == 1)
  <span class="label label-danger">待投放</span>
@elseif ($order->state == 2)
  <span class="label label-warning">待确认</span>
@elseif ($order->state == 3)
  <span class="label label-success">已完成</span>
@elseif ($order->state == 4)
  <span class="label label-default">已取消</span>
@endif

