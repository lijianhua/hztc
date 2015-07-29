<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\Navigator;
class AboutController extends Controller {

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
    return view('about.about')->with(compact('navigators'));
  }


  /**
   * Show the application dashboard to the user.
   *
   * @return Response
   */
  public function contact()
  {
    $nav = '首页';
    Session::put('current_navigator', $nav);
    $navigators = Navigator::all()->sortBy('sort');
    return view('about.contact')->with(compact('navigators'));
  }


  /**
   * Show the application dashboard to the user.
   *
   * @return Response
   */
  public function law()
  {
    $nav = '首页';
    Session::put('current_navigator', $nav);
    $navigators = Navigator::all()->sortBy('sort');
    return view('about.law')->with(compact('navigators'));
  }


  public function notFound()
  {
    return view('about.404')->with(compact(''));
  }


  public function notCode()
  {
    return view('about.500')->with(compact(''));
  }
}
