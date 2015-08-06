<div class="col-md-3 price">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">广告价格</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="remove">
          <i class="fa fa-times"></i>
        </button>
      </div>
    </div>
    <div class="box-body">
      <div class="form-group">
        <label>刊例价</label>
        <input class="form-control" type="text"
               name="ad_prices[{{ isset($index) ? $index : 0 }}][original_price]"
               value="{{ isset($price) ?  $price['original_price'] : 0 }}">
      </div>
      <div class="form-group">
        <label>执行价</label>
        <div class="input-group">
          <input class="form-control" type="text"
                name="ad_prices[{{ isset($index) ? $index : 0 }}][price]"
                value="{{ isset($price) ? $price['price'] : 0 }}">
          <span class="input-group-addon">元/</span>
          <input class="form-control" type="text"
                 name="ad_prices[{{ isset($index) ? $index : 0 }}][unit]"
                 value="{{ isset($price) ? $price['unit'] : '' }}"
                 placeholder="期、周等">
        </div>
      </div>
      <div class="form-group">
        <label>备注</label>
        <input class="form-control" type="text"
                name="ad_prices[{{ isset($index) ? $index : 0 }}][note]"
                value="{{ isset($price) ? $price['note'] : '' }}"
                placeholder="比如描述广告频次等">
      </div>
      <div class="form-group">
        <label>积分</label>
        <input class="form-control" type="text" 
               name="ad_prices[{{ isset($index) ? $index : 0 }}][score]"
               value="{{ isset($price) ? $price['score'] : 0 }}">
      </div>
      <div class="form-group">
        <label>投放时间段</label>
        <input class="form-control" type="text" 
               data-type="daterange" 
               name="ad_prices[{{ isset($index) ? $index : 0 }}][daterange]"
               value="{{ isset($price) ? $price['daterange'] : '' }}">
      </div>
      <div class="form-group">
        <label>投放次数</label>
        <input class="form-control" type="text" 
               name="ad_prices[{{ isset($index) ? $index : 0 }}][send_count]"
               value="{{ isset($price) ? $price['send_count'] : 1 }}">
      </div>
      <div class="form-group">
        <label>可销售次数</label>
        <input class="form-control" type="text"
               name="ad_prices[{{ isset($index) ? $index : 0 }}][sale_count]"
               value="{{ isset($price) ? $price['sale_count'] : 1 }}">
      </div>
    </div>
  </div>
</div>
