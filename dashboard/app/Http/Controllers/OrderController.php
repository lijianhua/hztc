<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Reponsitories\OrderReponsitory;

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
    $orders = Order::with('user', 'orderItems', 'orderItems.adSpace')->recent();

    return $this->service->datatables($orders);
  }

  public function pendingServer()
  {
    $orders = Order::with('user', 'orderItems', 'orderItems.adSpace')->recent()->pendingProccess();

    return $this->service->datatables($orders);
  }

  public function newestServer()
  {
    $orders = Order::with('user', 'orderItems', 'orderItems.adSpace')->recent()->newest();

    return $this->service->datatables($orders);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
    //
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

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    //
  }

  public function proccess(Request $request, $id)
  {
    $order = Order::findOrFail($id);

    if ($order->isPending()) {
      $order->state = 3;
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
