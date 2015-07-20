@extends('app')

@section('content')
<div class="layout">
    <div class="personal clearfix">
      @include ('layouts.user_nav')
        <div class="single">
            <div class="single-title"><span>评价</span></div>
            <div class="single-table">
                <table class="single-table-th">
                    <tr>
                        <th>商品名称</th>
                        <th>下单时间</th>
                        <th>状态</th>
                    </tr>
                </table>
                <table class="single-table-td">
                    <tr>
                        <td>{{$order->orderItems->first()->adSpace->title}}</td>
                        <td>{{$order->orderItems->first()->adSpace->created_at}}</td>
                        <td>{{$order->customer->count()?'已评价':'未评价'}}</td>
                    </tr>
                </table>
            </div>

            <div class="single-info">
                <div class="single-title"><span>我的评价</span></div>
              <form method='post' action='/users/comment'>
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <ul>
                    <li class="single-star">
                        <strong>评分</strong>
                        <span class="single-star-click">
                            <i class="fa fa-heart"></i>
                            <i class="fa fa-heart"></i>
                            <i class="fa fa-heart"></i>
                            <i class="fa fa-heart"></i>
                            <i class="fa fa-heart"></i>
                        </span>
                    </li>
                    <li>
                        <strong>评论</strong>
                        <div class="single-info-text">
                            <input type='hidden' name='single' value='3'>
                            <input type='hidden' name='order_id' value='{{ $order->id }}'>
                            <input type='hidden' name='ad_space_id' value='{{ $order->orderItems->first()->ad_space_id }}'>
                            <input type='hidden' name='score' value='{{ $order->orderItems->first()->score }}'>
                            <textarea name='comment'></textarea>
                        </div>
                    </li>
                    <li class="single-personal-enter">
                        <button type="submit">提交</button>
                    </li>
                </ul>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection
