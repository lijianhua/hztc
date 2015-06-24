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
        <div class="details">
            <div class="details-title"><span>当前订单</span></div>
            <div class="center">订单跟踪</div>
            <div class="details-list-code">
                <span class="details-list-code-number">订单编号：<b>123455454545</b></span>
                <span class="details-list-code-state">状态:<span>商家已确认</span></span>
                <span class="details-list-code-go fr"><a href="#">评价</a></span>
            </div>
            <div class="details-flow">
                <div class="details-flow-info">
                    <div class="details-mark-line"></div>
                    <span class="details-flow-item success">
                        <div class="details-flow-mark">
                            <div class="details-flow-number">1</div>
                            <div class="details-flow-text">提交订单</div>
                        </div>
                    </span>
                    <span class="details-flow-item success">
                        <div class="details-flow-mark">
                            <div class="details-flow-number">2</div>
                            <div class="details-flow-text">付款成功</div>
                        </div>
                    </span>
                    <span class="details-flow-item active">
                        <div class="details-flow-mark">
                            <div class="details-flow-number">3</div>
                            <div class="details-flow-text">广告商已确认</div>
                        </div>
                        <div class="details-this"><span>当前</span></div>
                    </span>
                    <span class="details-flow-item will">
                        <div class="details-flow-mark">
                            <div class="details-flow-number">4</div>
                            <div class="details-flow-text">广告设计中</div>
                        </div>
                    </span>
                    <span class="details-flow-item will">
                        <div class="details-flow-mark">
                            <div class="details-flow-number">5</div>
                            <div class="details-flow-text">完成</div>
                        </div>
                    </span>
                </div>
            </div>
            <div class="details-title"><span>当前订单</span></div>
            <div class="details-info">
                <table>
                    <tr>
                        <td class="details-info-left">收货人</td>
                        <td class="details-info-right">张威</td>
                    </tr>
                    <tr>
                        <td class="details-info-left">联系电话</td>
                        <td class="details-info-right">15858585858</td>
                    </tr>
                    <tr>
                        <td class="details-info-left">广告商</td>
                        <td class="details-info-right">安家传媒</td>
                    </tr>
                    <tr>
                        <td class="details-info-left">完成日期</td>
                        <td class="details-info-right">2015 / 12 / 23</td>
                    </tr>
                    <tr>
                        <td class="details-info-left">成交价格</td>
                        <td class="details-info-right"><i class="fa fa-jpy"></i>500</td>
                    </tr>
                    <tr>
                        <td class="details-info-left">法律效力</td>
                        <td class="details-info-right"><a href="#">电子合同</a> <a href="#">下载</a></td>
                    </tr>
                </table>
            </div>
            <div class="details-list">
                <div class="details-title"><span>当前订单</span></div>
                <div class="details-list-title">
                    <span class="details-list-content">订单内容</span>
                    <span class="details-list-people">收货人</span>
                    <span class="details-list-money">金额</span>
                    <span class="details-list-operate">操作</span>
                </div>
                <div class="details-list-info">
                    <div class="details-list-code">
                        <span class="details-list-code-number">订单编号：<b>123455454545</b></span>
                        <span class="details-list-code-time">下单日期：2015/12/12</span>
                        <span class="details-list-code-state fr">状态:<span>未支付</span></span>
                    </div>
                    <div class="details-list-table">
                        <span class="details-list-content table-details details-list-name">
                            <span class="details-list-img">
                                <img src="images/personal/img.png">
                            </span>
                            <span class="details-list-name-text">
                                <span>安德烈的展板</span><br/>
                                <span class="details-color">积分：<span>6088</span></span>
                            </span>
                        </span>
                        <span class="details-list-people table-details">张威</span>
                        <span class="details-list-money table-details details-list-money-color"><i class="fa fa-jpy"></i>2000</span>
                        <span class="details-list-operate details-list-operate-info">
                            <div class="details-list-operate-text">
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
