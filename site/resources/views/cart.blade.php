@extends('app')

@section('content')
<div class="layout">
    <div class="shop">
        <div class="shop-mark"><span>首页</span>><span>购物车</span></div>
        <div class="shop-title"><i class="shop-title-img"></i>我的购物车</div>
        <div class="shop-list">
            <table border="1">
                <tr>
                    <th>选择提交</th>
                    <th>商品名称</th>
                    <th>价格</th>
                    <th>数量</th>
                    <th>操作</th>
                </tr>
              @if ($carts)
              @foreach ($carts as $cart)
                <tr>
                    <td style="width: 120px"><input type="radio" name="radio" checked></td>
                    <td>{{$cart->adSpacesCart->title}}</td>
                    <td class="shop-price"><i class="fa fa-jpy">&nbsp;</i><span>{{$cart->price}}</span></td>
                    <td>
                        <div class="shop-number">
                            <span class="shop-add fl"></span>
                            <span class="shop-enter fl"><input type="text" value="{{$cart->quantity}}" readonly></span>
                            <span class="shop-minus fl"></span>
                        </div>
                    </td>
                    <td class="shop-delete"><a href="/cart/cartdel/{{$cart->id}}" data-method='DELETE' data-confirm='确定删除购物车内广告位么？'>删除</a> </td>
                </tr>
              @endforeach
              @endif
            </table>
            <div class="shop-submit-text">备注：每次下单直选一个产品，带来的不便敬请见谅。</div>
        </div>
        <div class="shop-submit" style="margin-top: 150px">
            <span class="shop-submit-total">总计：<span>6000</span></span>
            <span class="shop-submit-button"><button type="button">提交订单</button></span>
        </div>
    </div>
</div>
@endsection
