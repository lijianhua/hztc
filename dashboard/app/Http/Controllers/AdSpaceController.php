<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\AdCategory;
use App\Http\Requests\PostAdSpaceRequest;

class AdSpaceController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    return view('ads.index');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $categories = AdCategory::roots()->get();

    return view('ads.create')->with(compact('categories'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(PostAdSpaceRequest $request)
  {
    $store = new \App\Reponsitories\AdSpaceReponsitory();
    $store->store($request->all());

    return redirect()->action('AdSpaceController@index')->with('status', '广告位添加成功！');
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
    //
  }
}
