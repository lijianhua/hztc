<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\AdSpace;
use Illuminate\Http\Request;
use Collection;
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
    $query = [] ;
    if ($para['city'] == '全部')
    {
    }
    else
    {
       array_push($query, ['terms' => ['city' => [trim($para['city'])] ]]);

    }
    if ($para['type'] == '全部')
    {
    }
    else
    {
       array_push($query, ['terms' => ['name' => [trim($para['type'])]]]);
    }
    if ($para['type2'] == '全部')
    {
    }
    else
    {
        array_push($query, ['terms' => ['name' => [trim($para['type2'])]]]);
    }
    if(is_numeric($para['start_price'])) 
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
      if(is_numeric($para['end_price']))
      {
        array_push($query, ['range' => ['price' => ['lte'=> trim($para['end_price'])]]]);
      }
      
    }
   $query = ['query' => ['filtered' => ['filter' => ['bool'=> ['must' => $query]]]]];
   $results = AdSpace::searchByQuery($query)->getResults(); echo ($results); exit;
  }
  public function search_list_filter()
  {
      //$para2 = $request->all();
    // $para = [ 
    //             'filter_0' => ['北京','上海'], //city
    //             'filter_1' =>['APP'],//name
    //             'filter_2' =>['IT圈'],//name 
    //             'filter_3' => ['APP'], //name
    //             'filter_4' =>['APP'],//name
    //             'filter_5' =>['IT圈'],//sex
    //             'filter_6' =>['IT圈'],//name
    //             'filter_7' => ['3'],//广告整体上的分类 如特价广告位、免费广告位、创意广告位
    //             'filter_8' => ['id']//排序的字段
    //         ];
      $para = [];
      $query = [] ;
      $query = $this -> get_query($para, $query);
      $query = ['query' => ['filtered' => ['filter' => ['bool'=> ['must' => $query]]]]];
      //$results = AdSpace::searchByQuery($query, ['per_page' => '1','offset' => '0'])->getResults(); echo ($results); exit;
      //$results = AdSpace::searchByQuery($query)->getTotal(); echo ($results); exit;
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
            case 'type':
              $query = $this -> get_search_array(array_values($para['type']), 'type', $query);
              break;
        }
     }
     return $query;
  }
}


