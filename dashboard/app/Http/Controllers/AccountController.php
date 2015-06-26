<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\AccountResetPasswordRequest;

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
  public function update($id)
  {
    //
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
