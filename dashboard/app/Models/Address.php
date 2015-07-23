<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
  public function adSpaces()
  {
    return $this->hasMany('App\Models\AdSpace')->withTrashed();
  }
}
