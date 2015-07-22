<p class="lead">基本信息</p>
<div class="table-responsive">
  <table class="table">
    <tbody>
      <tr>
        <th style="width: 50%">申请日期</th>
        <td>{{ $refund->apply_at }}</td>
      </tr>
      <tr>
        <th style="width: 50%">退款金额</th>
        <td class="text-danger">￥{{ money_format('%.2n', $refund->order->amount) }}</td>
      </tr>
      <tr>
        <th style="width: 50%">退款进度</th>
        <td>{!! $service->refundProgressLabel($refund->state) !!}</td>
      </tr>
      <tr>
        <th style="width: 50%">退款日期</th>
        <td>{{ $refund->refund_at }}</td>
      </tr>
    </tbody>
  </table>
</div>

