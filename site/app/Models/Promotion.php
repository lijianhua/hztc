<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
  protected $dates    = ['start', 'end'];

  protected $fillable = [ 'title', 'stock', 'price', 'start', 'end', 'ad_space_id' ];

  public function adSpace()
  {
    return $this->belongsTo('App\Models\AdSpace');
  }

  //正在进行中
  public function scopeProccessing($query)
  {
    $now = Carbon::now();
    return $query->where('start', '<=', $now)
                 ->where('end', '>=', $now);
  }
  //即将开始的
  public function scopeSoon($query)
  {
    $now = Carbon::now();
    return $query->where('start', '>', $now);
  }
  //即将开始的和正在进行的
  public function scopeSoonOrProccessing($query)
  {
    $now = Carbon::now();
    return $query->where('end', '>', $now);
  }
  //已经过期的
  public function scopeExpired($query)
  {
    $now = Carbon::now();
    return $query->where('end', '<', $now);
  }
  //排序一最近的免费广告
  public function scopeRecent($query)
  {
    return $query->orderBy('created_at', 'desc');
  }

  //是否是在进行中的
  public function isProccessing()
  {
    $now = Carbon::now();
    return $now >= $this->start && $now <= $this->end;
  }
  //判断是否是即将开始的
  public function isSoon()
  {
    return $this->start > Carbon::now();
  }
  //判断是否已经过期
  public function isExpired()
  {
    return $this->end < Carbon::now();
  }
}
