<nav>
    <div class="nav">
        <div class="layout">
            <div class="nav-phone fl">
                <i class="nav-phone-icon"></i>
                <span class="nav-phone-number">400-0102-123</span>
            </div>
            <div class="fl nav-info">
                <ul>
                    @foreach ($navigators as $nav)
                    <li class="nav-info-item fl"><a href="{{ $nav->url }}">
                    {{$nav->name }}</a><span class="nav-mark 
                    {{ $nav->name == Session::get('current_navigator')?'':'display'}} "></span></li>
                    @endforeach
                    </li>
                </ul>
            </div>
            <div class="nav-search fr">
                <div class="button-classify fl">
                    <button type="button" class="btn btn-default dropdown-toggle nav-classify" data-toggle="dropdown" aria-expanded="false">分&nbsp;&nbsp;类 </button>
                    <ul class="nav-search-menu dropdown-menu" role="menu">
                        <li>
                            <strong>自媒体:</strong>
                            <span><a href="#">微博</a> </span>
                            <span><a href="#">微信</a> </span>
                            <span><a href="#">其他</a> </span>
                        </li>
                        <li>
                            <strong>网络广告:</strong>
                            <span><a href="#">图文</a> </span>
                            <span><a href="#">视频</a> </span>
                            <span><a href="#">其他</a> </span>
                        </li>
                        <li>
                            <strong>APP:</strong>
                            <span><a href="#">app广告</a> </span>
                        </li>
                        <li>
                            <strong>纸媒广告:</strong>
                            <span><a href="#">报纸</a> </span>
                            <span><a href="#">杂志</a> </span>
                            <span><a href="#">其他</a> </span>
                        </li>
                        <li>
                            <strong>电视广告:</strong>
                            <span><a href="#">时段广告</a> </span>
                            <span><a href="#">赞助广告</a> </span>
                        </li>
                        <li>
                            <strong>广告平台:</strong>
                            <span><a href="#">室内广告</a> </span>
                            <span><a href="#">户外广告</a> </span>
                        </li>
                    </ul>
                    <input type="text" class="search-input" placeholder="搜索广告位">
                    <i class="fa fa-search"></i>
                </div>

            </div>
        </div>
    </div>
</nav>
