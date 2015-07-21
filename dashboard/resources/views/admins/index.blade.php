@extends ('app')

@section ('title')
管理员
@stop

@section ('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{{ url('/') }}}"><i class="fa fa-dashboard"></i>首页</a></li>
    <li><a href="{{{ url('admins') }}}"><i class="fa fa-user-secret"></i>管理员</a></li>
  </ol>
@stop

@section ('content')
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          @include ('admins.index.table')
        </div>
      </div>
    </div>
  </div>
@stop

