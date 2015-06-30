{!! Form::open(['url' => url('ad-space/create'), 'method' => 'post', 'files' => true, 'id' => 'createAdSpaceForm']) !!}

<div class="form-group">
  <label>标题</label>
  <input type="text" name="title" class="form-control" value="{{ old('title') }}">
</div>

<div class="form-group">
  <label>封面图片</label>
  <input type="file" name="avatar" value="{{ old('avatar') }}">
</div>

<div class="form-group">
  <label>展示图片</label>
  <input type="file" name="images[]" multiple="true">
  <p><small>按住ctrl多选</small></p>
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
  <input type="text" name="street_address" class="form-control" value="{{ old('street_address') }}">
</div>

@foreach($categories as $category)
  <div class="form-group">
    <label>{{ $category->name }}</label>
    <select class="form-control" name="category_id[]">
      <option>全部</option>
      @foreach($category->children()->get() as $option)
        <option value="{{ $option->id }}">{{ $option->name }}</option>
      @endforeach
    </select>
  </div>
@endforeach

<div class="form-group">
  <label>价格</label>
  <p>TODO</p>
</div>

<div class="form-group">
  <label>详情</label>
  <textarea id="ckeditor" class="ckeditor" name="detail" cols="30" rows="10">
    {{ old('detail') }}
  </textarea>
</div>

<div class="form-group">
  {!! Form::submit('保存', ['class' => 'btn btn-flat btn-default btn-primary btn-lg']) !!}
</div>

{!! Form::close() !!}
