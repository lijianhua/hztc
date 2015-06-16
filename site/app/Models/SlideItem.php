<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlideItem extends Model {

  //
  public function slide()
  {
    return $this->belongsTo('App\Models\Slide');
  }

}
