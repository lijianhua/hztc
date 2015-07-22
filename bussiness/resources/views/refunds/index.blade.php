@extends ('app')

@section ('title')
所有退单
@stop

@section ('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{{ url('/') }}}"><i class="fa fa-dashboard"></i>首页</a></li>
    <li><a href="{{{ url('refunds') }}}"><i class="fa fa-table"></i>所有退单</a></li>
  </ol>
@stop

@section ('content')
  <div class="row">
    <div class="col-xs-12">
      @include ('shared.status')
      <div class="box">
        <div class="box-body">
          @include ('refunds.index.table')
        </div>
      </div>
    </div>
  </div>
@stop




