<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\UpdateNavigatorRequest;
use App\Http\Controllers\Controller;
use App\Models\Navigator;

use Illuminate\Http\Request;

class NavigatorController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $navigators = Navigator::all()->sortBy('sort');
    return view('navigators.index')->with(compact('navigators'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(UpdateNavigatorRequest $request, $id)
  {
    $attributes = $request->only('name', 'url', 'state', 'sort');
    $navigator  = Navigator::find($id);
    $navigator->update($attributes);
    return response()->json([
      'state'   => 'OK',
      'message' => '更新成功',
      'data'    => $navigator->toArray()
    ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $navigator = Navigator::find($id);

    if (is_null($navigator))
      return response()->json(['state' => 'error', 'message' => '不存在这个导航']);

    $navigator->delete();
    return response()->json(['state' => 'OK', 'message' => '删除成功']);
  }

  /**
   * 切换导航状态
   *
   * @param  int $id
   * @return Response
   **/
  public function toggle($id)
  {
    $navigator = Navigator::find($id);

    if (is_null($navigator))
      return response()->json(['state' => 'error', 'message' => '不存在这个导航']);

    $navigator->state = !$navigator->state;
    $navigator->save();

    return response()->json(['state' => 'OK', 'message' => '导航状态切换成功']);
  }

}
