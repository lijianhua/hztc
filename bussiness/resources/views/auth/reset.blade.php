@extends('fullscreen')

@section ('title')
  重置密码 - 魔媒网
@stop

@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="/"><b>魔媒网</b>LET</a>
  </div>

  <div class="login-box-body">
    @include ('shared.errors')

    <p class="login-box-msg">重置您的密码</p>

    <form action="{{ url('/password/reset') }}" method="POST" role="form">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="token" value="{{ $token }}">

      <div class="form-group has-feedback">
        <input class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="邮箱">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input class="form-control" type="password" name="password" placeholder="新密码">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input class="form-control" type="password" name="password_confirmation" placeholder="确认新密码">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block btn-flat">确认</button>
      </div>
    </form>

  </div>
</div>
@endsection
