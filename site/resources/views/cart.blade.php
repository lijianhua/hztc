@extends('app')

@section('content')
<div class="layout">
    <div class="shop">
        <div class="shop-title"><i class="shop-title-img"></i>我的购物车</div>
        <div class="shop-list">
            <table border="1">
                <tr>
                    <th>商品名称</th>
                    <th>价格</th>
                    <th>数量</th>
                    <th>操作</th>
                </tr>
                <tr>
                    <td>安德里广告牌</td>
                    <td class="shop-price"><i class="fa fa-jpy">&nbsp;</i><span>2000</span></td>
                    <td>
                        <div class="shop-number">
                            <span class="shop-add fl"></span>
                            <span class="shop-enter fl"><input type="text" value="1" readonly></span>
                            <span class="shop-minus fl"></span>
                        </div>
                    </td>
                    <td class="shop-delete"><a href="#">删除</a> </td>
                </tr>
                <tr>
                    <td>安德里广告牌</td>
                    <td class="shop-price"><i class="fa fa-jpy">&nbsp;</i><span>2000</span></td>
                    <td>
                        <div class="shop-number">
                            <span class="shop-add fl"></span>
                            <span class="shop-enter fl"><input type="text" value="1" readonly></span>
                            <span class="shop-minus fl"></span>
                        </div>
                    </td>
                    <td class="shop-delete"><a href="#">删除</a> </td>
                </tr>
                <tr>
                    <td>安德里广告牌</td>
                    <td class="shop-price"><i class="fa fa-jpy">&nbsp;</i><span>2000</span></td>
                    <td>
                        <div class="shop-number">
                            <span class="shop-add fl"></span>
                            <span class="shop-enter fl"><input type="text" value="1" readonly></span>
                            <span class="shop-minus fl"></span>
                        </div>
                    </td>
                    <td class="shop-delete"><a href="#">删除</a> </td>
                </tr>
            </table>
        </div>
        <div class="shop-submit" style="margin-top: 150px">
            <span class="shop-submit-total">总计：<span>6000</span></span>
            <span class="shop-submit-button"><button type="button">提交订单</button></span>
        </div>
    </div>
</div>
@endsection
