<?php namespace App\Http\Controllers;
use DB;
use Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Navigator;
use App\Models\Order;
use App\Models\UserScoreAccount;
use App\Models\Enterprise;
use App\Models\ReviewMaterial;
use App\Models\UserInformation;
use App\Models\UserScoreDetail;
use App\Models\AdSpaceUser;
use App\Models\Refund;
use App\Models\CustomerReview;
use App\Http\Requests\PostEnterpriseRequest;
use Illuminate\Http\Request;
use Auth;

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
    $nav    = '首页';
    $unav   = '我的订单';
    $states = array('提交订单', '付款成功', '广告商已确认', '提供服务', '审核完成');
    Session::put('current_navigator', $nav);
    Session::put('user_navigator', $unav);
    $navigators = Navigator::all()->sortBy('sort');
    $orders     = Order::where('user_id', '=', Auth::user()->id)
      ->orderBy('created_at', 'desc')
      ->paginate(5);
    return view('order')->with(compact('navigators', 'orders', 'states'));
  }

  /**
   * 订单详情
   *
   */
  public function orderDetail($id)
  {
    $nav    = '首页';
    $unav   = '我的订单';
    $states = array('提交订单', '付款成功', '广告商已确认', '提供服务', '审核完成');
    Session::put('current_navigator', $nav);
    Session::put('user_navigator', $unav);
    $navigators = Navigator::all()->sortBy('sort');
    $orders     = Order::where('user_id', '=', Auth::user()->id)
                    ->where('id', '=', $id)->first();
    return view('orderDetail')->with(compact('navigators', 'orders', 'states'));
  }


  /**
   * 删除订单
   *
   *
   */
  public function orderDel($id, $state=0)
  {
    if ($state == 1)
    {
      $order     = Order::where('user_id', '=', Auth::user()->id)
                    ->where('id', '=', $id)->first();
      $refund = new Refund;
      $refund->user_id = Auth::user()->id;
      $refund->order_seq = $order->order_seq;
      $refund->state = 0;
      $refund->order_id = $id;
      $refund->apply_at = date('Y-m-d H:i:s',time());
      $refund->confirmed = 0;
      $refund->save();
    }

    $order = Order::find($id);
    $order->delete();

    return redirect('/users/order')->with('status', '删除成功'); 
  }


  /**
   * 评价
   *
   */
  public function getComment($id)
  {
    $nav    = '首页';
    $unav   = '我的订单';
    Session::put('current_navigator', $nav);
    Session::put('user_navigator', $unav);
    $navigators = Navigator::all()->sortBy('sort');
    $order   = Order::where('user_id', '=', Auth::user()->id)
                    ->where('id', '=', $id)->first();

    return view('comment')->with(compact('navigators', 'order'));
  
  }


  /**
   * 添加评价
   *
   * 
   */
  public function addComment(Request $request)
  {
    $CustomerReview = new CustomerReview;
    $CustomerReview->user_id = Auth::user()->id;
    $CustomerReview->order_id = $request->input('order_id');
    $CustomerReview->ad_space_id = $request->input('ad_space_id');
    $CustomerReview->score = $request->input('score');
    $CustomerReview->grade = $request->input('single');
    $CustomerReview->body = $request->input('comment');
    $CustomerReview->save();

    return redirect('/users/order')->with('status', '添加成功'); 
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
    $user = Auth::user();
    $navigators = Navigator::all()->sortBy('sort');
    $enterprise = Enterprise::find($user->enterprise_id);
    $enterprise = $enterprise?$enterprise:'';
    $truthname     = UserInformation::where('user_id','=',$user->id)->where('key','=','truthname')->first();
    $idcard     = UserInformation::where('user_id','=',$user->id)->where('key','=','idcard')->first();
    $telphone     = UserInformation::where('user_id','=',$user->id)->where('key','=','telphone')->first();
    $license = ReviewMaterial::where('enterprise_id','=',$user->enterprise_id)->where('name','=','license')->first();
    $tax = ReviewMaterial::where('enterprise_id','=',$user->enterprise_id)->where('name','=','tax')->first();
    $organizing = ReviewMaterial::where('enterprise_id','=',$user->enterprise_id)->where('name','=','organizing')->first();
    return view('advertisers')->with(compact('navigators','user','enterprise','truthname','idcard','telphone','license','tax','organizing'));
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
    $scores     = UserScoreAccount::where('user_id', '=', Auth::user()->id)->first();
    $redscore = '';
    if ($scores)
    {
      $redscore = $scores->ScoreDetails()
        ->orderBy('created_at', 'desc')
        ->paginate(5);
    }
    return view('score')->with(compact('navigators', 'scores', 'redscore'));
  }


  /**
   * 收藏
   *
   *
   */
  public function collect()
  {
    $nav  = '首页';
    $unav = '我的收藏';
    Session::put('current_navigator', $nav);
    Session::put('user_navigator', $unav);
    $type_space = array('正常广告位', '特价广告位', '免费广告位', '新奇特广告位');
    $navigators = Navigator::all()->sortBy('sort');
    $collects = AdSpaceUser::where('user_id', '=', Auth::user()->id)
      ->orderBy('created_at', 'desc')
      ->paginate(5);
    return view('collect')->with(compact('navigators', 'collects', 'type_space'));
  }

  /**
   *
   *
   */
  public function collectDel($id)
  {
    $collect = AdSpaceUser::where('ad_space_id', '=', $id)->delete();

    return redirect('/users/collect')->with('status', '删除成功');
  }



  /**
   *退货清单 
   *
   *
   */
  public function refund()
  {
    $nav  = '首页';
    $unav = '退货清单';
    Session::put('current_navigator', $nav);
    Session::put('user_navigator', $unav);
    $navigators = Navigator::all()->sortBy('sort');
    $refunds = Refund::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(5);
    return view('refund')->with(compact('navigators', 'refunds'));
  }
  /**
   * 
   *
   *
   */
  public function detail($id)
  {
    $nav  = '首页';
    $unav = '退货清单';
    Session::put('current_navigator', $nav);
    Session::put('user_navigator', $unav);
    $navigators = Navigator::all()->sortBy('sort');
    $refund = Refund::find($id);
    return view('refund_detail')->with(compact('navigators', 'refund'));
  }
  /**
   * store_auth function
   *
   * @return response
   * @author Pc jinyan
   **/
  public function store_user_auth(PostEnterpriseRequest $request)
  {
    $attributes = $request->only('id', 'idcard', 'truthname', 'enterprise','telphone');
    $user = Auth::user();
    $userinfo = UserInformation::where('user_id', '=', $user->id)->first();
    if($userinfo && $user->enterprise_id)
    {
      DB::transaction(function() use ($attributes,$user)
      {
        Enterprise::where('id', '=', $user->enterprise_id)->update(['name' => $attributes['enterprise']]); 
        UserInformation::where('user_id', '=', $user->id)->where('key', '=', 'idcard')->update(['value' => $attributes['idcard']]);
        UserInformation::where('user_id', '=', $user->id)->where('key', '=', 'truthname')->update(['value' => $attributes['truthname']]);
        UserInformation::where('user_id', '=', $user->id)->where('key', '=', 'telphone')->update(['value' => $attributes['telphone']]);
      });   
    }
    else
    {
      DB::transaction(function() use ($attributes, $user)
      {
        $enterprise = Enterprise::create(['name' => $attributes['enterprise']]); 
        User::where('id', '=',$attributes['id'])->update(['enterprise_id' => $enterprise->id]);
        UserInformation::create(['user_id' => $user->id, 'key' => 'idcard', 'value' => $attributes['idcard'], 'authority' => 0]);
        UserInformation::create(['user_id' => $user->id, 'key' => 'truthname', 'value' => $attributes['truthname'], 'authority' => 0]);
        UserInformation::create(['user_id' => $user->id, 'key' => 'telphone', 'value' => $attributes['telphone'], 'authority' => 0]);
      });   
    }
    return Redirect::to('users/info');
  }
  public function store_company_auth(Request $request)
  {
		$this->validate($request, [
			'license' => 'image',
			'tax' => 'image',
			'organizing' => 'image'],
      [ 'license.mimes' => '营业执照只能上传图片', 
        'tax.mimes' => '税务登记只能上传图片', 
        'organizing.mimes' => '组织结构代码只能上传图片', 
      ]);
    $requests = $request->all();
    $user = Auth::user();
    if($user->enterprise_id)
    {
      $requests = $request->all();
      DB::transaction(function() use ($requests,$user)
      {
        $key_a = ReviewMaterial::where('enterprise_id', '=', $user->enterprise_id)->where('name','=','license')->first();   
        $key_b = ReviewMaterial::where('enterprise_id', '=', $user->enterprise_id)->where('name','=','tax')->first();   
        $key_c = ReviewMaterial::where('enterprise_id', '=', $user->enterprise_id)->where('name','=','organizing')->first();   
        if(array_key_exists('license',$requests))
        {
          if(!$key_a)
          {
            ReviewMaterial::create(['enterprise_id' => $user->enterprise_id, 'name' => 'license', 'note' => 'license','avatar' => $requests['license'],'is_text'=>0, 'is_image'=>0]);
          }
          else
          {
              ReviewMaterial::where('enterprise_id', '=', $user->enterprise_id)->where('name','=','license')->delete();
              ReviewMaterial::create(['enterprise_id' => $user->enterprise_id, 'name' => 'license', 'note' => 'license','avatar' => $requests['license'],'is_text'=>0, 'is_image'=>0]);
          }
        }
        if(array_key_exists('tax',$requests))
        {
          if(!$key_b)
          {
            ReviewMaterial::create(['enterprise_id' => $user->enterprise_id, 'name' => 'tax', 'note' => 'tax','avatar' => $requests['tax'], 'is_text'=>0, 'is_image'=>0]);
          }
          else
          {
              ReviewMaterial::where('enterprise_id', '=', $user->enterprise_id)->where('name','=','tax')->delete();
              ReviewMaterial::create(['enterprise_id' => $user->enterprise_id, 'name' => 'tax', 'note' => 'tax','avatar' => $requests['tax'], 'is_text'=>0, 'is_image'=>0]);
          }
        }
        if(array_key_exists('organizing',$requests))
        {
          if(!$key_c)
          {
            ReviewMaterial::create(['enterprise_id' => $user->enterprise_id, 'name' => 'organizing', 'note' => 'organizing','avatar' => $requests['organizing'], 'is_text'=>0, 'is_image'=>0]);
          }
          else
          {
              ReviewMaterial::where('enterprise_id', '=', $user->enterprise_id)->where('name','=','organizing')->delete();
              ReviewMaterial::create(['enterprise_id' => $user->enterprise_id, 'name' => 'organizing', 'note' => 'organizing','avatar' => $requests['organizing'], 'is_text'=>0, 'is_image'=>0]);
          }
        }
      });   
      if ($request->ajax()) {
        return response()->json(['status' => 'OK', 'message' => 'Success.']);
      } else
        return Redirect::to('users/info');
    }
    else
    {
        return Redirect::to('users/info');
    }
  } 


  /**
   * 审核完成
   *
   */
  public function endOrder(Request $request)
  {
    $orderId = $request->input('oid');
    $order = Order::find($orderId);
    $order->state = 4;
    $order->save();
    return 1;
  }
}

