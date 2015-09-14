<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\AccountResetPasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateEnterpriseRequest;

class AccountController extends Controller
{
  use ResetsPasswords;

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    //
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
    $user = User::find($id);
    $enterprise = $user->enterprise;
    return view('accounts.show', compact('user', 'enterprise'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $user = User::find($id);
    $enterprise = $user->enterprise;
    return view('accounts.edit', compact('user', 'enterprise'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(UpdateUserRequest $request, $id)
  {
    $user = User::find($id);
    $user->name = $request->get('name');
    if ($request->hasFile('avatar')) {
      $user->avatar = $request->file('avatar');
    }
    $user->save();

    return redirect()->back()->with('status', '更新成功');
  }

  public function updateEnterprise(UpdateEnterpriseRequest $request, $id)
  {
    $enterprise = User::find($id)->enterprise;

    $enterprise->email    = $request->get('email');
    $enterprise->telphone = $request->get('telphone');
    $enterprise->phone    = $request->get('phone');
    $enterprise->weixin   = $request->get('weixin');
    $enterprise->weibo    = $request->get('weibo');
    $enterprise->qq       = $request->get('qq');
    $enterprise->detail   = $request->get('detail');
    if ($request->hasFile('avatar')) {
      $enterprise->avatar = $request->file('avatar');
    }
    $enterprise->save();

    return redirect()->back()->with('status', '更新成功');
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

  /**
   * 登录后修改用户密码
   *
   * @return response
   **/
  public function postResetPassword(AccountResetPasswordRequest $request, $id)
  {
    if (Auth::attempt(['id' => $id, 'password' => $request->get('oldPassword')])) {
      $user = User::find($id);
      $this->resetPassword($user, $request->get('password'));

      return redirect()->back()->with('status', trans('passwords.reset'));
    }

    return redirect()->back()->withErrors([
      'password' => trans("passwords.miss")
    ]);
  }
}
