@extends('app')

@section('content')
<div class="layout">
    <div class="personal clearfix">
        <div class="personal-left">
            <dl>
                <dt class="personal-left-title"></dt>
                <dd class="personal-left-item"><a href="#" class="active">我的订单</a> </dd>
                <dd class="personal-left-item"><a href="#">广告主信息</a> </dd>
                <dd class="personal-left-item"><a href="#">我的收藏</a> </dd>
                <dd class="personal-left-item"><a href="#">我的关注</a> </dd>
                <dd class="personal-left-item"><a href="#">我的积分</a> </dd>
                <dd class="personal-left-item"><a href="#">退货清单</a> </dd>
            </dl>
        </div>
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
                <div class="order-list-info">
                    <div class="order-list-code">
                        <span class="order-list-code-number">订单编号：<b>123455454545</b></span>
                        <span class="order-list-code-time">下单日期：2015/12/12</span>
                        <span class="order-list-code-state fr">状态:<span>未支付</span></span>
                    </div>
                    <div class="order-list-table">
                        <span class="order-list-content table-border order-list-name">
                            <span class="order-list-img">
                                <img src="images/personal/img.png">
                            </span>
                            <span class="order-list-name-text">
                                <span>安德烈的展板</span><br/>
                                <span class="order-color">积分：<span>6088</span></span>
                            </span>
                        </span>
                        <span class="order-list-people table-border">张威</span>
                        <span class="order-list-money table-border order-list-money-color"><i class="fa fa-jpy"></i>2000</span>
                        <span class="order-list-operate order-list-operate-info">
                            <div class="order-list-operate-text">
                                <a href="#">查看订单</a>/<a href="#">删除订单</a>
                                <a href="#">评价订单</a>/<a href="#">申请退款</a>
                            </div>
                        </span>
                    </div>
                </div>
                <div class="order-list-info">
                    <div class="order-list-code">
                        <span class="order-list-code-number">订单编号：<b>123455454545</b></span>
                        <span class="order-list-code-time">下单日期：2015/12/12</span>
                        <span class="order-list-code-state fr">状态:<span>未支付</span></span>
                    </div>
                    <div class="order-list-table">
                        <span class="order-list-content table-border order-list-name">
                            <span class="order-list-img">
                                <img src="images/personal/img.png">
                            </span>
                            <span class="order-list-name-text">
                                <span>安德烈的展板</span><br/>
                                <span class="order-color">积分：<span>6088</span></span>
                            </span>
                        </span>
                        <span class="order-list-people table-border">张威</span>
                        <span class="order-list-money table-border order-list-money-color"><i class="fa fa-jpy"></i>2000</span>
                        <span class="order-list-operate order-list-operate-info">
                            <div class="order-list-operate-text">
                                <a href="#">查看订单</a>/<a href="#">删除订单</a>
                                <a href="#">评价订单</a>/<a href="#">申请退款</a>
                            </div>
                        </span>
                    </div>
                </div>
                <div class="order-list-info">
                    <div class="order-list-code">
                        <span class="order-list-code-number">订单编号：<b>123455454545</b></span>
                        <span class="order-list-code-time">下单日期：2015/12/12</span>
                        <span class="order-list-code-state fr">状态:<span>未支付</span></span>
                    </div>
                    <div class="order-list-table">
                        <span class="order-list-content table-border order-list-name">
                            <span class="order-list-img">
                                <img src="images/personal/img.png">
                            </span>
                            <span class="order-list-name-text">
                                <span>安德烈的展板</span><br/>
                                <span class="order-color">积分：<span>6088</span></span>
                            </span>
                        </span>
                        <span class="order-list-people table-border">张威</span>
                        <span class="order-list-money table-border order-list-money-color"><i class="fa fa-jpy"></i>2000</span>
                        <span class="order-list-operate order-list-operate-info">
                            <div class="order-list-operate-text">
                                <a href="#">查看订单</a>/<a href="#">删除订单</a>
                                <a href="#">评价订单</a>/<a href="#">申请退款</a>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
