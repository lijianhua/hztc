<div class="modal fade" id="change_state_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">更改订单：{{ $order->order_seq }}状态</h4>
      </div>
      {!! Form::model($order, ['url' => route('orders.status.patch', ['id' => $order->id]), 'method' => 'put', 'id' => 'changeStatusForm']) !!}
      <div class="modal-body">
          <div class="form-group">
            <label>状态</label>
            {!! Form::select('state', Config::get('order.states'), $order->state, ['class' => 'form-control']) !!}
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-primary btn-flat">确定</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
