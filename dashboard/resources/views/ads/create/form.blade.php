{!! Form::open(['url' => url('ad-spaces/create'), 'method' => 'post', 'files' => true, 'id' => 'createAdSpaceForm']) !!}

<div class="form-group">
  <label>标题</label>
  <input type="text" name="title" class="form-control" value="{{ old('title') }}">
</div>

<div class="form-group">
  <label>封面图片</label>
  <p><small class="text-danger">秒杀广告(585像素 x 285像素), 其他(440像素 x 200像素), 上传图片建议小于1M </small></p>
  <input type="file" name="avatar" value="{{ old('avatar') }}">
</div>

<div class="form-group images">
  <label>展示图片</label>
  <p><small class="text-danger">图片大小(520像素 x 390像素), 上传图片建议小于1M </small></p>
  <input type="file" name="images[]" multiple="true">
</div>

<div class="form-group">
  <label>广告类型</label>
  <p>
    <label class="radio-inline">
      <input type="radio" name="type" value="0" checked> 正常广告
    </label>
    <label class="radio-inline">
      <input type="radio" name="type" value="1"> 特价广告
    </label>
    <label class="radio-inline">
      <input type="radio" name="type" value="2"> 免费广告
    </label>
    <label class="radio-inline">
      <input type="radio" name="type" value="3"> 新奇特广告
    </label>
  </p>
</div>

<div class="form-group">
  <label>影响人数</label>
  <input type="text" name="influence" class="form-control" value="{{ old('influence') }}">
</div>

<div class="form-group">
  <label>关注度</label>
  <p><small class="text-danger">0-50为1星, 50-100为2星, 100-200为3星, 200-300为4星, 300以上为5星</small></p>
  <input type="text" name="attraction_rate" class="form-control" value="{{ old('attraction_rate') }}">
</div>

<div class="form-group">
  <label>简介</label>
  <input type="text" name="description" class="form-control" value="{{ old('description') }}">
</div>

<div class="form-group">
  <label>位置</label>
  <input type="hidden" name="address_id">
  <div class="row">
    <div class="col-md-4">
      <select id="addr_province" class="form-control">
      </select>
    </div>
    <div class="col-md-4">
      <select id="addr_city" class="form-control">
        <option>请选择城市</option>
      </select>
    </div>
    <div class="col-md-4">
      <select id="addr_area" class="form-control">
        <option>请选择地区</option>
      </select>
    </div>
  </div>
</div>

<div class="form-group">
  <input type="text" name="street_address" class="form-control" value="{{ old('street_address') }}" placeholder="辐射区域">
</div>

@foreach($categories as $category)
  <div class="form-group">
    <label>
      {{ $category->name }}
      <button class="clear-select" title="清空选择" data-toggle="tooltip"
      data-placement="right" type="button"> <i class="fa fa-close"></i></button>
    </label>
    <select class="form-control" name="category_ids[]" multiple size="8">
      <option value>全部</option>
      @foreach($category->children()->get() as $option)
        <option value="{{ $option->id }}">{{ $option->name }}</option>
      @endforeach
    </select>
    <p><small class="text-muted">按住ctrl多选</small></p>
  </div>
@endforeach

<div class="form-group">
  <label>价格</label>
  <div class="form-group">
    <button class="btn btn-app btn-flat" type="button" id="newPrice">
      <i class="fa fa-plus"></i>
      添加
    </button>
  </div>
  <div class="row prices clearfix">
    @if (old('ad_prices'))
      @foreach(old('ad_prices') as $index => $price)
        @include ('ads.create.form_partial_of_price',
                  [ 'price' => $price , 'index' => $index])
      @endforeach
    @else
      @include ('ads.create.form_partial_of_price')
    @endif
  </div>
</div>

<div class="form-group">
  <label>详情</label>
  <textarea id="ckeditor" name="detail" cols="30" rows="20">
    {{ old('detail') }}
  </textarea>
</div>

<div class="form-group">
  {!! Form::submit('保存', ['class' => 'btn btn-flat btn-default btn-primary btn-lg']) !!}
</div>

{!! Form::close() !!}
