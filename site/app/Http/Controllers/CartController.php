<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\Navigator;
use App\Models\Slide;
use App\Models\SlideItem;
class CartController extends Controller {

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    // $this->middleware('auth');
  }

  /**
   * Show the application dashboard to the user.
   *
   * @return Response
   */
  public function index()
  {
    $nav = '首页';
    Session::put('current_navigator', $nav);
    $navigators = Navigator::all()->sortBy('sort');
    return view('cart')->with(compact('navigators'));
  }


  /**
   * 支付页面
   *
   * @return Response
   */
  public function pay() 
  {
    $nav = '首页';
    Session::put('current_navigator', $nav);
    $navigators = Navigator::all()->sortBy('sort');
    return view('pay')->with(compact('navigators'));
  }

  /**
   * 协议页面
   *
   * @return Response
   */
  public function settlement()
  {
    $nav = '首页';
    Session::put('current_navigator', $nav);
    $navigators = Navigator::all()->sortBy('sort');
    return view('settlement')->with(compact('navigators'));
  }

}
