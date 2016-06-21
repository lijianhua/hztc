@extends ('app')

@section ('title')
编辑用户
@stop

@section ('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{{ url('/') }}}"><i class="fa fa-dashboard"></i>首页</a></li>
    <li><a href="{{{ url('/users/pending-verify') }}}"><i class="fa fa-shirtsinbulk"></i>所有用户</a></li>
    <li><a href="#"><i class="fa fa-edit"></i>编辑用户</a></li>
  </ol>
@stop

@section ('content')
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          @include ('shared.status')
          @include ('shared.errors')
          @include ('users.edit.form')
        </div>
      </div>
    </div>
  </div>
@stop




