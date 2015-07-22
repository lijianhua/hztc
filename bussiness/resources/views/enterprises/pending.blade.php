@extends ('app')

@section ('title')
企业审核
@stop

@section ('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{{ url('/') }}}"><i class="fa fa-dashboard"></i>首页</a></li>
    <li><a href="{{{ url('enterprises/pending-verify') }}}"><i class="fa fa-bank"></i>企业审核</a></li>
  </ol>
@stop

@section ('content')
  <div class="row">
    <div class="col-xs-12">
      @include ('shared.status')
      <div class="box">
        <div class="box-body">
          @include ('enterprises.pending.table')
        </div>
      </div>
    </div>
  </div>
@stop






