<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Enterprise;
use App\Reponsitories\EnterpriseReponsitory;

class EnterpriseController extends Controller
{
  protected $service;

  public function __construct(EnterpriseReponsitory $service)
  {
    $this->service = $service;

    parent::__construct();
  }

  public function pending()
  {
    return view('enterprises.pending');
  }

  public function pendingServer()
  {
    $enterprises = Enterprise::pending();

    return $this->service->datatables($enterprises);
  }

  public function aggree(Request $request, $id)
  {
    $enterprise = Enterprise::findOrFail($id);
    $enterprise->is_verify  = 1;
    $enterprise->is_audited = true;
    $enterprise->save();

    return $this->okResponse('已同意企业认证。');
  }

  public function refuse(Request $request, $id)
  {
    $enterprise = Enterprise::findOrFail($id);
    $enterprise->is_verify  = 2;
    $enterprise->is_audited = false;
    $enterprise->save();

    return $this->okResponse('已拒绝企业认证。');
  }
}
