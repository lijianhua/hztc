@extends('app')

@section('content')
<article>

    <div class="content">
        <div class="c_details_side">
            <div class="c_details_side_hover">
                <div class="c_details_side_buy_item"></div>
                <div class="c_details_side_add_item"></div>
                <div class="c_details_side_contrast_item"></div>
            </div>
            <div class="c_details_side_line">
                <div class="c_details_side_block">
                    <div class="c_details_side_buy"><a href="#"></a></div>
                    <div class="c_details_side_add"><a href="#"></a></div>
                    <div class="c_details_side_contrast"><a href="/getContrast"></a></div>
                </div>
            </div>

        </div>
        <div class="details">
            <div class="d_global_title">首页  > {{$adspace->title}} {{$iscontrast}}</div>
            <div class="d_product">
                <div class="clearfix">
                    <div class="d_product_img fl">
                        <div class="d_product_img_block">
                            <div class="d_product_img_line">
                                <div class="d_product_img_line_info">
                                @foreach ($adspace->images as $index=>$image)
                                    <img src="{{ $image->avatar->url() }}">
                                @endforeach
                                </div>
                            </div>
                            <div class="d_product_small">
                                <div class="d_product_small_top"></div>
                                <div class="d_product_small_down"></div>
                                <div class="d_product_small_operate">
                                    <div class="d_product_small-img">
                                    @foreach ($adspace->images as $index=>$image)
                                        <span class="d_product_small_item {{$index==0?'active':''}}"><img src="{{ $image->avatar->url('thumb') }}"></span>
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="d_product_info fl">
                        <div class="d_product_info_top clearfix">
                            <span class="d_product_info_title fl">{{ $adspace->title }}</span>
                        <span class="d_product_info_attention fr">
                            <strong>关注度:</strong>
                            <span>
                                <i class="active fa fa-star"></i>
                                <i class="active fa fa-star"></i>
                                <i class="active fa fa-star"></i>
                                <i class="active fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </span>
                        </span>
                        </div>
                        <ul class="d_product_attribute">
                            <li>
                                <strong>刊例价：</strong>
                                <span class="">{{$adspace->adPrices->min('original_price')}}
                                /{{$adspace->AdPrices->max('unit')?$adspace->AdPrices->max('unit'):'期'}}，
                                  执行价{{$adspace->adPrices->min('price')}}{{$adspace->AdPrices->max('unit')?$adspace->AdPrices->max('unit'):'期'}}</span>
                            </li>
                        </ul>
                        <ul class="d_product_attribute">
                            <li>
                                <strong>数量：</strong>
                            <span class="details-amount clearfix">
                                <span class="details-amount-plus"></span>
                                <span class="details-amount-input"><input type="text" readonly value="1"></span>
                                <span class="details-amount-minus"></span>
                            </span>
                                <strong>月</strong>

                            </li>
                            <li>
                                <strong>版位：</strong>
                            <span class="d_product_position">
                                <span class="d_product_position_item">1</span>
                                <span class="d_product_position_item">2</span>
                                <span class="d_product_position_item">3</span>
                            </span>
                            </li>
                            <li>
                                <strong>日期：</strong>
                            <span class="d_product_time">
                                <span class="d_product_time_item">2015.6——2015.7</span>
                                <span class="d_product_time_item">2015.6——2015.7</span>
                                <span class="d_product_time_item">2015.6——2015.7</span>
                            </span>
                            </li>
                            <li>
                                <strong>收藏：</strong>
                                <span class="d_product_star
{{$collect?'':'no'}}" onclick='addCollect({{$adspace->id}})'><i class="fa fa-star"></i></span>
                            </li>
                            <input type='hidden' id='ad_space_id_to' value='{{ $adspace->id}}'>
                            <input type='hidden' value='{{Auth::check()?Auth::user()->id:0}}' id='user_id'>
                            <li class="d_product_bt">
                                <a href="#" class="d_product_bt_buy"></a>
                                <a href="#" class="d_product_bt_look"></a>
                                @if ($iscontrast)
                                  <a href="javascript:void(0)" class="d_product_bt_contrast add" onclick="delContrast({{ $adspace->id }})" ></a>
                                @else
                                  <a href="javascript:void(0)" class="d_product_bt_contrast" onclick="addContrast({{ $adspace->id }})" ></a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="d_teach clearfix">
                    <span class="d_teach_left fl">
                        初次来访：
                        <span><a href="#">如何使用？</a></span>
                        <span><a href="#">如何支付？</a></span>
                    </span>
                    <span class="d_teach_right fr">
                        <span><img src="/images/details/d1.png"></span>
                        <span><img src="/images/details/d2.png"></span>
                        <span><img src="/images/details/d3.png"></span>
                        <span><img src="/images/details/d4.png"></span>
                    </span>
                </div>
            </div>
            <div class="d_information clearfix">
                <div class="d_information_left">
                    <div class="d_information_buy">
                        <div class="d_information_buy_title">
                            <i></i>购买此广告位的人还购买了
                        </div>
                        <div class="d_information_buy_block">
                            <div class="d_information_buy_info">
                            @foreach ($rebuy as $buy)
                                <span class="d_information_buy_item"><a href="/ads/{{ $buy[0]}}" target="__blank">{{ $buy[1]}}</a> </span>
                            @endforeach
                            </div>
                            <div class="d_information_buy_bottom"></div>
                        </div>
                    </div>
                    <div class="d_information_recommend">
                        <div class="d_information_buy_title">
                            <i></i>本公司推荐
                        </div>
                        <div class="d_information_recommend_block">
                        @if ($app_medias['app_medias'])
                            @foreach($app_medias['app_medias'] as $idea)
                            <div class="d_information_recommend_info">
                                <span><img src="{{$idea->avatar->url()}}" alt="{{$idea->title}}" title="{{$idea->title}}"></span>
                                <div class="d_information_recommend_link">
                                  <a href="/ads/{{$idea->id}}">
                                    <i class="fa fa-angle-right"></i>
                                      {{ $idea->title }}
                                  </a>
                                </div>
                            </div>
                            @endforeach
                        @endif
                        </div>
                    </div>
                    <div class="d_information_recommend">
                        <div class="d_information_recommend_title">
                            <i></i>更多同类新奇特推荐
                        </div>
                        <div class="d_information_recommend_info clearfix">
                        @if ($ideas)
                          @foreach($ideas as $idea)
                            <span class="d_information_recommend_link_small">
                              <img src="{{$idea->avatar->url()}}">
                              <a href="/ads/{{$idea->id}}">
                              <i class="fa fa-angle-right"></i>{{ $idea->title }}</a> </span>
                          @endforeach
                        @endif
                        </div>
                    </div>
                </div>
                <div class="d_information_right">
                    <div class="d_details">
                        <div class="d_details_content">
                            <div class="d_details_title">
                                <span class="d_details_title_item active">主要详情</span>
                                <span class="d_details_title_item">广告评论</span>
                                <span class="
