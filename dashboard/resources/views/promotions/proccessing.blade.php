@extends ('app')

@section ('title')
进行中的秒杀活动
@stop

@section ('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{{ url('/') }}}"><i class="fa fa-dashboard"></i>首页</a></li>
    <li><a href="{{{ url('promotions') }}}"><i class="fa fa-bolt"></i>所有秒杀活动</a></li>
    <li><a href="{{{ url('promotions/proccessing') }}}"><i class="fa fa-circle-o"></i>进行中的秒杀活动</a></li>
  </ol>
@stop

@section ('content')
  <div class="row">
    <div class="col-xs-12">
      @include ('shared.status')
      <div class="box">
        <div class="box-body">
          @include ('promotions.proccessing.table')
        </div>
      </div>
    </div>
  </div>
@stop





