@extends('app_login')

@section('content')
<div class="sign clearfix">
    <div class="sign-info">
        @if (count($errors) > 0)
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
				<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <table class="sign-block">
              <tr>
                  <td class="sign-block-left"><strong>用户名：</strong></td>
                  <td>
                      <input type="text" class="sign-enter" name="name" value="{{ old('name') }}" id='username'>
                      <span class="sign-warning">用户名不能小于6位</span><br/>
                      <span class="sign-prompt">请使用常用帐号，用于登录，6位以上，不能含有特殊字符。</span>
                  </td>
              </tr>
              <tr>
                  <td class="sign-block-left"><strong>电子邮箱：</strong></td>
                  <td>
                      <input type="email" id='email' class="sign-enter" name="email" value="{{ old('email') }}">
                      <span class="sign-warning">请填写正确的邮箱</span><br/>
                      <span class="sign-prompt">请使用常用邮箱作为注册帐号，用于登录、找回密码等重要操作。</span>
                  </td>
              </tr>
              <tr>
                  <td class="sign-block-left"><strong>创建登录密码：</strong></td>
                  <td>
                      <input type="password" class="sign-enter" name="password" id='password'>
                      <span class="sign-warning">密码不能小于6位</span><br/>
                      <div class="sign-strength clearfix">
                          <span class="sign-strength-item sign-strength-left">弱</span>
                          <span class="sign-strength-item sign-strength-center">中</span>
                          <span class="sign-strength-item sign-strength-right">强</span>
                      </div>
                  </td>
              </tr>
              <tr>
                  <td class="sign-block-left"><strong>确认登录密码：</strong></td>
                  <td>
                      <input type="password" class="sign-enter" name="password_confirmation" id='re_password'>
                      <span class="sign-warning">密码不一致</span><br/>
                  </td>
              </tr>
              <tr>
                  <td class="sign-block-left"></td>
                  <td>
                      <input type="checkbox" class="sign-checkbox">
                      <span class="sign-checkbox-text">已阅读并同意<a href="#">《360媒体网用户协议》</a> </span><br/>
                  </td>
              </tr>
              <tr>
                  <td class="sign-block-left"></td>
                  <td class="sign-submit">
                      <button type="submit" class="btn btn-primary" >同意条款立即注册</button>
                  </td>
              </tr>
          </table>
        </form>
    </div>
</div>
@endsection
