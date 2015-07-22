<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Reponsitories\RefundReponsitory;
use App\Models\Refund;

class RefundController extends Controller
{
  protected $service;

  public function __construct(RefundReponsitory $service)
  {
    $this->service = $service;

    parent::__construct();
  }

  public function index()
  {
    return view('refunds.index');
  }

  public function server()
  {
    $refunds = Refund::with('order', 'order.orderItems', 'order.orderItems.adSpace')->recent();

    return $this->service->datatables($refunds);
  }

  public function pending()
  {
    return view('refunds.pending');
  }

  public function pendingServer()
  {
    $refunds = Refund::with('order', 'order.orderItems', 'order.orderItems.adSpace')->recent()->pendingProccess();

    return $this->service->datatables($refunds);
  }

  public function underway()
  {
    return view('refunds.underway');
  }

  public function underwayServer()
  {
    $refunds = Refund::with('order', 'order.orderItems', 'order.orderItems.adSpace')->recent()->underway();

    return $this->service->datatables($refunds);
  }

  public function aggree(Request $request, $id)
  {
    $refund = Refund::findOrFail($id);

    if ($refund->isPending()) {
      $refund->confirmed = 1;
      $refund->state = 1;
      $refund->save();

      if ($request->ajax()) {
        return $this->okResponse('已同意退款。');
      } else {
        return redirect()
          ->action('RefundController@show', ['id' => $refund->id])
          ->with('status', '已同意退款');
      }
    } else {
      if ($request->ajax()) {
        return $this->failResponse('错误！该退单不能同意退款。');
      } else {
        return redirect()->action('RefundController@show', ['id' => $refund->id]);
      }
    }
  }

  public function refuse(Request $request, $id)
  {
    $refund = Refund::findOrFail($id);

    if ($refund->isPending()) {
      $refund->confirmed = 2;
      $refund->save();

      if ($request->ajax()) {
        return $this->okResponse('已拒绝退款。');
      } else {
        return redirect()
          ->action('RefundController@show', ['id' => $refund->id])
          ->with('status', '已拒绝退款');
      }
    } else {
      if ($request->ajax()) {
        return $this->failResponse('错误！该退单不能拒绝退款。');
      } else {
        return redirect()->action('RefundController@show', ['id' => $refund->id]);
      }
    }
  }

  public function finish(Request $request, $id)
  {
    $refund = Refund::findOrFail($id);

    if ($refund->isUnderway()) {
      $refund->state = 2;
      $refund->save();

      if ($request->ajax()) {
        return $this->okResponse('已标记完成退款。');
      } else {
        return redirect()
          ->action('RefundController@show', ['id' => $refund->id])
          ->with('status', '已标记完成退款');
      }
    } else {
      if ($request->ajax()) {
        return $this->failResponse('错误！该退单不能标记完成退款。');
      } else {
        return redirect()->action('RefundController@show', ['id' => $refund->id]);
      }
    }
  }
}
