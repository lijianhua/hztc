<nav>
    <div class="nav">
        <div class="layout">
            <div class="nav-phone fl">
                <i class="nav-phone-icon"></i>
                <span class="nav-phone-number">400-0102-123</span>
            </div>
            <div class="fl nav-info">
                <ul>
                    @foreach ( $navigators as $nav)
                        <li class="nav-info-item fl {{ $nav->name == Session::get('current_navigator')?'active':''}}">
                          <a href="{{ url($nav->url) }}">{{{$nav->name}}}</a></span>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="nav-search fr">
                <div class="button-classify fl">
                    <div class="nav-search-hide fl">
                       <button type="button" class="btn dropdown-toggle nav-classify" data-toggle="dropdown" aria-expanded="false"><b>分&nbsp;&nbsp;类</b> </button>
                        <ul class="nav-search-menu dropdown-menu" role="menu">
                          <li>
                              <span><a href="#">自媒体</a> </span>
                          </li>
                          <li>
                              <span><a href="#">网络广告</a> </span>
                          </li>
                          <li>
                              <span><a href="#">APP</a> </span>
                          </li>
                          <li>
                              <span><a href="#">纸媒广告</a> </span>
                          </li>
                          <li>
                              <span><a href="#">纸媒广告</a> </span>
                          </li>
                          <li>
                              <span><a href="#">广告平台</a> </span>
                          </li>
                        </ul>
                        <input type="text" class="search-input" placeholder="搜索广告位">
                    </div>
                    <div class="nav-search-bt fl">
                        <i class="fa fa-search"></i>
                    </div>
                </div>

            </div>
        </div>
    </div>
</nav>
