<?php
namespace App\Reponsitories;

use HTML;
use Datatables;

/**
 * 订单业务逻辑处理
 **/
class OrderReponsitory
{
  public function datatables($query)
  {
    return Datatables::of($query)
      ->editColumn('state', function ($order) {
        switch ($order->state) {
          case 0:
            return '<span class="label bg-navy">未付款</span>';
            break;
          case 1:
            return '<span class="label label-danger">待投放</span>';
            break;
          case 2:
            return '<span class="label label-warning">已投放</span>';
            break;
          case 3:
            return '<span class="label label-success">已完成</span>';
            break;
          case 4:
            return '<span class="label label-default">已取消</span>';
            break;
        }
      })
      ->editColumn('amount', function ($order) {
        return money_format('%i', $order->amount);
      })
      ->addColumn('order_detail', function ($order) {
        return $this->orderDetailForDatatables($order);
      })
      ->make(true);
  }

  public function orderDetailForDatatables($order)
  {
    return HTML::decode(
      '<p>'
      . HTML::link('orders/' . $order->id, $order->order_seq, ['class' => 'text-primary'])
      . '</p>'
      . $this->adsDetailOfOrder($order)
    );
  }

  public function adsDetailOfOrder($order)
  {
    $result = '';
    foreach ($order->orderItems as $item) {
      $result .= <<< EOF
        <p>
          <small>{$item->adSpace->title}</small><br>
          <small>{$item->from->format('Y/m/d')} &nbsp;&nbsp;-&nbsp;&nbsp; {$item->to->format('Y/m/d')}</small><br>
          <small>数量:&nbsp;&nbsp;{$item->quantity}</small>
        </p>
EOF;
    return $result;
    }
  }
}
