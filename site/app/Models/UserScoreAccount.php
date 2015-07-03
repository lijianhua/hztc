<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserScoreAccount extends Model {



  public function ScoreDetails()
  {
    return $this->hasMany('App\Models\UserScoreDetail');
  }
}
