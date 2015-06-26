@if (!is_null($enterprise))
  <dl class="dl-horizontal">
    <dt>名称</dt>
    <dd>{{ $enterprise->name }}</dd>
    <dt>LOGO</dt>
    <dd>TODO</dd>
    <dt>行业</dt>
    <dd>{{ $enterprise->trade }}</dd>
    <dt>移动电话</dt>
    <dd>{{ $enterprise->telphone }}</dd>
    <dt>固定电话</dt>
    <dd>{{ $enterprise->phone }}</dd>
    <dt>微信</dt>
    <dd>{{ $enterprise->weixin }}</dd>
    <dt>QQ</dt>
    <dd>{{ $enterprise->qq }}</dd>
  </dl>
@else
  <div class="callout callout-warning">
    <h4><i class="fa fa-bullhorn"></i>警告</h4>
    <p>您暂时没有添加公司资料</p>
  </div>
@endif
