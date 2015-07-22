<div class="row">
  <div class="col-md-6 col-md-offset-1">
    @include ('shared.status')
    @include ('shared.errors')

    {!! Form::open(['url' => url("accounts/{$user->id}/edit"), 'method' => 'PUT', 'files' => true]) !!}
      <input type="hidden" name="id" value="{{ $user->id }}">

      <div class="form-group">
        <label>邮箱</label>
        <input class="form-control" type="email" name="email" value="{{ $user->email }}" disabled>
      </div>

      <div class="form-group">
        <label>姓名</label>
        <input class="form-control" type="text" name="name" required value="{{ $user->name }}">
      </div>

      <div class="form-group">
        <label>头像</label>
        {!! Form::file('avatar', ['class' => 'form-control']) !!}
      </div>

      <div class="form-group">
        {!! Form::submit('保存', ['class' => 'btn btn-flat btn-lg btn-primary']) !!}
      </div>
    {!! Form::close() !!}
  </div>
</div>
