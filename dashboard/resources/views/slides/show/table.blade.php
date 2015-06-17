<table id="slideItemsTable" class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>图片</th>
      <th>链接</th>
      <th>备注</th>
      <th>排序</th>
      <th>属于</th>
    </tr>
  </thead>
  <tbody>
  @foreach($slide->slideItems()->get()->sortBy('sort') as $slideItem)
    <td>{{{ $slideItem->id }}}</td>
    <td>
      <img src="{{{ $repons->url($slideItem->picture) }}}" alt="{{{ $slideItem->note }}}" height="100">
    </td>
    <td>{{{ $slideItem->url }}}</td>
    <td>{{{ $slideItem->note }}}</td>
    <td>{{{ $slideItem->sort }}}</td>
    <td>{{{ $slideItem->slide_id }}}</td>
  @endforeach
  </tbody>
</table>

