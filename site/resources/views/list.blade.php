@extends('app')

@section('content')
<div class="layout">
    <div class="content clearfix">
        <div class="filter fl">
            <div class="filter-selected">
                <dl>
                    <dt>已选择</dt>
                      @if(isset($query_array))
                        @foreach($query_array as $index => $query)
                              @if(is_array($query))
                                  @foreach($query as $sindex => $value)
                                        <dd rel="0" class="filter-selected-item" data-name="{{$index}}" data-value="{{$value}}" data-index="{{$sindex}}"><i>{{$value}}</i><span class="filter-delete"></span></dd>
                                  @endforeach
                              @else
                                        <dd rel="0" class="filter-selected-item" data-name="{{$index}}" data-value="{{$query}}" >{{$query}}</i><span class="filter-delete"></span></dd>
                              @endif
                        @endforeach
                      @endif
                </dl>
            </div>
            <div class="filter-operate-block">
                <dl>
                    <dt>城市<span class="filter-mark"></span></dt>
                    @foreach ($cities as $index => $city)
                      <dd rel="0" class="filter-operate" data-name='cities' data-index="{{$index}}" data-value={{$city}}><b>{{$city}}</b><span class="filter-add"></span></dd>
                    @endforeach
                </dl>
                @foreach($adcategories as $index => $adcategory)
                    <dl>
                        <dt>{{$adcategory->name}}<span class="filter-mark"></span></dt>
                        @foreach($adcategory->getChildren($adcategory->id)->get() as $child)
                          <dd rel="1" class="filter-operate" data-name="categories_{{$index}}" data-index="{{$child->id}}" data-value="{{$child->name}}"><b>{{$child->name}}<i class="filter-operate-{{$index==6? 'hot':''}}"></i></b><span class="filter-add"></span></dd>
                        @endforeach
                    </dl>
                @endforeach
            </div>
            <div class="filter-recommend">
                <div class="filter-recommend-title"><span>人气新奇特广告</span></div>
                @foreach($ideas as $idea)
                  <div class="filter-recommend-item">
                      <a href="/ads/{{$idea->id}}">
                          <img src="{{$idea->avatar->url()}}">
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
                <span class="list-sort-item {{$sort == 'id'? 'active':''}}"><a href="/list/{{$current_category}}/id?{{$str}}">默认排序</a> </span>
                <span class="list-sort-item {{$sort== 'quantity'?  'active':''}}"><a href="/list/{{$current_category}}/quantity?{{$str}}">销量</a> </span>
                <span class="list-sort-item {{$sort == 'price'?  'active':''}}"><a href="/list/{{$current_category}}/price?{{$str}}">价格</a> </span>
                <span class="list-sort-item {{$sort == 'created_at'? 'active':''}}"><a href="/list/{{$current_category}}/created_at?{{$str}}">时间</a> </span>
            </div>
            <div class="list-info clearfix">
                @for($i = 0; $i < count($adspaces); $i++)
                <a href="/ads/{{$adspaces[$i]->id}}" class="link">
                    <div class="list-info-item {{$i%2 == 0 ? 'mr9':''}}">
                        <div class="list-info-item-img">
                            <img src="{{$adspaces[$i]->avatar->url()}}">
                        </div>
                        <div class="list-info-item-block">
                            <div class="list-info-item-name" title="{{$adspaces[$i]->title}}">{{$adspaces[$i]->title}}</div>
                            <div class="list-info-item-combination">
                                <!-- <span class="list&#45;info&#45;item&#45;collection">收藏<i class="fa fa&#45;star"></i></span> -->
                                <span class="list-info-item-buy"><code>{{$adspaces[$i]->orderItems->sum('quantity')}}</code>人购买</span>
                                <span class="list-info-item-money"><i class="fa fa-jpy"></i>
                                {{App\Models\AdPrice::getLowPrice($adspaces[$i]->AdPrices)->price}}/{{App\Models\AdPrice::getLowPrice($adspaces[$i]->AdPrices)->unit !='' ?App\Models\AdPrice::getLowPrice($adspaces[$i]->AdPrices)->unit:'期' }}
                            </div>
                            <div class="list-info-item-description">
                               <div style='color:#333333;text-align:left' title="{{$adspaces[$i]->description}}">{{$adspaces[$i]->description}}</div><a href="/ads/{{$adspaces[$i]->id}}" class="link" style='color:#333333'>查看详情》</a>
                            </div>
                        </div>
                    </div>
                </a>
                @endfor
            </div>
            <div class="page">
              @if(count($adspaces) != 0)
                @if($current_page != 1)
                    <span><a href="/{{$index}}/{{$sort}}?page={{$current_page-1}}" class="page-item-previous" data-name="page" data-value="{{$current_page-1}}">上一页</a> </span>
                @endif
                <span><a href="/{{$index}}/{{$sort}}?page={{$current_page}}" class="page-item active" data-name="page" data-value="{{$current_page}}">{{$current_page}}</a> </span>
                    @if(($total-$current_page)==0)
                    @elseif($total-$current_page==1)
                      <span><a href="/{{$index}}/{{$sort}}?page={{$current_page+1}}" class="page-item" data-name="page" data-value="{{$current_page+1}}">{{$current_page+1}}</a> </span>
                    @else
                        @for($i=1;$i<3;$i++)
                            <span><a href="/{{$index}}/{{$sort}}?page={{$current_page+$i}}" class="page-item" data-name="page" data-value="{{$current_page+$i}}">{{$current_page+$i}}</a> </span>
                        @endfor
                    @endif
                @if($current_page != $total)
                    <span><a href="/{{$index}}/{{$sort}}?page={{$current_page+1}}" class="page-item-previous" data-name="page" data-value="{{$current_page+1}}">下一页</a> </span>
                @endif
              @endif
                <!-- <span class="page&#45;return"> -->
                <!--     <input type="text"> -->
                <!--     <button>跳转</button> -->
                <!-- </span> -->
            </div>
        </div>
    </div>
</div>
@endsection
