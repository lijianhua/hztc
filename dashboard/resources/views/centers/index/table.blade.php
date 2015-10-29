<table id="adCentersTable" class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>名称</th>
      <th>图标</th>
      <th>创建时间</th>
    </tr>
  </thead>
  <tbody>
  @foreach($adCenters as $center)
    <tr>
      <td>{{{ $center->id }}}</td>
      <td> {{ $center->name }} </td>
      <td>
        <img src="{{ $center->avatar->url() }}" alt="{{ $center->name }}">
      </td>
      <td>{{{ $center->created_at }}}</td>
    </tr>
  @endforeach
  </tbody>
</table>

