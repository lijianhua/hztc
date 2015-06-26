<div class="row">
  <div class="col-md-6 col-md-offset-1">
    @include ('shared.status')
    @include ('shared.errors')

    <form action="#" role="form">
    {!! Form::open(['url' => '#', 'method' => 'PUT', 'files' => true]) !!}
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
        <label>LOGO</label>
        {!! Form::file('picture', ['class' => 'form-control']) !!}
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
        <label>QQ</label>
        <input type="text" class="form-control" name="qq" value="{{ $enterprise->qq }}">
      </div>

      <div class="form-group">
        {!! Form::submit('保存', ['class' => 'btn btn-flat btn-lg btn-primary']) !!}
      </div>
    {!! Form::close() !!}
  </div>
</div>

