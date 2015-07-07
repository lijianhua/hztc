<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Iverberk\Larasearch\Traits\TransformableTrait;
use Iverberk\Larasearch\Traits\CallableTrait;

class AdCategory extends \Baum\Node {
  use TransformableTrait, CallableTrait;

  protected $fillable = ['name'];

  public function adSpaces()
  {
    return $this->belongsToMany('App\Models\AdSpace', 'ad_category_ad_space');
  }
}
