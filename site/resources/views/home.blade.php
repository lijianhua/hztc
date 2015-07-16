@extends('app')

@section('content')
<div id="">
    <!-- banner-->
    <div id="banner" class="clearfix">
        <div class="layout ">
            <div class="left-nav">
                <div class="advert">
                    <img src="images/index/advert.jpg">
                </div>
                <div class="filter-nav">
                    <ul>
                        <li class="filter-nav-item">
                            <span class="filter-nav-title">投放市场</span><br/>
                            <div class="btn-group">
                                <button class="filter-nav-button btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                    <b id='city'>全部</b> <span class="filter-nav-caret caret"></span>
                                </button>
                                <ul class="filter-nav-menu dropdown-menu" role="menu">
                                    <li><a href="#">全部</a> </li>
                                    <li><a href="#">北京</a> </li>
                                    <li><a href="#">上海</a> </li>
                                    <li><a href="#">广州</a> </li>
                                    <li><a href="#">深圳</a> </li>
                                </ul>
                            </div>
                        </li>
                        <li class="filter-nav-item">
                            <span class="filter-nav-title">媒体类型</span><br/>
                            <div class="btn-group">
                                <button class="filter-nav-button btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                    <b id='type'>全部</b> <span class="filter-nav-caret caret"></span>
                                </button>
                                <ul class="filter-nav-menu dropdown-menu" role="menu">
                                    <li><a href="#">全部</a> </li>
                                    <li><a href="#">新媒体</a> </li>
                                    <li><a href="#">APP</a> </li>
                                    <li><a href="#">网络</a> </li>
                                    <li><a href="#">电视</a> </li>
                                </ul>
                            </div>
                        </li>
                        <li class="filter-nav-item">
                            <span class="filter-nav-title">社会圈</span><br/>
                            <div class="btn-group">
                                <button class="filter-nav-button btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                    <b id='society'>全部</b> <span class="filter-nav-caret caret"></span>
                                </button>
                                <ul class="filter-nav-menu dropdown-menu" role="menu">
                                    <li><a href="#">全部</a> </li>
                                    <li><a href="#">财富圈</a> </li>
                                    <li><a href="#">地产圈</a> </li>
                                    <li><a href="#">IT圈</a> </li>
                                    <li><a href="#">金融圈</a> </li>
                                </ul>
                            </div>
                        </li>
                        <li class="filter-nav-item">
                            <span class="filter-nav-title">价位</span><br/>
                            <div class="filter-nav-input">
                                <span><input type="text" id='start_price'></span> 
                                <b>至</b> <span><input type="text" id='end_price'></span>
                            </div>
                        </li>
                        <li class="filter-nav-item"><button class="filter-nav-retrieval">检索</button></li>
                    </ul>
                </div>
            </div>
            <div class="banner-img">
                <div class="banner">
                    <div class="carousel slide">
                        <div class="carousel-inner nav-banner">
                          @foreach ($slides->slideItems as $index => $slide)
                            <div class="page item {{ $index==0?'active':''}}">
                              <a href="#"><img src="{{ $slide->picture}}"></a>
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
                    <a href="#">
                        <img src="images/index/bg.png" />
                        <dl class="plate-text-show">
                            <dd class="plate-item-china">免费广告</dd>
                            <dd class="plate-item-big">MINIMAL OUTLINE ICONS</dd>
                            <dd class="plate-item-small">enjoy & share & be happy</dd>
                        </dl>
                        <div class="plate-text">
                            <span class="plate-item-china">免费广告</span></br>
                            <span class="plate-item-big">MINIMAL OUTLINE ICONS</span></br>
                            <span class="plate-item-small">enjoy & share & be happy</span></br>
                        </div>
                    </a>
                </li>
                <li class="mr15">
                    <a href="#">
                        <img src="images/index/bg.png" />
                        <dl class="plate-text-show">
                            <dd class="plate-item-china">创意广告</dd>
                            <dd class="plate-item-big">MINIMAL OUTLINE ICONS</dd>
                            <dd class="plate-item-small">enjoy & share & be happy</dd>
                        </dl>
                        <div class="plate-text">
                            <span class="plate-item-china">创意广告</span></br>
                            <span class="plate-item-big">MINIMAL OUTLINE ICONS</span></br>
                            <span class="plate-item-small">enjoy & share & be happy</span></br>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="images/index/bg.png" />
                        <dl class="plate-text-show">
                            <dd class="plate-item-china">特价广告</dd>
                            <dd class="plate-item-big">MINIMAL OUTLINE ICONS</dd>
                            <dd class="plate-item-small">enjoy & share & be happy</dd>
                        </dl>
                        <div class="plate-text">
                            <span class="plate-item-china">特价广告</span></br>
                            <span class="plate-item-big">MINIMAL OUTLINE ICONS</span></br>
                            <span class="plate-item-small">enjoy & share & be happy</span></br>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- banner-->
</div>
@endsection
