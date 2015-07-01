<header>
  <div class="layout">
      <div class="header-top clearfix">
          <div class="logo fl"></div>
          <ul class="header-top-info fr">
              <li class="header-top-have fl"><a href="#"><span>我要发广告</span></a> </li>
              <li class="header-top-have fl"><a href="#"><span>我有广告位</span></a> </li>
              <li class="header-top-user fr">
                    @if(Auth::check())
                            <a href="/users/order">
                              <img src="/images/user_out.png">
                            </a>
                            <span class="header-top-user-name">
                              欢迎 <a href="/users/order">{{Auth::user()->name}}</a> 登录
                            </span>
                            <span class="header-top-user-out"><a href="/auth/logout">退出</a> </span>
                    @else
                        <a href="/auth/login"><img src="/images/user.jpg"></a>
                        <span><a href="/auth/login">登录</a></span>|
                        <span><a href="/auth/register">注册</a> </span>
                    @endif
              </li>
              <li class="fr header-top-callme">
                  <a href="#"> <img src="/images/callme.png"></a>
              </li>
          </ul>
      </div>
  </div>
    @include ('layouts.navigation')
</header>
