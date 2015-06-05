<table id="navigatorsTable" class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>名称</th>
      <th>链接</th>
      <th>状态</th>
      <th>排序</th>
    </tr>
  </thead>
  <tbody>
  @foreach($navigators as $nav)
    <tr>
      <td>{{{ $nav->id }}}</td>
      <td>{{{ $nav->name }}}</td>
      <td>{{{ $nav->url }}}</td>
      <td><span class="label label-{{{ $nav->classOfStateLabel }}}">
        {{{ $nav->textOfStateLabel }}}
      </span></td>
      <td>{{{ $nav->sort }}}</td>
    </tr>
  @endforeach
  </tbody>
</table>
