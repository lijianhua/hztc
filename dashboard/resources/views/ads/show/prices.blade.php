<p class="lead">价格信息</p>
<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>价格（元）</th>
        <th>原价（元）</th>
        <th>积分</th>
        <th>起始日期</th>
        <th>截止日期</th>
        <th>投放次数</th>
        <th>销售次数</th>
      </tr>
    </thead>
    <tbody>
      @foreach($ad->adPrices as $price)
        <tr>
          <td>{{ money_format('%i', $price->price) }}</td>
          <td>{{ money_format('%i', $price->original_price) }}</td>
          <td>{{ $price->score }}</td>
          <td>{{ $price->from }}</td>
          <td>{{ $price->to }}</td>
          <td>{{ $price->send_count }}</td>
          <td>{{ $price->sale_count }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
