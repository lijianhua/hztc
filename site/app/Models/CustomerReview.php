<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerReview extends Model
{

  public function adSpace()
  {
    return $this->belongsTo('App\Models\AdSpace');
  }
}