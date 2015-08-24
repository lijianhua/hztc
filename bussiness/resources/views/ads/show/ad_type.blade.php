@if ($type == 0)
  <span class="label label-success">正常广告</span>
@elseif ($type == 1)
  <span class="label label-danger">特价广告</span>
@elseif ($type == 2)
  <span class="label label-danger">免费广告</span>
@else
  <span class="label bg-purple">新奇特广告</span>
@endif
