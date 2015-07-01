<?php

namespace App\Reponsitories;

/**
 * 用来处理上传后的照片
 *
 **/
class ImageUploadReponsitory
{
  /**
   * 上传成功后生成krajee bootstrap fileinput
   * 所需要的返回值
   *
   * @var mixed $uploaded
   * @var boolean $append default true
   * @return array
   **/
  public static function krajee($uploaded, $append = true)
  {
    if (!is_array($uploaded))
      $uploaded = [$uploaded];

    $result = [
      'initialPreview' => [],
      'initialPreviewConfig' => [],
      'append' => $append
    ];

    foreach ($uploaded as $image) {
      array_push($result['initialPreview'], 
                 "<img src=\"{$image->avatar->url()}\" class=\"file-preview-image\">");
      array_push($result['initialPreviewConfig'], [
        'caption' => $image->note ? $image->note : $image->avatar_file_name,
        'url'     => '/avatars/delete/' . $image->id,
        'key'     => $image->id
      ]);
    }

    return $result;
  }

  public static function ckeditor($image, $uploaded = 1)
  {
    return [
      'uploaded' => $uploaded,
      'fileName' => $image->avatar_file_name,
      'url'      => $image->avatar->url()
    ];
  }
} // END class ImageUploadReponsitory
