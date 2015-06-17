<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UpdateSlideItemRequest;
use App\Http\Requests\PostSlideItemRequest;
use App\Http\Controllers\Controller;
use App\Models\Slide;
use App\Models\SlideItem;
use App\Reponsitories\ImageReponsitory;

class SlideItemController extends Controller
{
  protected $imageRepons;

  public function __construct(ImageReponsitory $imageRepons)
  {
    $this->imageRepons = $imageRepons;
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    //
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
  public function store(PostSlideItemRequest $request, $slide_id)
  {
    $slide = Slide::find($slide_id);
    $attributes = $request->only('url', 'note', 'sort');
    $picture = $this->imageRepons->save($request->file('picture'));
    $attributes['picture'] = $picture->getFilename();

    $slideItem = $slide->slideItems()->create($attributes);
    return response()->json([
      'state' => 'OK',
      'message' => '添加成功',
      'data' => [
        $slideItem->id,
        $this->imageRepons->tag($slideItem->picture, ['height' => 100]),
        $slideItem->url,
        $slideItem->note,
        $slideItem->sort,
        $slideItem->slide_id
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
  public function update(UpdateSlideItemRequest $request, $silde_id, $id)
  {
    $slideItem = SlideItem::find($id);

    if ($request->hasFile('picture'))
      $picture = $this->imageRepons->save($request->file('picture'));

    $attributes = $request->only('url', 'note', 'sort');

    if (isset($picture))
      $attributes['picture'] = $picture->getFilename();

    $slideItem->update($attributes);

    return response()->json([
      'state' => 'OK',
      'message' => '更新成功',
      'data' => [
        $slideItem->id,
        $this->imageRepons->tag($slideItem->picture, ['height' => 100]),
        $slideItem->url,
        $slideItem->note,
        $slideItem->sort,
        $slideItem->slide_id
      ]]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($slide_id, $id)
  {
    SlideItem::where(['slide_id' => $slide_id, 'id' => $id])->delete();
    return response()->json(['state' => 'OK', 'message' => '删除成功']);
  }
}
