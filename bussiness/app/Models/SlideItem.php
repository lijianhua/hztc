<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

class SlideItem extends Model implements StaplerableInterface
{
  use EloquentTrait;

  protected $guarded = ['id', 'slide_id'];

  public function __construct(array $attributes = array()) {
    $this->hasAttachedFile('avatar', [
      'styles' => [
        'medium' => '300x300',
        'thumb'  => '100x100',
      ]
    ]);

    parent::__construct($attributes);
  }

  public function slide()
  {
    return $this->belongsTo('App\Models\Slide');
  }
}
