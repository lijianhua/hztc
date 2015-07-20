<?php namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Session;
use App\Models\Navigator;
use App\Models\AdSpace;
use App\Models\AdPrice;
use Illuminate\Database\Eloquent\Collection;
use App\Models\AdSpaceUser;
use Illuminate\Support\Arr;
use Auth;
use Illuminate\Http\Request;
use App\Models\AdCategory;
use App\Models\Address;
use App\Models\CustomerReview;

class AdSpaceController extends Controller {

  /**
   * Create a new controller instance.
   *
   * @return void
   */
   private $list_array = array('all-ads'=>['name'=>'全部广告位', 'type'=> ''], 'free-ads'=>['name'=>'免费广告位', 'type'=> 1],'special-ads'=>['name'=>'特价广告位','type'=> 2], 'creative-ads'=>['name'=>'创意广告位', 'type'=> 3]);
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
  public function ad_list(Request $request, $list_name, $sort = 'id')
  {

    foreach($this->list_array as $index => $value)
    {
      if(trim($index) == trim($list_name))
      {
        return $this->get_list_view($value['name'], $value['type'], $sort, $index, Arr::get($request->all(), 'page', 1),$request->all());
      }
    }
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

    //商品评论
    $comments = CustomerReview::where('ad_space_id', '=', $id)->paginate(1);

    //是否收藏
    if (Auth::check())
    {
      $collect = AdSpaceUser::where('ad_space_id', '=', $id)
        ->where('user_id', '=', Auth::user()->id)
        ->count();
    }else{
      $collect = 0;
    }

    //广告类型
    $type = $this->adSpaceType($adspace);

    return view('show')->with(compact('navigators', 'adspace', 'collect', 'comments', 'type'));
  }
 

  /**
   * 广告类型
   *
   *
   */
  public function adSpaceType($adspace)
  {
    $categories = $adspace->categories;
    $type = '';
    foreach ($categories as $category)
    {
      $type .= $category->name. ',';
    }

    return rtrim($type, ',');
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
  private function get_list_view($nav, $type_nu, $sort, $current_category,$page,$query_array)
  {
    Session::put('current_navigator', $nav);
    $navigators = $this->navigators;
    $adcategories = AdCategory::where('parent_id', '=', NULL)->get(); 
    $cities = Address::groupBy('city')->lists('city'); 
    $query = '';
    if($type_nu=='')
    {
      $query = (new SearchController())->get_query(['type' => [1,2,3]], []);
    }
    else
    {
      $query = (new SearchController())->get_query(['type' => [$type_nu]], []);
    }
   // $query = (new SearchController())->get_query(['cities' => ['北京市','上海市']], $query);
    $query = (new SearchController())->get_query($query_array,$query);
    // print_r ($query);
    // exit;
    // print_r($query_array);
    // exit;
    $para = AdSpace::get_ideas_adspaces($type_nu, $sort, $query, $page);
    $adspaces = $para['adspaces'];
    $ideas = $para['ideas'];
    $current_page = $para['current_page'];
    $total = $para['total'];
    return view('list')->with(compact('navigators', 'adspaces', 'ideas', 'cities', 'adcategories', 'current_category', 'sort', 'current_page', 'total','query_array'));
  }

}
