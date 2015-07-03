@extends ('app')

@section ('title')
编辑广告位
@stop

@section ('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{{ url('/') }}}"><i class="fa fa-dashboard"></i>首页</a></li>
    <li><a href="{{{ url('ads') }}}"><i class="fa fa-shirtsinbulk"></i>所有广告位</a></li>
    <li><a href="{{{ url('ads/' . $ad->id) }}}"><i class="fa fa-circle-o"></i>{{ $ad->title}}</a></li>
    <li><a href="{{{ url('ads/' . $ad->id . '/edit') }}}"><i class="fa fa-edit"></i>编辑广告位</a></li>
  </ol>
@stop

@section ('content')
  <div class="row">
    <div class="col-xs-12">
      @include ('shared.initWarning')
      <div class="box">
        @include ('shared.overlay')
        <div class="box-body">
          @include ('shared.status')
          @include ('shared.errors')
          @include ('ads.edit.form')
        </div>
      </div>
    </div>
  </div>
@stop




