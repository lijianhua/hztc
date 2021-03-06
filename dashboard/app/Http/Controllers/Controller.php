<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController
{
  use DispatchesJobs, ValidatesRequests;

  public function __construct()
  {
    $__counts = [];

    // 待审核产品
    $__counts['waitingForAuditedAd'] = \App\Models\AdSpace::waitingForAudited()->count();
    $__counts['pendingProccessOrders'] = \App\Models\Order::pendingProccess()->count();
    $__counts['newestOrders'] = \App\Models\Order::newest()->count();
    $__counts['pendingProcessRefunds'] = \App\Models\Refund::pendingProccess()->count();
    $__counts['underwayRefunds'] = \App\Models\Refund::underway()->count();
    $__counts['proccessingPromotion'] = \App\Models\Promotion::proccessing()->count();

    view()->share('__counts', $__counts);
  }

  public function okResponse($message, $data = null)
  {
    return $this->jsonResponseWithStatus('OK', $message, $data);
  }

  public function failResponse($message, $data = null)
  {
    return $this->jsonResponseWithStatus('Fail', $message, $data);
  }

  public function jsonResponseWithStatus($status, $message, $data)
  {
    $jsonArray = [
      'state'   => $status,
      'message' => $message
    ];

    if (!(is_null($data) && empty($data))) {
      $jsonArray['data'] = $data;
    }

    return new JsonResponse($jsonArray);
  }
}
