<?php

namespace App\Http\Controllers;

use DB;
use Config;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Reponsitories\OrderReponsitory;
use Auth;

class OrderController extends Controller
{
  /**
   * 订单业务逻辑处理
   *
   * @var mixed $service
   **/
  protected $service;

  public function __construct(OrderReponsitory $service)
  {
    $this->service = $service;

    parent::__construct();
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    return view('orders.index');
  }

  public function pending()
  {
    return view('orders.pending');
  }

  public function newest()
  {
    return view('orders.newest');
  }

  public function server()
  {
    $orders = Order::with('user', 'orderItems', 'orderItems.adSpace')
      ->byUser(Auth::user()->id)
      ->recent()
      ->select('orders.*');

    return $this->service->datatables($orders);
  }

  public function pendingServer()
  {
    $orders = Order::with('user', 'orderItems', 'orderItems.adSpace')
      ->byUser(Auth::user()->id)
      ->recent()
      ->pendingProccess()
      ->select('orders.*');

    return $this->service->datatables($orders);
  }

  public function newestServer()
  {
    $orders = Order::with('user', 'orderItems', 'orderItems.adSpace')
      ->byUser(Auth::user()->id)
      ->recent()
      ->newest()
      ->select('orders.*');

    return $this->service->datatables($orders);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    $order = Order::findOrFail($id);

    return view('orders.show', compact('order'));
  }

  public function proccess(Request $request, $id)
  {
    $order = Order::findOrFail($id);

    if ($order->isPending()) {
      $order->state = 3;
      $order->save();

      $time = Carbon::now()->addDays(Config::get('app.order_auto_complete'));
      $order->mayAutoFinished($time);

      if ($request->ajax()) {
        return $this->okResponse('标记完成。');
      } else {
        return redirect()
          ->action('OrderController@show', ['id' => $order->id])
          ->with('status', '标记完成');
      }
    }
    if ($request->ajax()) {
      return $this->failResponse('标记错误。这个订单不能标记为已投放。');
    } else {
      return redirect()->action('OrderController@show', ['id' => $order->id]);
    }
  }

  public function confirm(Request $request, $id)
  {
    $order = Order::findOrFail($id);

    if ($order->isNewest()) {
      $order->state = 2;
      $order->save();

      if ($request->ajax()) {
        return $this->okResponse('标记完成。');
      } else {
        return redirect()
          ->action('OrderController@show', ['id' => $order->id])
          ->with('status', '标记完成');
      }
    }
    if ($request->ajax()) {
      return $this->failResponse('标记错误。这个订单不能标记为已投放。');
    } else {
      return redirect()->action('OrderController@show', ['id' => $order->id]);
    }
  }
}
