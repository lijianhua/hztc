@extends('app_login')

@section('content')
<div class="login clearfix">
    <div class="layout">
        <div class="login-info">
            <div class="login-left fl">
                <img src="../images/login/login-left.png">
            </div>
            <div class="login-right fl">
                <div class="login-title">
                    <img src="../images/login/logo.png">
                </div>
                      <div class='login-error' style='position:absolute;font-size:12px;margin-top:22px;margin-left:90px;color:red'>
                        @if (count($errors) > 0)
                            @foreach ($errors->all() as $error)
                              {{ $error }}
                            @endforeach
                        @endif
                      </div>
                  
					        <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}" id='login-form'>
						        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <ul class="login-right-info">
                        <li> <strong>账户名：</strong><br/>
								            <input type="email" name="email" id='username' class='login-enter' placeholder='电子邮箱' value="{{ old('email') }}">
                            <span class="login-yes"></span>
                        </li>
                        <li>
                            <strong>登录密码：</strong><span class="forget-password"><a href="{{ url('/password/email')}}">忘记登录密码？</a>
</span> <br/>
								            <input type="password" class="login-enter" name="password" id='password'>
                            <span class="login-yes"></span>
                        </li>
                        <li>
                            <strong>验证码：</strong> <br/>
                            <input type="text" id="usercode" class="login-code" name='captcha' >
                            <span class="login-yes"></span>
                            {!! Html::image(captcha_src(), '验证码',['id' => 'captchda']) !!}
                            <span class="no-look"><a id='captcha_validate'>看不清</a> </span>
                        </li>
                        <li class="login-submit">
								            <button type="button" class="btn btn-primary">登录</button>
                        </li>
                    </ul>
                  </form>
                <div class="login-share">
                    <span class="registered-link"><a href="/auth/register">注册</a> </span>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
  #captchda,#captcha_validate{
  cursor:pointer; 
}
</style>
@endsection
