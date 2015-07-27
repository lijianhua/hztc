<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePromotionRequest;
use App\Models\Promotion;

class PromotionController extends Controller
{
  public function create()
  {
    return view('promotions.create');
  }

  public function store(CreatePromotionRequest $request)
  {
    Promotion::create($request->all());

    return $this->okResponse('创建成功');
  }
}
