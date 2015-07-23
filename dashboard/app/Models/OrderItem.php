<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
  protected $fillable = [
    'ad_space_id', 'order_id', 'ad_space_snapshot_id',
    'from', 'to', 'original_price', 'price',
    'subtotal', 'score', 'quantity'
  ];

  protected $dates = [ 'from', 'to' ];

  public function order()
  {
    return $this->belongsTo('App\Models\Order')->withTrashed();
  }

  public function adSpace()
  {
    return $this->belongsTo('App\Models\AdSpace')->withTrashed();
  }
}
