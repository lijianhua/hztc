<p class="lead">价格信息</p>
<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>执行价（元）</th>
        <th>刊例价（元）</th>
        <th>版位</th>
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
          <td>
            {{ money_format('%i', $price->price) }}
            @if ($price->unit)
              /{{ $price->unit }}
            @endif
          </td>
          <td>
            {{ money_format('%i', $price->original_price) }}
            @if ($price->unit)
              /{{ $price->unit }}
            @endif
          </td>
          <td>{{ $price->position }}</td>
          <td>{{ $price->score }}</td>
          <td>{{ $price->from }}</td>
          <td>{{ $price->to }}</td>
          <td>{{ $price->send_count }}</td>
          <td>{{ $price->sale_count }}</td>
        </tr>
        <tr>
          <th>备注：</th>
          <td colspan="7">{{ $price->note }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
