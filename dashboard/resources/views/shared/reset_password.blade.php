<form action="#" role="form">
  <input type="hidden" name="id" value="{{ $user->id }}">
  <div class="form-group">
    <label>原密码</label>
    <input class="form-control" type="password" name="oldPassword">
  </div>
  <div class="form-group">
    <label>新密码</label>
    <input class="form-control" type="password" name="password">
  </div>
  <div class="form-group">
    <label>确认密码</label>
    <input class="form-control" type="password" name="password_confirmation">
  </div>
  <div class="form-group">
    <button class="btn btn-lg btn-flat btn-primary" type="submit">提交</button>
  </div>
</form>
