@extends ('app')

@section ('title')
分类中心
@stop

@section ('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{{ url('/') }}}"><i class="fa fa-dashboard"></i>首页</a></li>
    <li><a href="{{{ url('ad-centers') }}}"><i class="fa fa-tags"></i>分类中心</a></li>
  </ol>
@stop

@section ('content')
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          @include ('centers.index.table')
        </div>
      </div>
    </div>
  </div>
@stop


