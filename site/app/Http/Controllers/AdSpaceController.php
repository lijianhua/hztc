<?php namespace App\Http\Controllers;
use DB;
use Input;
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
use App\Models\Promotion;
use App\Models\CustomerReview;
use App\Models\Enterprise;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\AdCenter;
use Cookie;
use Response;

class AdSpaceController extends Controller {

  /**
   * Create a new controller instance.
   *
   * @return void
   */
   private $list_array = array('all-ads'=>['name'=>'全部广告资源', 'type'=> ''], 'free-ads'=>['name'=>'免费广告资源', 'type'=> 2],'special-ads'=>['name'=>'特价广告资源','type'=> 1], 'creative-ads'=>['name'=>'新奇特广告资源', 'type'=> 3]);
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
        return $this->get_list_view($value['name'], $value['type'], $sort, $index, Arr::get($request->all(), 'page', 1),$request->all(), 1);
      }
    }
  }
  /**
   * Show free adspaces 
   *
   * @return Response
   */
  public function free()
  {

    $nav = '免费广告资源';
    $navigators = $this->navigators;
    Session::put('current_navigator', $nav);


    $adspaces = Promotion::with(['adSpace'])->SoonOrProccessing()->recent()->paginate(2);
    $ideas     = AdSpace::creative();
    return view('free')->with(compact('navigators', 'adspaces', 'ideas'));
  }


  /**
   *
   * 购买此广告的人还购买了
   */
  public function rebuy($gid)
  {
    $oritem = OrderItem::where('ad_space_id', '=', $gid)
      ->orderBy('created_at', 'desc')->take(5)->get();
    if ($oritem)
    {
      $uarry = array();
      foreach ($oritem as $or)
      {
        array_push($uarry, $or->order->user_id);
      }
      $uarry = array_unique($uarry);
      $rebuy =  array();
      foreach ($uarry as $ua)
      {
        $adsp = Order::with(['orderItems'])
          ->where('orders.user_id', '=', $ua)
          ->orderBy('created_at', 'desc')
          ->firstOrFail();
        $ad = AdSpace::find($adsp->orderItems->first()->ad_space_id);
        array_push($rebuy,[$ad->id, $ad->title]);
      }
      return $rebuy;
    }else {
      return array();
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
    $comments = CustomerReview::where('ad_space_id', '=', $id)->orderBy('created_at', 'desc')->paginate(15);
    $user_id = AdSpace::where('id', '=', $id)->first()->user_id;
    $company = Enterprise::where('id', '=', User::where('id', '=', $user_id)->first()->enterprise_id)->first();

    //分类广告中心
    $centers = $company->adCenters;
    $carray = array(
      '报纸' => '8',
      '户外' => '51',
      '微信' => '3',
      '微博' => '4',
      '网络' => '9',
      'App'  => '6',
      '电视' => '10',
      '广播' => '50',
      '室内' => '61',
      '其他' => '62',
      '热门活动' => '2',
    );

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
    $list = [];
    $str_type = '';
    $list=explode(',', $this->adSpaceType($adspace));
    foreach($list as $index => $value)
    {
      $str_type = $str_type.'categories_0'.'['.$index.']'.'='.$value.'&';
    }
    $type = rtrim($str_type,'&');
    //创意类广告
    //更多同类新奇特
    $ideas = AdSpace::creativeType($list);
    //本公司推荐 
    $company_name = Enterprise::find(User::find($adspace->user_id)->enterprise_id)->name;
    $app_medias = AdSpace::app_media($company_name);

    //购买此广告位的人还购买了
    $rebuy = $this->rebuy($id);

    //关注度
    $active = $this->active($id);

    //对比
    $contrast = Cookie::get('contrast');
    $iscontrast = $contrast?in_array($id, $contrast):0;

    //大V
    $query_array = array('puid'=>$user_id, 'categories_0' => array('5' => '名人大V'));
    $adspacev = $this->get_list_view('全部广告资源', '', 'id', 'all-ads', 1, $query_array, 0);
    $position = $this->position($adspace);

    return view('show')->with(compact('navigators', 'adspace', 'collect', 'comments', 'type', 'ideas', 'company', 'app_medias', 'rebuy','iscontrast', 'adspacev', 'centers', 'carray', 'active', 'position'));
  }
 

  /**
   * 版位
   *
   */
  public function position($adspace)
  {
    $adprices = $adspace->AdPrices;
    $position = array();
    foreach($adprices as $adprice)
    {
      array_push($position, $adprice->position);
    }
    return count(array_unique($position));
  }

  /**
   *加入对比
   *
   */
  public function addContrast(){
    $id = Input::get('id');
    if (Cookie::has('contrast')){
      $contrast = Cookie::get('contrast');
      if (!in_array($id, $contrast))
      {
        array_push($contrast, $id);
        Cookie::queue('contrast', $contrast, 10);
      }
      else
      {
        return response()->json(['state' => '0']);
      }
    }
    else {
      $contrast = array($id);
      Cookie::queue('contrast', $contrast, 10);
    }
    return response()->json(['state' => '1']);
  }

  /**
   * 查看对比
   *
   */
  public function getContrast(){
    $nav = '首页';
    Session::put('current_navigator', $nav);
    $navigators = Navigator::all()->sortBy('sort');
    $adspaces = array();
    if (Cookie::has('contrast'))
    {
      $contrast = Cookie::get('contrast');
      foreach ($contrast as $gid)
      {
        $adspace   = AdSpace::with(['adPrices', 'images', 'customerReviews'])
          ->where('ad_spaces.audited', '=', 1)
          ->where('id', '=', $gid)
          ->firstOrFail();
        $adspace = $this->filter_merge($adspace);
        $adspaces = array_merge($adspaces, $adspace);
      }
    }
    return view('contrast')->with(compact('navigators', 'adspaces'));

  }

  /**
   * 整理字段
   *
   */
  public function filter_merge($adspace)
  {
    $user_id = AdSpace::where('id', '=', $adspace->id)->first()->user_id;
    $company = Enterprise::where('id', '=', User::where('id', '=', $user_id)->first()->enterprise_id)->first();
    return array([
        'id'  => $adspace->id,
        'name' => $adspace->title,
        'image' => $adspace->avatar->url(),
        'kprice' => $adspace->adPrices->min('original_price'),
        'dw' => $adspace->AdPrices->max('unit')?$adspace->AdPrices->max('unit'):'期',
        'zprice' => $adspace->adPrices->min('price'),
        'area' => $adspace->address->province.' '.$adspace->address->city.' '.$adspace->address->area,
        'mj' => $this->typeEcho($adspace, 1),
        'mtsx' => $this->typeEcho($adspace, 11),
        'szsr' => $this->typeEcho($adspace, 22),
        'age' => $this->typeEcho($adspace, 26),
        'sex' => $this->typeEcho($adspace, 31),
        'szr' => $this->typeEcho($adspace, 34),
        'description' => $adspace->description,
        'gname' => $company->name,
        'gimage' => $company->avatar->url(),
        'gtelphone' => $company->telphone,
        'gemail' => $company->email,
        'active' => $this->active($adspace->id),
        'influence' => $adspace['influence'],
      ]);
  }

  // 组织类型字段
  public function typeEcho($adspace, $tid)
  {
    $category = '';
    foreach ($adspace->categories as $categories)
    {
      if ($categories->parent_id == $tid)
      {
        $category .= $categories->name.',';
      }
    }
    return rtrim($category, ",");
  }


  /**
   * 关注度
   *
   *
   */
  public function active($id)
  {
    $adspace = AdSpace::find($id);
    $adspace->attraction_rate+= 1;
    $adspace->save();
    $active = $adspace->attraction_rate;
    if ($active <= 50)
    {
      $active = 1;
    }
    else if ($active > 50 && $active <= 100){
      $active = 2;
    }
    else if ($active > 100 && $active <= 200){
      $active = 3;
    }
    else if ( $active > 200 && $active <= 300){
      $active = 4;
    }
    else if ($active > 300){
      $active = 5;
    }
    return $active;

  }

  /**
   * 删除对比
   *
   */
  public function delContrast(){
    $id = Input::get('id');
    if (Cookie::has('contrast'))
    {
      $contrast = Cookie::get('contrast');
      unset($contrast[array_search($id, $contrast)]);
      Cookie::queue('contrast', $contrast, 10);
      return Response::json(array('status'=>'ok' ));
    }
    else {
      return Response::json(array('status'=>'fail' ));
    }
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
  private function get_list_view($nav, $type_nu, $sort, $current_category,$page,$query_array, $check=1)
  {
    Session::put('current_navigator', $nav);
    $navigators = $this->navigators;
    $adcategories = '';
    if($current_category == 'creative-ads')
    {
        $adcategories = AdCategory::where('parent_id', '=', NULL)->get(); 
    }
    else
    {
        $adcategories = AdCategory::where('parent_id', '=', NULL)->where('name', '!=', '新奇特广告')->get(); 
    }
    $cities = Address::groupBy('city')->lists('city'); 
    $query = '';
    if(array_key_exists('page', $query_array))
    {
      unset($query_array['page']);
    }
    if($type_nu=='')
    {
      $query = (new SearchController())->get_query(['type' => [0,1,3]], []);
    }
    else
    {
      $query = (new SearchController())->get_query(['type' => [$type_nu]], []);
    }
    if(array_key_exists('puid', $query_array))
     {
        $company_id = User::where('enterprise_id', '=', User::find($query_array['puid'])->enterprise_id)->lists('id'); 
        $query_array['puid'] = $company_id;
     }
    $query_price = (new SearchController())->get_price_array($query_array, $query);
    $query = (new SearchController())->get_query($query_array,$query_price);
    $str = (new SearchController())->get_url_str($query_array);
    $q = '';
    if(array_key_exists('q', $query_array))
    {
      $q = $query_array['q']; 
    }
    $para = AdSpace::get_ideas_adspaces($type_nu, $sort, $query, $page, $per_page='6',$q);
    $adspaces = $para['adspaces'];
    $ideas = $para['ideas'];
    $current_page = $para['current_page'];
    $total = $para['total'];
    $query_str = [];
    foreach($query_array as $index => $value)
    {
        if(is_array($value)) 
        {
          foreach($value as $inner_index => $inner_value)
          {
            array_push($query_str,$inner_value); 
          }
        }
        else
        {
          array_push($query_str, $value);
        }
    }
    $query_array = $this->get_clean_query_array(array_diff_assoc($query_str,array_unique($query_str)),$query_array);
    foreach($query_array as $index => $value)
    {
      if(is_array($value) )
      {
            $query_array[$index] = array_filter($value);
      }
      else
      {
        if($value == '') 
        {
          unset($query_array[$index]); 
        }
      }
    }
    if(array_key_exists('puid',$query_array))
    {
      $user_id = User::find($query_array['puid'][0])->enterprise_id;
      $query_array['puid'] = Enterprise::whereId($user_id)->first()->name; 
    }
    if ($check == 1)
    {
      return view('list')->with(compact('navigators', 'adspaces', 'ideas', 'cities', 'adcategories', 'current_category', 'sort', 'current_page', 'total','query_array','str'));
    }
    else
    {
      return $adspaces;
    }
  }
  public function get_clean_query_array($str, $list)
  {
    $repetition='';
    foreach($str as $name)
    {
      foreach($list as $index => $value)
      {
        if(is_array($value)) 
        {
          foreach($value as $inner_index => $inner_value) 
          {
            if($inner_value != $repetition)
            {
                if($inner_value == $name) 
                {
                  unset($list[$index][$inner_index]);
                  $repetition = $name;
                }
            }
          }
        }
      }  
    }
    return $list;
  }

}
