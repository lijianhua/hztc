<div class="personal-left">
<dl>
    <dt class="personal-left-title"></dt>
    <dd class="personal-left-item">
      <span>
        <a href="/users/order" class="{{'我的订单'==Session::get('user_navigator')?'active':''}}">我的订单</a> 
      </span>
    </dd>
    <dd class="personal-left-item">
      <span>
        <a href="/users/info" class="{{'广告主信息'==Session::get('user_navigator')?'active':''}}">广告主信息</a> 
      </span>
    </dd>
    <dd class="personal-left-item">
      <span>
        <a href="/users/collect" class="{{'我的收藏'==Session::get('user_navigator')?'active':''}}">我的收藏</a> 
      </span>
    </dd>
    <dd class="personal-left-item">
      <span>
        <a href="/users/score" class="{{'我的积分'==Session::get('user_navigator')?'active':''}}">我的积分</a> 
      </span>
    </dd>
    <dd class="personal-left-item">
      <span>
        <a href="/users/refund" class="{{'退货清单'==Session::get('user_navigator')?'active':''}}">退货清单</a> 
      </span>
    </dd>
    <dd class="personal-left-item">
      <span>
        <a href="/accounts/{{ Auth::user()->id}}" class="{{'修改密码'==Session::get('user_navigator')?'active':''}}">修改密码</a> 
      </span>
    </dd>
</dl>
</div>
