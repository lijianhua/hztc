<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
  protected $dates = ['apply_at', 'refund_at'];

  public function order()
  {
    return $this->belongsTo('App\Models\Order');
  }

  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }

  public function scopePendingProccess($query)
  {
    return $query->whereConfirmed(0);
  }

  public function scopeRecent($query)
  {
    return $query->orderBy('apply_at', 'desc');
  }
}
