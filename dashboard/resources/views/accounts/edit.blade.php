@extends ('app')

@section ('title')
编辑资料
@stop

@section ('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{{ url('/') }}}"><i class="fa fa-dashboard"></i>首页</a></li>
    <li><a href="{{{ url('accounts/' . $user->id) }}}"><i class="fa fa-cog"></i>我的账户</a></li>
    <li><a href="{{{ url('accounts/' . $user->id . '/edit') }}}"><i class="fa fa-edit"></i>编辑资料</a></li>
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
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="user">
                @include ('accounts.edit.user')
              </div>
              <div class="tab-pane" id="enterprise">
                @include ('accounts.edit.enterprise')
              </div>
              <div class="tab-pane" id="security">
                @include ('accounts.edit.security')
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop

