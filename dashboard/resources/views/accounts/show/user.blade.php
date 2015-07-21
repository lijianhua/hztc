<dl class="dl-horizontal">
  <dt>姓名</dt>
  <dd>{{ $user->name }}</dd>
  <dt>邮箱</dt>
  <dd>{{ $user->email }}</dd>
  <dt>头像</dt>
  <dd>
    <img src="{{ $userRepons->userImageUrl($user) }}" class="img-circle" alt="{{ $user->name }}"/>
  </dd>

  @foreach($user->userInformations as $info)
    <dt>{{ $info->key }}</dt>
    <dd>{{ $info->value }}</dd>
  @endforeach
</dl>
