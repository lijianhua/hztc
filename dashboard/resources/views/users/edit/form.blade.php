{!! Form::model($user, ['url' => url('users/' . $user->id), 'method' => 'put', 'files' => true, 'id' => 'updateAdSpaceForm', 'data-id' => $user->id]) !!}

<div class="form-group">
  <label>用户名</label>
  <input type="text" name="name" value="{{ $user->name }}">
</div>
<div class="form-group">
  <label>手机号</label>
  <input type="text" name="phone" value="{{ $user->phone }}">
</div>

<div class="form-group">
  <label>邮&nbsp;&nbsp;&nbsp;&nbsp;箱</label>
  <input type="email" name="email" value="{{ $user->email }}">
</div>

<div class="form-group">
  <label>密&nbsp;&nbsp;&nbsp;&nbsp;码</label>
  <input type="text" name="password">
</div>

<div class="form-group">
  <label>用户类型</label>
  <p>
    <label class="radio-inline">
      <input type="radio" name="type" value="普通用户" {{$user->user_type=='普通用户'?"checked":""}}> 普通用户 
    </label>
    <label class="radio-inline">
      <input type="radio" name="type" value="会员用户" {{$user->user_type=='会员用户'?"checked":""}}> 会员用户 
    </label>
  </p>
</div>
<div class="form-group">
  {!! Form::submit('保存', ['class' => 'btn btn-flat btn-default btn-primary btn-lg']) !!}
</div>
{!! Form::close() !!}

