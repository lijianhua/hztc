<?php

namespace App\Http\Controllers;

use Datatables;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\AdCategory;

class AdCategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    return view('categories.index');
  }

  /**
   * 用于获取分类数据的API
   *
   * @return Response
   **/
  public function server(Request $request)
  {
    $categories = AdCategory::with('parent');
    return Datatables::of($categories)->setRowId('id')->make(true);
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
  public function update($id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $category = AdCategory::find($id);

    if ($category->isLeaf()) {
      $category->delete();
      return response()->json(['state' => 'OK', 'message' => '删除成功。']);
    }

    return response()->json(['state' => 'Fail', 'message' => '该分类下面还有其他子分类，无法删除！']);
  }
}
