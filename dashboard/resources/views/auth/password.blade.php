@extends('fullscreen')

@section ('title')
找回密码 - 布谷广告
@stop

@section('content')
<div class="login-box">
  <div class="login-logo"><a href="/"><b>布谷广告</b>LTE</a></div>

  <div class="login-box-body">
    @include ('shared.status')
    @include ('shared.errors')

    <p class="login-box-msg">找回您的密码</p>

    <form role="form" method="POST" action="{{ url('/password/email') }}">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">

      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-block btn-primary btn-flat"> 找回密码 </button>
      </div>
    </form>
  </div>
</div>
@endsection
