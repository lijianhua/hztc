@extends('app')

@section('content')
<article>
    <div class="content_home">
        <div class="content clearfix">
            <div class="left_nav">
                <div class="left_nav_title"><span>全媒体&nbsp;&nbsp;大数据</span></div>
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/Search') }}" id='login-form'>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <ul class="left_nav_change">
                    <li class="left_nav_every">
                        <div class="left_nav_change_topic"><i></i>投放市场</div>
                        <div class="left_nav_change_select">
                            <div class="btn-group">
                            <button class="left_nav_change_item btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                        <b id='city'>全部</b>
                            </button>
                                        <input name='city' type='hidden' value='全部'/>
                                <ul class="filter-nav-menu left_nav_change_option dropdown-menu" role="menu">
                                  <li><a href="#">全部</a> </li>
                                  <li><a href="#">北京市</a> </li>
                                  <li><a href="#">上海市</a> </li>
                                  <li><a href="#">广州市</a> </li>
                                  <li><a href="#">深圳市</a> </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="left_nav_every">
                        <div class="left_nav_change_topic"><i></i>传播媒介</div>
                        <div class="left_nav_change_select">
                            <div class="btn-group">
                                <button class="left_nav_change_item btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                        <b id='type'>全部</b>
</button>
                                        <input name='type' type='hidden' value='全部'>
                                <ul class="filter-nav-menu left_nav_change_option dropdown-menu" role="menu">
                                    <li><a href="#">全部</a> </li>
                                    <li><a href="#">热门活动</a> </li>
                                    <li><a href="#">微信</a> </li>
                                    <li><a href="#">微博</a> </li>
                                    <li><a href="#">名人大V</a> </li>
                                    <li><a href="#">其他新媒体、APP</a> </li>
                                    <li><a href="#">报纸</a> </li>
                                    <li><a href="#">杂志</a> </li>
                                    <li><a href="#">网络</a> </li>
                                    <li><a href="#">电视</a> </li>
                                    <li><a href="#">广播</a> </li>
                                    <li><a href="#">户外</a> </li>
                                    <li><a href="#">室内</a> </li>
                                    <li><a href="#">其他</a> </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="left_nav_every">
                        <div class="left_nav_change_topic"><i></i>目标受众</div>
                        <div class="left_nav_change_select">
                            <div class="btn-group">
                                <button class="left_nav_change_item btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                        <b id='society'>全部</b>
</button>
                                        <input name='type2' type='hidden' value='全部'/>
                                <ul class="filter-nav-menu left_nav_change_option dropdown-menu" role="menu">
                                        <li><a href="#">全部</a> </li>
                                        <li><a href="#">大众</a> </li>
                                        <li><a href="#">白领</a> </li>
                                        <li><a href="#">投资客</a> </li>
                                        <li><a href="#">购房人</a> </li>
                                        <li><a href="#">屌丝</a> </li>
                                        <li><a href="#">创业者</a> </li>
                                        <li><a href="#">御宅族</a> </li>
                                        <li><a href="#">美食吃货</a> </li>
                                        <li><a href="#">数码控</a> </li>
                                        <li><a href="#">体育迷</a> </li>
                                        <li><a href="#">游戏咖</a> </li>
                                        <li><a href="#">时尚达人</a> </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="left_nav_every" style="border: none">
                        <div class="left_nav_change_topic"><i></i>预算价位</div>
                        <div class="left_nav_change_input">
                            <input type="text" name ='start_price' value=''><span>至</span><input type="text" name='end_price' value=''>
                        </div>
                    </li>
                    <li class="left_nav_every_bt"><button></button></li>
                </ul>
            </form>
            </div>
            <div class="banner_right">
                <div class="banner">
                    <div class="carousel slide">
                        <div class="carousel-inner nav-banner">
                          @foreach ($slides->slideItems as $index => $slide)
                            <div class="page item {{ $index==0?'active':''}}">
                              <a href="{{$slide->url?$slide->url:'#'}}"><img src="{{ $slide->avatar->url()}}"></a>
                            </div>
                          @endforeach
                        </div>
                    </div>
                    <div class="banner-mark">
                      @foreach ($slides->slideItems as $index => $slide)
                        <div class="banner-mark-item {{ $index==0?'active':''}}">
                          <a href="javascript:switchPage({{ $index }})"></a>
                        </div>
                      @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
</article>
<div class="content">
    <div class="plate_bg">
        <div class="plate">
            <ul id="da-thumbs" class="plate-block da-thumbs">
                <li class="mr15">
                    <a href="/free-ads">
                        <img src="images/index/bg.png" />
                        <dl class="plate-text-show">
                            <dd class="plate-item-china">免费广告</dd>
                            <dd class="plate-item-big">天价广告资源  0元秒杀</dd>
                        </dl>
                        <div class="plate-text">
                            <span class="plate-item-china">免费广告</span></br>
                            <dd class="plate-item-big">天价广告资源  0元秒杀</dd>
                        </div>
                    </a>
                </li>
                <li class="mr15">
                    <a href="/list/creative-ads">
                        <img src="images/index/bg.png" />
                        <dl class="plate-text-show">
                            <dd class="plate-item-china">新奇特广告</dd>
                            <dd class="plate-item-big">创意资源  点子变金子</dd>
                        </dl>
                        <div class="plate-text">
                            <span class="plate-item-china">新奇特广告</span></br>
                            <dd class="plate-item-big">创意资源  点子变金子</dd>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/list/special-ads">
                        <img src="images/index/bg.png" />
                        <dl class="plate-text-show">
                            <dd class="plate-item-china">特价广告</dd>
                            <dd class="plate-item-big">折到想不到  低到离谱</dd>
                        </dl>
                        <div class="plate-text">
                            <span class="plate-item-china">特价广告</span></br>
                            <dd class="plate-item-big">折到想不到  低到离谱</dd>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="right-float">
    <div class="float-top" style="color: #fff"></div>
</div>

<script type="text/javascript" src="js/jquery.hoverdir.js"></script>
<script type="text/javascript">
    $(function(){
        $('#da-thumbs > li').each( function() { $(this).hoverdir();});
    });
</script>

@endsection
