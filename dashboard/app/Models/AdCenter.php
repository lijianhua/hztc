<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Codesleeve\Stapler\ORM\EloquentTrait;
use Codesleeve\Stapler\ORM\StaplerableInterface;

class AdCenter extends Model implements StaplerableInterface
{
  use EloquentTrait;

  protected $fillable = ['name', 'avatar'];

  public function __construct(array $attributes = array()) {
    $this->hasAttachedFile('avatar');

    parent::__construct($attributes);
  }
}
