@extends('app')

@section('content')
<div class="layout">
    <div class="personal clearfix">
        <div class="personal-left">
            @include ('layouts.user_nav')
        </div>
        <div class="details">
            <div class="details-title"><span>退款流程进度</span></div>
            <div class="details-list-code">
                <span class="details-list-code-number">退单编号：<b>{{$refund->order_seq}}</b></span>
                <span class="details-list-code-state">商品:<span>{{$refund->Order()->first()->orderItems()->first()->adSpace()->first()->title}}</span></span>
            </div>
            <div class="details-flow">
                <div class="details-flow-info">
                    <div class="details-mark-line"></div>
                    @for($i =0 ; $i < 3 ; $i++)
                    <span class="details-flow-item {{$i<$refund->state?'success':(($i==$refund->state)? 'active':'will')}}">
                        <div class="details-flow-mark">
                            <div class="details-flow-number">{{$i+1}}</div>
                            <div class="details-flow-text">{{$i==0?'申请退款':($i==1?'正在审核':'退款完成')}}</div>
                        </div>
                        @if($i==$refund->state)
                          <div class="details-this"><span>当前</span></div>
                        @endif
                    </span>
                    @endfor
                </div>
            </div>
            <div class="details-title"><span>退单详情</span></div>
            <div class="details-info">
                <table>
                    <tr>
                        <td class="details-info-left">退款方式</td>
                        <td class="details-info-right">线下返还&nbsp;&nbsp;&nbsp;金额：<span class="return-process-color">{{$refund->Order()->first()->count_price}}</span>元&nbsp;&nbsp;&nbsp;积分：<span class="return-process-color">-{{$refund->Order()->first()->amount}}</span></td>
                    </tr>
                    <tr>
                        <td class="details-info-left">处理方式</td>
                        <td class="details-info-right"> 客户期望处理方式为“退货” ，最终处理方式为“退货”</td>
                    </tr>
                    <!-- <tr> -->
                    <!--     <td class="details&#45;info&#45;left">问题描述</td> -->
                    <!--     <td class="details&#45;info&#45;right"><span class="return&#45;process&#45;color">不合格</span></td> -->
                    <!-- </tr> -->
                    <tr>
                        <td class="details-info-left">所属公司</td>
                        <td class="details-info-right">{{$refund->Order()->first()->orderItems()->first()->adSpace()->first()->user()->first()->enterprise()->first()->name}}</td>
                    </tr>
                    <tr>
                        <td class="details-info-left">联系方式</td>
                        <td class="details-info-right"><span>联系人：{{$refund->Order()->first()->orderItems()->first()->adSpace()->first()->user()->first()->name}}</span>&nbsp;&nbsp;&nbsp;<span>联系电话：{{$refund->Order()->first()->orderItems()->first()->adSpace()->first()->user()->first()->enterprise()->first()->telphone}}</span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
