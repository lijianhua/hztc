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
                                    <b>北京</b> <span class="filter-nav-caret caret"></span>
                                </button>
                                <ul class="filter-nav-menu dropdown-menu" role="menu">
                                    <li><a href="#">北京</a> </li>
                                    <li><a href="#">天津</a> </li>
                                </ul>
                            </div>
                        </li>
                        <li class="filter-nav-item">
                            <span class="filter-nav-title">媒体类型</span><br/>
                            <div class="btn-group">
                                <button class="filter-nav-button btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                    <b>高端国际</b> <span class="filter-nav-caret caret"></span>
                                </button>
                                <ul class="filter-nav-menu dropdown-menu" role="menu">
                                    <li><a href="#">高端国际</a> </li>
                                    <li><a href="#">奢华皇庭</a> </li>
                                </ul>
                            </div>
                        </li>
                        <li class="filter-nav-item">
                            <span class="filter-nav-title">媒体类型</span><br/>
                            <div class="btn-group">
                                <button class="filter-nav-button btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                    <b>财富圈</b> <span class="filter-nav-caret caret"></span>
                                </button>
                                <ul class="filter-nav-menu dropdown-menu" role="menu">
                                    <li><a href="#">财富圈</a> </li>
                                    <li><a href="#">行业圈</a> </li>
                                </ul>
                            </div>
                        </li>
                        <li class="filter-nav-item">
                            <span class="filter-nav-title">媒体类型</span><br/>
                            <div class="filter-nav-input">
                                <span><input type="text"></span> <b>至</b> <span><input type="text"></span>
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
                            <div class="page active item"><a href="#"><img src="images/index/1.jpg"></a></div>
                            <div class="page item"><a href="#"><img src="images/index/2.jpg"></a> </div>
                            <div class="page item"><a href="#"><img src="images/index/1.jpg"></a> </div>
                            <div class="page item"><a href="#"><img src="images/index/2.jpg"></a> </div>
                        </div>
                    </div>
                    <div class="banner-mark">
                        <div class="banner-mark-item active"><a href="javascript:switchPage(0)"></a> </div>
                        <div class="banner-mark-item"><a href="javascript:switchPage(1)"></a> </div>
                        <div class="banner-mark-item"><a href="javascript:switchPage(2)"></a> </div>
                        <div class="banner-mark-item"><a href="javascript:switchPage(3)"></a> </div>
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
                    <div class="plate-item-china">免费专区活动</div>
                    <div class="plate-item-big">MINIMAL OUTLINE ICONS</div>
                    <div class="plate-item-small">enjoy & share & be happy</div>
                </div>
                <div class="plate-item plate-color2 ml3">
                    <div class="plate-item-china">免费专区活动</div>
                    <div class="plate-item-big">MINIMAL OUTLINE ICONS</div>
                    <div class="plate-item-small">enjoy & share & be happy</div>
                </div>
                <div class="plate-item plate-color3 ml3">
                    <div class="plate-item-china">免费专区活动</div>
                    <div class="plate-item-big">MINIMAL OUTLINE ICONS</div>
                    <div class="plate-item-small">enjoy & share & be happy</div>
                </div>
                <div class="plate-item plate-color4 ml2">
                    <div class="plate-item-china">免费专区活动</div>
                    <div class="plate-item-big">MINIMAL OUTLINE ICONS</div>
                    <div class="plate-item-small"><i>enjoy & share & be happy</i></div>
                </div>
            </div>

        </div>
    </div>
    <!-- banner-->
</div>
@endsection
