<p class="lead">基本信息</p>
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th>订购日期</th>
        <th>广告买家</th>
        <th>订单总额</th>
        <th>支付日期</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{{ $order->created_at }}</td>
        <td>{{ $order->user->name }}</td>
        <td>{{ money_format('%i', $order->amount) }}</td>
        <td>{{ $order->paid_at ? $order->paid_at : '未支付' }}</td>
      </tr>
    </tbody>
  </table>
</div>
