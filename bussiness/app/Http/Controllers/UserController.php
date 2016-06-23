<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Reponsitories\UserReponsitory;
use DB;

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
    $user = User::with('userInformations')->findOrFail($id);
    $user->daterange = implode("-",array(str_replace('-', '/',$user->userInformations->first()->start_time), 
    str_replace('-', '/', $user->userInformations->first()->end_time))); 

    return view('users.edit', compact('user'));
  }

  public function parseVip()
  {
    $user = User::find(Auth::user()->id)->userInformations->first();
    $user->vipnum -= 1;
    $user->save();

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, $id)
  {
    DB::transaction(function() use ($id, $request)
    {
      $user = User::find($id);
      $user->name = $request->get('name');
      $user->phone = $request->get('phone');
      $user->email = $request->get('email');
      if ($user->user_type != $request->get('type'))
      {
        $user->user_type = $request->get('type');
        $this->parseVip();
      }
      $user->save();

      $userInfo = $user->userInformations->first();
      if ($user->admin)
      {
        $parseDate = $this->parseDate($request);
        $userInfo->start_time = $parseDate['start_time'];
        $userInfo->end_time = $parseDate['end_time'];
        $userInfo->vipnum = $request->get('vipnum');
        $userInfo->city = $request->get('city');
      } else {
        $userInfo->burnish = $request->get('burnish');
        $userInfo->clinic = $request->get('clinic');
        $userInfo->rshow = $request->get('rshow');
      }

      $userInfo->save();
    });


    return redirect()->action('UserController@pending')->with('status', '用户更新成功。');
  }

}
