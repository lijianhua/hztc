@extends ('app')

@section ('title')
广告位详情
@stop

@section ('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{{ url('/') }}}"><i class="fa fa-dashboard"></i>首页</a></li>
    <li><a href="{{{ url('ads') }}}"><i class="fa fa-shirtsinbulk"></i>所有广告位</a></li>
    <li><a href="{{{ url('ads/' . $ad->id) }}}"><i class="fa fa-circle-o"></i>{{ $ad->title}}</a></li>
  </ol>
@stop

@section ('content')
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          @include ('ads.show.panel')
        </div>
      </div>
    </div>
  </div>
@stop



