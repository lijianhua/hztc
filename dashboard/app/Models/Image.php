<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

class Image extends Model implements StaplerableInterface
{
  use EloquentTrait;

  protected $fillable = ['avatar', 'note'];

  public function __construct(array $attributes = array()) {
    $this->hasAttachedFile('avatar', [
      'styles' => [
        'medium' => '300x300',
        'thumb'  => '150x150',
        'cover'  => '280x160',
        'detail' => '480x280',
      ]
    ]);

    parent::__construct($attributes);
  }

  public function adSpaces()
  {
    return $this->belongsToMany('App\Models\AdSpace', 'ad_space_image', 'image_id', 'ad_space_id')->withTrashed();
  }
}
