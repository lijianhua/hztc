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
            <div class="filter-operate-block">
                <dl>
                    <dt>区县<span class="filter-mark"></span></dt>
                    <dd class="filter-operate"><b>海淀</b><span class="filter-add"></span></dd>
                    <dd class="filter-operate"><b>昌平</b><span class="filter-add"></span></dd>
                    <dd class="filter-operate"><b>丰台</b><span class="filter-add"></span></dd>
                </dl>
                <dl>
                    <dt>媒体风格<span class="filter-mark"></span></dt>
                    <dd class="filter-operate"><b>全部</b><span class="filter-add"></span></dd>
                    <dd class="filter-operate"><b>社会</b><span class="filter-add"></span></dd>
                    <dd class="filter-operate"><b>娱乐</b><span class="filter-add"></span></dd>
                    <dd class="filter-operate"><b>科技</b><span class="filter-add"></span></dd>
                    <dd class="filter-operate"><b>体育</b><span class="filter-add"></span></dd>
                    <dd class="filter-operate"><b>时尚</b><span class="filter-add"></span></dd>
                    <dd class="filter-operate"><b>财经</b><span class="filter-add"></span></dd>
                    <dd class="filter-operate"><b>学术</b><span class="filter-add"></span></dd>
                    <dd class="filter-operate"><b>生活</b><span class="filter-add"></span></dd>
                    <dd class="filter-operate"><b>法制</b><span class="filter-add"></span></dd>
                    <dd class="filter-operate"><b>健康</b><span class="filter-add"></span></dd>
                </dl>
                <dl>
                    <dt>媒体类型<span class="filter-mark"></span></dt>
                    <dd class="filter-operate"><b>全部</b><span class="filter-add"></span></dd>
                    <dd class="filter-operate"><b>热门活动</b><span class="filter-add"></span></dd>
                    <dd class="filter-operate"><b>新媒体(微信、微博、其他)</b><span class="filter-add"></span></dd>
                    <dd class="filter-operate"><b>app</b><span class="filter-add"></span></dd>
                    <dd class="filter-operate"><b>网站(网络，软件)</b><span class="filter-add"></span></dd>
                    <dd class="filter-operate"><b>电视</b><span class="filter-add"></span></dd>
                    <dd class="filter-operate"><b>广播</b><span class="filter-add"></span></dd>
                    <dd class="filter-operate"><b>户外</b><span class="filter-add"></span></dd>
                    <dd class="filter-operate"><b>室内</b><span class="filter-add"></span></dd>
                    <dd class="filter-operate"><b>其他</b><span class="filter-add"></span></dd>
                </dl>
                <dl>
                    <dt>财富圈<span class="filter-mark"></span></dt>
                    <dd class="filter-operate"><b>全部</b></dd>
                    <dd class="filter-operate"><b>普通</b></dd>
                    <dd class="filter-operate"><b>精英</b></dd>
                    <dd class="filter-operate"><b>财富</b></dd>
                </dl>
                <dl>
                    <dt>针对性别<span class="filter-mark"></span></dt>
                    <dd class="filter-operate"><b>男</b></dd>
                    <dd class="filter-operate"><b>女</b></dd>
                </dl>
                <dl>
                    <dt>社会圈<span class="filter-mark"></span></dt>
                    <dd class="filter-operate"><b>全部</b></dd>
                    <dd class="filter-operate"><b>地产圈</b></dd>
                    <dd class="filter-operate"><b>IT圈</b></dd>
                    <dd class="filter-operate"><b>金融圈</b></dd>
                    <dd class="filter-operate"><b>汽车圈</b></dd>
                    <dd class="filter-operate"><b>科技圈</b></dd>
                    <dd class="filter-operate"><b>养生圈</b></dd>
                </dl>
                <dl>
                    <dt>年龄圈<span class="filter-mark"></span></dt>
                    <dd class="filter-operate"><b>全部</b></dd>
                    <dd class="filter-operate"><b>儿童</b></dd>
                    <dd class="filter-operate"><b>青少年</b></dd>
                    <dd class="filter-operate"><b>中年</b></dd>
                    <dd class="filter-operate"> <b>老年</b></dd>
                </dl>
                <dl>
                    <dt>社会圈<span class="filter-mark"></span></dt>
                    <dd class="filter-operate"><b>全部</b></dd>
                    <dd class="filter-operate"><b>地产圈</b></dd>
                    <dd class="filter-operate"><b>IT圈</b></dd>
                    <dd class="filter-operate"><b>金融圈</b></dd>
                    <dd class="filter-operate"><b>汽车圈</b></dd>
                    <dd class="filter-operate"><b>科技圈</b></dd>
                    <dd class="filter-operate"><b>养生圈</b></dd>
                    <dd class="filter-operate"><b>购物圈</b></dd>
                    <dd class="filter-operate"><b>吃货圈</b></dd>
                    <dd class="filter-operate"><b>八卦圈</b></dd>
                    <dd class="filter-operate"><b>养生圈</b></dd>
                    <dd class="filter-operate"><b>养生圈</b></dd>
                    <dd class="filter-operate"><b>养生圈</b></dd>
                    <dd class="filter-operate"><b>养生圈</b></dd>
                </dl>
            </div>
            <div class="filter-recommend">
                <div class="filter-recommend-title"><span>人气创意广告</span></div>
                @foreach($ideas as $idea)
                  <div class="filter-recommend-item">
                      <a href="ads/{{$idea->id}}">
                          <img src="{{$idea->avatar->url}}">
                          <div class="filter-recommend-item-bg">
                            {{$idea->description}}
                          </div>
                      </a>
                  </div>
                @endforeach
            </div>
        </div>
        <div class="list-main fl">
            <div class="list-sort">
                <span class="list-sort-item active"><a href="/ads">默认排序</a> </span>
                <span class="list-sort-item"><a href="#">销量</a> </span>
                <span class="list-sort-item"><a href="#">价格</a> </span>
                <span class="list-sort-item"><a href="#">时间</a> </span>
            </div>
            <div class="list-info clearfix">
                @for($i = 0; $i < count($adspaces); $i++)
                  <div class="list-info-item {{$i/2 == 0 ? '':'mr9'}}">
                      <div class="list-info-item-img">
                          <a href="#"><img src="{{$adspaces[$i]->avatar->url}}"></a>
                      </div>
                      <div class="list-info-item-block">
                          <div class="list-info-item-name">{{$adspaces[$i]->title}}</div>
                          <div class="list-info-item-combination">
                              <span class="list-info-item-collection">收藏<i class="fa fa-star"></i></span>
                              <span class="list-info-item-buy"><code>{{$adspaces[$i]->orderItems->sum('quantity')}}</code>人购买</span>
                              <span class="list-info-item-money"><i class="fa fa-jpy"></i>{{$adspaces[$i]->AdPrices->min('price')}}/天</span>
                          </div>
                          <div class="list-info-item-description">
                              {{$adspaces[$i]->description}} <a href="ads/{{$adspaces[$i]->id}}" class="link">查看详情》</a>
                          </div>
                      </div>
                  </div>
                @endfor
            </div>
            <div class="page">
             <?php echo $adspaces->render(); ?>
                <!-- <span><a href="#" class="page&#45;item&#45;previous">上一页</a> </span> -->
                <!-- <span><a href="#" class="page&#45;item active">1</a> </span> -->
                <!-- <span><a href="#" class="page&#45;item">2</a> </span> -->
                <!-- <span><a href="#" class="page&#45;item">3</a> </span> -->
                <!-- <span><a href="#" class="page&#45;item&#45;next">下一页</a> </span> -->
                <!-- <span class="page&#45;return"> -->
                <!--     <input type="text"> -->
                <!--     <button>跳转</button> -->
                <!-- </span> -->
            </div>
        </div>
    </div>
</div>
@endsection
