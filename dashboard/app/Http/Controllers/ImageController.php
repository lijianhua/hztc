<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Reponsitories\ImageUploadReponsitory;

class ImageController extends Controller
{
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
  public function store(Request $request)
  {
    $images = array_get($request->all(), 'images');

    if (!empty($images)) {
      $uploaded = [];

      foreach ($images as $image) {
        $__image = new Image();
        $__image->avatar = $image;
        $__image->save();

        array_push($uploaded, $__image);
      }

      return response()->json(ImageUploadReponsitory::krajee($uploaded));
    }
  }

  public function ckeditor(Request $request)
  {
    $image = new Image();
    $image->avatar = $request->file('upload');
    $image->save();

    $funcNum = $request->get("CKEditorFuncNum");
    $url     = $image->avatar->url();
    $message = "";

    return "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
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
    Image::destroy($id);

    return response()->json([]);
  }
}
