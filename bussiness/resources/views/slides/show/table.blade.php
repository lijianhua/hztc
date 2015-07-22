<table id="slideItemsTable" class="table table-striped" data-slide-id="{{{ $slide->id }}}">
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
  <tr>
    <td>{{{ $slideItem->id }}}</td>
    <td>
      {!! HTML::image($slideItem->avatar->url('thumb')) !!}
    </td>
    <td>{{{ $slideItem->url }}}</td>
    <td>{{{ $slideItem->note }}}</td>
    <td>{{{ $slideItem->sort }}}</td>
    <td>{{{ $slideItem->slide_id }}}</td>
  </tr>
  @endforeach
  </tbody>
</table>
