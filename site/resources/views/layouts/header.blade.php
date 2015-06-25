<header>
  <div class="layout">
      <div class="header-top clearfix">
          <div class="logo fl"></div>
          <ul class="header-top-info fr">
              <li class="header-top-have fl"><a href="#"><span>我要发广告</span></a> </li>
              <li class="header-top-have fl"><a href="#"><span>我有广告位</span></a> </li>
              <li class="header-top-user fr">
                  <a href="#"><img src="images/user.jpg"></a>
                    @if(Auth::check())
                        <span><a href="#">{{Auth::check()? Auth::user()->id:'登录'}}</a></span>|<span><a href="#">注册</a> </span>
                    @else
                        <span><a href="/auth/login">登录</a></span>|<span><a
href="/auth/register">注册</a> </span>
                    @endif
              </li>
              <li class="fr header-top-callme">
                  <a href="#"> <img src="images/callme.png"></a>
              </li>
          </ul>
      </div>
  </div>
    @include ('layouts.navigation')
</header>
