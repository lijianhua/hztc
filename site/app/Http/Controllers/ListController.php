<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\Navigator;
use App\Models\Slide;
use App\Models\SlideItem;
class ListController extends Controller {

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
    $nav = '首页';
    Session::put('current_navigator', $nav);
    $navigators = Navigator::all()->sortBy('sort');
    $slides     = Slide::all()->where('belongs_page', $nav);
    return view('home')->with(compact('navigators', 'slides'));
  }

}
