@extends('app')

@section('content')
<div class="layout">
    <div class="personal clearfix">
        <div class="personal-left">
            @include ('layouts.user_nav')
        </div>
        <div class="refund">
            <div class="order-title">
                <span>退货清单</span>
            </div>
            <div class="order-list">
                <div class="order-list-title">
                    <span class="refund-list-content">商品订单</span>
                    <span class="refund-list-people">退款明细</span>
                    <span class="refund-list-operate">操作</span>
                </div>
                @foreach($refunds as $index => $refund)
                    <div class="order-list-info">
                        <div class="order-list-code">
                            <span class="order-list-code-number">退单编号：<b>{{$refund->order_seq}}</b></span>
                            <span class="order-list-code-time">申请日期：{{$refund->apply_at}}</span>
                            <span class="order-list-code-state fr">状态:<span>{{($refund&&$refund->confirmed==1)? '已通过': '未通过'}}</span></span>
                        </div>
                        <div class="order-list-table">
                            <span class="refund-list-content table-border order-list-name">
                                <span class="order-list-img">
                                    <img src="{{$refund->orderItems()->first()->adSpace()->first()->avatar->url()}}">
                                </span>
                                <span class="order-list-name-text">
                                    <span>{{$refund->orderItems->adSpace()->first()->title}}</span><br/>
                                    <span class="order-color">积分：<span>{{$refund->orders->count_price}}</span></span>
                                </span>
                            </span>
                            <span class="refund-list-people table-border">
                                <div style="position:relative;top: -10px">
                                    <div>退款金额：{{$refund->orders->amount}}</div>
                                    <div class="order-color">积分：<span>-{{$refund->orders->count_price}}</span></div>
                                </div>
                            </span>
                            <span class="refund-list-operate order-list-operate-info">
                                <div class="order-list-operate-text">
                                    <a href="/users/refund/detail/{{$refund->id}}">查看退款详情</a>
                                </div>
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
            <?php echo $refunds->render();?>
        </div>
    </div>
</div>
@endsection
