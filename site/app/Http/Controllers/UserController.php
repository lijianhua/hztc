<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Navigator;
use App\Models\Order;
use App\Models\UserScoreAccount;
use App\Models\UserScoreDetail;
use Auth;

use Illuminate\Http\Request;

class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}
  public function showemail($email)
  {
      $user = User::where('email','=',$email)->first();
      if($user)
      {
        return 1;
      }
      else
      {
        return 0;
      }
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
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
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
   * 用户订单页
   *
   *
   */
  public function order()
  {
    $nav  = '首页';
    $unav = '我的订单';
    Session::put('current_navigator', $nav);
    Session::put('user_navigator', $unav);
    $navigators = Navigator::all()->sortBy('sort');
    $orders     = Order::where('user_id', '=', Auth::user()->id)->paginate(10);
    return view('order')->with(compact('navigators', 'orders'));
  }


  /**
   * 用户信息页
   *
   *
   */
  public function info()
  {
    $nav  = '首页';
    $unav = '广告主信息';
    Session::put('current_navigator', $nav);
    Session::put('user_navigator', $unav);
    $navigators = Navigator::all()->sortBy('sort');
    return view('advertisers')->with(compact('navigators'));
  }


  /**
   * 用户积分
   *
   *
   */
  public function score()
  {
    $nav  = '首页';
    $unav = '我的积分';
    Session::put('current_navigator', $nav);
    Session::put('user_navigator', $unav);
    $navigators = Navigator::all()->sortBy('sort');
    $scores     = UserScoreAccount::where('user_id', '=', Auth::user()->id)->paginate(5);
    return view('score')->with(compact('navigators', 'scores'));
  }
}

