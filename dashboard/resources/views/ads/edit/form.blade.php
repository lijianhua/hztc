{!! Form::model($ad, ['url' => url('ads/' . $ad->id), 'method' => 'put', 'files' => true, 'id' => 'updateAdSpaceForm', 'data-id' => $ad->id]) !!}
<div class="form-group">
  <label>标题</label>
  {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
  <label>封面图片</label>
  {!! Form::file('avatar', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group images">
  <label>展示图片</label>
  {!! Form::file('images[]', null, ['class' => 'form-control']) !!}
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
      {!! Form::radio('type', 3) !!} 创意广告
    </label>
  </p>
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
  {!! Form::text('street_address', null, ['class' => 'form-control']) !!}
</div>

@foreach($categories as $category)
  <div class="form-group">
    <label>{{ $category->name }}</label>
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
{!! Form::close() !!}

