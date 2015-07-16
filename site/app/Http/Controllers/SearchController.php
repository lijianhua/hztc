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
}


