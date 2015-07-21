<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Slide;
use App\Http\Requests\UpdateSlideRequest;
use App\Reponsitories\ImageReponsitory;

class SlideController extends Controller
{
  protected $imageRepons;

  public function __construct(ImageReponsitory $imageRepons)
  {
    $this->imageRepons = $imageRepons;

    parent::__construct();
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $slides = Slide::all();
    return view("slides.index")->with(compact('slides'));
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
  public function store(UpdateSlideRequest $request)
  {
    $slide = Slide::create($request->only('belongs_page'));
    $slideDetailUrl = url('slides', [$slide->id]);
    return response()->json([
      'state' => 'OK',
      'message' => '保存成功',
      'data' => [
        $slide->id,
        "<a href=\"{$slideDetailUrl}\" title=\"查看详情\" data-toggle=\"tooltip\" data-placement=\"right\">{$slide->belongs_page}</a>",
        "{$slide->created_at}",
        "{$slide->updated_at}"
      ]]);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    $slide  = Slide::find($id);
    $repons = $this->imageRepons;
    return view('slides.show')->with(compact('slide', 'repons'));
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
  public function update(UpdateSlideRequest $request, $id)
  {
    $slide = Slide::find($id);
    $slide->update($request->only('belongs_page'));
    $slideDetailUrl = url('slides', [$slide->id]);
    return response()->json([
      'state' => 'OK',
      'message' => '更新成功',
      'data' => [
        $slide->id,
        "<a href=\"{$slideDetailUrl}\" title=\"查看详情\" data-toggle=\"tooltip\" data-placement=\"right\">{$slide->belongs_page}</a>",
        "{$slide->created_at}",
        "{$slide->updated_at}"
      ]]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    Slide::destroy($id);
    return response()->json(['state' => 'OK', 'message' => '删除成功']);
  }
}
