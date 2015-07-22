@extends('app')

@section('content')
  <div class="row">
    <div class="col-xs-12">
      @include ('shared.status')
      <div class="callout callout-success">
        <h4><i class="fa fa-bullhorn"></i>&nbsp;&nbsp;登录成功</h4>
        <p>欢迎您使用魔媒网LET。</p>
      </div>
    </div>
  </div>
@endsection
