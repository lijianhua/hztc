<table id="slidesTable" class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>属于</th>
      <th>创建日期</th>
      <th>更新日期</th>
    </tr>
  </thead>
  <tbody>
  @foreach($slides as $slide)
    <tr>
      <td>{{{ $slide->id }}}</td>
      <td>
        <a href="{{{ url("slides", [$slide->id]) }}}" title="查看详情"
           data-toggle="tooltip" data-placement="right">
          {{{ $slide->belongs_page }}}
        </a>
      </td>
      <td>{{{ $slide->created_at }}}</td>
      <td>{{{ $slide->updated_at }}}</td>
    </tr>
  @endforeach
  </tbody>
</table>
