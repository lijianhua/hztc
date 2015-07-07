<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Iverberk\Larasearch\Traits\TransformableTrait;

class Address extends Model
{
  use TransformableTrait;

  /**
    * @return \Illuminate\Database\Eloquent\Relations
    **/
  public function adSpaces()
  {
    return $this->hasMany('App\Models\AdSpace');
  }
}
