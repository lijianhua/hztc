<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Iverberk\Larasearch\Traits\TransformableTrait;
use Iverberk\Larasearch\Traits\CallableTrait;

class AdPrice extends Model {
  use TransformableTrait, CallableTrait;

  protected $fillable = [
    'original_price', 'price', 'score',
    'from', 'to', 'send_count', 'sale_count',
    'position'
  ];

  public static $__es_enable = [];

  /**
    * @return \Illuminate\Database\Eloquent\Relations
    **/
  public function adSpace()
  {
    return $this->belongsTo('App\Models\AdSpace');
  }

  public function toArrayWithDateRange()
  {
    $array = $this->toArray();

    $from = date('Y/m/d', strtotime($this->from));
    $to   = date('Y/m/d', strtotime($this->to));
    $array['daterange'] = $from . ' - ' . $to;

    return $array;
  }
  public static function getLowPrice($results)
  {
    $LowPrice = $results->min('price');
    foreach($results as $result)
    {
      if($result->price==$LowPrice) 
      {
        return $result; 
      }
    }
    return null;
  }
}
