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
                    <img src="../images/login/logo.jpg">
                </div>
                  @if (count($errors) > 0)
                      <ul>
                        @foreach ($errors->all() as $error)
                          {{ $error }}
                        @endforeach
                      </ul>
                  @endif
					        <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
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
                            <input type="text" id="usercode" class="login-code"
name='captcha' >
                            <span class="login-yes"></span>
                            {!! Html::image(captcha_src()) !!}
                            <span class="no-look"><a href="#">看不清</a> </span>
                        </li>
                        <li class="login-submit">
								            <button type="submit" class="btn btn-primary">登录</button>
                        </li>
                    </ul>
                  </form>
                <div class="login-share">
                    <span>免费注册：</span>
                    <span><img src="../images/login/share1.jpg"></span>
                    <span><img src="../images/login/share2.jpg"></span>
                    <span><img src="../images/login/share3.jpg"></span>
                    <span class="registered-link">|<a href="#">注册</a> </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
