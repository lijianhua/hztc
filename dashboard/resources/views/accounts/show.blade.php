@extends ('app')

@section ('title')
我的账户
@stop

@section ('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{{ url('/') }}}"><i class="fa fa-dashboard"></i>首页</a></li>
    <li><a href="{{{ url('accounts/' . $user->id) }}}"><i class="fa fa-cog"></i>我的账户</a></li>
  </ol>
@stop

@section ('content')
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          <div class="nav-tabs-custom accounts">
            <ul class="nav nav-tabs">
              <li class="active">
                <a href="#user" data-toggle="tab" aria-expanded="true">个人资料</a>
              </li>
              <li>
                <a href="#enterprise" data-toggle="tab" aria-expanded="true">公司资料</a>
              </li>
              <li>
                <a href="#security" data-toggle="tab" aria-expanded="true">账户安全</a>
              </li>
              <li class="pull-right">
              <a href="#" title="编辑" data-toggle="tooltip" data-placement="bottom">
                <i class="fa fa-edit"></i>
              </a>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="user">
                @include ('accounts.show.user')
              </div>
              <div class="tab-pane" id="enterprise">
                @include ('accounts.show.enterprise')
              </div>
              <div class="tab-pane" id="security">
                @include ('accounts.show.security')
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop

