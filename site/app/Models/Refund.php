<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Refund extends Model {

	//
  public function orderItems()
  {
    return $this->hasOne('App\Models\OrderItem', 'order_id', 'order_id');
  }



  public function orders()
  {
    return $this->hasOne('App\Models\Order', 'id', 'order_id');
  }

}
