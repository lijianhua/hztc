@extends('app')

@section('content')
<div class="layout">
    <div class="content clearfix">
        <div class="filter fl">
            <div class="filter-selected">
                <dl>
                    <dt>已选择</dt>
                    <dd class="filter-selected-item"><i>北京</i><span class="filter-delete"></span></dd>
                </dl>
            </div>
            <div class="filter-operate">
                <dl>
                    <dt>区县<span class="filter-mark"></span></dt>
                    <dd class="filter-operate">海淀<span class="filter-add"></span></dd>
                    <dd class="filter-operate">昌平<span class="filter-add"></span></dd>
                    <dd class="filter-operate">丰台<span class="filter-add"></span></dd>
                </dl>
                <dl>
                    <dt>媒体风格<span class="filter-mark"></span></dt>
                    <dd class="filter-operate">全部<span class="filter-add"></span></dd>
                    <dd class="filter-operate">社会<span class="filter-add"></span></dd>
                    <dd class="filter-operate">娱乐<span class="filter-add"></span></dd>
                    <dd class="filter-operate">科技<span class="filter-add"></span></dd>
                    <dd class="filter-operate">体育<span class="filter-add"></span></dd>
                    <dd class="filter-operate">时尚<span class="filter-add"></span></dd>
                    <dd class="filter-operate">财经<span class="filter-add"></span></dd>
                    <dd class="filter-operate">学术<span class="filter-add"></span></dd>
                    <dd class="filter-operate">生活<span class="filter-add"></span></dd>
                    <dd class="filter-operate">法制<span class="filter-add"></span></dd>
                    <dd class="filter-operate">健康<span class="filter-add"></span></dd>
                </dl>
                <dl>
                    <dt>媒体类型<span class="filter-mark"></span></dt>
                    <dd class="filter-operate">全部<span class="filter-add"></span></dd>
                    <dd class="filter-operate">热门活动<span class="filter-add"></span></dd>
                    <dd>新媒体(微信、微博、其他)<span class="filter-add"></span></dd>
                    <dd class="filter-operate">app<span class="filter-add"></span></dd>
                    <dd class="filter-operate">网站(网络，软件)<span class="filter-add"></span></dd>
                    <dd class="filter-operate">电视<span class="filter-add"></span></dd>
                    <dd class="filter-operate">广播<span class="filter-add"></span></dd>
                    <dd class="filter-operate">户外<span class="filter-add"></span></dd>
                    <dd class="filter-operate">室内<span class="filter-add"></span></dd>
                    <dd class="filter-operate">其他<span class="filter-add"></span></dd>
                </dl>
                <dl>
                    <dt>财富圈<span class="filter-mark"></span></dt>
                    <dd class="filter-operate">全部</dd>
                    <dd class="filter-operate">普通</dd>
                    <dd class="filter-operate">精英</dd>
                    <dd class="filter-operate">财富</dd>
                </dl>
                <dl>
                    <dt>针对性别<span class="filter-mark"></span></dt>
                    <dd class="filter-operate">男</dd>
                    <dd class="filter-operate">女</dd>
                </dl>
                <dl>
                    <dt>社会圈<span class="filter-mark"></span></dt>
                    <dd class="filter-operate">全部</dd>
                    <dd class="filter-operate">地产圈</dd>
                    <dd class="filter-operate">IT圈</dd>
                    <dd class="filter-operate">金融圈</dd>
                    <dd class="filter-operate">汽车圈</dd>
                    <dd class="filter-operate">科技圈</dd>
                    <dd class="filter-operate">养生圈</dd>
                </dl>
                <dl>
                    <dt>年龄圈<span class="filter-mark"></span></dt>
                    <dd class="filter-operate">全部</dd>
                    <dd class="filter-operate"> 儿童</dd>
                    <dd class="filter-operate">青少年</dd>
                    <dd class="filter-operate">中年</dd>
                    <dd class="filter-operate"> 老年</dd>
                </dl>
                <dl>
                    <dt>社会圈<span class="filter-mark"></span></dt>
                    <dd class="filter-operate">全部</dd>
                    <dd class="filter-operate">地产圈</dd>
                    <dd class="filter-operate">IT圈</dd>
                    <dd class="filter-operate">金融圈</dd>
                    <dd class="filter-operate">汽车圈</dd>
                    <dd class="filter-operate">科技圈</dd>
                    <dd class="filter-operate">养生圈</dd>
                    <dd class="filter-operate">购物圈</dd>
                    <dd class="filter-operate">吃货圈</dd>
                    <dd class="filter-operate">八卦圈</dd>
                    <dd class="filter-operate">养生圈</dd>
                    <dd class="filter-operate">养生圈</dd>
                    <dd class="filter-operate">养生圈</dd>
                    <dd class="filter-operate">养生圈</dd>
                </dl>
            </div>
        </div>
        <div class="list-main fl">
            <div class="list-sort">
                <span class="list-sort-item active"><a href="#">默认排序</a> </span>
                <span class="list-sort-item"><a href="#">销量</a> </span>
                <span class="list-sort-item"><a href="#">价格</a> </span>
            </div>
            <div class="list-info clearfix">
            @foreach ($adspaces as $index=>$space)
                <div class="list-info-item fl  mr19">
                    <div class="list-info-block">
                        <div><img src="{{ $space->avatar->url() }}"></div>
                        <div class="list-info-details">
                            <div class="list-info-details-title"><span>{{$space->title}}</span></div>
                            <div class="list-info-details-text">
                                <span>{{ $space->description }}</span>
                            </div>
                            <div class="list-info-details-go">
                                <span class="list-info-details-star">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star active"></i>
                                </span>
                                <span class="list-info-details-look">
                                    <i class="fa fa-star"></i>
                                    <span class="list-info-details-look-text1">收藏人数</span>
                                    <span class="list-info-details-look-text2">{{ $space->adSpaceUsers->sum('id')}}</span>
                                </span>
                            </div>
                            <div class="list-info-details-money">
                                <span class="list-info-details-price">
                                    <span class="list-info-details-price-img"><i class="fa fa-jpy"></i></span>
                                    <span class="list-info-details-price-number">
                                      {{ $space->AdPrices->min('price') }}
                                    </span>
                                </span>
                                <span class="list-info-details-people">
                                    <span class="list-info-details-people-number">
                                      {{ $space->orderItems->sum('quantity')}}
                                    </span>人购买
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="list-info-nutton">
                        <a href="ads/{{ $space->id }}">加入购物车</a>
                    </div>
                </div>
            @endforeach
            </div>
             <?php echo $adspaces->render(); ?>
            <div class="page">
                <span><a href="#" class="page-item-previous">上一页</a> </span>
                <span><a href="#" class="page-item active">1</a> </span>
                <span><a href="#" class="page-item">2</a> </span>
                <span><a href="#" class="page-item">3</a> </span>
                <span><a href="#" class="page-item-next">下一页</a> </span>
                <span class="page-return">
                    <input type="text">
                    <button>跳转</button>
                </span>
            </div>
        </div>
    </div>
</div>
@endsection
