<p class="lead">基本信息</p>
<div class="table-responsive">
  <table class="table">
    <tbody>
      <tr>
        <th style="width: 50%">标题</th>
        <td>{{ $ad->title }}</td>
      </tr>
      <tr>
        <th style="width: 50%">状态</th>
        <td>
          <span class="label {{ $ad->audited ? "label-success" : "label-danger" }}">{{ $ad->audited ? "通过审核" : "未通过审核" }}</span>
        </td>
      </tr>
      <tr>
        <th style="width: 50%">地区</th>
        <td>
          {{ $ad->address->province . "  " . $ad->address->city . "  " .  $ad->address->area }}
          <br>
          {{ $ad->street_address }}
        </td>
      </tr>
      <tr>
        <th style="width: 50%">影响人数</th>
        <td>{{ $ad->influence }}</td>
      </tr>
      <tr>
        <th style="width: 50%">关注度</th>
        <td>
         {{ $ad->attraction_rate}}
        </td>
      </tr>
      <tr>
        <th style="width: 50%">所属</th>
        <td>{{ $ad->user->name }}</td>
      </tr>
      <tr>
        <th style="width: 50%">公司</th>
        <td>{{ $ad->user->enterprise->name }}</td>
      </tr>
      <tr>
        <th style="width: 50%">简介</th>
        <td>{{ $ad->description }}</td>
      </tr>
    </tbody>
  </table>
</div>
