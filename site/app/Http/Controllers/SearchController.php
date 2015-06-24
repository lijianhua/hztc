<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\AdSpace;
class SearchController extends Controller {

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
    $city = '北京';
    $type = '新媒体';
    $circle = '财富圈';
    $start_price = 100;
    $end_price   = 5000;

    //$spaces = AdSpace::join('ad_prices', 'ad_spaces.id', '=', 'ad_prices.Ad_space_id')
    //  ->where('price', '>=', $start_price)
    //  ->where('price', '<=', $end_price)
    //  ->join('addresses', 'ad_spaces.address_id', '=', 'addresses.id')
    //  ->where('city', '=', $city)
    //  ->join('ad_category_ad_space', 'ad_spaces.id', '=', 'ad_categoroy_ad_space.ad_space_id')
    //  ->join('ad_categories', 'ad_categoroy_ad_space.ad_category_id', '=', 'ad_categoroies.id')
    //  ->whereIn('name', [$type, $circle])
    //  ->get();
    $spaces = AdSpace::join('ad_prices', 'ad_spaces.id', '=', 'ad_prices.Ad_space_id')
      ->where('price', '>=', $start_price)
      ->where('price', '<=', $end_price)
      ->join('addresses', 'ad_spaces.address_id', '=', 'addresses.id')
      ->where('city', '=', $city)
      ->get();

    print_r($spaces);


  }

}
