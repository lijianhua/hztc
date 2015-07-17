<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\AdSpace;
use Illuminate\Http\Request;

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
      $para = [ 'filter_0' => ['北京','上海'], 'filter_1' =>['APP'], 'filter_2' =>['IT圈'], 'filter_7' => ['3']];
      $query = [] ;
      $query = $this -> get_query($para, $query);
      $query = ['query' => ['filtered' => ['filter' => ['bool'=> ['must' => $query]]]]];
      $results = AdSpace::searchByQuery($query)->getResults(); echo ($results); exit;
      print_r ($results);
      exit;
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
  private function get_query($para, $query)
  {
     foreach ($para as $index => $str) 
     {
        switch ($index) 
        {
            case 'filter_0':
              $query = $this -> get_search_array($para['filter_0'], 'city', $query);
              break;
            case 'filter_1':
              $query = $this -> get_search_array($para['filter_1'], 'name', $query);
              break;
            case 'filter_2':
              $query = $this -> get_search_array($para['filter_2'], 'name', $query);
              break;
            case 'filter_3':
              $query = $this -> get_search_array($para['filter_3'], 'name', $query);
              break;
            case 'filter_4':
              $query = $this -> get_search_array($para['filter_4'], 'name', $query);
              break;
            case 'filter_5':
              $query = $this -> get_search_array($para['filter_5'], 'name', $query);
              break;
            case 'filter_6':
              $query = $this -> get_search_array($para['filter_6'], 'name', $query);
              break;
            case 'filter_7':
              $query = $this -> get_search_array($para['filter_7'], 'type', $query);
              break;
        }
     }
     return $query;
  }
}


