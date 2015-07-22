<?php

namespace App\Transformers;

use HTML;
use League\Fractal\TransformerAbstract;

use App\Models\AdSpace;

/**
 * AdSpace transformer for fractals
 **/
class AdSpaceTransformer extends TransformerAbstract
{
  protected $availableIncludes = ['categories'];

  public function transform(AdSpace $ad)
  {
    return [
      'id'          => (int) $ad->id,
      'title'       => $ad->title,
      'type'        => (int) $ad->type,
      'description' => $ad->description,
      'detail'      => $ad->detail,
      'avatar'      => [
        'initialPreview' => [
          HTML::image($ad->avatar->url(), $ad->avatar_file_name, ['class' => 'file-preview-image'])
        ]
      ],
      'images'      => [
        'initialPreview'       => $this->imagesPreview($ad),
        'initialPreviewConfig' => $this->imagesPreviewConfig($ad)
      ],
      'address'     => [
        'id'       => $ad->address->id,
        'province' => $ad->address->province,
        'city'     => $ad->address->city,
        'area'     => $ad->address->area
      ],
      'street_address' => $ad->street_address
    ];
  }

  public function imagesPreview($ad) {
    $images = [];

    foreach ($ad->images as $image) {
      array_push($images, HTML::image($image->avatar->url(), '', ['class' => 'file-preview-image']));
    }

    return $images;
  }

  public function imagesPreviewConfig($ad)
  {
    $configs = [];

    foreach ($ad->images as $image) {
      array_push($configs, [
        'caption' => $image->note ? $image->note : $image->avatar_file_name,
        'url'     => '/avatars/delete/' . $image->id,
        'key'     => $image->id
      ]);
    }

    return $configs;
  }

  public function includeCategories(AdSpace $ad)
  {
    return $this->collection($ad->categories, new AdCategoryTransformer());
  }
}

