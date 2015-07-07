<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Iverberk\Larasearch\Traits\TransformableTrait;
use Iverberk\Larasearch\Traits\CallableTrait;

class AdCategory extends Model {
  use TransformableTrait, CallableTrait;

  /**
    * @return \Illuminate\Database\Eloquent\Relations
    **/
  public function adSpaces()
  {
    return $this->belongsToMany('App\Models\AdSpace', 'ad_category_ad_space');
  }

  public function parent()
  {
    return $this->belongsTo('App\Models\AdCategory', 'parent_id');
  }

  public function scopeRoots($query)
  {
    return $query->whereNull('parent_id');
  }
}
