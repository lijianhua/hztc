<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\Navigator;
use App\Models\ShoppingCart;
use Auth;
use Illuminate\Http\Request;
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
    $carts      = ShoppingCart::with(['adSpacesCart'])->where('user_id', '=', Auth::user()->id)->paginate(10);
    return view('cart')->with(compact('navigators', 'carts'));
  }

  /**
   * 删除购物车内广告位
   *
   *
   */
  public function CartDel($id)
  {
    $cart = ShoppingCart::find($id);
    $cart->delete();
    return redirect('/cart')->with('status', '删除成功'); 
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
  public function settlement(Request $request)
  {
    $id = 1;
    $input = $request->input();
    $nav = '首页';
    Session::put('current_navigator', $nav);
    $navigators = Navigator::all()->sortBy('sort');
    $shop = ShoppingCart::find($id)->first();
    return view('settlement')->with(compact('navigators', 'shop'));
  }

}
