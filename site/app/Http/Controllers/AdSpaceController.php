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
        return $this->get_list_view($value['name'], $value['type'], $sort, $index, Arr::get($request->all(), 'page', 1),$request->all());
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
    $ideas = AdSpace::creative();
    

    //APP自媒体广告
    $company_name = Enterprise::find(User::find($adspace->user_id)->enterprise_id)->name;
    $app_medias = AdSpace::app_media($company_name);
    return view('show')->with(compact('navigators', 'adspace', 'collect', 'comments', 'type', 'ideas', 'company', 'app_medias'));
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
    return view('list')->with(compact('navigators', 'adspaces', 'ideas', 'cities', 'adcategories', 'current_category', 'sort', 'current_page', 'total','query_array','str'));
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
