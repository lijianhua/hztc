@if (!is_null($enterprise))
  <dl class="dl-horizontal">
    <dt>名称</dt>
    <dd>{{ $enterprise->name }}</dd>
    <dt>企业邮箱</dt>
    <dd>{{ $enterprise->email }}</dd>
    <dt>LOGO</dt>
    <dd>
    @if ($enterprise->avatar_file_name)
      <img src="{{ $enterprise->avatar->url('medium') }}" alt="">
    @else
      未上传
    @endif
    </dd>
    <dt>广告分类中心</dt>
    <dd>
      <div class="row">
        @foreach($enterprise->adCenters as $adCenter)
          <div class="col-md-4 col-sm-6 col-xs-12">
            {{ $adCenter->name }}
            <br>
            {!! HTML::image($adCenter->avatar->url()) !!}
          </div>
        @endforeach
      </div>
    </dd>
    <dt>行业</dt>
    <dd>{{ $enterprise->trade }}</dd>
    <dt>移动电话</dt>
    <dd>{{ $enterprise->telphone }}</dd>
    <dt>固定电话</dt>
    <dd>{{ $enterprise->phone }}</dd>
    <dt>微信</dt>
    <dd>{{ $enterprise->weixin }}</dd>
    <dt>微博</dt>
    <dd>{{ $enterprise->weibo }}</dd>
    <dt>QQ</dt>
    <dd>{{ $enterprise->qq }}</dd>
    <dt>商铺详情</dt>
    <dd>{!! Purifier::clean($enterprise->detail) !!}</dd>
  </dl>
@else
  <div class="callout callout-warning">
    <h4><i class="fa fa-bullhorn"></i>警告</h4>
    <p>您暂时没有添加公司资料</p>
  </div>
@endif
