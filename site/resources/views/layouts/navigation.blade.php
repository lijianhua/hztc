<div class="m_nav">
  <div class="content m_nav_position clearfix">
      <div class="m_nav_call"><i class="fa fa-phone"></i>400-831-9003</div>
      <div class="btn-group m_nav_search">
          <div class="m_nav_search_bt"><i class="fa fa-search"></i></div>
          <div class="m_nav_search_info_bg">
          <div class="m_nav_search_info">
              <form class="form-horizontal" role="form" method="POST" action="{{ url('/Search') }}" id='login-form'>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <span class="btn-group m_nav_search_operate">
                  <button class="btn btn-sm dropdown-toggle" type="button"
data-toggle="dropdown" aria-haspopup="true"
aria-expanded="false"><b>全部</b><input class='htext' type='hidden' name='type' value='全部'/> <span class="caret"></span>
                  </button>
              <ul class="dropdown-menu">
                  <li>
                      <a href="#">自媒体</a>
                  </li>
                  <li>
                      <a href="#">网络广告</a>
                  </li>
                  <li>
                      <a href="#">APP</a>
                  </li>
                  <li>
                      <a href="#">纸媒广告</a>
                  </li>
                  <li>
                      <a href="#">广告平台</a>
                  </li>
              </ul>
              </span>
              <span class="m_nav_search_operate"><input type="text"
placeholder="搜索广告" name='q'></span>
              <span class="m_nav_search_operate"><button class="m_nav_search_operate_bt"><i class="fa fa-search"></i></button></span>
              </form>
          </div>
        </div>
      </div>
      <ul class="m_nav_item">
          @foreach ( $navigators as $nav)
              <li class="nav-info-item fl {{ $nav->name == Session::get('current_navigator')?'active':''}}">
                <a href="{{ url($nav->url) }}">{{{$nav->name}}}</a></span>
              </li>
          @endforeach
              <li class="nav-info-item fl {{ '新媒体广告资源' == Session::get('current_navigator')?'active':''}}">
                <a href="/list/all-ads?categories_0[3]=微信&categories_0[4]=微博&categories_0[6]=其他新媒体、APP">新媒体广告资源</a></span>
              </li>
      </ul>
  </div>
</div>
