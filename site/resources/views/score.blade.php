@extends('app') 
@section('content')
<div class="layout">
  <div class="personal clearfix">
        @include ('layouts.user_nav')
      <div class="points">
          <div class="points-number">
              <div class="order-title"><span>我的积分</span></div>
              <div class="points-number-info">
                  <span class="points-number-info-big">{{ $scores->total_score }}</span>
                  <span class="points-number-info-small">积分</span>
              </div>
          </div>
          <div class="points-detail">
              <div class="order-title"><span>积分收入明细</span></div>
              <div class="points-detail-info">
                  <table>
                      <tr>
                          <th>积分来源</th>
                          <th>收入支出</th>
                          <th>日期</th>
                      </tr>
                      @foreach ($redscore as $score)
                      <tr>
                          <td>{{ $score->reason }}</td>
                          <td class="points-detail-color">{{ $score->score }}</td>
                          <td>{{ $score->created_at }}</td>
                      </tr>
                      @endforeach
                      <?php echo $redscore->render()?>
                  </table>
              </div>
          </div>
      </div>

  </div>
</div>
@endsection
