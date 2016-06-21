@extends ('app')

@section ('title')
添加用户
@stop

@section ('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{{ url('/') }}}"><i class="fa fa-dashboard"></i>首页</a></li>
    <li><a href="{{{ url('pending-verify') }}}"><i class="fa fa-shirtsinbulk"></i>用户管理</a></li>
    <li><a href="{{{ url('ad-spaces/create') }}}"><i class="fa fa-circle-o"></i>添加用户</a></li>
  </ol>
@stop

@section ('content')
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          @include ('shared.status')
          @include ('shared.errors')
          @include ('users.create.form')
        </div>
      </div>
    </div>
  </div>
@stop