bdsharebuttonbox"><span>分享到：</span>
                                  <span style="margin-right:20px;"><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>微信</span>
                                  <span><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到微信"></a>微博</span>
                              </span>
                            </div>
                            <div class="d_comment display">
                              @foreach ($comments as $comment)
                                <table class="d_comment_item">
                                    <tr>
                                        <td class="d_comment_left">
                                            <div class="d_comment_left_name">{{ $comment->user->name}}</div>
                                        </td>
                                        <td class="d_comment_main">
                                            <div>
                                                 {{ $comment->body }}
                                            </div>
                                            <div class="d_comment_time">{{ $comment->created_at }}</div>
                                        </td>
                                    </tr>
                                </table>
                              @endforeach
                            </div>
                            <div class="d_details_content_info">
                                {!! Purifier::clean($adspace->detail) !!}
                            </div>
                        </div>
                    </div>
                    <div class="d_app">
                        <div class="d_app_title"><i></i>自媒体阵营</div>
                        <div class="d_app_bg">
                            <div class="d_app_content">
                                <div class="d_app_content_block clearfix">
                                    <div class="d_app_content_block_title"><span>本公司新媒体阵营</span></div>
                                    <span class="d_app_content_item">
                                        <img src="/images/details/wx.png">
                                        <p><a href="/list/all-ads?puid={{ $adspace->user_id}}&categories_0[3]=微信"><i class="fa fa-angle-right"></i>官方微信</a> </p>
                                    </span>
                                    <span class="d_app_content_item">
                                        <img src="/images/details/wb.png">
                                        <p><a href="/list/all-ads?puid={{ $adspace->user_id}}&categories_0[4]=微博"><i class="fa fa-angle-right"></i>官方微博</a> </p>
                                    </span>
                                    <span class="d_app_content_item">
                                        <img src="/images/details/wy.png">
                                        <p><a href="/list/all-ads?puid={{ $adspace->user_id}}&categories_0[5]=新媒体"><i class="fa fa-angle-right"></i>其他新媒体</a> </p>
                                    </span>
                                </div>
                            </div>
                            <div class="d_app_content">
                                <div class="d_app_content_block clearfix">
                                    <div class="d_app_content_block_title"><span>本公司大V</span></div>
                                <span class="d_app_content_item">
                                    <img src="/images/details/1.png">
                                    <p><a href="#"><i class="fa fa-angle-right"></i>ihouse公众号</a> </p>
                                </span>
                                <span class="d_app_content_item">
                                    <img src="/images/details/1.png">
                                    <p><a href="#"><i class="fa fa-angle-right"></i>ihouse公众号</a> </p>
                                </span>
                                <span class="d_app_content_item">
                                    <img src="/images/details/1.png">
                                    <p><a href="#"><i class="fa fa-angle-right"></i>ihouse公众号</a> </p>
                                </span>
                                <span class="d_app_content_item">
                                    <img src="/images/details/1.png">
                                    <p><a href="#"><i class="fa fa-angle-right"></i>ihouse公众号</a> </p>
                                </span>
                                <span class="d_app_content_item">
                                    <img src="/images/details/1.png">
                                    <p><a href="#"><i class="fa fa-angle-right"></i>ihouse公众号</a> </p>
                                </span>
                                <span class="d_app_content_item">
                                    <img src="/images/details/1.png">
                                    <p><a href="#"><i class="fa fa-angle-right"></i>ihouse公众号</a> </p>
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d_details d_details_bottom">
                        <div class="d_details_content">
                            <div class="d_details_title">
                                <span class="d_details_title_item active">公司简介</span>
                            </div>
                            <table class="d_details_content_info">
                                <tr class="d_details_content_info_item">
                                    <td class="d_details_left_td" rowspan="4">
                                        <div class="d_details_left_img">
                                            <img src="{{$company->avatar->url()}}">
                                        </div>
                                    </td>
                                    <td><strong>名称</strong>{{ $company->name }}</td>
                                </tr>
                                <tr class="d_details_content_info_item">
                                    <td><strong>联系电话</strong>{{ $company->telphone}}</td>
                                </tr>
                                <tr class="d_details_content_info_item">
                                    <td><strong>微信</strong> {{ $company->weixin}}</td>
                                </tr>
                                <tr class="d_details_content_info_item">
                                    <td><strong>QQ</strong> {{ $company->qq }}</td>
                                </tr>
                                <tr class="">
                                    <td colspan="2">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="d_app">
                        <div class="d_app_title"><i></i>分类广告中心</div>
                        <div class="d_app_bg">
                            <div class="d_app_content_block_bg clearfix">
                                <span class="d_app_content_item_bg">
                                    <img src="/images/details/3.png">
                                </span>
                                <span class="d_app_content_item_bg">
                                    <img src="/images/details/4.png">
                                </span>
                                <span class="d_app_content_item_bg">
                                    <img src="/images/details/5.png">
                                </span>
                                <span class="d_app_content_item_bg">
                                    <img src="/images/details/6.png">
                                </span>
                                <span class="d_app_content_item_bg">
                                    <img src="/images/details/7.png">
                                </span>
                                <span class="d_app_content_item_bg">
                                    <img src="/images/details/8.png">
                                </span>
                                <span class="d_app_content_item_bg">
                                    <img src="/images/details/9.png">
                                </span>
                                <span class="d_app_content_item_bg">
                                    <img src="/images/details/10.png">
                                </span>
                                <span class="d_app_content_item_bg">
                                    <img src="/images/details/11.png">
                                </span>
                                <span class="d_app_content_item_bg">
                                    <img src="/images/details/12.png">
                                </span>
                                <span class="d_app_content_item_bg">
                                    <img src="/images/details/13.png">
                                </span>
                                <span class="d_app_content_item_bg">
                                    <img src="/images/details/14.png">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>
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
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"1","bdMiniList":["weixin","renren","tqq","bdxc","kaixin001","tqf","tieba","douban","bdhome","sqq","thx","ibaidu","meilishuo","mogujie","diandian","huaban","duitang","hx","fx","youdao","sdo","qingbiji","people","xinhua","mail","isohu","yaolan","wealink","ty","iguba","fbook","twi","linkedin","h163","evernotecn","copy","print"],"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new
Date()/36e5)];</script>
@endsection
