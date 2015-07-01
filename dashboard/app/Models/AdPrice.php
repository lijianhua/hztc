<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdPrice extends Model {

  protected $fillable = [
    'original_price', 'price', 'score',
    'from', 'to', 'send_count', 'sale_count'
  ];

  public function adSpace()
  {
    return $this->belongsTo('App\Models\AdSpace');
  }
}
