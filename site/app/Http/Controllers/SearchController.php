<?php namespace App\Http\Controllers;
use Redirect;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\AdSpace;
use Illuminate\Http\Request;
use Collection;
use App\Models\Navigator;
use App\Models\AdCategory;
use App\Models\Address;
class SearchController extends Controller {

  public function search(Request $request)
  {
    $q = $request->get('q');
    $results = AdSpace::search($q)->getResults();
    echo $results;exit;
  }
  public function search_index_filter(Request $request)
  {
    $para = $request->all();
    unset($para['_token']);
    $query = $this->get_price_array($para);
    foreach($para as $index=>$value)
    {
      if($value=='全部' || $value=='')
      {
        unset($para[$index]);
      } 
    }
    $list = [];
    foreach($para as $index=>$value)
    {
      if($index=='city') 
      {
        $list['cities']= [$value];
      }
      if($index=='type') 
      {
        $list['categories_0']= [$value];
      }
      if($index=='type2') 
      {
        $list['categories_5']= [$value];
      }
      if($index=='start_price') 
      {
        $list['start_price']= $value;
      }
      if($index=='end_price') 
      {
        $list['end_price']= $value;
      }
      if($index=='q') 
      {
        $list['q']= $value;
      }
    }
    $str = $this->get_url_str($list,$str='');
    return Redirect::to('/list/all-ads/id?'.$str);
  }
  public function search_list_filter()
  {
      $para = [];
      $query = [] ;
      $query = $this -> get_query($para, $query);
      $query = ['query' => ['filtered' => ['filter' => ['bool'=> ['must' => $query]]]]];
      $results = AdSpace::searchByQuery($query, ['per_page' => '1','offset' => '0'])->getResults();
      $list = [];
      foreach($results as $result)
      {
        array_push($list, $result->id);
      } 
      $query = AdSpace::whereIn('id', $list)->get();
      return (new AdSpaceController)->get_list_view('全部广告位', '', 'id', 'all-ads', $results);
  } 
  private function get_search_array($array_str, $field_name, $query)
  {
      $array_str = $this->trim_array_str($array_str);
      if(count($array_str) !=0 )
      {
        array_push($query, ['terms' => [$field_name => $array_str]]);
      }
      return $query;
  }
  private function trim_array_str($array_str)
  {
      foreach($array_str as $index => $str) 
      {
          if(is_array($str))
          {
            $this->trim_array_str($str);
          }
          else
          {
            $array_str[$index] = trim($str);
          }
      }
      return $array_str ;
  }
  public function get_query($para, $query=[])
  {
     foreach ($para as $index => $str) 
     {
        switch ($index) 
        {
            case 'cities':
              $query = $this -> get_search_array(array_values($para['cities']), 'city', $query);
              break;
            case 'categories_0':
              $query = $this -> get_search_array(array_values($para['categories_0']), 'name', $query);
              break;
            case 'categories_1':
              $query = $this -> get_search_array(array_values( $para['categories_1']), 'name', $query);
              break;
            case 'categories_2':
              $query = $this -> get_search_array(array_values($para['categories_2']), 'name', $query);
              break;
            case 'categories_3':
              $query = $this -> get_search_array(array_values($para['categories_3']), 'name', $query);
              break;
            case 'categories_4':
              $query = $this -> get_search_array(array_values($para['categories_4']), 'name', $query);
              break;
            case 'categories_5':
              $query = $this -> get_search_array(array_values($para['categories_5']), 'name', $query);
              break;
            case 'categories_6':
              $query = $this -> get_search_array(array_values($para['categories_6']), 'name', $query);
              break;
            case 'type':
              $query = $this -> get_search_array(array_values($para['type']), 'type', $query);
              break;
            case 'puid':
              $query = $this -> get_search_array(array_values([$para['puid']]), 'user_id', $query);
              break;
        }
     }
     return $query;
  }
  public function get_price_array($para, $query=[])
  {
    if(array_key_exists('start_price', $para))
    {
        if(is_numeric($para['start_price'])) 
        {
            if(array_key_exists('end_price', $para))
            {
                if(is_numeric($para['end_price']))
                {
                  array_push($query, ['range' => ['price' => ['gte'=> trim($para['start_price']),'lte'=> trim($para['end_price'])]]]);
                }
                else
                {
                  array_push($query, ['range' => ['price' => ['gte'=> trim($para['start_price'])]]]);
                }
            }
            else
            {
                  array_push($query, ['range' => ['price' => ['gte'=> trim($para['start_price'])]]]);
            }
        }
        else
        {
            if(array_key_exists('end_price', $para))
            {
                if(is_numeric($para['end_price']))
                {
                  array_push($query, ['range' => ['price' => ['lte'=> trim($para['end_price'])]]]);
                }
            }
        }
    }
    else
    {
      if(array_key_exists('end_price', $para))
      {
          if(is_numeric($para['end_price']))
          {
            array_push($query, ['range' => ['price' => ['lte'=> trim($para['end_price'])]]]);
          }
      }

    }
    return $query;
  }
  public function get_url_str($list,$str='')
  {
    if(is_array($list))
    {
        if(count($list)>0)
        {
            foreach($list as $key => $inner_list)
            {
              if(is_array($inner_list))
              {
                  foreach($inner_list as $index => $value)
                  {
                    $str = $str.$key.'['.$index.']'.'='.$value.'&' ;
                  }
              }
              else
              {
                  $str = $str.$key.'='.$inner_list.'&' ;
              }
            }
            $str = rtrim($str,'&');
        }
    }
    return $str;
  }
}


