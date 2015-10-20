@extends('app')

@section('content')
<div class="layout content">
    <div class="personal clearfix">
      @include ('layouts.user_nav')
        <div class="order-details">
            <div class="order-details-title"><span>当前订单</span></div>
            <div class="center">订单跟踪</div>
            <div class="order-details-list-code">
                <span class="order-details-list-code-number">订单编号：<b>{{$orders->order_seq}}</b></span>
                <span class="order-details-list-code-state">状态:<span>{{$states[$orders->state]}}</span></span>
                @if ($orders->state == 3)
                <span class="order-over"><a href='{{$orders->id}}'> 审核完成 </a></span>
                @endif
            </div>
            <div class="order-details-flow order-new-line">
                <div class="order-details-flow-info">
                    @if ($orders->state > 0)
                      <div class="order-details-mark-line"></div>
                    @endif
                    @for ($i=0;$i<=4;$i++)
                      <span class="order-details-flow-item 
                        {{$i<$orders->state?'success':(($i==$orders->state)?'active':'will')}}">
                          <div class="order-details-flow-mark">
                              <div class="order-details-flow-number">{{$i+1}}</div>
                              <div class="order-details-flow-text">{{$states[$i]}}</div>
                          </div>
                        @if($i==$orders->state)
                          <div class="order-details-this"><span>当前</span></div>
                        @endif
                      </span>
                    @endfor
                </div>
            </div>
            <div class="order-details-title"><span>当前订单</span></div>
            <div class="order-details-info">
                <table>
                    <tr>
                        <td class="order-details-info-left">收货人</td>
                        <td class="order-details-info-right">{{ Auth::user()->name}}</td>
                    </tr>
                    <tr>
                        <td class="order-details-info-left">广告商</td>
                        <td class="order-details-info-right">{{$orders->orderItems->first()->adSpace->user->name}}</td>
                    </tr>
                    <tr>
                        <td class="order-details-info-left">完成日期</td>
                        <td class="order-details-info-right">{{$orders->state==1?$orders->updated_at:''}}</td>
                    </tr>
                    <tr>
                        <td class="order-details-info-left">成交价格</td>
                        <td class="order-details-info-right"><i class="fa fa-jpy"></i>{{$orders->amount}}</td>
                    </tr>
                    <tr>
                        <td class="order-details-info-left">法律效力</td>
                        <td class="order-details-info-right"><a href="#">电子合同</a> <a href="#">下载</a></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
