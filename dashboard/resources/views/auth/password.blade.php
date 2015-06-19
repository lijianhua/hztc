@extends('fullscreen')

@section ('title')
找回密码 - 布谷广告
@stop

@section('content')
<div class="row reset-password-container">
  <div class="col-md-8 col-md-offset-2">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h2 class="box-title">找回密码</h2>
      </div>
      <div class="box-body">
        @if (session('status'))
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
        @endif

        @if (count($errors) > 0)
          <div class="alert alert-danger">
            <strong>哦噢!</strong>发生了一些错误。<br><br>
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form-group">
            <label class="col-md-4 control-label">邮箱</label>
            <div class="col-md-6">
              <input type="email" class="form-control" name="email" value="{{ old('email') }}">
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
              <button type="submit" class="btn btn-primary btn-flat">
              找回密码
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
