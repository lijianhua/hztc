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
    $users = User::with('userInformations');

    return $this->service->datatables($users);
  }

  public function aggree(Request $request, $id)
  {
    $user = User::findOrFail($id);
    $user->is_verify = 1;
    $user->save();

    return $this->okResponse('已同意用户认证。');
  }

  public function refuse(Request $request, $id)
  {
    $user = User::findOrFail($id);
    if ($user->id != 1) {
      $user->is_verify = 2;
      $user->save();
    }
    return $this->okResponse('已拒绝用户认证。');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return view('users.create');
  }


  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {

    $this->validate($request, [ 
      'name' => 'required|min:2',
      'email' => 'required|email|max:255|unique:users',
      'phone' => 'required|unique:users',
      ],
      [
        'name.required' => '用户名不能为空', 
        'name.min' => '用户名最少两位',
        'email.required'=> '邮箱不能为空',
        'email.unique'=> '邮箱已经存在',
        'phone.unique'=> '手机号已经存在',
        'phone.required' => '手机号不能为空',
        'name.alpha_dash'=> '用户名含有特殊字符',
      ]);
    $name = $request->get('name');
    $email = $request->get('email');
    $phone = $request->get('phone');
    $pwd = bcrypt($request->get('password'));
    $user_id = 1;
    $user_code = 'hdssdd';
    $active_token = hash_hmac('sha256', str_random(40),'activing');
    $user = User::create([
      'name' => $name,
      'email' => $email,
      'phone' => $phone,
      'password' => $pwd,
      'active_token' => $active_token,
      'user_id' => $user_id,
      'user_code' => $user_code,
      'user_type' => $request->get('type'),
      'progress' => 'fdsfd',
    ]);
    return redirect()->action('UserController@pending')
                     ->with('status', '用户添加成功！');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Request $request, $id)
  {
    $user = User::findOrFail($id);
    $user->delete();

    if ($request->ajax()) {
      return $this->okResponse('删除成功');
    } else {
      return redirect('/users/pending-verify')->with('status', '删除成功');
    }
  }


  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $user = User::findOrFail($id);

    return view('users.edit', compact('user'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, $id)
  {
    $user = User::find($id);
    $user->name = $request->get('name');
    $user->phone = $request->get('phone');
    $user->email = $request->get('email');
    $user->user_type = $request->get('type');
    if ($request->has('password'))
    {
      $user->password  = bcrypt($request->get('password'));
    }
    $user->save();
    return redirect()->action('UserController@pending')->with('status', '用户更新成功。');
  }


}
