<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePromotionRequest;
use App\Models\Promotion;
use App\Reponsitories\PromotionReponsitory;

class PromotionController extends Controller
{
  protected $service;

  public function __construct(PromotionReponsitory $service)
  {
    $this->service = $service;

    parent::__construct();
  }

  public function create()
  {
    return view('promotions.create');
  }

  public function store(CreatePromotionRequest $request)
  {
    Promotion::create($request->all());

    return $this->okResponse('创建成功');
  }

  public function index()
  {
    return view('promotions.index');
  }

  public function server()
  {
    $query = Promotion::with('adSpace', 'adSpace.address');

    return $this->service->datatables($query);
  }

  public function proccessingServer()
  {
    $query = Promotion::with('adSpace', 'adSpace.address')->proccessing();

    return $this->service->datatables($query);
  }

  public function destroy($id)
  {
    Promotion::destroy($id);

    return $this->okResponse('删除成功');
  }

  public function update(CreatePromotionRequest $request, $id)
  {
    $promotion = Promotion::find($id);
    $promotion->update($request->all());

    return $this->okResponse('更新成功, 请重新刷新。');
  }

  public function proccessing()
  {
    return view('promotions.proccessing');
  }
}
