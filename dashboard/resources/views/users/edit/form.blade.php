{!! Form::model($user, ['url' => url('users/' . $user->id), 'method' => 'put', 'files' => true, 'id' => 'createAdSpaceForm', 'data-id' => $user->id]) !!}

<div class="form-group">
  <label>用户名</label>
  <div class="form-group">
    <div class="col-xs-5">
      <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder=".col-xs-5">
    </div>
  </div>
</div>
</br>
<div class="form-group">
  <label>手机号</label>
  <div class="form-group">
    <div class="col-xs-5">
      <input type="text" class="form-control" name="phone" value="{{ $user->phone}}" >
    </div>
  </div>
</div>
</br>
<div class="form-group">
  <label>邮箱</label>
  <div class="form-group">
    <div class="col-xs-5">
      <input type="email" class="form-control" name="email" value="{{ $user->email}}" >
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
@if($user->admin == 1) 
<div class="form-group">
  <label>会员数</label>
  <div class="form-group">
    <div class="col-xs-5">
      <input type="text" class="form-control" name="vipnum" value='{{ $user->userInformations->first()->vipnum}}'>
    </div>
  </div>
</div>
</br>
<div class="form-group">
  <label>有效期</label>
  <div class="form-group">
    <div class="col-xs-5">
      <input type="text" data-type="daterange" class="form-control" name="daterange" value='{{ $user->daterange }}'>
    </div>
  </div>
</div>
</br>
<div class="form-group">
  <label>城市</label>
  <div class="form-group">
    <div class="col-xs-5">
      <input type="text" class="form-control" name="city" value='{{ $user->userInformations->first()->city}}'>
    </div>
  </div>
</div>
@else
<div class="form-group">
  <label>打磨</label>
  <div class="form-group">
    <div class="col-xs-5">
      <input type="text"  class="form-control" name="burnish" value='{{ $user->userInformations->first()->burnish}}'>
    </div>
  </div>
</div>
</br>
<div class="form-group">
  <label>训练营</label>
  <div class="form-group">
    <div class="col-xs-5">
      <input type="text"  class="form-control" name="clinic" value='{{ $user->userInformations->first()->clinic}}'>
    </div>
  </div>
</div>
</br>
<div class="form-group">
  <label>路演</label>
  <div class="form-group">
    <div class="col-xs-5">
      <input type="text"  class="form-control" name="rshow" value='{{ $user->userInformations->first()->rshow}}'>
    </div>
  </div>
</div>
@endif
</br>
<div class="form-group">
  <label>用户类型</label>
  <div class="form-group">
    <label class="col-xs-5">
      <input type="radio" name="type" value="普通用户" {{$user->user_type=='普通用户'?"checked":""}}> 普通用户 
      <input type="radio" name="type" value="会员用户" {{$user->user_type=='会员用户'?"checked":""}}> 会员用户 
    </label>
  </div>
</div>
</br>
<div class="form-group">
  {!! Form::submit('保存', ['class' => 'btn btn-flat btn-default btn-primary btn-lg']) !!}
</div>
{!! Form::close() !!}
