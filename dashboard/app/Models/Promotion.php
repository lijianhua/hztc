<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
  protected $dates    = ['start', 'end'];

  protected $fillable = [ 'title', 'stock', 'price', 'start', 'end' ];

  protected $dateFormat   = 'Y/m/d H:i';

  public function adSpace()
  {
    return $this->belongsTo('App\Models\AdSpace');
  }

  public function scopeProccessing($query)
  {
    $now = Carbon::now();
    return $query->where('start', '<=', $now)
                 ->where('end', '>=', $now);
  }

  public function scopeSoon($query)
  {
    $now = Carbon::now();
    return $query->where('start', '>', $now);
  }

  public function scopeExpired($query)
  {
    $now = Carbon::now();
    return $query->where('end', '<', $now);
  }

  public function isProccessing()
  {
    $now = Carbon::now();
    return $now >= $this->start && $now <= $this->end;
  }

  public function isSoon()
  {
    return $this->start > Carbon::now();
  }

  public function isExpired()
  {
    return $this->end < Carbon::now();
  }
}
