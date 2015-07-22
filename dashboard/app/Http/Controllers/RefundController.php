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
}
