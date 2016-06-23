<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

use App\Models\User;
use App\Models\UserInformation;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Reponsitories\UserReponsitory;
use App\Models\RandCode;
use DB;
use Carbon\Carbon;

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
      'name' => 'required|min:2|unique:users',
      'email' => 'required|email|max:255|unique:users',
      'phone' => 'required|unique:users',
      'password' => 'required',
      ],
      [
        'name.required' => '用户名不能为空', 
        'name.min' => '用户名最少两位',
        'name.unique' => '用户名以存在',
        'email.required'=> '邮箱不能为空',
        'email.unique'=> '邮箱已经存在',
        'password.required'=> '密码不能为空',
        'phone.unique'=> '手机号已经存在',
        'phone.required' => '手机号不能为空',
        'name.alpha_dash'=> '用户名含有特殊字符',
      ]);
    $name = $request->get('name');
    $email = $request->get('email');
    $phone = $request->get('phone');
    $pwd = bcrypt($request->get('password'));
    $user_id = 0;
    $user_code = RandCode::first();
    $active_token = hash_hmac('sha256', str_random(40),'activing');
    $parseDate = $this->parseDate($request);
    DB::transaction(function() use ($name, $email, $phone, $pwd, $user_id, 
      $user_code, $active_token, $parseDate, $request)
    {
      $user = User::create([
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'password' => $pwd,
        'active_token' => $active_token,
        'user_id' => $user_id,
        'user_code' => $user_code->nonce,
        'user_type' => $request->get('type'),
        'progress' => '',
      ]);
      UserInformation::create([
        'user_id' => $user->id,
        'start_time' => $parseDate['start_time'],
        'end_time' => $parseDate['end_time'],
        'vipnum' => $request->get('vipnum'), 
        'city' => $request->has('city')?$request->get('city'):'',
        'burnish' => $request->get('burnish'),
        'clinic' => $request->get('clinic'),
        'rshow' => $request->get('rshow'),
        'authority' => 0 
      ]);
      $user_code->delete();
    });
    return redirect()->action('UserController@pending')
                     ->with('status', '用户添加成功！');
  }


  public function parseDate($user)
  {
    $daterange = $user->daterange;
    $dates     = explode("-", $daterange);

    $parseDate['start_time'] = Carbon::parse($dates[0]);
    $parseDate['end_time']   = Carbon::parse($dates[1]);

    return $parseDate;
  }
  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Request $request, $id)
  {
    DB::transaction(function() use ($id)
    {
      $user = User::findOrFail($id);
      $userinfo = UserInformation::where('user_id', '=', $id);
      $user->delete();
      $userinfo->delete();
    });

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
    $user = User::with('userInformations')->findOrFail($id);
    $user->daterange = implode("-",array(str_replace('-', '/',$user->userInformations->first()->start_time), 
    str_replace('-', '/', $user->userInformations->first()->end_time))); 

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
    $this->validate($request, [ 
      'name' => 'required|min:2',
      'email' => 'required|email|max:255',
      'phone' => 'required',
      ],
      [
        'name.required' => '用户名不能为空', 
        'name.min' => '用户名最少两位',
        'email.required'=> '邮箱不能为空',
        'phone.required' => '手机号不能为空',
        'name.alpha_dash'=> '用户名含有特殊字符',
      ]);
    DB::transaction(function() use ($id, $request)
    {
      $user = User::find($id);
      $user->name = $request->get('name');
      $user->phone = $request->get('phone');
      $user->email = $request->get('email');
      if ($request->has('type'))
      {
        $user->user_type = $request->get('type');
        $user->admin = false;
      }
      if ($request->has('password'))
      {
        $user->password  = bcrypt($request->get('password'));
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
