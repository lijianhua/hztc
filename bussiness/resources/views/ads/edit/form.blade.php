{!! Form::model($ad, ['url' => url('ads/' . $ad->id), 'method' => 'put', 'files' => true, 'id' => 'updateAdSpaceForm', 'data-id' => $ad->id]) !!}
<div class="form-group">
  <label>标题</label>
  {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
  <label>封面图片</label>
  <p><small class="text-danger">秒杀广告(585像素 x 285像素), 其他(440像素 x 200像素)</small></p>
  {!! Form::file('avatar', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group images">
  <label>展示图片</label>
  <p><small class="text-danger">图片大小(520像素 x 390像素)</small></p>
  {!! Form::file('images[]', null, ['class' => 'form-control']) !!}
  @foreach($ad->images as $image)
    {!! Form::hidden('__images[]', $image->id) !!}
  @endforeach
</div>

<div class="form-group">
  <label>广告类型</label>
  <p>
    <label class="radio-inline">
      {!! Form::radio('type', 0) !!} 正常广告
    </label>
    <label class="radio-inline">
      {!! Form::radio('type', 1) !!} 特价广告
    </label>
    <label class="radio-inline">
      {!! Form::radio('type', 2) !!} 免费广告
    </label>
    <label class="radio-inline">
      {!! Form::radio('type', 3) !!} 新奇特广告
    </label>
  </p>
</div>

<div class="form-group">
  <label>影响力</label>
  {!! Form::text('influence', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
  <label>关注度</label>
  <p><small class="text-danger">可以为空，关注度只能填1-5之间的值</small></p>
  {!! Form::text('attraction_rate', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
  <label>简介</label>
  {!! Form::text('description', null, ['class' => 'form-control']) !!}
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
  {!! Form::text('street_address', null, ['class' => 'form-control', 'placeholder' => '辐射区域']) !!}
</div>

@foreach($categories as $category)
  <div class="form-group">
    <label>
      {{ $category->name }}
      <button class="clear-select" title="清空选择" data-toggle="tooltip"
      data-placement="right" type="button"> <i class="fa fa-close"></i></button>
    </label>
    <select class="form-control" name="category_ids[]" multiple size="8" data-id="{{ $category->id }}">
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
    @if ($ad->adPrices()->count() > 0)
      @foreach($ad->adPrices as $price)
        @include ('ads.create.form_partial_of_price', [ 'price' => $price ->toArrayWithDateRange(), 'index' => $price->id])
      @endforeach
    @else
      @include ('ads.create.form_partial_of_price')
    @endif
  </div>
</div>

<div class="form-group">
  <label>详情</label>
  {!! Form::textarea('detail', null, ['id' => 'ckeditor', 'cols' => 30, 'rows' => 20]) !!}
</div>

<div class="form-group">
  {!! Form::submit('保存', ['class' => 'btn btn-flat btn-default btn-primary btn-lg']) !!}
</div>
{!! Form::close() !!}

