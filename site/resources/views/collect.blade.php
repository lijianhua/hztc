@extends('app')

@section('content')
<article>
<div class="layout">
    <div class="personal clearfix">
      @include ('layouts.user_nav')
        <div class="collection">
            <div class="order-title">
                <span>我的收藏</span>
            </div>
            <div class="order-list">
                <div class="order-list-title">
                    <span class="collection-list-content">商品名称</span>
                    <span class="collection-list-people">类型</span>
                    <span class="collection-list-operate">操作</span>
                </div>
                @foreach ($collects as $collect)
                <div class="order-list-info">
                    <div class="order-list-code">
                        <span class="order-list-code-number">热度：<span class="collection-fire"></span><span class="collection-fire"></span><span class="collection-fire"></span></span>
                        <span class="order-list-code-state fr"><span>{{
$collect->adSpaces->customerReviews->count('id')}}</span>评价</span>
                    </div>
                    <div class="order-list-table">
                        <span class="collection-list-content table-border order-list-name">
                            <span class="order-list-img">
                                <img src="{{ $collect->adSpaces->avatar->url()}}">
                            </span>
                            <span class="order-list-name-text">
                                <span>{{ $collect->adSpaces->title}}</span><br/>
                                <span
class="order-color">价格：<span>{{$collect->adSpaces->adPrices->min('price')}}</span></span>
                            </span>
                        </span>
                        <span class="collection-list-people table-border">
                            <div>
                                <span>{{ $collect->adSpaces->type}}</span>
                            </div>
                        </span>
                        <span class="collection-list-operate order-list-operate-info">
                            <div class="order-list-operate-text">
                                <a href="/ads/{{ $collect->ad_space_id }}" target='__blank'>查看广告位</a>
                                <a href="/users/collectDel/{{ $collect->ad_space_id}}"
                                      class="delete" data-method='DELETE' data-confirm="确定要取消收藏么?">删除</a>
                            </div>
                        </span>
                    </div>
                </div>
                @endforeach
                <div class="order-list-info">
                    <div class="order-list-code">
                        <span class="order-list-code-number">评分：<i class="fa fa-heart"></i><i class="fa fa-heart"></i><i class="fa fa-heart"></i></span>
                        <span class="order-list-code-state fr"><span>23</span>评价</span>
                    </div>
                    <div class="order-list-table">
                        <span class="collection-list-content table-border order-list-name">
                            <span class="order-list-img">
                                <img src="/images/personal/img.png">
                            </span>
                            <span class="order-list-name-text">
                                <span>安德烈的展板</span><br/>
                                <span class="order-color">价格：<span>6088</span></span>
                            </span>
                        </span>
                        <span class="collection-list-people table-border">
                            <div>
                                <span>特价广告</span>
                            </div>
                        </span>
                        <span class="collection-list-operate order-list-operate-info">
                            <div class="order-list-operate-text">
                                <a href="#">查看广告位</a>
                                <a href="#" class="delete">删除</a>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</article>
@endsection
