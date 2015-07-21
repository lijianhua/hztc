<?php

namespace App\Http\Controllers;

use HTML;
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
  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(PostSlideItemRequest $request, $slide_id)
  {
    $slide                = Slide::find($slide_id);
    $attributes           = $request->only('url', 'note', 'sort');
    $picture              = $request->file('picture');
    $attributes['avatar'] = $picture;
    $slideItem            = $slide->slideItems()->create($attributes);

    return response()->json([
      'state' => 'OK',
      'message' => '添加成功',
      'data' => [
        $slideItem->id,
        HTML::image($slideItem->avatar->url('thumb')),
        $slideItem->url,
        $slideItem->note,
        $slideItem->sort,
        $slideItem->slide_id
      ]]);
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
      $slideItem->avatar = $request->file('picture');

    $attributes = $request->only('url', 'note', 'sort');
    $slideItem->fill($attributes);
    $slideItem->save();

    return response()->json([
      'state' => 'OK',
      'message' => '更新成功',
      'data' => [
        $slideItem->id,
        HTML::image($slideItem->avatar->url('thumb')),
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
