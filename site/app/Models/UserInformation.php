<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
  protected $table = 'user_informations';

  protected $fillable = ['user_id', 'key', 'value', 'authority'];


  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }
}
