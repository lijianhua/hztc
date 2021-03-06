<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Datatables;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;

class AdminController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {

    return view('admins.index');
  }

  public function server()
  {
    $query = User::select(DB::raw('users.name as user_name, users.id, users.email, users.admin, users.created_at as created_at, users.phone'));
    return Datatables::of($query)
      ->addColumn('status', function ($user) {
        if ($user->admin) {
          $style = 'bg-green';
          $label = '管理员';
        } else {
          $style = 'bg-navy';
          $label = '注册用户';
        }
        return sprintf("<span class=\"label %s\">%s</span>", $style, $label);
      })
      ->make(true);
  }

  public function appointed($id)
  {
    if ($id == 1) {
      return $this->failResponse('您不能操作系统管理员');
    }

    if ($id == Auth::user()->id) {
      return $this->failResponse('您不能操作自身');
    }

    User::whereId($id)->update(['admin' => true, 'user_type' => '管理员']);

    return $this->okResponse('任命成功');
  }

  public function unappointed($id)
  {
    if ($id == 1) {
      return $this->failResponse('您不能操作系统管理员');
    }

    if ($id == Auth::user()->id) {
      return $this->failResponse('您不能操作自身');
    }

    User::whereId($id)->update(['admin' => false, 'user_type' => '普通用户']);

    return $this->okResponse('撤销任命成功');
  }
}
