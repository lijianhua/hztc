  @extends ('fullscreen')

  @section ('title')
    登录 - 魔媒网
  @stop

  @section ('content')
  <div class="login-box">
    <div class="login-logo">
      <a href="/"><b>魔媒网</b>LTE</a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">

      @include ('shared.errors')

      <p class="login-box-msg">登录管理您的控制台</p>

      <form action="{{ url('/auth/login') }}" method="post" role="form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group has-feedback">
          <input type="email" class="form-control" placeholder="邮箱" name="email" value="{{ old('email') }}">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="密码" name="password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-8">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox" name="remember"> 记住我
              </label>
            </div>
          </div>
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">登录</button>
          </div>
        </div>
      </form>

      <a class="text-muted" href="{{ url('/password/email') }}">忘记密码?</a>

    </div><!-- /.login-box-body -->
  </div><!-- /.login-box -->

  <!-- Scripts -->
  <script src="{{ asset('/js/vendor.js') }}"></script>
  <script src="{{ asset('/js/all.js') }}"></script>
  <script>
    $(function () {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      });
    });
  </script>
  @stop
