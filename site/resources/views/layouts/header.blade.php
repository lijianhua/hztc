<header>
    <div class="header">
        <div class="content clearfix">
            <div class="logo">
              <a href="/"><img src="/images/logo.png"></a>
            </div>
            <div class="advertisement">
                <span class="advertisement-bt1"><a href="/list/all-ads" target="_blank"><button></button></a></span>
                <span class="advertisement-bt2"><a href="http://bussiness.momeiw.com:8888" target="_blank" ><button></button></a></span>
            </div>
            <div class="m_h_link">
                <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=2300084649&site=qq&menu=yes">
                <span class="m_h_online"><i></i>
              在线咨询</a> </span>
                <span class="m_h_top ml5">
                    <i></i>
                    @if(Auth::check())
                            <a href="/users/order">
                            <span class="header-top-user-name">
                              {{Auth::user()->name}}
                            </span>
                            </a>
                            <span class="header-top-user-out"><a href="/auth/logout">退出</a> </span>
                    @else
                      <span class="m_h_sign"><a href="/auth/login">登录</a> </span>|
                      <span class="m_h_login"><a href="/auth/register">注册</a> </span>
                    @endif
                </span>
            </div>
        </div>
    @include ('layouts.navigation')
    </div>
</header>
