<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model {

  Use SoftDeletes;

  protected $dates = ['deleted_at'];

  protected $fillable = ['order_seq', 'user_id', 'state', 'paid_at'];

  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }

  public function orderItems()
  {
    return $this->hasMany('App\Models\OrderItem');
  }

  public function scopeRecent($query)
  {
    return $query->orderBy('created_at', 'desc');
  }

  public function scopePendingProccess($query)
  {
    return $query->whereState(2);
  }

  public function isPending()
  {
    return $this->state == 2;
  }
}
