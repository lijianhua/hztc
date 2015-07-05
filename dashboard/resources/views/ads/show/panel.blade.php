<section class="ad">
  <div class="clearfix ad-tools">
    <small class="text-muted">{{ $ad->created_at }}</small>
    <a href="{{ url("ads/{$ad->id}") }}" class="pull-right text-muted" title="删除" data-toggle="tooltip" data-method="DELETE" data-confirm="这个操作无法逆转，确定删除吗？">
      <span class="fa-stack fa-lg">
        <i class="fa fa-square-o fa-stack-2x"></i>
        <i class="fa fa-trash-o fa-stack-1x"></i>
      </span>
    </a>
    <a href="{{ url("ad-spaces/{$ad->id}/edit") }}" class="pull-right text-muted" title="编辑" data-toggle="tooltip">
      <span class="fa-stack fa-lg">
        <i class="fa fa-square-o fa-stack-2x"></i>
        <i class="fa fa-pencil fa-stack-1x"></i>
      </span>
    </a>
    @if (!$ad->audited)
      <a href="{{ url("ads/{$ad->id}/audit") }}" class="pull-right text-muted" title="审核通过" data-toggle="tooltip" data-method="PUT">
        <span class="fa-stack fa-lg">
          <i class="fa fa-square-o fa-stack-2x"></i>
          <i class="fa fa-gavel fa-stack-1x"></i>
        </span>
      </a>
    @endif
  </div>
  <h2 class="page-header">
    <i class="fa fa-columns"></i>
    {{ $ad->title }}
    <small class="pull-right">
      @include ('ads.show.ad_type', ['type' => $ad->type])
    </small>
  </h2>
  <div class="row">
    <div class="col-xs-6">
      @include ('ads.show.base_info')
    </div>
    <div class="col-xs-6">
      @include ('ads.show.slides')
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      @include ('ads.show.categories')
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      @include ('ads.show.prices')
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      @include ('ads.show.detail')
    </div>
  </div>
</section>
