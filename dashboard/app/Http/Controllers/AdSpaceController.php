<?php

namespace App\Http\Controllers;

use HTML;
use Datatables;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\AdCategory;
use App\Models\AdSpace;
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

  public function server()
  {
    $ads = AdSpace::with(['user', 'user.enterprise', 'address']);
    return Datatables::of($ads)
      ->editColumn('title', function ($ad) {
        return HTML::link(url('ads/' . $ad->id), $ad->title, [
          'title'          => '查看详情',
          'data-toggle'    => 'tooltip',
          'data-placement' => 'right'
        ]);
      })
      ->editColumn('type', function ($ad) {
        switch ($ad->type) {
          case 0:
            return '正常广告';
            break;
          case 1:
            return '免费广告';
            break;
          case 2:
            return '特价广告';
            break;
          case 3:
            return '创意广告';
            break;
        }
      })
      ->editColumn('street_address', function ($ad) {
        return $ad->address->province . '  ' .
               $ad->address->city . '  ' .
               $ad->address->area . '  ' .
               $ad->street_address;
      })
      ->editColumn('audited', function ($ad) {
        if ($ad->audited) {
          return '<span class="label label-success">已审核</span>';
        } else {
          return '<span class="label label-danger">未通过审核</span>';
        }
      })
      ->setRowId('id')
      ->make(true);
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
    $ad = AdSpace::findOrFail($id);

    return view('ads.show', compact('ad'));
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
    $ad = AdSpace::findOrFail($id);
    $ad->delete();
    return $this->okResponse('删除成功');
  }
}
