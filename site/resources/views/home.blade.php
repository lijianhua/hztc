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
                        <form class="form-horizontal" role="form" method="POST"
action="{{ url('/Search/home/left') }}" id='login-form'>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <li class="filter-nav-item">
                                <span class="filter-nav-title">投放市场</span><br/>
                                <div class="btn-group">
                                    <button class="filter-nav-button btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                        <b id='city'>全部</b> <span class="filter-nav-caret caret"></span>
                                        <input name='city' type='hidden' value='全部'>
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
                                        <input name='type' type='hidden' value='全部'>
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
                                        <input name='type2' type='hidden' value='全部'>
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
                                    <span><input type="text" name='start_price' value='  '></span> 
                                    <b>至</b> <span><input type="text" name='end_price' value='  '></span>
                                </div>
                            </li>
                            <li class="filter-nav-item">
                                <input class="filter-nav-retrieval" type='submit' value='检索'>
                            </li>
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
                    <div class="banner-project clearfix">
                        <span class="banner-project-item active"><i class="fa fa-bullhorn"></i></span>
                        <span class="banner-project-item"><i class="fa fa-lightbulb-o"></i></span>
                        <span class="banner-project-item"><i class="fa fa-heart"></i></span>
                        <span class="banner-project-item"><i class="fa fa-clipboard"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="layout">
        <div class="plate">
            <div class="plate-block clearfix">
                <div class="plate-item plate-color1">
                    <div class="plate-item-china">免费广告位</div>
                    <div class="plate-item-big">MINIMAL OUTLINE ICONS</div>
                    <div class="plate-item-small">enjoy & share & be happy</div>
                </div>
                <div class="plate-item plate-color2 ml3">
                    <div class="plate-item-china">特价广告位</div>
                    <div class="plate-item-big">MINIMAL OUTLINE ICONS</div>
                    <div class="plate-item-small">enjoy & share & be happy</div>
                </div>
                <div class="plate-item plate-color3 ml3">
                    <div class="plate-item-china">特色广告位</div>
                    <div class="plate-item-big">MINIMAL OUTLINE ICONS</div>
                    <div class="plate-item-small">enjoy & share & be happy</div>
                </div>
                <div class="plate-item plate-color4 ml2">
                    <div class="plate-item-china">创意类广告位</div>
                    <div class="plate-item-big">MINIMAL OUTLINE ICONS</div>
                    <div class="plate-item-small"><i>enjoy & share & be happy</i></div>
                </div>
            </div>

        </div>
    </div>
    <!-- banner-->
</div>
@endsection
