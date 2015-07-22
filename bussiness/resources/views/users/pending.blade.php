@extends ('app')

@section ('title')
用户审核
@stop

@section ('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{{ url('/') }}}"><i class="fa fa-dashboard"></i>首页</a></li>
    <li><a href="{{{ url('users/pending-verify') }}}"><i class="fa fa-street-view"></i>用户审核</a></li>
  </ol>
@stop

@section ('content')
  <div class="row">
    <div class="col-xs-12">
      @include ('shared.status')
      <div class="box">
        <div class="box-body">
          @include ('users.pending.table')
        </div>
      </div>
    </div>
  </div>
@stop





