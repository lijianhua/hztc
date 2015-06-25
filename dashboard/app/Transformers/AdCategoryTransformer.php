<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

use App\Models\AdCategory;

/**
 * AdCategory transformer for fractals
 *
 **/
class AdCategoryTransformer extends TransformerAbstract
{
  /**
   * List of resources possible to include
   *
   * @var array
   **/
  protected $availableIncludes = [ 'parent' ];

  public function transform(AdCategory $category)
  {
    return [
      'id'         => (int) $category->id,
      'parent_id'  => (int) $category->parent_id,
      'name'       => $category->name,
      'created_at' => (string) $category->created_at,
      'updated_at' => (string) $category->updated_at
    ];
  }

  public function includeParent(AdCategory $category)
  {
    $parent = $category->parent;

    return $this->item($parent, new AdCategoryTransformer());
  }
} // END class AdCategoryTransformer
