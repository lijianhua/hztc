<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model {

  //
  public function slideItems()
  {
    return $this->hasMany('App\Models\SlideItem');
  }

}
