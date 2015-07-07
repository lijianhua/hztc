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
use App\Models\UserScoreDetail;
use App\Models\AdSpaceUser;
use Auth;
use  App\Http\Requests\PostEnterpriseRequest;
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
    $user = Auth::user();
    $navigators = Navigator::all()->sortBy('sort');
    $enterprise = Enterprise::find($user->enterprise_id);
    $enterprise = $enterprise?$enterprise:'';
    $truthname     = ReviewMaterial::where('enterprise_id','=',$user->enterprise_id)->where('name','=','truthname')->first();
    $idcard     = ReviewMaterial::where('enterprise_id','=',$user->enterprise_id)->where('name','=','idcard')->first();
    $telphone     = ReviewMaterial::where('enterprise_id','=',$user->enterprise_id)->where('name','=','telphone')->first();
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
      $redscore = $scores->ScoreDetails()->paginate(10);
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
    $navigators = Navigator::all()->sortBy('sort');
    $collects = AdSpaceUser::where('user_id', '=', Auth::user()->id)->paginate(5);
    return view('collect')->with(compact('navigators', 'collects'));
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
    if($user->enterprise_id)
    {
      DB::transaction(function() use ($attributes,$user)
      {
        Enterprise::where('id', '=', $user->enterprise_id)->update(['name' => $attributes['enterprise']]); 
        ReviewMaterial::where('enterprise_id', '=', $user->enterprise_id)->where('name', '=', 'idcard')->update(['note' => $attributes['idcard']]);
        ReviewMaterial::where('enterprise_id', '=', $user->enterprise_id)->where('name', '=', 'truthname')->update(['note' => $attributes['truthname']]);
        ReviewMaterial::where('enterprise_id', '=', $user->enterprise_id)->where('name', '=', 'telphone')->update(['note' => $attributes['telphone']]);
      });   
    }
    else
    {
      DB::transaction(function() use ($attributes, $user)
      {
        $enterprise = Enterprise::create(['name' => $attributes['enterprise']]); 
        User::where('id', '=',$attributes['id'])->update(['enterprise_id' => $enterprise->id]);
        ReviewMaterial::create(['enterprise_id' => $enterprise->id, 'name' => 'idcard', 'note' => $attributes['idcard']]);
        ReviewMaterial::create(['enterprise_id' => $enterprise->id, 'name' => 'truthname', 'note' => $attributes['truthname']]);
        ReviewMaterial::create(['enterprise_id' => $enterprise->id, 'name' => 'telphone', 'note' => $attributes['telphone']]);
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
            ReviewMaterial::create(['enterprise_id' => $user->enterprise_id, 'name' => 'license', 'note' => 'license','avatar' => $requests['license']]);
          }
          else
          {
              ReviewMaterial::where('enterprise_id', '=', $user->enterprise_id)->where('name','=','license')->delete();
              ReviewMaterial::create(['enterprise_id' => $user->enterprise_id, 'name' => 'license', 'note' => 'license','avatar' => $requests['license']]);
          }
        }
        if(array_key_exists('tax',$requests))
        {
          if(!$key_b)
          {
            ReviewMaterial::create(['enterprise_id' => $user->enterprise_id, 'name' => 'tax', 'note' => 'tax','avatar' => $requests['tax']]);
          }
          else
          {
              ReviewMaterial::where('enterprise_id', '=', $user->enterprise_id)->where('name','=','tax')->delete();
              ReviewMaterial::create(['enterprise_id' => $user->enterprise_id, 'name' => 'tax', 'note' => 'tax','avatar' => $requests['tax']]);
          }
        }
        if(array_key_exists('organizing',$requests))
        {
          if(!$key_c)
          {
            ReviewMaterial::create(['enterprise_id' => $user->enterprise_id, 'name' => 'organizing', 'note' => 'organizing','avatar' => $requests['organizing']]);
          }
          else
          {
              ReviewMaterial::where('enterprise_id', '=', $user->enterprise_id)->where('name','=','organizing')->delete();
              ReviewMaterial::create(['enterprise_id' => $user->enterprise_id, 'name' => 'organizing', 'note' => 'organizing','avatar' => $requests['organizing']]);
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
}

