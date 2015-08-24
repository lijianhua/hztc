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
use App\Http\Requests\UpdateAdSpaceRequest;

class AdSpaceController extends Controller
{
  /**
   * 广告位商业逻辑封装
   *
   * @var mixed $store
   **/
  protected $store;

  public function __construct()
  {
    $this->store = new \App\Reponsitories\AdSpaceReponsitory();

    parent::__construct();
  }

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
   * 等待审核页面
   *
   * @return response
   **/
  public function getWaitingAudited()
  {
    return view('ads.waitingAudited');
  }

  public function server()
  {
    $ads = AdSpace::with(['user', 'user.enterprise', 'address']);
    return $this->store->datatables($ads);
  }

  public function waitingAuditedServer()
  {
    $ads = AdSpace::waitingForAudited()->with(['user', 'user.enterprise', 'address']);
    return $this->store->datatables($ads);
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
    $ad = $this->store->store($request->all());

    if ($request->ajax()) {
      return response()->json([
        'state' => 'OK',
        'href'  => action('AdSpaceController@show', ['id' => $ad->id])
      ]);
    }

    return redirect()->action('AdSpaceController@show', ['id' => $ad->id])
                     ->with('status', '广告位添加成功！');
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
    $categories = AdCategory::roots()->get();

    return view('ads.show', compact('ad', 'categories'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $ad = AdSpace::findOrFail($id);
    $categories = AdCategory::roots()->get();

    return view('ads.edit', compact('ad', 'categories'));
  }

  /**
   * 获取编辑广告位所需要的信息
   *
   * @var int id
   * @return response
   **/
  public function getEditInformation($id)
  {
    $ad = AdSpace::with(['address', 'images', 'categories'])->findOrFail($id);

    return response()->json($this->store->fractal($ad));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(UpdateAdSpaceRequest $request, $id)
  {
    $ad = AdSpace::findOrFail($id);
    $this->store->update($ad, $request->all());

    if ($request->ajax()) {
      return response()->json([
        'state' => 'OK',
        'href'  => action('AdSpaceController@show', ['id' => $ad->id])
      ]);
    }

    return redirect()->action('AdSpaceController@show', ['id' => $ad->id])->with('status', '广告位更新成功。');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Request $request, $id)
  {
    $ad = AdSpace::findOrFail($id);
    $ad->delete();

    if ($request->ajax()) {
      return $this->okResponse('删除成功');
    } else {
      return redirect('ads')->with('status', '删除成功');
    }
  }

  /**
   * 审核广告位
   *
   * @return response
   **/
  public function audit(Request $request, $id)
  {
    AdSpace::whereId($id)->update(['audited' => true]);

    if ($request->ajax()) {
      // code...
    } else {
      return redirect()->back()->with('status', '审核通过');
    }
  }
}
