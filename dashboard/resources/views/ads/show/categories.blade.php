<p class="lead">分类信息</p>
<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        @foreach($categories as $category)
          <th>{{ $category->name }}</th>
        @endforeach
      </tr>
    </thead>
    <tbody>
      <tr>
        @foreach($categories as $category)
          <td>{{ \App\Reponsitories\AdCategoryReponsitory::categoriesStrForAd($ad, $category) }}</td>
        @endforeach
      </tr>
    </tbody>
  </table>
</div>
