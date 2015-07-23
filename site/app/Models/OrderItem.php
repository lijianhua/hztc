<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Iverberk\Larasearch\Traits\TransformableTrait;

class OrderItem extends Model
{
  use TransformableTrait;
  protected $fillable = [
    'ad_space_id', 'order_id', 'ad_space_snapshot_id',
    'from', 'to', 'original_price', 'price',
    'subtotal', 'score', 'quantity'
  ];

  protected $dates = [ 'from', 'to' ];

  /**
    * @return \Illuminate\Database\Eloquent\Relations
    **/
  public function order()
  {
    return $this->belongsTo('App\Models\Order')->withTrashed();
  }

  /**
    * @return \Illuminate\Database\Eloquent\Relations
    **/
  public function adSpace()
  {
    return $this->belongsTo('App\Models\AdSpace')->withTrashed();
  }
}
