<p class="lead">客户信息</p>
<div class="table-responsive">
  <table class="table">
    <tbody>
      <tr>
        <th style="width: 50%">客户名称</th>
        <td>{{ $user->name }}</td>
      </tr>
      <tr>
        <th style="width: 50%">客户邮箱</th>
        <td>{{ $user->email }}</td>
      </tr>
      <tr>
        <th style="width: 50%">联系方式</th>
        <td>
        @if ($user->enterprise)
          {{ $user->enterprise->reviewMaterials()->whereName('telphone')->select('note')->first() }}
        @endif
        </td>
      </tr>
      <tr>
        <th style="width: 50%">企业名称</th>
        <td>
        @if ($user->enterprise)
          {{ $user->enterprise->name }}
        @endif
        </td>
      </tr>
    </tbody>
  </table>
</div>


