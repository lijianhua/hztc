<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Reponsitories\UserReponsitory;

class UserController extends Controller
{
  protected $service;

  public function __construct(UserReponsitory $service)
  {
    $this->service = $service;

    parent::__construct();
  }

  public function pending()
  {
    return view('users.pending');
  }

  public function pendingServer()
  {
    $users = User::with('userInformations')->pending();

    return $this->service->datatables($users);
  }

  public function aggree(Request $request, $id)
  {
    $user = User::findOrFail($id);
    $user->is_verify = true;
    $user->save();

    return $this->okResponse('已同意用户认证。');
  }
}
