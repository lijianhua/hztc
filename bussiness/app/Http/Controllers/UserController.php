<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Auth;
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
    $users = User::where('user_id', '=', Auth::user()->id)->pending();

    return $this->service->datatables($users);
  }

  public function aggree(Request $request, $id)
  {
    $user = User::findOrFail($id);
    $user->is_verify = true;
    $user->save();

    return $this->okResponse('已同意用户认证。');
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
