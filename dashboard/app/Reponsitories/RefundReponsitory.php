<?php
namespace App\Reponsitories;

use HTML;
use Datatables;

/**
 * 退单业务处理
 **/
class RefundReponsitory
{
  public function datatables($query)
  {
    return Datatables::of($query)
      ->editColumn('confirmed', function ($refund) {
        return $this->refundStateLabel($refund->confirmed);
      })
      ->addColumn('amount', function ($refund) {
        return money_format('%.2n', $refund->order->amount);
      })
      ->addColumn('order_detail', function ($refund) {
        return $this->refundDetail($refund);
      })
      ->editColumn('state', function ($refund) {
        return $this->refundProgressLabel($refund->state);
      })
      ->make(true);
  }

  public function refundDetail($refund)
  {
    $orderService = new OrderReponsitory();

    return HTML::decode(
      '<p>'
      . HTML::link('refunds/' . $refund->id, '<strong>'.$refund->order_seq.'</strong>', ['class' => 'text-primary'])
      . '</p>'
      . $orderService->adsDetailOfOrder($refund->order)
    );
  }

  public function refundProgressLabel($state)
  {
    switch ($state) {
      case 0:
        return '<span class="label bg-navy">申请中</span>';
        break;
      case 1:
        return '<span class="label label-warning">退款中</span>';
        break;
      case 2:
        return '<span class="label label-success">退款完成</span>';
        break;
    }
  }

  public function refundStateLabel($confirmed)
  {
    switch ($confirmed) {
      case 0:
        return '<span class="label label-danger">待处理</span>';
        break;
      case 1:
        return '<span class="label bg-navy">同意</span>';
        break;
      case 2:
        return '<span class="label bg-navy">拒绝</span>';
        break;
    }
  }
}

