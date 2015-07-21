@extends ('app')

@section ('title')
  全局导航
@stop

@section ('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{{ url('/') }}}"><i class="fa fa-dashboard"></i>首页</a></li>
    <li><a href="{{{ url('navigators') }}}"><i class="fa fa-navicon"></i>全局导航</a></li>
  </ol>
@stop

@section ('content')
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          @include ('navigators.index.dataTable')
        </div>
      </div>
    </div>
  </div>
@stop
