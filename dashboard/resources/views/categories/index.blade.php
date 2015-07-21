@extends ('app')

@section ('title')
广告分类
@stop

@section ('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{{ url('/') }}}"><i class="fa fa-dashboard"></i>首页</a></li>
    <li><a href="{{{ url('ad-categories') }}}"><i class="fa fa-cubes"></i>广告分类</a></li>
  </ol>
@stop

@section ('content')
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          @include ('categories.index.table')
        </div>
      </div>
    </div>
  </div>
@stop

