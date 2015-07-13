@extends('app')

@section('content')
<div class="layout">
    <div class="details">
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
                <div class="details-info-title"><span>{{{ $adspace->title }}}</span></div>
                <div class="details-info-price clearfix">
                    <div class="details-info-price-left fl">
                        <div class="details-info-price-number">
                            <span>价格：</span>
                            <span class="details-info-price-info details-info-price-color">
                              <i class="fa fa-jpy"></i>&nbsp;{{$adspace->adPrices->min('price')}}/天</span>
                              @foreach($adspace->adPrices as $price) 
                                {{ $price->from}}
                              @endforeach
                        </div>
                        <div class="details-info-price-service">
                            服  务：<span style="color: #878787">由本平台统一发货并提供一切售后服务</span>
                        </div>
                    </div>
                    <div class="details-info-evaluation fr">
                        <span class="details-info-evaluation-top">累计评价</span><br/>
                        <span
class="details-info-evaluation-down">{{$adspace->customerReviews->count('id') }}</span>
                    </div>
                </div>
                <div class="details-info-amount">
                    <span>数量：</span>
                    <span class="details-amount clearfix">
                        <span class="details-amount-plus"></span>
                        <span class="details-amount-input"><input type="text" readonly value="1"></span>
                        <span class="details-amount-minus"></span>
                    </span>
                    <span>&nbsp;&nbsp;&nbsp;件</span>
                    <span class="details-amount-total">
                        <span>合计：<span class="details-amount-total-text"><i class="fa fa-jpy"></i> 500，000，00元</span></span>
                    </span>
                </div>
                <div class="details-concerned-collection">
                  <a href="#" onclick='return addCollect({{ $adspace->id }})'>
                    <span class="details-info-collection">收藏<i class="fa fa-star-o"></i></span>
                  </a>
                </div>
                <div class="details-reminder"><span>温馨提示： 1.北京地区支持礼品包装  2.支持7天无理由退货</span></div>
                <div class="details-business">
                    <span class="details-buy-now"><button>立即购买</button></span>
                    <span class="details-cart"><button>加入购物车</button></span>
                </div>
            </div>
        </div>
        <div class="details-specifics clearfix">
            <div class="details-recommend fl">
                <div class="details-recommend-title"><span>相关推荐</span></div>
                <ul>
                    <li class="details-recommend-item">
                        <div class="details-recommend-item-img"><img src="images/list/list.png"></div>
                        <div class="details-recommend-item-name"><span>【长安街路口高架桥广告展板】</span></div>
                        <div class="details-recommend-item-price"><span><i class="fa fa-jpy"></i>800,00/ 天</span></div>
                        <div class="details-recommend-item-bt"><span>查看</span></div>
                    </li>
                    <li class="details-recommend-item">
                        <div class="details-recommend-item-img"><img src="images/list/list.png"></div>
                        <div class="details-recommend-item-name"><span>【长安街路口高架桥广告展板】</span></div>
                        <div class="details-recommend-item-price"><span><i class="fa fa-jpy"></i>800,00/ 天</span></div>
                        <div class="details-recommend-item-bt"><span>查看</span></div>
                    </li>
                    <li class="details-recommend-item">
                        <div class="details-recommend-item-img"><img src="images/list/list.png"></div>
                        <div class="details-recommend-item-name"><span>【长安街路口高架桥广告展板】</span></div>
                        <div class="details-recommend-item-price"><span><i class="fa fa-jpy"></i>800,00/ 天</span></div>
                        <div class="details-recommend-item-bt"><span>查看</span></div>
                    </li>
                </ul>
                <div class="details-recommend-more">
                    <a href="#">发现更多<i class="fa fa-angle-right details-recommend-more-mark"></i></a>
                </div>
            </div>
            <div class="introduction fl">
                <div class="introduction-list-title"><span class="active">广告详情</span><span>客户评论</span></div>
                <div class="introduction-advert">
                    <div class="introduction-list">
                      {{ $adspace->detail }}
                    </div>
                    <div class="introduction-seller">
                        <div class="introduction-seller-info">
                            <img src="images/details/img.png">
                        </div>
                    </div>
                </div>
                <div class="introduction-consumer display">
                    <div class="introduction-consumer-score">
                        <table>
                            <tr>
                                <td>
                                    <div class="introduction-consumer-score-left">
                                        <div class="introduction-consumer-score-number"><span>94</span><sup>分</sup></div>
                                        <div class="introduction-consumer-score-star">
                                            <i class="fa fa-heart active"></i>
                                            <i class="fa fa-heart active"></i>
                                            <i class="fa fa-heart active"></i>
                                            <i class="fa fa-heart active"></i>
                                            <i class="fa fa-heart"></i>
                                        </div>
                                        <div class="introduction-consumer-score-people">共<span>100</span>人评价</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="introduction-consumer-score-right">
                                        <div class="introduction-consumer-score-right-title">标签</div>
                                        <div class="introduction-consumer-score-info">
                                            <span class="introduction-consumer-score-item">这个套系很便宜(25)</span>
                                            <span class="introduction-consumer-score-item">不错的一次回忆</span>
                                            <span class="introduction-consumer-score-item">世间少有</span>
                                            <span class="introduction-consumer-score-item">在这里可以找到真爱</span>
                                            <span class="introduction-consumer-score-item">这个套系很便宜(25)</span>
                                            <span class="introduction-consumer-score-item">不错的一次回忆</span>
                                            <span class="introduction-consumer-score-item">世间少有</span>
                                            <span class="introduction-consumer-score-item">在这里可以找到真爱</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="introduction-consumer-assess">
                        <table>
                            <tr>
                                <td class="introduction-consumer-assess-name"><span>Karry</span></td>
                                <td class="introduction-consumer-assess-info">
                                    <div class="introduction-consumer-assess-heart">
                                        <span>评分：
                                            <i class="fa fa-heart active"></i>
                                            <i class="fa fa-heart active"></i>
                                            <i class="fa fa-heart active"></i>
                                            <i class="fa fa-heart active"></i>
                                            <i class="fa fa-heart"></i>
                                        </span>
                                        <span class="introduction-consumer-time fr">
                                            2015-7-30 19:45:59
                                        </span>
                                    </div>
                                    <div class="introduction-consumer-content">
                                        <span>好好非常好，如果有这样的好东西，一定要学会分享。比欸说我是厂家的人，我就是普通的消费者的说</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="introduction-consumer-assess-name"><span>Karry</span></td>
                                <td class="introduction-consumer-assess-info">
                                    <div class="introduction-consumer-assess-heart">
                                        <span>评分：
                                            <i class="fa fa-heart active"></i>
                                            <i class="fa fa-heart active"></i>
                                            <i class="fa fa-heart active"></i>
                                            <i class="fa fa-heart active"></i>
                                            <i class="fa fa-heart"></i>
                                        </span>
                                        <span class="introduction-consumer-time fr">
                                            2015-7-30 19:45:59
                                        </span>
                                    </div>
                                    <div class="introduction-consumer-content">
                                        <span>好好非常好，如果有这样的好东西，一定要学会分享。比欸说我是厂家的人，我就是普通的消费者的说</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="introduction-consumer-assess-name"><span>Karry</span></td>
                                <td class="introduction-consumer-assess-info">
                                    <div class="introduction-consumer-assess-heart">
                                        <span>评分：
                                            <i class="fa fa-heart active"></i>
                                            <i class="fa fa-heart active"></i>
                                            <i class="fa fa-heart active"></i>
                                            <i class="fa fa-heart active"></i>
                                            <i class="fa fa-heart"></i>
                                        </span>
                                        <span class="introduction-consumer-time fr">
                                            2015-7-30 19:45:59
                                        </span>
                                    </div>
                                    <div class="introduction-consumer-content">
                                        <span>好好非常好，如果有这样的好东西，一定要学会分享。比欸说我是厂家的人，我就是普通的消费者的说</span>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
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
        alert(data)
}
    });  
  }
</script>
@endsection
