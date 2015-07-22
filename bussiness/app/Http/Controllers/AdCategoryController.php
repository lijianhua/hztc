<?php

namespace App\Http\Controllers;

use Datatables;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\AdCategory;
use App\Reponsitories\AdCategoryReponsitory;
use App\Http\Requests\PostAdCategoryRequest;
use App\Http\Requests\UpdateAdCategoryRequest;

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
  public function store(PostAdCategoryRequest $request)
  {
    $category = AdCategory::create($request->only(['name']));

    $parentId = $request->get('parent_id');
    if (!is_null($parentId) && strtolower($parentId) != 'null') {
      $parent = AdCategory::find($parentId);
      $category->makeChildOf($parent);
    }

    $repons = new AdCategoryReponsitory($category);
    $data   = $repons->convertToDatatableArrayWithRowId('id');

    return $this->okResponse("创建成功", $data);
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
  public function update(UpdateAdCategoryRequest $request, $id)
  {
    $category = AdCategory::with('parent')->find($id);
    $category->update($request->only(['name']));

    // 更改父类
    $parentId = $request->get('parent_id');

    if ($parentId != $category->parent_id) {
      if (is_null($parentId) || strtolower($parentId) == 'null') {
        $category->makeRoot();
      } else {
        $parent = AdCategory::find($parentId);
        $category->makeChildOf($parent);
      }
    }

    $repons = new AdCategoryReponsitory($category);
    $data   = $repons->convertToDatatableArrayWithRowId('id');

    return $this->okResponse("更新成功", $data);
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
      return $this->okResponse("删除成功");
    }

    return $this->failResponse("该分类下还有其他子分类，无法删除！");
  }

  /**
   * 获取所有的顶级分类
   *
   * @return response
   **/
  public function roots()
  {
    $categories = AdCategory::roots()->get();
    return response()->json($categories->toArray());
  }
}
