<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlideItem extends Model {
  protected $guarded = ['id', 'slide_id'];

  public function slide()
  {
    return $this->belongsTo('App\Models\Slide');
  }
}
