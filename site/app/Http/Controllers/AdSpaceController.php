<?php namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Session;
use App\Models\Navigator;
use App\Models\AdSpace;
use App\Models\AdPrice;
use Illuminate\Database\Eloquent\Collection;
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
 

}
