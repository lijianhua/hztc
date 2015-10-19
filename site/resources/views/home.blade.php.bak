@extends('app')

@section('content')
<div id="">
    <!-- banner-->
    <div id="banner" class="clearfix">
        <div class="layout ">
            <div class="left-nav">
                <div class="advert">
                    <img src="images/index/advert.png">
                </div>
                <div class="filter-nav">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/Search') }}" id='login-form'>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <ul>
                            <li class="filter-nav-item">
                                <span class="filter-nav-title">投放市场</span><br/>
                                <div class="btn-group">
                                    <button class="filter-nav-button btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                        <b id='city'>全部</b> <span class="filter-nav-caret caret"></span>
                                        <input name='city' type='hidden' value='全部'/>
                                    </button>
                                    <ul class="filter-nav-menu dropdown-menu" role="menu">
                                        <li><a href="#">全部</a> </li>
                                        <li><a href="#">北京市</a> </li>
                                        <li><a href="#">上海市</a> </li>
                                        <li><a href="#">广州市</a> </li>
                                        <li><a href="#">深圳市</a> </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="filter-nav-item">
                                <span class="filter-nav-title">传播媒介</span><br/>
                                <div class="btn-group">
                                    <button class="filter-nav-button btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                        <b id='type'>全部</b> <span class="filter-nav-caret caret"></span>
                                        <input name='type' type='hidden' value='全部'>
                                    </button>
                                    <ul class="filter-nav-menu dropdown-menu" role="menu">
                                        <li><a href="#">全部</a> </li>
                                        <li><a href="#">热门活动</a> </li>
                                        <li><a href="#">新媒体</a> </li>
                                        <li><a href="#">报纸</a> </li>
                                        <li><a href="#">杂志</a> </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="filter-nav-item">
                                <span class="filter-nav-title">受众标的</span><br/>
                                <div class="btn-group">
                                    <button class="filter-nav-button btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                        <b id='society'>全部</b> <span class="filter-nav-caret caret"></span>
                                        <input name='type2' type='hidden' value='全部'/>
                                    </button>
                                    <ul class="filter-nav-menu dropdown-menu" role="menu">
                                        <li><a href="#">全部</a> </li>
                                        <li><a href="#">大众</a> </li>
                                        <li><a href="#">白领</a> </li>
                                        <li><a href="#">投资客</a> </li>
                                        <li><a href="#">购房人</a> </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="filter-nav-item">
                                <span class="filter-nav-title">预算价位</span><br/>
                                <div class="filter-nav-input">
                                    <span><input type="text" name='start_price' value=''></span> 
                                    <b>至</b> <span><input type="text" name='end_price' value=''></span>
                                </div>
                            </li>
                            <li class="filter-nav-item"><button class="filter-nav-retrieval" type='submit'>检索</button></li>
                        </ul>
                  </form>
                </div>
            </div>
            <div class="banner-img">
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
    <div class="layout">
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
    <!-- banner-->
</div>
@endsection
