<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Refund extends Model {

	//
  public function Order()
  {
    return $this->hasOne('App\Models\Order', 'id', 'order_id');
  }

}
