@extends('app')

@section('content')
<div class="layout">
    <div class="content clearfix">
        <div class="filter fl">
            <div class="filter-selected">
                <dl>
                    <dt>已选择</dt>
                    <dd rel="0" class="filter-selected-item"><i>北京</i><span class="filter-delete"></span></dd>
                </dl>
            </div>
            <div class="filter-operate-block">
                <dl>
                    <dt>城市<span class="filter-mark"></span></dt>
                    @foreach ($cities as $city)
                      <dd rel="0" class="filter-operate"><b>{{$city}}</b><span class="filter-add"></span></dd>
                    @endforeach
                </dl>
                @foreach($adcategories as $adcategory)
                    <dl>
                        <dt>{{$adcategory->name}}<span class="filter-mark"></span></dt>
                        @foreach($adcategory->getChildren($adcategory->id)->get() as $child)
                          <dd rel="1" class="filter-operate"><b>{{$child->name}}</b><span class="filter-add"></span></dd>
                        @endforeach
                    </dl>
                @endforeach
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
                <span class="list-sort-item {{$sort == 'id'? 'active':''}}"><a href="/{{$index}}/id">默认排序</a> </span>
                <span class="list-sort-item {{$sort== 'quantity'? 'active':''}}"><a href="/{{$index}}/quantity">销量</a> </span>
                <span class="list-sort-item {{$sort == 'price'? 'active':''}}"><a href="/{{$index}}/price">价格</a> </span>
                <span class="list-sort-item {{$sort == 'date'? 'active':''}}"><a href="/{{$index}}/date">时间</a> </span>
            </div>
            <div class="list-info clearfix">
                @for($i = 0; $i < count($adspaces); $i++)
                  <a href="ads/{{$adspaces[$i]->id}}" class="link">
                    <div class="list-info-item {{$i/2 == 0 ? 'mr9':''}}">
                        <div class="list-info-item-img">
                            <img src="{{$adspaces[$i]->avatar->url}}">
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
                  </a>
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
