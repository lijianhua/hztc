@extends('app')

@section('content')
<div class="layout content">
    <div class="personal clearfix">
      @include ('layouts.user_nav')
        <div class="order">
          @if (count($errors) > 0)
            <div class="alert alert-danger">
              <strong>错误!</strong> 您的请求存在下面问题：<br><br>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
        @if (session('status'))
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
        @endif

        <form action="{{ url('/accounts/' . $user->id . '/reset-password') }}" role="form" method="POST">
          <input type="hidden" name="id" value="{{ $user->id }}">
          <input type="hidden" name="_method" value="PUT">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
            <label>原密码</label>
            <input class="form-control" type="password" name="oldPassword">
          </div>
          <div class="form-group">
            <label>新密码</label>
            <input class="form-control" type="password" name="password">
          </div>
          <div class="form-group">
            <label>确认密码</label>
            <input class="form-control" type="password" name="password_confirmation">
          </div>
          <div class="form-group">
            <button class="btn btn-lg btn-flat btn-primary" type="submit">提交</button>
          </div>
        </form>
    </div>
</div>
@endsection
