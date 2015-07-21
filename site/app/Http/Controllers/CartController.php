<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\Navigator;
use App\Models\ShoppingCart;
use App\Models\Order;
use Config;
use App\Models\OrderItem;
use App\Models\AdPrice;
use App\Models\AdSpaceSnapshot;
use Auth;
use DB;
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
   * 添加到购物车
   *
   */
  public function create(Request $request)
  {
    $id = $request->input('product_id');
    $pid = $request->input('price_id');
    $quantity = $request->input('count');
    $price = AdPrice::find($pid);
    if (Auth::check())
    {
      $shop = new ShoppingCart;
      $shop->user_id = Auth::user()->id;
      $shop->ad_space_id = $id;
      $shop->ad_space_snapshot_id = 0; 
      $shop->quantity = $quantity;
      $shop->from = $price->from;
      $shop->to  = $price->to;
      $shop->original_price = $price->original_price;
      $shop->price = $price->price;
      $shop->subtotal = $price->price * $quantity;
      $shop->is_validate = 0;
      $shop->save();
    }

    return 1;
  }

  /**
   * 支付页面
   *
   * @return Response
   */
  public function payMent(Request $request)
  {
    $id = $request->input('aid_id');
    $agree_checked = $request->input('agree_checked');
    $shop = ShoppingCart::where('id', '=', $id)->first();
    $nav = '首页';
    Session::put('current_navigator', $nav);
    $navigators = Navigator::all()->sortBy('sort');
    $order = DB::transaction(function() use ($shop)
    {
      $order = $this->addOrder($shop);
      $orderItem = $this->addOrderItem($shop, $order);
      return $order;
    });
    return view('pay')->with(compact('navigators', 'order'));
  }

  /**
   * 订单详情
   *
   *
   */
  public function addOrderItem($shop, $order)
  {
    $orderItem = new OrderItem;
    $orderItem->ad_space_id = $shop->ad_space_id;
    $orderItem->order_id = $order->id;
    $orderItem->ad_space_snapshot_id = $shop->ad_space_snapshot_id;
    $orderItem->original_price = $shop->original_price;
    $orderItem->price = $shop->price;
    $orderItem->subtotal = $shop->original_price;
    $orderItem->score = $shop->adSpacesCart->adPrices->max('score');
    $orderItem->quantity = $shop->quantity;
    $orderItem->from = date('Y-m-d H:i:s',time());
    $orderItem->to = date('Y-m-d H:i:s',time());
    $orderItem->save();
    return $orderItem->id;
  }



  /**
   * 结算
   *
   */
  public function addOrder($shop)
  {
    $order = new Order;
    $order->user_id = Auth::user()->id;
    $order->order_seq = $this->orderNub();
    $order->state = 0;
    $order->amount = $shop->subtotal;
    $order->count_price = $shop->adSpacesCart->adPrices->max('score')*$shop->quantity;
    $order->save();
    return $order;

  }

  /**
   * 生成订单号
   *
   *
   */
  public function orderNub()
  {
    $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
    $orderSn = $yCode[intval(date('Y')) - 2011] . strtoupper(dechex(date('m'))) 
      . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));
    return $orderSn;
  }

  /**
   * 协议页面
   *
   * @return Response
   */
  public function settlement(Request $request)
  {
    $id = $request->input('aid');
    $quantity = $request->input('quantity');
    $nav = '首页';
    Session::put('current_navigator', $nav);
    $navigators = Navigator::all()->sortBy('sort');
    $shop = ShoppingCart::where('id', '=', $id)->first();
    $shop->quantity = $quantity;
    $shop->subtotal= $shop->price*$quantity;
    $shop->save();
    return view('settlement')->with(compact('navigators', 'shop', 'id'));
  }

  /**
   * 支付
   *
   *
   */
  public function goPay(Request $request)
  {
     $alipay = app('alipay.web');
     $alipay->setOutTradeNo('D12311321');
     $alipay->setTotalFee('123');
     $alipay->setSubject('测试订单');
     $alipay->setBody('goods_description');

    // 跳转到支付页面。
     return redirect()->to($alipay->getPayLink());
  }


  /**
  * 异步通知
  */
  public function webNotify()
  {
      // 验证请求。
      if (! app('alipay.web')->verify()) {
          Log::notice('Alipay notify post data verification fail.', [
              'data' => Request::instance()->getContent()
          ]);
          return 'fail';
      }

      // 判断通知类型。
      switch (Input::get('trade_status')) {
          case 'TRADE_SUCCESS':
          case 'TRADE_FINISHED':
              // TODO: 支付成功，取得订单号进行其它相关操作。
              Log::debug('Alipay notify post data verification success.', [
                  'out_trade_no' => Input::get('out_trade_no'),
                  'trade_no' => Input::get('trade_no')
              ]);
              break;
      }

      return 'success';
  }

 /**
  * 同步通知
  */
  public function webReturn()
  {
      // 验证请求。
      if (! app('alipay.web')->verify()) {
          Log::notice('Alipay return query data verification fail.', [
              'data' => Request::getQueryString()
          ]);
          return view('alipay.fail');
      }

      // 判断通知类型。
      switch (Input::get('trade_status')) {
          case 'TRADE_SUCCESS':
          case 'TRADE_FINISHED':
              // TODO: 支付成功，取得订单号进行其它相关操作。
              Log::debug('Alipay notify get data verification success.', [
                  'out_trade_no' => Input::get('out_trade_no'),
                  'trade_no' => Input::get('trade_no')
              ]);
              break;
      }

      return view('alipay.success');
  }
}
