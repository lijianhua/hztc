<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\Navigator;
use App\Models\AdSpace;
use App\Models\AdPrice;
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


    return view('list')->with(compact('navigators', 'adspaces'));
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
