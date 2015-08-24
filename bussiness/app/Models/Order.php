<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Console\Scheduling\Schedule;

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
    return $query->orderBy('orders.created_at', 'desc');
  }

  public function scopePendingProccess($query)
  {
    return $query->whereState(2);
  }

  public function scopeNewest($query)
  {
    return $query->whereState(1);
  }

  public function scopeByUser($query, $user_id)
  {
    return $query
      ->leftJoin('order_items', 'order_items.order_id', '=', 'orders.id')
      ->leftJoin('ad_spaces', 'order_items.ad_space_id', '=', 'ad_spaces.id')
      ->where('ad_spaces.user_id', '=', $user_id);
  }

  public function isPending()
  {
    return $this->state == 2;
  }

  public function isNewest()
  {
    return $this->state == 1;
  }

  /**
   * 设置自动完成订单的定时人物
   *
   * @param $time time when finished
   *
   * @return void
   **/
  public function mayAutoFinished($time)
  {
    $schedule = new Schedule();
    $id       = $this->id;
    $table    = $this->table;

    $schedule->call(function() use ($id, $table) {
      DB::table($table)
        ->whereId($id)
        ->whereState(3)
        ->update(['state' => 4]);
    })->at($time);
  }
}
