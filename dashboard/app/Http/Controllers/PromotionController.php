<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PromotionController extends Controller
{
  public function create()
  {
    return view('promotions.create');
  }
}
