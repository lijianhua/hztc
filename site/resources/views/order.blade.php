@extends('app')

@section('content')
<div class="layout content">
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
                        <span class="order-list-code-statefr">状态:<span>{{$states[$order->state] }}</span></span>
                    </div>
                    @foreach ($order->orderItems as $orderitem)
                    <div class="order-list-table">
                        <span class="order-list-content table-border order-list-name">
                            <a href='/ads/{{ $orderitem->ad_space_id }}' target='__blank'>
                              <span class="order-list-img">
                                  <img src="{{  $orderitem->adSpace->avatar->url() }}">
                              </span>
                              <span class="order-list-name-text">
                                  <span>{{ $orderitem->adSpace->title }}</span><br/>
                              </span>
                            </a>
                        </span>
                            
                        <span class="order-list-people table-border">{{ Auth::user()->name }}</span>
                        <span class="order-list-money table-border order-list-money-color">
                          <i class="fa fa-jpy"></i>{{ $order->amount }}
                        </span>
                        <span class="order-list-operate order-list-operate-info">
                            <div class="order-list-operate-text">
                                <a href="/users/orderDetail/{{$orderitem->order_id}}">查看订单</a>/
                                <a href="/users/orderDel/{{$orderitem->order_id}}/0" data-method='DELETE'
                                        data-confirm="确定要删除订单吗?">删除订单</a>
                                <a href="/users/comment/{{ $orderitem->order_id}}">评价订单</a>/
                                <a href="/users/orderDel/{{$orderitem->order_id}}/1" data-method='DELETE' 
                                        data-confirm="确定要申请退货?" >申请退款</a>
                            </div>
                        </span>
                    </div>
                    @endforeach
                </div>
            @endforeach
            </div>
              <?php echo $orders->render()?>
        </div>
    </div>
</div>
@endsection
