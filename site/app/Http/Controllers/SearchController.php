<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\AdSpace;
use Illuminate\Http\Request;

class SearchController extends Controller {

  public function search(Request $request)
  {
    $q = $request->get('q');
    $results = AdSpace::search($q)->getResults()->first();

    var_dump($results); exit;
  }
}
