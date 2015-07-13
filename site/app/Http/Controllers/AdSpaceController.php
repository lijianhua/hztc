<?php namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Session;
use App\Models\Navigator;
use App\Models\AdSpace;
use App\Models\AdPrice;
use Illuminate\Database\Eloquent\Collection;
use App\Models\AdSpaceUser;
use Auth;
use Illuminate\Http\Request;

class AdSpaceController extends Controller {

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    // $this->middleware('auth');
    $this->navigators = Navigator::all()->sortBy('sort');
  }

  /**
   * Show all adspaces 
   *
   * @return Response
   */
  public function index()
  {
    $nav = '全部广告位';
    Session::put('current_navigator', $nav);
    $navigators = $this->navigators;

    $adspaces   = AdSpace::with(['adPrices', 'images', 'orderItems', 'adSpaceUsers'])
      ->where('ad_spaces.audited', '=', 1)
      ->paginate(9);
    $ideas = AdSpace::leftjoin('ad_prices', 'ad_spaces.id', '=', 'ad_prices.ad_space_id')
                  ->leftjoin('order_items', 'ad_spaces.id', '=', 'order_items.ad_space_id')
                  ->leftjoin('ad_space_users', 'ad_spaces.id', '=', 'ad_space_users.ad_space_id')
                  ->where('ad_spaces.audited', '=', '1')
                  ->where('ad_spaces.type', '=', '3')
                  ->orderBy('order_items.quantity', 'desc')
                  ->get();
    return view('list')->with(compact('navigators', 'adspaces', 'ideas'));
  }



  /**
   * 广告位详情
   *
   */
  public function show($id)
  {
    $nav = '首页';
    $navigators = $this->navigators;
    Session::put('current_navigator', $nav);


    $adspace   = AdSpace::with(['adPrices', 'images', 'customerReviews'])
      ->where('ad_spaces.audited', '=', 1)
      ->where('id', '=', $id)
      ->firstOrFail();

    //print_r($adspace->customerReviews->sum('id'));exit;

    return view('show')->with(compact('navigators', 'adspace'));
  }
 
  /**
   * 收藏
   *
   */
  public function addCollect(Request $request)
  {
    $id = $request->input('id');
    $collect = new AdSpaceUser;
    if (Auth::check())
    {
      if (!$this->checkCollect($id, Auth::user()->id))
      {
        $collect->ad_space_id = $id;
        $collect->user_id = Auth::user()->id;
        $collect->save();
        return response()->json(['name' => 'error', 'state' => '1']);
      }
      else
      {
        return response()->json(['name' => 'error', 'state' => '2']);
      }

      
    }
    else
    {
      return response()->json(['name' => 'error', 'state' => '3']);
    }
  }

  /**
   * 验证收藏
   *
   */
  public function checkCollect($aid, $uid)
  {
    $iscollect = AdSpaceUser::where('ad_space_id', '=', $aid)
      ->where('user_id', '=', $uid)
      ->count();
    return $iscollect;

  }

}
