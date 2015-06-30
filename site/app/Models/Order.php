<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model {

  Use SoftDeletes;

  protected $dates = ['deleted_at'];

  public function adSpaces()
  {
    return $this->belongsTo('App\Models\AdSpace', 'ad_space_id', 'id');
  }
}
