@extends('app')

@section('content')
<div class="col-md-3 col-sm-6 col-xs-12">
  <div class="info-box">
    <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>

    <div class="info-box-content">
      <span class="info-box-text">会员数</span>
      <span class="info-box-number">{{ $userInfo->vipnum}}</span>
    </div>
    <!-- /.info-box-content -->
  </div>
  <!-- /.info-box -->
</div>
<div class="col-md-3 col-sm-6 col-xs-12">
  <div class="info-box">
    <span class="info-box-icon bg-aqua"><i class="fa fa-calendar"></i></span>

    <div class="info-box-content">
      <span class="info-box-text">有效期</span>
      <span class="info-box-number">{{ $userInfo->end_time }}</span>
    </div>
    <!-- /.info-box-content -->
  </div>
  <!-- /.info-box -->
</div>
<div class="col-md-3 col-sm-6 col-xs-12">
  <div class="info-box">
    <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

    <div class="info-box-content">
      <span class="info-box-text">Likes</span>
      <span class="info-box-number">41,410</span>
    </div>
    <!-- /.info-box-content -->
  </div>
  <!-- /.info-box -->
</div>
<div class="col-md-3 col-sm-6 col-xs-12">
  <div class="info-box">
    <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

    <div class="info-box-content">
      <span class="info-box-text">Sales</span>
      <span class="info-box-number">760</span>
    </div>
    <!-- /.info-box-content -->
  </div>
  <!-- /.info-box -->
</div>
@endsection
