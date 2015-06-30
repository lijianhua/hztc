@extends('app')

@section('content')
<div class="layout">
    <div class="personal clearfix">
      @include ('layouts.user_nav')
        <div class="order">
            <div class="order-title">
                <span>全部订单</span>
            </div>
            <div class="order-list">
                <div class="order-list-title">
                    <span class="order-list-content">订单内容</span>
                    <span class="order-list-people">收货人</span>
                    <span class="order-list-money">金额</span>
                    <span class="order-list-operate">操作</span>
                </div>
              @foreach ($orders as $order)
                <div class="order-list-info">
                    <div class="order-list-code">
                        <span class="order-list-code-number">订单编号：<b>{{ $order->order_seq }}</b></span>
                        <span class="order-list-code-time">下单日期：{{ $order->created_at }}</span>
                        <span class="order-list-code-state fr">状态:<span>{{ $order->state }}</span></span>
                    </div>
                    <div class="order-list-table">
                        <span class="order-list-content table-border order-list-name">
                            <span class="order-list-img">
                                <img src="images/personal/img.png">
                            </span>
                            <span class="order-list-name-text">
                                <span>{{ $order->adSpaces->title }}</span><br/>
                            </span>
                        </span>
                        <span class="order-list-people table-border">{{ Auth::user()->name }}</span>
                        <span class="order-list-money table-border order-list-money-color">
                          <i class="fa fa-jpy"></i>{{ $order->subtotal }}
                        </span>
                        <span class="order-list-operate order-list-operate-info">
                            <div class="order-list-operate-text">
                                <a href="#">查看订单</a>/<a href="#">删除订单</a>
                                <a href="#">评价订单</a>/<a href="#">申请退款</a>
                            </div>
                        </span>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
