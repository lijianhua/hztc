<div class="row">
  <div class="col-md-10 col-md-offset-1" id="editEnterpriseAccount">
    {!! Form::open(['url' => url("accounts/{$user->id}/enterprise"), 'method' => 'PUT', 'files' => true]) !!}
      <input type="hidden" name="id" value="{{ $enterprise->id }}">

      <div class="form-group">
        <label>名称</label>
        <input class="form-control" type="text" name="name" value="{{ $enterprise->name }}" disabled>
      </div>

      <div class="form-group">
        <label>行业</label>
        <input class="form-control" type="text" value="{{ $enterprise->trade }}" disabled>
      </div>

      <div class="form-group">
        <label>企业邮箱</label>
        <input class="form-control" type="email" name="email" value="{{ $enterprise->email }}">
      </div>

      <div class="form-group">
        <label>LOGO</label>
        {!! Form::file('avatar', ['class' => 'form-control']) !!}
      </div>

      <div class="form-group">
        <label>移动电话</label>
        <input class="form-control" type="text" name="telphone" value="{{ $enterprise->telphone }}">
      </div>

      <div class="form-group">
        <label>固定电话</label>
        <input class="form-control" type="text" name="phone" value="{{ $enterprise->phone }}">
      </div>

      <div class="form-group">
        <label>微信</label>
        <input type="text" class="form-control" name="weixin" value="{{ $enterprise->weixin }}">
      </div>

      <div class="form-group">
        <label>微博</label>
        <input type="text" class="form-control" name="weibo" value="{{ $enterprise->weibo }}">
      </div>

      <div class="form-group">
        <label>QQ</label>
        <input type="text" class="form-control" name="qq" value="{{ $enterprise->qq }}">
      </div>

      <div class="form-group">
        <label>商铺详情</label>
        <textarea id="ckeditor" name="detail" cols="30" rows="20" class="form-control">
        {{ $enterprise->detail }}
        </textarea>
      </div>

      <div class="form-group">
        {!! Form::submit('保存', ['class' => 'btn btn-flat btn-lg btn-primary']) !!}
      </div>
    {!! Form::close() !!}
  </div>
</div>

