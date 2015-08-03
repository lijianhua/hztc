@extends('app')

@section('content')
<div class="layout">
    <div class="details">
        <div class="details-title">
            <span class="details-title-text"><span>首页</span>
            <i class="fa fa-angle-right"></i><span class="details-title-text-break" title="{{ $adspace->title}}">{{ $adspace->title}}</span></span>
            <span class="details-title-bt">
              <span class="details-title-link"><a href="/list/all-ads?{{$type}}">同类更多资源</a> </span>
              <span class="details-title-link"><a href="/list/all-ads?puid={{ $adspace->user_id}}">本公司其他资源</a> </span>
            </span>
        </div>
        <div class="details-top clearfix">
            <div class="details-picture fl">
                <div class="details-picture-img">
                    @foreach ($adspace->images as $index=>$image)
                      <span class="{{ $index==0?'':'display'}}"><img src="{{ $image->avatar->url() }}"></span>
                    @endforeach
                </div>
                <div class="details-picture-tab clearfix">
                    <div class="details-picture-tab-left fl"></div>
                    <div class="details-picture-tab-block fl">
                        <div class="details-picture-tab-line">
                            @foreach ($adspace->images as $index=>$image)
                              <span class="details-picture-tab-item {{$index==0?'active':''}}">
                                <img src="{{ $image->avatar->url('thumb') }}">
                              </span>
                            @endforeach
                        </div>
                    </div>
                    <div class="details-picture-tab-right fr"></div>
                </div>
            </div>
            <div class="details-info">
                <div class="details-info-title" title='{{{ $adspace->title }}}'><span>{{{ $adspace->title }}}</span></div>
                <div class="details-info-price clearfix">
                    <div class="details-info-price-left fl">
                        <div class="details-info-price-number">
                            <span>价格：</span>
                            <span class="details-info-price-info details-info-price-color">
                              <i class="fa
fa-jpy"></i>&nbsp;<span>{{$adspace->adPrices->min('price')}}</span></span>
                        </div>
                        <div class="details-info-price-service">
                   <!--         服  务：<span style="color: #878787">由本平台统一发货并提供一切售后服务</span>-->
                        </div>
                    </div>
                    <div class="details-info-evaluation fr">
                        <span class="details-info-evaluation-top">累计评价</span><br/>
                        <span class="details-info-evaluation-down">{{$adspace->customerReviews->count('id') }}</span>
                    </div>
                </div>
                  <input type='hidden' value='{{Auth::check()?Auth::user()->id:0}}' id='user_id'>
                <div class="details-info-amount">
                    <span>数量：</span>
                    <span class="details-amount clearfix">
                        <span class="details-amount-plus"></span>
                        <span class="details-amount-input"><input
id="details-amount-count" type="text" readonly value="1"></span>
                        <span class="details-amount-minus"></span>
                    </span>
                    <span>&nbsp;&nbsp;&nbsp;件</span>
                    <span class="details-amount-total">
                        <span>合计：<span class="details-amount-total-text"><i
class="fa fa-jpy"></i><span></span> </span></span>
                    </span>
                </div>
                <div class="details-stage clearfix">
                    <table class="fl">
                        <tr>
                            <td class="details-stage-title">阶段：</td>
                            <td class="details-stage-block">
                              @foreach($adspace->adPrices as $index=>$price) 
                                <span class="details-stage-item {{$index==0?'active':''}}" 
                                data-price='{{ $price->price}}' data-priceid='{{ $price->id}}' 
                                data-sale-count='{{ $price->sale_count}}'>
                                   {{$price->from}}--{{$price->to}}
                                </span>
                              @endforeach
                            </td>
                        </tr>
                    </table>
                    <div class="details-concerned-collection fr">
                    <a href='#' onclick='return addCollect({{ $adspace->id }})'>
                      <span class="details-info-collection">收藏<i class="fa {{$collect?'fa-star':'fa-star-o'}}"></i></span>
                    </a>
                    </div>
                </div>
                <div class="details-business">
                    <input type='hidden' id='ad_space_id_to' value='{{ $adspace->id}}'>
                    <span class="details-buy-now"><button id="details_id_now">立即购买</button></span>
                    <span class="details-cart"><button id="details_id_cart">加入购物车</button></span>
                </div>
            </div>
        </div>
        <div class="details-specifics clearfix">
          @include ('creative')
            <div class="introduction fl">
                <div class="introduction-list-title"><span class="active">广告详情</span><span>客户评论</span></div>
                <div class="introduction-advert">
                    <div class="introduction-list">
                    {!! strip_tags($adspace->detail,
                    '<p><a><img><b><small><ul><ol><li><i><u><code><div><br><span><em><strong><style>')!!}
                    </div>
                </div>
                <div class="introduction-consumer display">
                @if ($adspace->customerReviews->count('id') > 0)
                  @include('adcomment')
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  function addCollect(id)
  {
    $.ajax({
      type:'POST',
        url:'/collect',
        async : true,
        data:{'id':id},
        headers  :{'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
        success:function(data){
          if(data.state == 3)
          {
            alert('请登录');
          }
}
    });  
  }
</script>
@endsection
