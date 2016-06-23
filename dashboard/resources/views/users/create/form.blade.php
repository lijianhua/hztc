{!! Form::open(['url' => url('users/create'), 'method' => 'post', 'files' => true, 'id' => 'createAdSpaceForm']) !!}
<div class="form-group">
  <label>用户名</label>
  <div class="form-group">
    <div class="col-xs-5">
      <input type="text" class="form-control" name="name">
    </div>
  </div>
</div>
</br>
<div class="form-group">
  <label>手机号</label>
  <div class="form-group">
    <div class="col-xs-5">
      <input type="text" class="form-control" name="phone" >
    </div>
  </div>
</div>
</br>
<div class="form-group">
  <label>邮箱</label>
  <div class="form-group">
    <div class="col-xs-5">
      <input type="email" class="form-control" name="email" >
    </div>
  </div>
</div>
</br>
<div class="form-group">
  <label>密码</label>
  <div class="form-group">
    <div class="col-xs-5">
      <input type="text" class="form-control" name="password">
    </div>
  </div>
</div>
</br>
<div class="form-group">
  <label>会员数</label>
  <div class="form-group">
    <div class="col-xs-5">
      <input type="text" class="form-control" name="vipnum" >
    </div>
  </div>
</div>
</br>
<div class="form-group">
  <label>有效期</label>
  <div class="form-group">
    <div class="col-xs-5">
      <input type="text" data-type="daterange" class="form-control" name="daterange" >
    </div>
  </div>
</div>
</br>
<div class="form-group">
  <label>城市</label>
  <div class="form-group">
    <div class="col-xs-5">
      <input type="text"  class="form-control" name="city" >
    </div>
  </div>
</div>
</br>
<div class="form-group">
  <label>打磨</label>
  <div class="form-group">
    <div class="col-xs-5">
      <input type="text"  class="form-control" name="burnish" >
    </div>
  </div>
</div>
</br>
<div class="form-group">
  <label>训练营</label>
  <div class="form-group">
    <div class="col-xs-5">
      <input type="text"  class="form-control" name="clinic" >
    </div>
  </div>
</div>
</br>
<div class="form-group">
  <label>路演</label>
  <div class="form-group">
    <div class="col-xs-5">
      <input type="text"  class="form-control" name="rshow" >
    </div>
  </div>
</div>
</br>
<div class="form-group">
  <label>用户类型</label>
  <div class="form-group">
    <label class="col-xs-5">
      <input type="radio" name="type" value="普通用户" checked="checked"}> 普通用户 
      <input type="radio" name="type" value="会员用户"> 会员用户 
    </label>
  </div>
</div>
</br>

<div class="form-group">
  {!! Form::submit('保存', ['class' => 'btn btn-flat btn-default btn-primary btn-lg']) !!}
</div>

{!! Form::close() !!}
