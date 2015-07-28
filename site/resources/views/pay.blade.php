@extends('app')

@section('content')
<div class="layout">
    <div class="pay">
        <div class="pay-code">
            <span class="pay-code-left">
              订单提交成功！&nbsp;&nbsp;&nbsp;&nbsp;订单号：<b>{{$order->order_seq}}</b></span>
            <span class="pay-code-right">应付金额：<b><i class="fa fa-jpy"></i>{{$order->amount}}</b></span>
		<input type='hidden' name='order_id' value='{{ $order->id}}' >
        </div>
        <div class="bank-code">
            <div class="bank-code-title">请选择您的支付方式</div>
            <div class="bank-code-block">
                <span class="bank-code-item mr19">
                    <label>
                        <input type="radio" name="radio">
                        <img src="/images/zhifubao.jpg">
                    </label>
                </span>
            </div>
        </div>
        <div class="pay-submit">
            <form method='post' action='/gopay'>
              <input type="hidden" name="_token" value="{{csrf_token()}}">
              <input type='hidden' name='pay_id' value='{{$order->id}}'>
              <input type='text' name='pay_price_id' value='{{$order->price_id}}'>
              <input type='hidden' name='pay_seq' value='{{$order->order_seq}}'>
              <input type='hidden' name='pay_amount' value='{{$order->amount}}'>
              <span class="pay-submit-total">总计：<span>{{$order->amount}}</span></span>
              <span class="pay-submit-button"><button type="submit">提交订单</button></span>
            </form>
        </div>
    </div>
</div>
@endsection
