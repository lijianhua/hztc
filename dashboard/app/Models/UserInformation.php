<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }

  public function scopeVerified($query)
  {
    return $query->whereIn('key', ['telphone', 'idcard', 'truthname']);
  }
}
