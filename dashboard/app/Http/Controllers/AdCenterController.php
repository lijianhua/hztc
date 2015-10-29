<?php

namespace App\Http\Controllers;

use HTML;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\AdCenter;

class AdCenterController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $adCenters = AdCenter::all();
    return view('centers.index', compact('adCenters'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  Request  $request
   * @return Response
   */
  public function store(Request $request)
  {
    $adCenter = AdCenter::create($request->all());

    return response()->json([
      'state' => 'OK',
      'message' => '添加成功',
      'data' => [
        $adCenter->id,
        $adCenter->name,
        HTML::image($adCenter->avatar->url()),
        "{$adCenter->created_at}"
      ]
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  Request  $request
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, $id)
  {
    $adCenter = AdCenter::find($id);
    $adCenter->fill($request->all());
    $adCenter->save();

    return response()->json([
      'state' => 'OK',
      'message' => '更新成功',
      'data' => [
        $adCenter->id,
        $adCenter->name,
        HTML::image($adCenter->avatar->url()),
        "{$adCenter->created_at}"
      ]
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
    AdCenter::destroy($id);
    return response()->json(['state' => 'OK', 'message' => '删除成功']);
  }
}
