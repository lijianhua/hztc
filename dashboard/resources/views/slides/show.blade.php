@extends ('app')

@section ('title')
 {{{ $slide->belongs_page }}}轮播图
@stop

@section ('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{{ url('/') }}}"><i class="fa fa-dashboard"></i>首页</a></li>
    <li><a href="{{{ url('slides') }}}"><i class="fa fa-file-image-o"></i>轮播图</a></li>
    <li><a href="{{{ url('slides', [$slide->id]) }}}"><i class="fa
    fa-circle-o"></i>{{{ $slide->belongs_page }}}轮播图</a></li>
  </ol>
@stop

@section ('content')
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          @include ('slides.show.table')
        </div>
      </div>
    </div>
  </div>
@stop
