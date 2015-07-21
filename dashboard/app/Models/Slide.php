<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model {
  protected $fillable = ['belongs_page'];

  public function slideItems()
  {
    return $this->hasMany('App\Models\SlideItem');
  }
}
