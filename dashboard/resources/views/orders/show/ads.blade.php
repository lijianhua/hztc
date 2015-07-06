<p class="lead">广告位信息</p>
<table class="table">
  <thead>
    <tr>
      <th>广告位</th>
      <th>起始日期</th>
      <th>截止日期</th>
      <th>数量</th>
      <th>原价（元）</th>
      <th>单价（元）</th>
      <th>小计（元）</th>
    </tr>
  </thead>
  <tbody>
    @foreach($order->orderItems as $item)
      <tr>
        <td>{{ $item->adSpace->title }}</td>
        <td>{{ $item->from->format('Y/m/d') }}</td>
        <td>{{ $item->to->format('Y/m/d') }}</td>
        <td>{{ $item->quantity }}</td>
        <td>{{ money_format('%i', $item->original_price) }}</td>
        <td>{{ money_format('%i', $item->price) }}</td>
        <td>{{ money_format('%i', $item->subtotal) }}</td>
      </tr>
    @endforeach
    <tr>
      <th colspan="6" class="text-right text-danger">总计（元）: </th>
      <td class="text-danger"><strong>{{ money_format('%i', $order->amount) }}</strong></td>
    </tr>
  </tbody>
</div>
</table>
